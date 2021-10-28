<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeBannerController;


use App\Http\Controllers\Front\FrontController;
use App\Mail\CustomerVerification;


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

// Route::get('/', function () {
//     return view('welcome');
// });

//------------ Admin--Login--Routes------------
Route::get('admin',[AdminController::class,'index']);
Route::post('admin',[AdminController::class,'login_auth']);


Route::group(['middleware'=>'admin_auth'], function () {
    //------------ Dashboard------------
    Route::get('admin/dashboard',[dashboardController::class,'index']);
    //---------- Category ------------
    Route::get('admin/category',[categoryController::class,'show']);
    Route::get('admin/category/manage_category/{id?}',[categoryController::class,'manage_category']);
    Route::post('admin/category/manage_category',[categoryController::class,'manage_category_process']);
    Route::get('admin/category/manage_category/{id}/status/{status_value}',[categoryController::class,'status']);
    
    Route::get('admin/category/delete_category/{id}',[categoryController::class,'delete_category']);
    
     //---------- Coupon ------------
     Route::get('admin/coupon',[CouponController::class,'show']);
     Route::get('admin/coupon/manage_coupon/{id?}',[CouponController::class,'manage_coupon']);
     Route::post('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon_process']);
     Route::get('admin/coupon/manage_coupon/{id}/status/{status_value}',[CouponController::class,'status']);
     Route::get('admin/coupon/delete_coupon/{id}',[CouponController::class,'delete_coupon']);
      //---------- Size ------------
      Route::get('admin/size',[SizeController::class,'show']);
      Route::get('admin/size/manage_size/{id?}',[SizeController::class,'manage_size']);
      Route::post('admin/size/manage_size',[SizeController::class,'manage_size_process']);
      Route::get('admin/size/manage_size/{id}/status/{status_value}',[SizeController::class,'status']);
      Route::get('admin/size/delete_size/{id}',[SizeController::class,'delete_size']);
        //---------- Color ------------
        Route::get('admin/color',[ColorController::class,'show']);
        Route::get('admin/color/manage_color/{id?}',[ColorController::class,'manage_color']);
        Route::post('admin/color/manage_color',[ColorController::class,'manage_color_process']);
        Route::get('admin/color/manage_color/{id}/status/{status_value}',[ColorController::class,'status']);
        Route::get('admin/color/delete_color/{id}',[ColorController::class,'delete_color']);
          //---------- Product ------------
          Route::get('admin/product',[ProductController::class,'show']);
          Route::get('admin/product/manage_product/{id?}',[ProductController::class,'manage_product']);
          Route::post('admin/product/manage_product',[ProductController::class,'manage_product_process']);
          Route::get('admin/product/manage_product/{id}/status/{status_value}',[ProductController::class,'status']);
          Route::get('admin/product/delete_attr/{id}/{pid}',[ProductController::class,'delete_attribute']);
          Route::get('admin/product/delete_product/{id}',[ProductController::class,'delete_product']);
          Route::get('admin/product/single_img_delete/{id}/{pid}',[ProductController::class,'delete_single_img']);
           //---------- Brand ------------
     Route::get('admin/brand',[BrandController::class,'show']);
     Route::get('admin/brand/manage_brand/{id?}',[BrandController::class,'manage_brand']);
     Route::post('admin/brand/manage_brand',[BrandController::class,'manage_brand_process']);
     Route::get('admin/brand/manage_brand/{id}/status/{status_value}',[BrandController::class,'status']);
     Route::get('admin/brand/delete_brand/{id}',[BrandController::class,'delete_brand']);
      
     //---------- Customers ------------
     Route::get('admin/customer',[CustomerController::class,'show']);
     Route::get('admin/customer/manage_customer/{id?}',[CustomerController::class,'manage_customer']);
     Route::post('admin/customer/manage_customer',[CustomerController::class,'manage_customer_process']);
     Route::get('admin/customer/view_customer/{id}',[CustomerController::class,'view_customer']);
     Route::get('admin/customer/manage_customer/{id}/status/{status_value}',[CustomerController::class,'status']);
     Route::get('admin/customer/delete_customer/{id}',[CustomerController::class,'delete_customer']);
    
      //---------- Home Banner ------------
    Route::get('admin/home_banner',[HomeBannerController::class,'show']);
    Route::get('admin/home_banner/manage_home_banner/{id?}',[HomeBannerController::class,'manage_home_banner']);
    Route::post('admin/home_banner/manage_home_banner',[HomeBannerController::class,'manage_home_banner_process']);
    Route::get('admin/home_banner/manage_home_banner/{id}/status/{status_value}',[HomeBannerController::class,'status']);
   Route::get('admin/home_banner/delete_home_banner/{id}',[HomeBannerController::class,'delete_home_banner']);
   
     //------------ admin logout------------
Route::get('/logout',[AdminController::class,'admin_logout']);

});



//------------ Front-Routes------------

//------------Home Page------------
Route::get('/',[FrontController::class,'index']);
Route::get('/home_add_to_cart',[FrontController::class,'home_add_to_cart']);

//------------Product Page------------
Route::get('/product/{slug}',[FrontController::class,'product']);
Route::get('/add_to_cart',[FrontController::class,'add_to_cart']);

//------------Cart Page------------
Route::get('/cart',[FrontController::class,'cart']);
Route::get('/cart_product_delete',[FrontController::class,'cart_product_delete']);
Route::get('/cart_items_update',[FrontController::class,'cart_items_update']);

//------------Category Page------------
Route::get('/category/{id}',[FrontController::class,'category']);

//------------Search------------
 Route::get('/search/{str}',[FrontController::class,'search']);

 //------------Customer Registration------------
 Route::get('/registration',[FrontController::class,'registration']);
 Route::get('/register',[FrontController::class,'register']);
 Route::get('/Verification/{code}',[FrontController::class,'verification']);

//------------Customer Login/Logout------------
Route::post('/login_customer',[FrontController::class,'login']);
Route::get('/user_logout',function(){
  session()->forget('FRONT_LOGIN_USER');
  session()->forget('FRONT_USER_NAME');
  session()->forget('USE_TEMP_ID');
  // session()->forget('order_id');
  
  return redirect()->back();
});

//------------ Checkout ------------
Route::get('/checkout',[FrontController::class,'checkout']);
Route::post('/coupon_code',[FrontController::class,'coupon_code']);
Route::post('/remove_coupon_code',[FrontController::class,'remove_coupon_code']);

//------------ Order ------------
Route::post('/place_order',[FrontController::class,'place_order']);
Route::get('/order_placed',[FrontController::class,'place_order_notification']);












