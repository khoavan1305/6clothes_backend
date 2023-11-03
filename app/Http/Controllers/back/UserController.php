<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $Users=User::search()->paginate('15');    
        return view('dashboard.users.user',compact('Users'));
    }
    public function create()
    {
        return view('dashboard.users.createUser');

    }
    public function store(Request $request)
    {
        $request->validate([
                    'name' => 'required|max:25',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                    'level' => 'required|min:1|max:2|numeric:1,2',
            'file_upload' => 'max:10000|mimes:jpg,jpeg,png,doc,docs,pdf|required'
                ]);
                if($request->has('file_upload')){
                    $file = $request->file_upload;
                   $ext = $request->file_upload->extension();
                    $file_name ='product'.'-'.time().'.'.$ext;
                    $file->move(public_path('fonts/avatars'),$file_name);
                }
                $request->merge(['avatar'=>$file_name]); 
                User::create($request->all());
                return redirect()->route('user.index')->with('thongbao','Thêm User Thành Công');   
    }
    public function show(User $user)
    {
    }
    public function edit(User $user)
    {
        return view('dashboard.users.edituser',compact('user'));
    }
    public function update(Request $request,User  $user)
    {
        $request->validate([
            'name' => 'required|max:25',
            'password' => 'required|min:6',
            'level' => 'required|min:1|max:2|numeric:1,2',
            'file_upload' => 'max:10000|mimes:jpg,jpeg,png,doc,docs,pdf|required'
        ]);
        if($request->has('file_upload')){
            $file = $request->file_upload;
           $ext = $request->file_upload->extension();
            $file_name ='product'.'-'.time().'.'.$ext;
            $file->move(public_path('fonts/avatars'),$file_name);
        }
        $request->merge(['avatar'=>$file_name]);
        Hash::make($request->password);
        $user->update($request->all());
        return  redirect()->route('user.index')->with('thongbao','Cập nhật thành công');
    }
    public function destroy(User $user)
    {
            $user->delete();
            return  redirect()->route('user.index')->with('thongbao','Xóa thành công');
    }
    public function login(){
        return view('dashboard.login');
    }
    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
           
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'password' => 'Email or password không chính xác',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}