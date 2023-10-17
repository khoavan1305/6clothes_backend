<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\order_detaill;
use App\Models\product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class OrderDetallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_detaill = order_detaill::all();
        return response()->json($order_detaill);
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
            'order_id' => 'required',
            'product_id' => 'required',
            'total' => 'required',
            'amount' => 'required',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }

        $order_detail = order_detaill::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'total' => $request->total,
            'amount' => $request->amount,
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        $response['data'] = $order_detail;
        
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order_detaill = order_detaill::where("order_id",$id)->get();
        if(is_null($order_detaill)){
            $arr = [
                'status' => False,
                'code' => 409,
                'messages' => "Đơn hàng không tồn tại",
                'data' => [],
            ];
            return response()->json($arr);
        }
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Chi tiết đơn hàng",
            'data' => $order_detaill
        ];
        return response()->json($arr);
    }

    /**
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}