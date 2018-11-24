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

//alterar esta rota para post ou get assim que o botão do carrinho for arrumado
Route::any('/user','UserController@login');
Route::post('/user/login','UserController@emailVerify');
Route::post('/user/add','UserController@addUser');
Route::post('/user/finish','UserController@addOrder');

Route::get('/cart/show/{ISBN?}', "CartController@show");
Route::post('/cart/attCart', "CartController@attCart");

Route::get('/order/show/{email?}', "OrderController@getCart");
Route::post('/order/search', "OrderController@getSearch");

Route::get('/show/{ISBN}', "BookController@show");
Route::get('/search/{keyword}', 'BookController@bySearch');
Route::post('/search', 'BookController@bySearchPOST');

Route::get('/{cc?}', "BookController@byCategory");
