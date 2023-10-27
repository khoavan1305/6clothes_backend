<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\blog_comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index()
    {
        $blog_comment = blog_comment::all();
        return response()->json($blog_comment);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'messages' => 'required',
        ],[
        'email.required' => 'Email không để trống',
        'name.required' => 'name không để trống',
        'messages.required' => 'messages không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }

        $blog_comment = blog_comment::create([
            'user_id' => $request->user_id,
            'blog_id' => $request->blog_id,
            'email' => $request->email,
            'name' => $request->name,
            'messages' => $request->messages,
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        $response['data'] = $blog_comment;
        
        return response()->json($response);
    }

    public function show(string $id)
    {
        $blog_comment = blog_comment::find($id);
        if(is_null($blog_comment)){
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
            'data' => $blog_comment
        ];
        return response()->json($arr);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, blog_comment $blog_comment)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'messages' => 'required',
        ],[
        'email.required' => 'Email không để trống',
        'name.required' => 'name không để trống',
        'messages.required' => 'messages không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $blog_comment->name = $input['name'];
        $blog_comment->email = $input['email'];
        $blog_comment->messages = $input['messages'];
        $blog_comment->save();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Cập nhật thành công",
            'data' => $blog_comment
        ];
        return response()->json($arr);
    }
    public function destroy(blog_comment $blog_comment)
    {
        $blog_comment->delete();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Xóa thành công",
            'data' => []
        ];
        return response()->json($arr);
    }
}