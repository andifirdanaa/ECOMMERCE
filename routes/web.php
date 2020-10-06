<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
	$banner = App\Banner::all();
	$productAll = App\Product::inRandomOrder()->where('feature_item',1)->get();
	$imagecat = App\ImageCategory::where('id',1)->get();
	$imagetwo = App\ImageCategory::where('id',2)->get();
	$imagethree = App\ImageCategory::where('id',3)->get();
	$imagefour = App\ImageCategory::where('id',4)->get();
	$imagefive = App\ImageCategory::where('id',5)->get();
    return view('shop.index',compact('banner','productAll','imagecat','imagetwo','imagethree','imagefour','imagefive'));
});

Route::get('shop-hal', ['as' => 'shop-hal.index', 'uses' => 'IndexController@index']);
Route::get('detail/{id}', 'IndexController@indexdetail');
Route::get('categories/{category_id}','IndexController@categories');
//Get product Attribute Price
Route::get('/get-product-price','ProductController@getProductPrize');
//Cart Page Route
Route::match(['get','post'],'/cart', 'ProductController@cart');
//Add to cart Route
Route::match(['get','post'],'/add-cart', 'ProductController@addtocart');
// Delete Cart Product
Route::get('cart/delete-product/{id}','ProductController@deleteCartProduct');
//Update product quantity in cart
Route::get('/cart/update-quantity/{id}/{quantity}',['as'=> 'update.quantity', 'uses'=>'ProductController@updateCartQuantity']);
//Apply Coupon Code
Route::post('/cart/apply-coupon','ProductController@ApplyCoupon');
//Place Order
Route::match(['get','post'],'place-order','ProductController@placeOrder');
//COD Thanks Page
Route::get('/thanks','ProductController@thanks');
//Stripe  Page
Route::get('/bankthanks','ProductController@bankthanks');
//User Orders Page
Route::get('/orders','ProductController@userOrders');
//User Ordered Products Page
Route::get('/orders/{id}','ProductController@userOrderDetails');
//User Orders Page
Route::get('/orders','ProductController@userOrders');
//User Ordered Products Page
Route::get('/orders/{id}','ProductController@userOrderDetails');
//Confirm Account
Route::get('confirm/{code}','UserController@confirmAccount');
//Search Product
Route::post('/search-products','ProductController@searchProducts');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/account','UserController@account');

Route::resource('page','UserController');

Route::group(['middleware'=>'auth'],function(){
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	//checkout page
	Route::match(['get','post'],'checkout','ProductController@checkout');
	//Order Review Page
	Route::match(['get','post'],'order-review','ProductController@orderReview');
});

Route::group(['middleware'=>'checkRole'],function(){
	Route::resource('user', 'UserController', ['except' => ['show']]);
	

	//Product Controller Admin
	Route::resource('product','ProductController');
	Route::match(['get','post'],'/admin/add-attributes/{id}', 'ProductController@addAttributes');
	Route::match(['get','post'],'/admin/edit-attributes/{id}', 'ProductController@editAttributes');
	Route::match(['get','post'],'/admin/add-images/{id}', 'ProductsController@addImages');
	Route::get('/admin/delete-attribute/{id}', 'ProductController@deleteAttribute');

	//Category Controller admin
	Route::resource('category','CategoryController');

	//Banner Controller admin
	Route::resource('banner','BannerController');
	//Image Controller admin
	Route::resource('image','ImageController');

	//Coupons Route
	Route::resource('coupons','CouponsController');
	//Admin Orders Route
	Route::get('view-orders', ['as' => 'view-orders.viewOrders', 'uses' => 'ProductController@viewOrders']);

	//Admin Order Detail Page
	Route::get('view-order/{id}', 'ProductController@viewOrderDetails');
	//Invoice Order Detail Page
	Route::get('view-order-invoice/{id}', 'ProductController@viewOrderInvoice');
	//Order Detail Page PDF
	Route::get('view-order-pdf/{id}', 'ProductController@viewPDFInvoice');
	//Update Order Status
	Route::post('/admin/update-order-status','ProductController@updateOrderStatus');
	//Shipping charge
	Route::resource('shipping','ShippingController');
});

