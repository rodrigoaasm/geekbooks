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

Route::get('/cart', "CartController@show");

Route::get('/show/{ISBN}/{last}/{info?}', "BookController@show");
Route::post('/search', 'BookController@bySearch');

Route::get('/{cc?}', "BookController@byCategory");
