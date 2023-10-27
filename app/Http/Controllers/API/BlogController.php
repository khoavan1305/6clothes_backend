<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    public function index()
    {
        $blog = blog::all();
        return response()->json($blog);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'category' => 'required',
            'content' => 'required',
        ],[
        'name.required' => 'Name không để trống',
        'name.image' => 'image không để trống',
        'name.category' => 'category không để trống',
        'name.content' => 'content không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $blog = blog::where('title',$request['title'])->first();
        if($blog){
            $response['status'] = false;
            $response['code'] = 409;
            $response['messeage'] = "Tên tiêu đề đã tồn tại!";
        }
        else{
        $blog = blog::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'image' => $request->image,
            'category' => $request->category,
            'content' => $request->content,
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        $response['data'] = $blog;
        }
        return response()->json($response);
    }
    public function show(string $id)
    {
        $blog = blog::where('id',$id)->first();
        if(is_null($blog)){
            $arr = [
                'status' => False,
                'code' => 409,
                'messages' => "Blog không tồn tại",
                'data' => [],
            ];
            return response()->json($arr);
        }
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Chi tiết blog",
            'data' => $blog
        ];
        return response()->json($arr);
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request,blog $blog)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'category' => 'required',
            'content' => 'required',
        ],[
        'name.required' => 'Name không để trống',
        'name.image' => 'image không để trống',
        'name.category' => 'category không để trống',
        'name.content' => 'content không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $blog->title = $input['title'];
        $blog->image = $input['image'];
        $blog->category = $input['category'];
        $blog->content = $input['content'];
        $blog->save();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Cập nhật thành công",
            'data' => $blog
        ];
        return response()->json($arr);
    }
    public function destroy(blog $blog)
    {
        $blog->delete();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Xóa thành công",
            'data' => []
        ];
        return response()->json($arr);
    }
}