<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\API\AuthController;


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

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
 });

Route::resource('products', ProductController::class);
Route::get('/products', [ProductController::class,'index']);
Route::get('/categories', [CategoryController::class,'index']);
Route::get('/products/{id}', [ProductController::class,'show']);
Route::get('/products/categories/{category_id}', [ProductController::class,'getByCategories']);
Route::get('/products/users/{user_id}', [ProductController::class,'getByUsers']);
    // Route::resource('categories', CategoryController::class);
    // Route::resource('users', UserController::class);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


//  Route::get('sneakers/brand/{id}',[SneakersController::class,'getByBrand']);

//  Route::get('sneakers/type/{id}',[SneakersController::class,'getByType']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::resource('products', ProductController::class)->only(['store', 'update', 'destroy']);

    Route::post('products',[ProductController::class,'store']);
    Route::put('products/{id}',[ProductController::class,'update']);
    Route::delete('products/{id}',[ProductController::class,'destroy']);

    Route::get('myProduct',[ProductController::class,'myProduct']);

    Route::post('/logout',[AuthController::class,'logout']);
});