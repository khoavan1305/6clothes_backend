<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\order_detaill;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = order::all();
        return response()->json($order);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'pttt' => 'required',
        ],[
        'first_name.required' => 'first_name không để trống',
        'last_name.required' => 'last_name không để trống',
        'country.required' => 'country không để trống',
        'street_address.required' => 'street_address không để trống',
        'city.required' => 'city không để trống',
        'email.required' => 'email không để trống',
        'email.email' => 'email không đúng định dạng',
        'phone.required' => 'phone không để trống',
        'pttt.required' => 'Phương thức thanh toán không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $token = strtoupper(Str::random(20));
        $order = order::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'email' => $request->email,
            'phone' => $request->phone,
            'pttt' => $request->pttt,
            'note' => $request->note,
            'token' => $token,
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        $response['data'] = $order;
        
        return response()->json($response);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = order::find($id);
        if(is_null($order)){
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
            'data' => $order
        ];
        return response()->json($arr);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'pttt' => 'required',
        ],[
        'first_name.required' => 'first_name không để trống',
        'last_name.required' => 'last_name không để trống',
        'country.required' => 'country không để trống',
        'street_address.required' => 'street_address không để trống',
        'city.required' => 'city không để trống',
        'email.required' => 'email không để trống',
        'email.email' => 'email không đúng định dạng',
        'phone.required' => 'phone không để trống',
        'pttt.required' => 'Phương thức thanh toán không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $token = strtoupper(Str::random(20));

        $order->first_name = $input['first_name'];
        $order->last_name = $input['last_name'];
        $order->company_name = $input['company_name'];
        $order->country = $input['country'];
        $order->street_address = $input['street_address'];
        $order->city = $input['city'];
        $order->email = $input['email'];
        $order->phone = $input['phone'];
        $order->pttt = $input['pttt'];
        $order->note = $input['note'];
        $order->token =$token ;
        $order->save();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Cập nhật thành công",
            'data' => $order
        ];
        return response()->json($arr);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        $order->delete();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Xóa thành công",
            'data' => []
        ];
        return response()->json($arr);
    }
}