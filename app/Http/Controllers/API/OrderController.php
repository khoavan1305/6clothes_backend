<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\order_detaill;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
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

    public function create()
    {
    }

    public function store(Request $request)
    {
        Cache::put('cart', $request['array']);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'pttt' => 'required',
        ],[
        'first_name.required' => 'first_name không để trống',
        'last_name.required' => 'last_name không để trống',
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
        Cache::put('token', $token,86400);
        $oderId = time();
        $order = order::create([
            'id' => $oderId,
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'email' => $request->email,
            'phone' => $request->phone,
            'pttt' => $request->pttt,
            'note' => $request->note,
            'total' => $request->total,
            'token' => $token,
        ]);
        $orderdetaill = Cache::get("cart", "default");
        foreach ($orderdetaill  as $key => $value) {
            $order_details = order_detaill::create([
                'order_id' => $oderId,
                'product_id' => $value['id'],
                'amount' => $value['quantity'],
                'size' => $value['size'],
                'color' => $value['color'],
            ]);
        }
        Mail::send('emails.check_order',compact('order','orderdetaill'), function ($message) use ($order,$orderdetaill) {
            $message->subject('6Clothes - Xác nhận đơn hàng');
            $message->to($order->email, $order->first_name);
        });
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        $response['data'] = $order;
        
        return response()->json($response);
    }
    public function checkOrder(Request $request, $order, $token){
        $token = Cache::get("token", "default");
        $new_order = order::where('id',$order)->first();
            if($token === $new_order->token || $new_order->status == 1 ){
                $arr =[
                    "status" => true,
                    "code" => 200,
                    "message" => "Token hợp lệ",
                    "data"=>$new_order, 
                   ];
                   $new_order->update([
                    'status' => 1
                 ]);
                    Cache::flush(); 
                   return "<script>alert('Xác nhận đơn hàng thành công');
                   window.location='http://localhost:4200/';
                   </script>";
            }else{
                $arr =[
                    "status" => false,
                    "code" => 200,
                    "message" => "Mã Token đã hết hạn",
                   ];
                   $new_order->update([
                    'status' => 2
                 ]);
                 Cache::flush(); 
                   return "<script>alert('Thời gian xác nhận đã hết hạn.Đơn hàng đã bị hủy');
                   window.location='http://localhost:4200/';
                   </script>";
            }
    }
    public function show(string $id)
    {
        $order = order::where("user_id",$id)->get();
        if(is_null($order)){
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
            'data' => $order
        ];
        return response()->json($arr);
    }
    public function getOderUser(string $id)
    {
        $order = order::orderBy('user_id', 'asc')->first();
        if(is_null($order)){
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
            'data' => $order
        ];
        return response()->json($arr);
    }
    public function getOrderID(string $id)
    {
        $order = order::where("id",$id)->get();
        if(is_null($order)){
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
            'data' => $order
        ];
        return response()->json($arr);
    }

    public function edit(string $id)
    {
    }

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