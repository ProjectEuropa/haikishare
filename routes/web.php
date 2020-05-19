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

Route::get('/', function () {
    return view('app.top');
});
//ユーザー側
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::post('/users/{id}/edit', 'UsersController@update')->name('users.update');

//運営側
Route::group(['prefix' => 'companies'], function () {
  //Authチェック
Route::get('login', 'AuthCompany\LoginController@showLoginForm')->name('company_auth.login');
Route::post('login', 'AuthCompany\LoginController@login')->name('company_auth.login');
Route::get('register', 'AuthCompany\RegisterController@showRegisterForm')->name('company_auth.register');
Route::post('register', 'AuthCompany\RegisterController@register')->name('company_auth.register');
Route::post('logout', 'AuthCompany\LoginController@logout')->name('company_auth.logout');
Route::post('password/email', 'AuthCompany\ForgotPasswordController@sendResetLinkEmail')->name('company_auth.password.email');
Route::get('password/reset', 'AuthCompany\ForgotPasswordController@showLinkRequestForm')->name('company_auth.password.request');
Route::post('password/reset', 'AuthCompany\ResetPasswordController@reset')->name('company_auth.password.update');
Route::get('password/reset/{token}', 'AuthCompany\ResetPasswordController@showResetForm')->name('company_auth.password.reset');

Route::get('home', 'CompanyHomeController@index')->name('companies.home');
Route::get('/{id}/edit', 'CompaniesController@edit')->name('companies.edit');
Route::post('/{id}/edit', 'CompaniesController@update')->name('companies.update');
Route::get('/{id}/list', 'CompaniesController@list')->name('companies.list');
Route::get('/{id}/sell', 'CompaniesController@sell')->name('companies.sell');
});

Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::get('/products/destroy/{id}', 'ProductController@destroytoggle')->name('products.destroytoggle');
Route::resource('products', 'ProductController');
// Route::get('/products/search', 'CompaniesController@search')->name('products.search');

// オーダー
Route::get('/orders/{id}', 'OrdersController@create')->name('orders.create');
