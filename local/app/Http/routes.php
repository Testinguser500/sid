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
Route::get('admins/', 'Admin\HomeController@index');
Route::get('admins', 'Admin\HomeController@index');
Route::get('admins/login', 'Admin\HomeController@index');
Route::post('admins/log_user', 'Admin\HomeController@log_user');
Route::get('admins/log_out', 'Admin\HomeController@log_out');
Route::get('admins/dashboard', 'Admin\HomeController@dashboard');
Route::get('admins/home', 'Admin\HomeController@home');
Route::post('admins/imageupload', 'Admin\HomeController@imageupload');

Route::get('admins/category', 'Admin\CategoryController@index');
Route::get('admins/category/all', 'Admin\CategoryController@all');
Route::get('admins/category/add', 'Admin\CategoryController@add');
Route::post('admins/category/store', 'Admin\CategoryController@store');
Route::post('admins/category/delete', 'Admin\CategoryController@delete');
Route::get('admins/category/edit/{id}', 'Admin\CategoryController@edit');
Route::post('admins/category/update', 'Admin\CategoryController@update');

Route::get('admins/brand', 'Admin\BrandController@index');
Route::get('admins/brand/all', 'Admin\BrandController@all');
Route::get('admins/brand/add', 'Admin\BrandController@add');
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

Route::get('admins/template', 'Admin\TemplateController@index');
Route::get('admins/template/add', 'Admin\TemplateController@add');
Route::post('admins/template/store', 'Admin\TemplateController@store');
Route::post('admins/template/delete', 'Admin\TemplateController@delete');
Route::get('admins/template/edit/{id}', 'Admin\TemplateController@edit');
Route::post('admins/template/update', 'Admin\TemplateController@update');
Route::get('admins/template/send/{id}', 'Admin\TemplateController@send');
Route::post('admins/template/sent', 'Admin\TemplateController@sent');

Route::get('admins/config', 'Admin\ConfigController@index');
Route::get('admins/config/all', 'Admin\ConfigController@all');
Route::get('admins/config/edit', 'Admin\ConfigController@edit');
Route::post('admins/config/update', 'Admin\ConfigController@update');

Route::get('admins/enquiry', 'Admin\EnquiryController@index');
Route::get('admins/enquiry/edit/{id}', 'Admin\EnquiryController@edit');
Route::post('admins/enquiry/update', 'Admin\EnquiryController@update');
Route::post('admins/enquiry/delete', 'Admin\EnquiryController@delete');

Route::get('admins/user', 'Admin\UserController@index');
Route::get('admins/user/all', 'Admin\UserController@all');
Route::get('admins/user/add', 'Admin\UserController@add');
Route::post('admins/user/store', 'Admin\UserController@store');
Route::get('admins/user/edit/{id}', 'Admin\UserController@edit');
Route::post('admins/user/update', 'Admin\UserController@update');
Route::post('admins/user/delete', 'Admin\UserController@delete');

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