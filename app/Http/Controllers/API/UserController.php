<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return  response()->json($user);
    }
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'email' => 'required|email',
            'password' => 'required|min:6',
            
        ],[
        'name.required' => 'Name không để trống',
        'name.max' => 'Name không quá 25 ký tự',
        'email.required' => 'email không để trống',
        'email.email' => 'email không đúng định dạng',
        'password.required' => 'password không để trống',
        'password.min' => 'password ít nhất phải có 6 kí tự',

        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['messeage'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $user = User::where('email',$request['email'])->first();
        if($user){
            $response['status'] = false;
            $response['code'] = 401;
            $response['messeage'] = "Email đã tồn tại!";
        }
        else{
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>bcrypt($request->password) ,
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo tài khoản thành công";
        }
        return response()->json($response);
    }
    public function show(string $id)
    {
        $user = User::where('id', $id)->first();
        if(is_null($user)){
            $response['status'] = false;
            $response['code'] = 409;
            $response['messeage'] = "User không tồn tại";
            $response['data'] = [];
        }else{
            $response['status'] = true;
            $response['code'] = 200;
            $response['messeage'] = "Thông Tin User";
            $response['data'] = $user;
        }
        return  response()->json($response);
    }
    public function edit(string $id)
    {
        
    }
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:25',
            'password' => 'required|min:6',
        ],[
        'name.required' => 'Name không để trống',
        'name.max' => 'Name không quá 25 ký tự',
        'password.required' => 'password không để trống',
        'password.min' => 'password ít nhất phải có 6 kí tự',
        ]);
        if ( $validator->fails()) {
            $arr=[
                'status' => false,
                'code'=> 409,
                'Message'=> "lỗi kiểm tra dữ liệu", 
                'data'=> $validator->errors(), 
            ];
            return response()->json($arr);
        }else{
            $user->name = $input['name'];
            $user->password = $input['password'];
            $user->save();
            $arr=[
                'status'=> true,
                'code'=> 200,
                'Message'=> "Cập nhật thành công", 
                'data'=> $user
            ];
            return response()->json($arr);
        }
      
    }
    public function destroy(User $user)
    {
        $user->delete();
        $arr=[
            'status'=> true,
            'code'=> 200,
            'Message'=> "Xóa tài khoản thành công", 
            'data'=> []
        ];
        return response()->json($arr);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            
        ],[
        'email.required' => 'email không để trống',
        'email.email' => 'email không đúng định dạng',
        'password.required' => 'password không để trống',
        'password.min' => 'password ít nhất phải có 6 kí tự',

        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $credentials = $request->only('email','password');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = Str::random(20);
            $user = Auth::user();
            $user->token = $token;
            $user->save();
            $data['token'] = $token;
            $arr=[
                'status'=> true,
                'code'=> 200,
                'Message'=> "Đăng nhập thành công", 
                'data'=> Auth::user(),
            ];
            return response()->json($arr);
        }
        if(!Auth::attempt($credentials)){
            $arr=[
                'status'=> false,
                'code'=> 409,
                'Message'=> "Email hoặc mật khẩu không chính xác", 
            ];
            return response()->json($arr);
        }
    }
    
}