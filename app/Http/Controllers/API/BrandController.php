<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = brand::all();
        return  response()->json($brand);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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