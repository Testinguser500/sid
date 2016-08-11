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

Route::get('admins/plan', 'Admin\PlanController@index');
Route::get('admins/plan/all', 'Admin\PlanController@all');
Route::post('admins/plan/store', 'Admin\PlanController@store');
Route::get('admins/plan/edit/{id}', 'Admin\PlanController@edit');
Route::post('admins/plan/update', 'Admin\PlanController@update');

Route::get('admins/permission', 'Admin\PermissionController@index');
Route::get('admins/permission/all', 'Admin\PermissionController@all');
Route::post('admins/permission/store', 'Admin\PermissionController@store');

//Seller Panel
Route::get('seller/login', 'Seller\HomeController@index');
Route::post('seller/log_user', 'Seller\HomeController@log_user');
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


