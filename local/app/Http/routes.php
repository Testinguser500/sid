<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');

//Route::resource('api/admins','HomeController');

//Admin Panel
Route::get('admins/', 'Admin\HomeController@index');
Route::get('admins', 'Admin\HomeController@index');
Route::get('admins/login', 'Admin\HomeController@index');
Route::post('admins/log_user', 'Admin\HomeController@log_user');
Route::get('admins/log_out', 'Admin\HomeController@log_out');
Route::get('admins/dashboard', 'Admin\HomeController@dashboard');
Route::get('admins/home', 'Admin\HomeController@home');
Route::post('admins/imageupload', 'Admin\HomeController@imageupload');
Route::post('admins/Allimageupload', 'Admin\HomeController@Allimageupload');
Route::post('admins/imagemutipleupload', 'Admin\HomeController@imagemutipleupload');
Route::get('admins/not_access', 'Admin\HomeController@not_access');

Route::get('admins/category', 'Admin\CategoryController@index');
Route::get('admins/category/all', 'Admin\CategoryController@all');
Route::post('admins/category/store', 'Admin\CategoryController@store');
Route::post('admins/category/delete', 'Admin\CategoryController@delete');
Route::get('admins/category/edit/{id}', 'Admin\CategoryController@edit');
Route::post('admins/category/update', 'Admin\CategoryController@update');
Route::get('admins/category/getcataegorywithSub', 'Admin\CategoryController@getcataegorywithSub');
Route::post('admins/category/changeStatus', 'Admin\CategoryController@changeStatus');

Route::get('admins/brand', 'Admin\BrandController@index');
Route::get('admins/brand/all', 'Admin\BrandController@all');
Route::post('admins/brand/store', 'Admin\BrandController@store');
Route::post('admins/brand/delete', 'Admin\BrandController@delete');
Route::get('admins/brand/edit/{id}', 'Admin\BrandController@edit');
Route::post('admins/brand/update', 'Admin\BrandController@update');

Route::get('admins/faq', 'Admin\FaqController@index');
Route::get('admins/faq/all', 'Admin\FaqController@all');
Route::post('admins/faq/store', 'Admin\FaqController@store');
Route::post('admins/faq/delete', 'Admin\FaqController@delete');
Route::get('admins/faq/edit/{id}', 'Admin\FaqController@edit');
Route::post('admins/faq/update', 'Admin\FaqController@update');

Route::get('admins/newsletter', 'Admin\NewsletterController@index');
Route::get('admins/newsletter/all', 'Admin\NewsletterController@all');
Route::get('admins/newsletter/export', 'Admin\NewsletterController@export');
Route::post('admins/newsletter/store', 'Admin\NewsletterController@store');
Route::post('admins/newsletter/delete', 'Admin\NewsletterController@delete');
Route::post('admins/newsletter/update', 'Admin\NewsletterController@update');
Route::post('admins/newsletter/update_subscribe', 'Admin\NewsletterController@update_subscribe');

Route::get('admins/template', 'Admin\TemplateController@index');
Route::get('admins/template/all', 'Admin\TemplateController@all');
Route::post('admins/template/store', 'Admin\TemplateController@store');
Route::post('admins/template/delete', 'Admin\TemplateController@delete');
Route::get('admins/template/edit/{id}', 'Admin\TemplateController@edit');
Route::post('admins/template/update', 'Admin\TemplateController@update');
Route::post('admins/template/sent', 'Admin\TemplateController@sent');

Route::get('admins/config', 'Admin\ConfigController@index');
Route::get('admins/config/all', 'Admin\ConfigController@all');
Route::get('admins/config/edit', 'Admin\ConfigController@edit');
Route::post('admins/config/update', 'Admin\ConfigController@update');

Route::get('admins/enquiry', 'Admin\EnquiryController@index');
Route::get('admins/enquiry/all', 'Admin\EnquiryController@all');
Route::get('admins/enquiry/edit/{id}', 'Admin\EnquiryController@edit');
Route::post('admins/enquiry/update', 'Admin\EnquiryController@update');
Route::post('admins/enquiry/delete', 'Admin\EnquiryController@delete');

