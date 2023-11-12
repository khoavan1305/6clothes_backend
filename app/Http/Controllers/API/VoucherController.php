<?php

namespace App\Http\Controllers\API;

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
    public function show(string $id)
    {
        $voucher = voucher::where('code',$id)->first();
        if (is_null($voucher)) {
            $arr = [
                "status" => false,
                "code"=> 409,
                "msg"=> "Mã Voucher Sai",
                "data"=> $voucher,
            ];
            return response()->json($arr);
        }
            $arr = [
                "status" => true,
                "code"=> 200,
                "msg"=> "Mã Voucher Hợp Lệ",
                "data"=> $voucher,
            ];
        return response()->json($arr);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}