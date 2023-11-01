<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Support\Facades\DB;
use App\Models\product;
use App\Models\product_comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\brand;
use App\Models\order;
use App\Models\productCategory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function index(){
        $Users=User::all();
        $Products=product::all();
        $Order=order::all();
        $Orderdone=order::where("status",4)->get();
        $total = 0;
        foreach ($Orderdone as $key ) {
            $total += $key['total'];
        }
        return view('dashboard.index',compact('Users','Products','Order','total','Orderdone'));
    }
   
}