Route::get('admins/user', 'Admin\UserController@index');
Route::get('admins/user/all', 'Admin\UserController@all');
Route::post('admins/user/all', 'Admin\UserController@all');
Route::get('admins/user/add', 'Admin\UserController@add');
Route::post('admins/user/store', 'Admin\UserController@store');
Route::get('admins/user/edit/{id}', 'Admin\UserController@edit');
Route::post('admins/user/update', 'Admin\UserController@update');
Route::post('admins/user/delete', 'Admin\UserController@delete');
Route::post('admins/user/checkUser', 'Admin\UserController@checkUser');
Route::post('admins/user/changeStatus', 'Admin\UserController@changeStatus');
Route::post('admins/user/getProfileImage', 'Admin\UserController@getProfileImage');
Route::post('admins/user/changeRole', 'Admin\UserController@changeRole');
Route::post('admins/user/deleteAll', 'Admin\UserController@deleteAll');
Route::post('admins/user/checkLink', 'Admin\UserController@checkLink');

Route::get('admins/static-content', 'Admin\StaticContentController@index');
Route::get('admins/static-content/all', 'Admin\StaticContentController@all');
Route::get('admins/static-content/edit/{id}', 'Admin\StaticContentController@edit');
Route::post('admins/static-content/update', 'Admin\StaticContentController@update');

Route::get('admins/banner', 'Admin\BannerController@index');
Route::get('admins/banner/all', 'Admin\BannerController@all');
Route::post('admins/bannerImageUpload', 'Admin\BannerController@bannerImageUpload');
Route::get('admins/banner/add', 'Admin\BannerController@add');
Route::post('admins/banner/store', 'Admin\BannerController@store');
Route::get('admins/banner/edit/{id}', 'Admin\BannerController@edit');
Route::post('admins/banner/update', 'Admin\BannerController@update');
Route::post('admins/banner/delete', 'Admin\BannerController@delete');

Route::get('admins/seller', 'Admin\SellerController@index');
Route::get('admins/seller/all', 'Admin\SellerController@all');
Route::get('admins/seller/add', 'Admin\SellerController@add');
Route::post('admins/seller/store', 'Admin\SellerController@store');
Route::get('admins/seller/edit/{id}', 'Admin\SellerController@edit');
Route::post('admins/seller/update', 'Admin\SellerController@update');
Route::post('admins/seller/delete', 'Admin\SellerController@delete');

Route::get('admins/country', 'Admin\CountryController@index');
Route::get('admins/country/all', 'Admin\CountryController@all');
Route::post('admins/country/store', 'Admin\CountryController@store');
Route::get('admins/country/edit/{id}', 'Admin\CountryController@edit');
Route::post('admins/country/update', 'Admin\CountryController@update');
Route::post('admins/country/delete', 'Admin\CountryController@delete');
Route::post('admins/country/getState', 'Admin\CountryController@getState');
Route::post('admins/country/getCity', 'Admin\CountryController@getCity');

Route::get('admins/option', 'Admin\OptionController@index');
Route::get('admins/option/all', 'Admin\OptionController@all');
Route::get('admins/option/add', 'Admin\OptionController@add');
Route::post('admins/option/attribues', 'Admin\OptionController@attribues');
Route::post('admins/option/store', 'Admin\OptionController@store');
Route::post('admins/option/delete', 'Admin\OptionController@delete');
Route::get('admins/option/edit/{id}', 'Admin\OptionController@edit');
Route::post('admins/option/update', 'Admin\OptionController@update');

Route::get('admins/product', 'Admin\ProductController@index');
Route::get('admins/product/all', 'Admin\ProductController@all');
Route::post('admins/product/store', 'Admin\ProductController@store');
Route::post('admins/product/delete', 'Admin\ProductController@delete');
Route::get('admins/product/edit/{id}', 'Admin\ProductController@edit');
Route::post('admins/product/update', 'Admin\ProductController@update');
Route::post('admins/product/getoptionvalue', 'Admin\ProductController@getoptionvalue');
Route::post('admins/product/image_delete', 'Admin\ProductController@image_delete');
Route::get('admins/product/export', 'Admin\ProductController@export');
Route::post('admins/product/getvariation', 'Admin\ProductController@getvariation');
Route::post('admins/product/getMainCat', 'Admin\ProductController@getMainCat');

Route::post('admins/product/get_attr_gr', 'Admin\ProductController@get_attr_gr');

Route::post('admins/product/deleteAll', 'Admin\ProductController@deleteAll');
Route::post('admins/product/updateDes', 'Admin\ProductController@updateDes');

Route::get('admins/plan', 'Admin\PlanController@index');
Route::get('admins/plan/all', 'Admin\PlanController@all');
Route::post('admins/plan/store', 'Admin\PlanController@store');
Route::get('admins/plan/edit/{id}', 'Admin\PlanController@edit');
Route::post('admins/plan/update', 'Admin\PlanController@update');

Route::get('admins/permission', 'Admin\PermissionController@index');
Route::get('admins/permission/all', 'Admin\PermissionController@all');
Route::post('admins/permission/store', 'Admin\PermissionController@store');

