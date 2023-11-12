<?php

use App\Http\Controllers\back\AdminController;
use App\Http\Controllers\back\OrderController;
use App\Http\Controllers\back\OrderdetailController;
use App\Http\Controllers\back\ProductController;
use App\Http\Controllers\back\CommentController;
use App\Http\Controllers\back\UserController;
use App\Http\Controllers\back\BrandController;
use App\Http\Controllers\back\ProductCategory;
use App\Http\Controllers\back\VoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login',[UserController::class,'login_action'])->name('login.action');
Route::get('/logout',[UserController::class,'logout'])->name('logout');

Route::get('/unblock/{user}',[UserController::class,'unblock'])->name('unblock');
Route::get('/block/{user}',[UserController::class,'block'])->name('block');

Route::prefix('admin')->group(function () {
        Route::get('/',[AdminController::class,'index'])->name('admin.dashboard');
        Route::resources([
        'user' => UserController::class,
        'product' => ProductController::class,
        'comment' => CommentController::class,
        'order' => OrderController::class,
        'brand' => BrandController::class,
        'category' => ProductCategory::class,
        'orderdetail' => OrderdetailController::class,
        'voucher' => VoucherController::class,
        ]);
    });