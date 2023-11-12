<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\product_comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product_comment=product_comment::search()->paginate('10');
        return view('dashboard.comments.comment',compact('Product_comment'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $comment = product_comment::where("id",$id)->first();
        return view("dashboard.comments.commentdetaill",compact("comment"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product_comment $product_comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comment = product_comment::where("id",$id)->first();
        $comment->update([
            'status'=>$request->status,
        ]);
        return  redirect()->route('comment.index')->with('thongbao','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product_comment = product_comment::where("id",$id)->first();
        $product_comment->delete();
        return  redirect()->route('comment.index')->with('thongbao','Xóa thành công');
    }
}