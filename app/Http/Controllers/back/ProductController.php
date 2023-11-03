<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\product;
use App\Models\product_catelogy;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $Products=product::orderBy('id','desc')->search()->paginate('10');
      return view('dashboard.products.product',compact('Products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = product_catelogy::orderBy('name','ASC')->select('id','name')->get();
        $brand = brand::orderBy('name','ASC')->select('id','name')->get();
        return view('dashboard.products.createProduct',compact('category','brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|max:25',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6',
        //     'level' => 'required|min:0|max:1|numeric:0,1',
        // ]);
        if($request->has('file_upload')){
            $file = $request->file_upload;
           $ext = $request->file_upload->extension();
            $file_name ='product'.'-'.time().'.'.$ext;
            $file->move(public_path('fonts/images'),$file_name);
        }
        $request->merge(['image'=>$file_name]); 
        product::create([
            'brand_id'=>$request->brand_id,
            'product_category_id'=>$request->product_category_id,  
            'name' => $request->name,
            'price'=>$request->price,
            'amount'=>$request->amount,
            'status'=>$request->status,
            'discount'=>$request->discount,
            'featured'=>$request->featured,
            'description'=>$request->description,
            'image'=>$request->image,
        ]);
        return redirect()->route('product.index')->with('thongbao','Thêm Sản Phẩm Thành Công');    
    }
    public function show(product $product)
    {
    }
    public function edit(product $product,)
    {
        $category = product_catelogy::orderBy('name','ASC')->select('id','name')->get();
        $brand = Brand::orderBy('name','ASC')->select('id','name')->get();
        return view('dashboard.products.editproduct',compact('product','category','brand'));
    }
    public function update(Request $request, product $product)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'product_category_id' => 'required',
            'price' => 'required',
            'file_upload' => 'max:10000|mimes:jpeg,png,doc,docs,pdf|required'

        ]);
        if($request->has('file_upload')){
            $file = $request->file_upload;
           $ext = $request->file_upload->extension();
            $file_name ='product'.'-'.time().'.'.$ext;
            $file->move(public_path('fonts/images'),$file_name);
        }
        $request->merge(['image'=>$file_name]); 
        $product->update([
            'brand_id'=>$request->brand_id,
            'product_category_id'=>$request->product_category_id,  
            'name' => $request->name,
            'price'=>$request->price,
            'amount'=>$request->amount,
            'status'=>$request->status,
            'discount'=>$request->discount,
            'featured'=>$request->featured,
            'description'=>$request->description,
            'image'=>$request->image,
        ]);
        
        return  redirect()->route('product.index')->with('thongbao','Cập nhật thành công');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return  redirect()->route('product.index')->with('thongbao','Xóa thành công');
    }
}