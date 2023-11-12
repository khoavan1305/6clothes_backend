<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers=voucher::paginate('5');
        return view('dashboard.vouchers.voucher',compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.vouchers.createvoucher');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|max:25',
            'voucher' => 'required|max:25',
        ]);
        voucher::create($request->all());
        return redirect()->route('voucher.index')->with('thongbao','Thêm Thành Công');  
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
    public function edit(voucher $voucher)
    {
        return view('dashboard.vouchers.editvoucher',compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,voucher $voucher)
    {
        $request->validate([
            'code' => 'required|max:25',
            'voucher' => 'required|max:25',
        ]);
        $voucher->update($request->all());
        return  redirect()->route('voucher.index')->with('thongbao','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(voucher $voucher)
    {
        $voucher->delete();
        return  redirect()->route('voucher.index')->with('thongbao','Xóa thành công');
    }
}