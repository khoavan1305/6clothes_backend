<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product_like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productLike = product_like::all();
        return response()->json($productLike);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'unique:product_like,product_id,'.'user_id',
        ],[
        'product_id.unique' => 'Sản phẩm đã được thêm',
        ]);
        if ( $validator->fails()) {
            $arr=[
                'status' => false,
                'code' => 409,
                'messeage' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors(),
            ];
            return response()->json($arr);
        }
    $productLike = product_like::create([
        'name' => $request->name,
        'image' => $request->image,
        'price' => $request->price,
        'user_id' => $request->user_id,
        'product_id' => $request->product_id,
    ]);
    $arr=[
        'status' => true,
        'code' => 200,
        'messeage' => "Thêm sản phẩm yêu thích thành công!",
        'data' => $productLike,
    ];
    return response()->json($arr);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product_like = product_like::where('user_id',$id)->get();
        if(is_null($product_like)){
            $arr = [
                'status' => False,
                'code' => 409,
                'messages' => "không tồn tại",
                'data' => [],
            ];
            return response()->json($arr);
        }else{
            $arr = [
                'status' => True,
                'code' => 200,
                'messages' => "Chi tiết sản phẩm yêu thích",
                'data' => $product_like
            ];
            return response()->json($arr);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product_like $product_like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product_like $product_like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product_like $product_like)
    {
        $product_like->delete();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Xóa thành công",
            'data' => []
        ];
        return response()->json($arr);
    }
}