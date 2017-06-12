<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/edit/{id}', 'HomeController@edit');
Route::get('/delete/{id}', 'HomeController@destroy');
Route::get('/view', 'HomeController@view');
Route::post('/update', 'HomeController@update');
Route::resource('/home', 'HomeController');
Route::post('/searchOrder', 'HomeController@index');
Route::post('/createOrder', 'HomeController@store');

Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
    return "this page requires that you be logged in and an Admin";
}]);

