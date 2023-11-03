<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = product::search()->get();
        return response()->json($product);
    }
    public function NewP()
    {
        $product = product::where('featured',2)->limit(8)->get();
        return response()->json($product);
    }
    public function HotP()
    {
        $product = product::where('featured',1)->limit(8)->get();
        return response()->json($product);
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'featured' => 'required',
            'image' => 'required',
        ],[
        'name.required' => 'Name không để trống',
        'price.required' => 'price không để trống',
        'amount.required' => 'amount không để trống',
        'featured.required' => 'featured không để trống',
        'image.required' => 'image không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        $product = product::where('name',$request['name'])->first();
        if($product){
            $response['status'] = false;
            $response['code'] = 409;
            $response['messeage'] = "Sản phẩm đã tồn tại!";
        }
        else{
            $product = product::create([
            'brand_id' => $request->brand_id,
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'price' =>$request->price,
            'discount' =>$request->discount,
            'amount' =>$request->amount,
            'tag' => $request->tag,
            'featured' => $request->featured,
            'image' => $request->image
        ]);
        $response['status'] = true;
        $response['code'] = 200;
        $response['messeage'] = "Tạo thành công";
        $response['data'] = $product;
        }
        return response()->json($response);
    }
    public function show(string $id)
    {
        $product = product::find($id);
        if(is_null($product)){
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
            'data' => $product
        ];
        return response()->json($arr);
    }
    public function show_category_id(string $id)
    {
        $product_category = product::where('product_category_id',$id)->limit(4)->get();
        if(is_null($product_category)){
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
            'data' => $product_category,
        ];
        return response()->json($arr);
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request,product $product)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'price' => 'required',
            'amount' => 'required',
            'featured' => 'required',
            'image' => 'required',
        ],[
        'name.required' => 'Name không để trống',
        'name.unique' => 'Sản phẩm đã tồn tại',
        'price.required' => 'price không để trống',
        'amount.required' => 'amount không để trống',
        'featured.required' => 'featured không để trống',
        'image.required' => 'image không để trống',
        ]);
        if ( $validator->fails()) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['Message'] = 'Lỗi kiểm tra dữ liệu'; 
            $response['data'] = $validator->errors(); 
            return response()->json($response);
        }
        
        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->content = $input['content'];
        $product->price = $input['price'];
        $product->discount = $input['discount'];
        $product->amount = $input['amount'];
        $product->tag = $input['tag'];
        $product->featured = $input['featured'];
        $product->image = $input['image'];
        $product->save();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Cập nhật thành công",
            'data' => $product
        ];
        return response()->json($arr);
    }
    public function destroy(product $product)
    {
        $product->delete();
        $arr = [
            'status' => True,
            'code' => 200,
            'messages' => "Xóa thành công",
            'data' => []
        ];
        return response()->json($arr);
    }
}