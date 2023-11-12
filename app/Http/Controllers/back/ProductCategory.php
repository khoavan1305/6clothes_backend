<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\product_catelogy;
use Illuminate\Http\Request;

class ProductCategory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys=product_catelogy::search()->paginate('5');
        return view('dashboard.productCategory.category',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.productCategory.createcategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25',
        ]);
        product_catelogy::create($request->all());
        return redirect()->route('category.index')->with('thongbao','Thêm Thành Công'); 
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
    public function edit(product_catelogy $category)
    {
        return view('dashboard.productCategory.editcategory',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,product_catelogy $category)
    {
        $request->validate([
            'name' => 'required|max:25',
        ]);
        $category->update($request->all());
        return  redirect()->route('category.index')->with('thongbao','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product_catelogy $category)
    {
        $category->delete();
        return  redirect()->route('category.index')->with('thongbao','Cập nhật thành công');
    }
}