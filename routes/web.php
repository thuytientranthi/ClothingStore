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
    return view('welcome');
});


Route::get('/', 'UserControllers@getIndex');
Route::get('index', 'UserControllers@getIndex')->name('index');

Route::get('product', 'UserControllers@showProduct')->name('product');
Route::get('shop', 'UserControllers@shop')->name('shop');

Route::get('productInCategoryId/{idCategory}','UserControllers@showProducInCategory');

//detail
Route::get('productDetailid/{idProduct}-{idCategory}','UserControllers@showDetail');
Route::get('productDetailid/{idProduct}-{idCategory}','UserControllers@getDetail');

//search
Route::post('search','UserControllers@search');

//add To cart
Route::get('cart','UserControllers@cart');
Route::post('addToCart/{id}','UserControllers@addToCart');

//update to Cart
Route::post('updateToCart/{id}','UserControllers@updateCart');
Route::get('remove/{id}','UserControllers@removeCart');
Route::get('delete','UserControllers@deleteCart');

//login & logout
Route::get('login','Auth\LoginController@showLogin')->name('login');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LogoutController@getLogout')->name('logout');

//registered
Route::get('registered','Auth\RegisterController@showRegistered')->name('registered');
Route::post('registered','Auth\RegisterController@getRegistered');

Route::get('test/{id}','UserControllers@test');



