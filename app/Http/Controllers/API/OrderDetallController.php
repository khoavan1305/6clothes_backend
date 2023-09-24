<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\order_detaill;
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
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
            'country' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ],[
        'first_name.required' => 'first_name không để trống',
        'last_name.required' => 'last_name không để trống',
        'company_name.required' => 'company_name không để trống',
        'country.required' => 'country không để trống',
        'street_address.required' => 'street_address không để trống',
        'city.required' => 'city không để trống',
        'email.required' => 'email không để trống',
        'email.email' => 'email không đúng định dạng',
        'phone.required' => 'phone không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }

        $order_detaill = order_detaill::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        $response['data'] = $order_detaill;
        
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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