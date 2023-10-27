<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brand = brand::all();
        return  response()->json($brand);
    }

    public function create()
    {
        
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
        $brand = brand::where('name',$request['name'])->first();

        if($brand){
            $response['status'] = false;
            $response['code'] = 409;
            $response['messeage'] = "Tên thương hiệu đã tồn tại!";
        }
        else{
        $brand = brand::create([
            'name' => $request->name,
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        }
        return response()->json($response);
    }
    public function show(string $id)
    {
        $brand = brand::where('id',$id)->first();
        if(is_null($brand)){
            $arr = [
                'status' => False,
                'code' => 409,
                'messages' => "Thương hiệu không tồn tại",
                'data' => [],
            ];
            return response()->json($arr);
        }
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Chi tiết thương hiệu",
            'data' => $brand
        ];
        return response()->json($arr);
        
    }
    public function edit(string $id)
    {
        
    }
    public function update(Request $request,brand $brand)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
        ],[
        'name.required' => 'Tên không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $brand->name = $input['name'];
        $brand->save();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Cập nhật thành công",
            'data' => $brand
        ];
        return response()->json($arr);
    }
    public function destroy(brand $brand)
    {
        $brand->delete();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Xóa thành công",
            'data' => []
        ];
        return response()->json($arr);

    }
}