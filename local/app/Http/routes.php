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
Route::get('admins', 'Admin\HomeController@index');
Route::get('admins/login', 'Admin\HomeController@index');
Route::post('admins/log_user', 'Admin\HomeController@log_user');
Route::get('admins/log_out', 'Admin\HomeController@log_out');
Route::get('admins/dashboard', 'Admin\HomeController@dashboard');
Route::get('admins/home', 'Admin\HomeController@home');
Route::get('admins/category', 'Admin\CategoryController@index');
Route::get('admins/category/add', 'Admin\CategoryController@add');
Route::post('admins/category/store', 'Admin\CategoryController@store');
Route::post('admins/category/delete', 'Admin\CategoryController@delete');
Route::get('admins/category/edit/{id}', 'Admin\CategoryController@edit');
Route::post('admins/category/update', 'Admin\CategoryController@update');

Route::get('admin/brand', 'Admin\BrandController@index');
Route::get('admin/brand/add', 'Admin\BrandController@add');
Route::post('admin/brand/store', 'Admin\BrandController@store');
Route::post('admin/brand/delete', 'Admin\BrandController@delete');
Route::get('admin/brand/edit/{id}', 'Admin\BrandController@edit');
Route::post('admin/brand/update', 'Admin\BrandController@update');

Route::get('admin/faq', 'Admin\FaqController@index');
Route::get('admin/faq/add', 'Admin\FaqController@add');
Route::post('admin/faq/store', 'Admin\FaqController@store');
Route::post('admin/faq/delete', 'Admin\FaqController@delete');
Route::get('admin/faq/edit/{id}', 'Admin\FaqController@edit');
Route::post('admin/faq/update', 'Admin\FaqController@update');

Route::get('admin/newsletter', 'Admin\NewsletterController@index');
Route::post('admin/newsletter/delete', 'Admin\NewsletterController@delete');
Route::post('admin/newsletter/update', 'Admin\NewsletterController@update');

Route::get('admin/template', 'Admin\TemplateController@index');
Route::get('admin/template/add', 'Admin\TemplateController@add');
Route::post('admin/template/store', 'Admin\TemplateController@store');
Route::post('admin/template/delete', 'Admin\TemplateController@delete');
Route::get('admin/template/edit/{id}', 'Admin\TemplateController@edit');
Route::post('admin/template/update', 'Admin\TemplateController@update');
Route::get('admin/template/send/{id}', 'Admin\TemplateController@send');
Route::post('admin/template/sent', 'Admin\TemplateController@sent');

Route::get('admin/config', 'Admin\ConfigController@index');
Route::get('admin/config/edit', 'Admin\ConfigController@edit');
Route::post('admin/config/update', 'Admin\ConfigController@update');

Route::get('admin/enquiry', 'Admin\EnquiryController@index');
Route::get('admin/enquiry/edit/{id}', 'Admin\EnquiryController@edit');
Route::post('admin/enquiry/update', 'Admin\EnquiryController@update');
Route::post('admin/enquiry/delete', 'Admin\EnquiryController@delete');

Route::get('admin/user', 'Admin\UserController@index');
Route::get('admin/user/add', 'Admin\UserController@add');
Route::post('admin/user/store', 'Admin\UserController@store');
Route::get('admin/user/edit/{id}', 'Admin\UserController@edit');
Route::post('admin/user/update', 'Admin\UserController@update');
Route::post('admin/user/delete', 'Admin\UserController@delete');

Route::get('admin/static-content', 'Admin\StaticContentController@index');
Route::get('admin/static-content/edit/{id}', 'Admin\StaticContentController@edit');
Route::post('admin/static-content/update', 'Admin\StaticContentController@update');

Route::get('admin/banner', 'Admin\BannerController@index');
Route::get('admin/banner/add', 'Admin\BannerController@add');
Route::post('admin/banner/store', 'Admin\BannerController@store');
Route::get('admin/banner/edit/{id}', 'Admin\BannerController@edit');
Route::post('admin/banner/update', 'Admin\BannerController@update');