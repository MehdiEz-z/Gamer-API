<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UpdateProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('user/{user}', [UpdateProfileController::class, 'UpdateProfile']);


Route::group(['middleware'=>'auth:sanctum'], function(){
    // Products
    Route::group(['controller' => ProductController::class], function (){
        Route::get('products', 'index');
        Route::post('products', 'store')->middleware('permission:add product');
        Route::get('product/{id}', 'show')->middleware('permission:show product');
        Route::put('product/{id}', 'update')->middleware('permission:edit every product|edit my category');
        Route::delete('product/{id}', 'destroy')->middleware('permission:delete every product|delete my product');
    });
    // Categories
    Route::group(['controller' => CategoryController::class], function () {
        Route::get('categories', 'index')->middleware('permission:show category');
        Route::post('categories', 'store')->middleware('permission:add category');
        Route::get('category/{id}', 'show')->middleware('permission:show category');
        Route::put('category/{id}', 'update')->middleware('permission:edit category');
        Route::delete('category/{id}', 'destroy')->middleware('permission:delete category');
    });
});