Route::get('admins/coupon', 'Admin\CouponController@index');
Route::get('admins/coupon/all', 'Admin\CouponController@all');
Route::post('admins/coupon/store', 'Admin\CouponController@store');
Route::get('admins/coupon/edit/{id}', 'Admin\CouponController@edit');
Route::post('admins/coupon/update', 'Admin\CouponController@update');
Route::post('admins/coupon/delete', 'Admin\CouponController@deletecoupon');
Route::post('admins/coupon/changeStatus', 'Admin\CouponController@changeStatus');
Route::post('admins/coupon/getProduct', 'Admin\CouponController@getProduct');
Route::post('admins/coupon/getCategory', 'Admin\CouponController@getCategory');
Route::post('admins/coupon/getUser', 'Admin\CouponController@getUser');

//Seller Panel
Route::get('seller/login', 'Seller\HomeController@index');
Route::post('seller/log_user', 'Seller\HomeController@log_user');
Route::get('seller/profile/all', 'Seller\HomeController@all');
Route::get('seller/profile', 'Seller\HomeController@profile');
Route::post('seller/profile/update', 'Seller\HomeController@update');
Route::get('seller/log_out', 'Seller\HomeController@log_out');
Route::get('seller/dashboard', 'Seller\HomeController@dashboard');
Route::get('seller/home', 'Seller\HomeController@home');
Route::post('seller/imageupload', 'Seller\HomeController@imageupload');
Route::post('seller/Allimageupload', 'Seller\HomeController@Allimageupload');
Route::get('seller/not_access', 'Seller\HomeController@not_access');

Route::get('seller/setting', 'Seller\SettingController@index');
Route::get('seller/setting/all', 'Seller\SettingController@all');
Route::post('seller/country/getState', 'Admin\CountryController@getState');
Route::post('seller/country/getCity', 'Admin\CountryController@getCity');
Route::post('seller/setting/update', 'Seller\SettingController@update');
Route::get('seller/product-list', 'Seller\ProductController@category_list');
Route::get('seller/getCategory', 'Seller\ProductController@getCategory');
Route::post('seller/getSubCategory', 'Seller\ProductController@getSubCategory');
Route::post('seller/product_list','Seller\ProductController@getProduct');
Route::post('seller/product/all','Seller\ProductController@all');
Route::post('seller/product/getOptionValue','Seller\ProductController@getoptionvalue');
Route::post('seller/product/image_delete','Seller\ProductController@image_delete');
Route::get('seller/product/getAllCategory','Seller\ProductController@getAllCategory');


Route::get('admins/special-offer', 'Admin\SpecialOfferController@index');
Route::get('admins/special-offer/all', 'Admin\SpecialOfferController@all');
Route::post('admins/special-offer/getUser', 'Admin\SpecialOfferController@getUser');
Route::post('admins/special-offer/getRole', 'Admin\SpecialOfferController@getRole');
Route::post('admins/special-offer/store', 'Admin\SpecialOfferController@store');
Route::get('admins/special-offer/edit/{id}', 'Admin\SpecialOfferController@edit');
Route::post('admins/special-offer/update', 'Admin\SpecialOfferController@update');
Route::post('admins/special-offer/changeStatus', 'Admin\SpecialOfferController@changeStatus');
Route::post('admins/special-offer/delete', 'Admin\SpecialOfferController@delete');

Route::get('admins/bulk-discount', 'Admin\BulkDiscountController@index');
Route::get('admins/bulk-discount/all', 'Admin\BulkDiscountController@all');
Route::post('admins/bulk-discount/store', 'Admin\BulkDiscountController@store');
Route::get('admins/bulk-discount/edit/{id}', 'Admin\BulkDiscountController@edit');
Route::post('admins/bulk-discount/update', 'Admin\BulkDiscountController@update');
Route::post('admins/bulk-discount/changeStatus', 'Admin\BulkDiscountController@changeStatus');
Route::post('admins/bulk-discount/delete', 'Admin\BulkDiscountController@delete');

/*********************promotion************************/
Route::get('admins/create_promotion', 'Admin\PromotionController@index');
Route::get('admins/promotion_setting', 'Admin\PromotionSettingController@index');
Route::get('admins/promotion/get_setting/{setting}', 'Admin\PromotionSettingController@get_setting');
Route::post('admins/promotion/update_adtext', 'Admin\PromotionSettingController@update_adtext');
Route::post('admins/promotion/update_adbanr', 'Admin\PromotionSettingController@update_adbanr');

