<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product_comment;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
    }
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',     
                'regex:/[0-9]/',      
            ],
            'password_confirm' => 'required|same:password',
        ],[
        'name.required' => 'Name không để trống',
        'name.max' => 'Name không quá 25 ký tự',
        'email.required' => 'email không để trống',
        'email.email' => 'email không đúng định dạng',
        'password.required' => 'password không để trống',
        'password.min' => 'password ít nhất phải có 8 kí tự',
        'password.regex' => 'password ít nhất phải có 8 kí tự,1 kí tự Hoa,1 kí tự thường,1 chữ số',
        'password_confirm.same' => 'password_confirm không hợp lệ',
        'password_confirm.required' => 'password_confirm không để trống',
        
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
        $response['data'] = $user;
        }
        return response()->json($response);
    }
    public function show(string $token)
    {
        $user = User::where('token', $token)->first();
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
    public function getUserId(string $id)
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
    public function updatepw(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [  
            'old_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',      
            ],
            'confirm_password' => 'required|same:new_password',
        ],[
            'old_password.required' => 'password không để trống',
            'new_password.required' => 'new_password không để trống',
            'new_password.min' => 'new_password ít nhất phải có 8 kí tự',
            'new_password.regex' => 'new_password ít nhất phải có 8 kí tự,1 kí tự Hoa,1 kí tự thường,1 chữ số',
            'confirm_password.required' => 'password không để trống',
            'confirm_password.same' => 'Xác nhận mật khẩu không hợp lệ',
        ]);
        if ( $validator->fails()) {
            $arr=[
                'status' => false,
                'code'=> 409,
                'Message'=> "lỗi kiểm tra dữ liệu", 
                'data'=> $validator->errors(), 
            ];
            return response()->json($arr);
        }
        $users = User::where('id',$request->id)->get();
        if(password_verify ( $input['old_password'], $users[0]["password"] )){
            $user->password = $input['new_password'];
            $user->save();
            $arr=[
                'status'=> true,
                'code'=> 200,
                'Message'=> "Cập nhật thành công", 
                'data'=> $user
            ];
            return response()->json($arr);
        }else{
            $arr=[
                'status'=> false,
                'code'=> 401,
                'Message'=> "Mật khẩu cũ không chính xác", 
            ];
            return response()->json($arr);
        }
      
    }
    public function updatettcn(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [  
            'phone' => 'min:10',
        ],[
            'phone.min' => 'Ít nhất 10 số',
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
            $user->date = $input['date'];
            $user->address = $input['address'];
            $user->phone = $input['phone'];
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
    public function updatettc(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [  
            'name' => 'required',
        ],[
            'name.required' => 'Không để trống tên',
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
            'password' => 'required|min:8',
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
    public function changeAvatar(Request $request,User $user ){
        $proComment = product_comment::where('user_id',$user['id'])->get();
        if($request->has('images')){
            $file = $request->images;
            $ext = $request->file('images')->getClientOriginalExtension();
            $file_name ='avatar'.'-'.time().'.'.$ext;
            $request->merge(['images'=>$file_name]); 
            $request->images->move('C:\Users\84786\Downloads\abc\6clothes_FE\src\assets\img', $file_name);
            $user->avatar = $file_name;
            $user->save();
        $arr=[
            'status'=> true,
            'code'=> 200,
            'Message'=> "Cập nhật thành công", 
            'data'=> $user, 
        ];
        for ($i=0; $i < count($proComment); $i++) { 
            $proComment[$i]->avatar =$file_name ;
            $proComment[$i]->save();
        }

        return response()->json($arr);
        }else{
            $arr=[
                'status'=> false,
                'code'=> 409,
                'Message'=> "Cập nhật thất bại", 
            ];
            return response()->json($arr);
        }
    }
    public function forGetPassword(Request $request){
        $validator = Validator::make($request->all(), [  
            'email' => 'required|exists:users'
        ],[
            'email.required' => 'Vui lòng nhập địa chỉ email hợp lệ',
            'email.exists' => 'Email không tồn tại'
        ]);
        if ( $validator->fails()) {
            $arr=[
                'status' => false,
                'code'=> 409,
                'message'=> "Lỗi kiểm tra dữ liệu", 
                'data'=>$validator->errors(), 
            ];
            return response()->json($arr);
        }else{
            $token = strtoupper(Str::random(20));
            Cache::put('token', $token,60);
            $user = User::where('email',$request->email)->first();
            $user->update(['token' => $token]);
               Mail::send('emails.check_email_forget',compact('user',), function ($message) use ($user) {
                   $message->subject('6Clothes - Lấy lại mật khẩu');
                   $message->to($user->email, $user->name);
               });
               $arr =[
                "status" => true,
                "code" => 200,
                "message" => "Vui lòng kiểm tra e-mail để lấy lại mật khẩu (Sau 1 phút E-Mail sẽ hết hiệu lực)",
                "data"=>$user, 
               ];
               return response()->json($arr);
        }
    
    }
    public function getpass($user){
        $token = Cache::get("token", "default");
        $usernew = User::where('id',$user)->first();
            if($token === $usernew->token ){
                $arr =[
                    "status" => true,
                    "code" => 200,
                    "message" => "Token hợp lệ",
                    "data"=>$usernew, 
                   ];
                   Cache::put('id', $usernew->id,60);
                   
                   return Redirect::to("http://localhost:4200/getpass");
            }else{
                $arr =[
                    "status" => false,
                    "code" => 200,
                    "message" => "Mã Token đã hết hạn",
                   ];
                   return "<script>alert('Mã token đã hết hạn');
                   window.location='http://localhost:4200/';
                   </script>";

            }
    }
    public function getPassword(Request $request){
        $validator = Validator::make($request->all(), [  
            'new_password' => [
                'required',
                'string',
                'min:8',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',      
            ],
            'new_password_confirm' => 'required|same:new_password',
        ],[
            'new_password.required' => 'new_password không để trống',
            'new_password.min' => 'new_password ít nhất phải có 8 kí tự',
            'new_password.regex' => 'new_password ít nhất phải có 8 kí tự,1 kí tự Hoa,1 kí tự thường,1 chữ số',
            'confirm_password.required' => 'password không để trống',
            'confirm_password.same' => 'Xác nhận mật khẩu không hợp lệ',
        ]);
        $user_id = Cache::get("id", "default");
        $token = Cache::get("token", "default");
        if ( $validator->fails()) {
            $arr=[
                'status' => false,
                'code'=> 409,
                'message'=> "Lỗi kiểm tra dữ liệu", 
                'data'=>$validator->errors(), 
            ];
            return response()->json($arr);
        }
        $usernew = User::where('id',$user_id)->first();
        if($token === $usernew['token']){
            $usernew->password = Hash::make($request->new_password);
            $usernew->save();
            $arr=[
                'status' => true,
                'code'=> 200,
                'message'=> "Lấy mật khẩu thành công", 
                'token'=> $token, 
                'id'=> $user_id, 
            ];
            Cache::flush();
            return response()->json($arr);
        }else{
            $arr=[
                'status' => false,
                'code'=> 401,
                'message'=> "Mã token đã hết hạn", 
            ];
            return response()->json($arr);
        }
    }
}