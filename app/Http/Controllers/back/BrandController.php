<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Brands=brand::search()->paginate('5');
        return view('dashboard.brands.brand',compact('Brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brands.createbrand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25',
        ]);
        brand::create($request->all());
        return redirect()->route('brand.index')->with('thongbao','Thêm Thành Công');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.editbrand',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|max:25',
        ]);
        $brand->update($request->all());
        return  redirect()->route('brand.index')->with('thongbao','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return  redirect()->route('brand.index')->with('thongbao','Cập nhật thành công');
    }
}