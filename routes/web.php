<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/storagess', function () {
    Artisan::call('storage:link');
    return "yooo";
});
Route::get('/', function () {
    // return url('/login');
    return redirect()->route('login');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::post('login-dashboard','AdminController@login')->name('login-dashboard');
Route::get('dashboard','AdminController@index')->name('dashboard');
Route::get('category-actions','AdminController@categoryActions')->name('category-actions');
Route::get('sub-category-actions','AdminController@subCategoryActions')->name('sub-category-actions');
Route::get('products-actions','AdminController@getProdects')->name('products-actions');
Route::get('promocode','AdminController@promoCode')->name('promocode');
Route::get('app-users','AdminController@appUsers')->name('app-users');
Route::get('deliveries','AdminController@deliveries')->name('deliveries');
Route::get('days','AdminController@days')->name('days');
Route::get('plan-actions','AdminController@plans')->name('plan-actions');

#ajax routing 
#cateegory
Route::post('get-categories','AjaxController@getCategories');
Route::post('add-update','AjaxController@addOrUpdate');
Route::post('image-upload','AjaxController@imageUpload');
Route::post('delete-category','AjaxController@deleteCategory');
#subcategory
Route::get('get-subcategory','AjaxController@getSubcategory');
Route::post('add-update-subcategory','AjaxController@addUpdateSubcategory');
Route::post('delete-subcategory','AjaxController@deleteSubcategory');
Route::post('subcategory-image-upload','AjaxController@SubCatImageUpload');
#plan
Route::get('get-plan','AjaxController@getPlan');
Route::post('add-update-plan','AjaxController@addUpdatePlan');
Route::post('delete-plan','AjaxController@deletePlan');
#products
Route::get('get-products','AjaxController@getProducts');
Route::post('add-update-product','AjaxController@addUpdateProduct');
Route::post('delete-product','AjaxController@deleteProduct');
#days
Route::get('get-days','AjaxController@getDays');
Route::post('add-update-day','AjaxController@addUpdateDay');
Route::post('delete-day','AjaxController@deleteDay');
#promocode
Route::post('get-promo-codes','AjaxController@getAllPromocodes');
Route::post('add-update-promocode','AjaxController@addUpdatePromocode');
Route::post('delete-promocode','AjaxController@deletePromocode');
Route::post('promocode-image-upload','AjaxController@promocodeImageUpload');
#user
Route::post('get-user-data','AjaxController@getUserData');
Route::post('delete-user','AjaxController@deleteUser');
Route::post('get-user-delivery-address','AjaxController@getuserDeliveryAddress');
Route::post('user-transactions','AjaxController@getUserTransaction');
Route::post('user-feedbacks','AjaxController@getUserFeedbacks');

Route::post('get-deliveries','AjaxController@getDeliveries');
Route::post('change-delivery-status','AjaxController@changeDeliveryStatus');
Route::post('get-invoice-data','AjaxController@getInvoiceData');

