<?php

use App\Http\Controllers\back\AdminController;
use App\Http\Controllers\back\OrderController;
use App\Http\Controllers\back\OrderdetailController;
use App\Http\Controllers\back\ProductController;
use App\Http\Controllers\back\CommentController;
use App\Http\Controllers\back\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*  
BACK END
*/

//////////////////////////////////////////////////////////////////////////////////
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login',[UserController::class,'login_action'])->name('login.action');
Route::get('/logout',[UserController::class,'logout'])->name('logout');

Route::prefix('admin')->group(function () {
        Route::get('/',[AdminController::class,'index'])->name('admin.dashboard');
        Route::resources([
        'user' => UserController::class,
        'product' => ProductController::class,
        'comment' => CommentController::class,
        'order' => OrderController::class,
        // 'brand' => BrandController::class,
        'orderdetail' => OrderdetailController::class,
        ]);
    });