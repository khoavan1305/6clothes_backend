<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\product_comment;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product_comment=product_comment::paginate('5');
        return view('dashboard.comment',compact('Product_comment'));
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
    public function show(product_comment $product_comment)
    {
        //
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
    public function update(Request $request, product_comment $product_comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product_comment $product_comment)
    {
        //
    }
}