<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\FrontendController;
use App\Http\Controllers\API\CartController;

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

Route::post('register',[AuthController::Class, 'register']);
Route::post('login',[AuthController::Class, 'login']);

Route::get('getCategory',[FrontendController::Class, 'category']);
Route::get('fetchproducts/{slug}',[FrontendController::Class, 'product']);
Route::get('viewproductdetail/{category_slug}/{product_slug}',[FrontendController::Class, 'viewproduct']);
Route::post('add-to-cart',[CartController::Class, 'addtocart']);
Route::get('cart',[CartController::Class, 'viewcart']);
Route::put('cart-updatequantity/{cart_id}/{scope}',[CartController::Class, 'updatequantity']);
Route::delete('delete-cartitem/{cart_id}',[CartController::Class, 'deleteCartitem']);

Route::middleware(['auth:sanctum','isAPIAdmin'])->group(function() {
    
    Route::get('/checkingAuthenticated',function() {
        return response()->json(['messege'=>'You are in', 'status'=>200], 200);
    });

    //Category
    Route::get('view-category',[CategoryController::Class, 'index']);
    Route::post('store-category',[CategoryController::Class, 'store']);
    Route::get('edit-category/{id}',[CategoryController::Class, 'edit']);
    Route::put('update-category/{id}',[CategoryController::Class, 'update']);
    Route::delete('delete-category/{id}',[CategoryController::Class, 'destroy']);
    Route::get('all-category',[CategoryController::Class, 'allcategory']);
    //Product
    Route::post('store-product',[ProductController::Class, 'store']);
    Route::get('view-product',[ProductController::Class, 'index']);
    Route::get('edit-product/{id}',[ProductController::Class, 'edit']);
    Route::post('update-product/{id}',[ProductController::Class, 'update']);

});

Route::middleware(['auth:sanctum'])->group(function() {    
    Route::post('logout',[AuthController::Class, 'logout']);
});

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */