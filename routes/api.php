<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login','ApiController@login');
Route::post('/upload-image','ApiController@imageUpload');
Route::post('/update-firebase-token','ApiController@updateFireBaseToken');
Route::post('/update-user-profile','ApiController@appUserProfileUpdate');
Route::post('/get-all-categories','ApiController@getAllCategories');
Route::post('/get-all-products','ApiController@getAllProducts');
Route::post('/add-to-cart','ApiController@addToCart');
Route::post('/view-cart','ApiController@viewCartOfUser');
Route::post('/delete-cart-product','ApiController@deleteProductFromCart');
Route::post('/add-delivery-address','ApiController@AddUsersDeliveryAddress');
Route::post('/get-delivery-address','ApiController@getDeliveryAddress');
Route::post('/delete-delivery-address','ApiController@deleteDeliveryAddress');
Route::post('/add-feedback','ApiController@addFeedbacks');
Route::get('/get-users-feedbacks','ApiController@getUsersFeedback');
Route::get('/all-promocodes','ApiController@allPromocodes');
Route::post('/apply-promocode','ApiController@applyPromoCode');
Route::post('/add-user-referal-code','ApiController@addReferalCode');
Route::post('/add-redemeed-data','ApiController@addRedemeedData');
Route::post('/get-wallet-data','ApiController@getAllWalletAmount');
Route::post('/old-transactions','ApiController@oldTransactions');
Route::post('/submit-transaction','ApiController@submitTransaction');
Route::get('/get-all-states','ApiController@getAllStates');
Route::post('/get-all-cities','ApiController@getAllCities');
Route::post('/added-wallet-by-bank','ApiController@addWalletAmountByUser');
Route::post('/get-plan','ApiController@getPlan');
