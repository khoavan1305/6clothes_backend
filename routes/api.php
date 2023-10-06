<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login',[UserController::class, 'login']);
Route::put('/updatepw/{user}',[UserController::class, 'updatepw']);
Route::put('/updatettcn/{user}',[UserController::class, 'updatettcn']);
Route::put('/updatettc/{user}',[UserController::class, 'updatettc']);
Route::post('/changeAvatar/{user}',[UserController::class, 'changeAvatar']);
Route::post('/forGetPassword',[UserController::class, 'forGetPassword']);
Route::get('getPassword/{user}',[UserController::class,'getPass'])->name('get.pass');
Route::get('getUserId/{user}',[UserController::class,'getUserId']);
Route::post('getPassword',[UserController::class,'getPassword']);

Route::get('/NewP',[ProductController::class, 'NewP']);
Route::get('/HotP',[ProductController::class, 'HotP']);
Route::get('/show_category_id/{product}',[ProductController::class, 'show_category_id']);

Route::prefix('/')->group(function () {
    Route::resources([
        'user' => App\Http\Controllers\API\UserController::class,
        'brand' => App\Http\Controllers\API\BrandController::class,
        'blog' => App\Http\Controllers\API\BlogController::class,
        'product' => App\Http\Controllers\API\ProductController::class,
        'product_category' => App\Http\Controllers\API\ProductCategoryController::class,
        'order' => App\Http\Controllers\API\OrderController::class,
        'order_detaill' => App\Http\Controllers\API\OrderDetallController::class,
        'blog_comment' => App\Http\Controllers\API\BlogCommentController::class,
        'product_comment' => App\Http\Controllers\API\ProductCommentController::class,
   
    ]);
});