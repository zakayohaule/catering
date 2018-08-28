<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

//Front end route
Route::get('/' , 'FrontEndController@index')->name('index');

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'customer'] , function ()
{
    Route::get('verify/{token}', 'Auth\RegisterController@verifyUser')->name('customer.verify');
    Route::get('dashboard' , 'CustomerController@dashboard')->name('customer.dashboard');
});

Route::group(['prefix'=>'admin'] , function (){
    Route::get('dashboard' , 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('new-orders' , 'AdminController@newOrders')->name('admin.newOrders');
    Route::get('past-orders' , 'AdminController@pastOrders')->name('admin.pastOrders');
    Route::get('users' , 'AdminController@users')->name('admin.users');
    Route::get('add-meal' , 'AdminController@addMeal')->name('admin.addMeal');
});
