<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product_catelogy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $product_category  = product_catelogy::all();
        return response()->json($product_category );
        
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ],[
        'name.required' => 'Name không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $product_category = product_catelogy::where('name',$request['name'])->first();
        if($product_category){
            $response['status'] = false;
            $response['code'] = 409;
            $response['messeage'] = "Sản phẩm đã tồn tại!";
        }
        else{
        $product_category = product_catelogy::create([
            'name' => $request->name,
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        $response['data'] = $product_category;
        }
        return response()->json($response);
    }
    public function show(string $id)
    {
        $product_category = product_catelogy::find($id);
        if(is_null($product_category)){
            $arr = [
                'status' => False,
                'code' => 409,
                'messages' => "Sản phẩm không tồn tại",
                'data' => [],
            ];
            return response()->json($arr);
        }
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Chi tiết sản phẩm",
            'data' => $product_category
        ];
        return response()->json($arr);
    }
    public function edit(string $id)
    {
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
    }
}