<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCommentController extends Controller
{
   
    public function index()
    {
        $productCmt = product_comment::all();
        return response()->json($productCmt);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'messages' => 'required|min:3',
            'name' => 'required',
            'email' => 'required',
            'rating' => 'required',
        ],[
        'messages.required' => 'messages không để trống',
        'messages.min' => 'messages ít nhất 10 ký tự',
        'name.required' => 'name không để trống',
        'email.required' => 'email không để trống',
        'rating.required' => 'rating không để trống',
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
        $productCmt = product_comment::create([
            'rating' => $request->rating,
            'messages' => $request->messages,
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => $request->iduser,
            'product_id' => $request->idpro,
        ]);
        $arr=[
            'status' => true,
            'code' => 200,
            'messeage' => "Gửi bình luận thành công",
            'data' => $productCmt,
        ];
        return response()->json($arr);
    }
    public function show(string $id)
    {
        $productCmt = product_comment::where('product_id',$id)->get();
        if(is_null($productCmt)){
            $arr = [
                'status' => False,
                'code' => 409,
                'messages' => "Bình luận không tồn tại",
                'data' => [],
            ];
            return response()->json($arr);
        }else{
            $arr = [
                'status' => True,
                'code' => 200,
                'messages' => "Chi tiết Bình luận",
                'data' => $productCmt
            ];
            return response()->json($arr);
        }
    
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(product_comment $productCmt)
    {
        $productCmt->delete();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Xóa thành công",
            'data' => []
        ];
        return response()->json($arr);
    }
}