<?php

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\ApiController as ControllersApiController;
use App\Models\CmsPage;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\API')->group(function () {
    // Register User for react app
    Route::post('register-user', [APIController::class, 'registerUser']);
    // Login user for react app
    Route::post('login-user', [APIController::class, 'loginUser']);
    // Update user profile
    Route::post('update-user', [APIController::class, 'updateUser']);

    // CMS Pages
    $cmsUrls = CmsPage::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach ($cmsUrls as $url) {
        Route::get($url, [APIController::class, 'cmsPage']);
    }

    // Categories menu api
    Route::get('menu', [APIController::class, 'menu']);
    // listing Products API
    Route::get('listing/{url}', [APIController::class, 'listing']);
    // Product Detail api
    Route::get('detail/{productid}', [APIController::class, 'productDetail']);

    // Add To Cart Api
    Route::post('add-to-cart', [APIController::class, 'addToCart']);
    // Carts
    Route::get('cart/{userid}', [APIController::class, 'cart']);

    // Delete Cart Item
    Route::get('delete-cart-item/{cartid}', [APIController::class, 'deleteCartItem']);

    // Checkout API
    Route::get('checkout/{userid}', [APIController::class, 'checkout']);

    // Place Order
    Route::post('place-order/{userid}', [APIController::class, 'placeOrder']);
    Route::get('user-orders/{userid}',[APIController::class,'userOrders']);
});
