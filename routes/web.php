<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'profile' ,'middleware'=>['auth']], function (){
    Route::get('/view','ProfileController@index')->name('profile.index');
    Route::get('/edit/{id}','ProfileController@edit')->name('profile.edit');
    Route::put('/update/{id}','ProfileController@update')->name('profile.update');
//    Route::get('/password/','ProfileController@update')->name('profile.update');
//    Route::put('/update/{id}','ProfileController@update')->name('profile.update');
    Route::get('/password/change','ProfileController@changePassword')->name('password.change');
    Route::put('/password/update/{id}','ProfileController@updatePassword')->name('password.update');

});


Route::group(['as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth','admin']], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::get('/test','DashboardController@test')->name('test');

    Route::group(['prefix'=>'user'], function (){
        Route::get('/view','UserController@index')->name('user.index');
        Route::get('/create','UserController@create')->name('user.create');
        Route::post('/store','UserController@store')->name('user.store');
        Route::get('/edit/{id}','UserController@edit')->name('user.edit');
        Route::put('/update/{id}','UserController@update')->name('user.update');
        Route::delete('/destroy/{id}','UserController@destroy')->name('user.destroy');
    });
    Route::group(['prefix'=>'supplier'], function (){
        Route::get('/view','SupplierController@index')->name('supplier.index');
        Route::get('/create','SupplierController@create')->name('supplier.create');
        Route::post('/store','SupplierController@store')->name('supplier.store');
        Route::get('/edit/{id}','SupplierController@edit')->name('supplier.edit');
        Route::put('/update/{id}','SupplierController@update')->name('supplier.update');
        Route::delete('/destroy/{id}','SupplierController@destroy')->name('supplier.destroy');
    });
    Route::group(['prefix'=>'customer'], function (){
        Route::get('/view','CustomerController@index')->name('customer.index');
        Route::get('/create','CustomerController@create')->name('customer.create');
        Route::post('/store','CustomerController@store')->name('customer.store');
        Route::get('/edit/{id}','CustomerController@edit')->name('customer.edit');
        Route::put('/update/{id}','CustomerController@update')->name('customer.update');
        Route::delete('/destroy/{id}','CustomerController@destroy')->name('customer.destroy');
    });
    Route::group(['prefix'=>'unit'], function (){
        Route::get('/view','UnitController@index')->name('unit.index');
        Route::get('/create','UnitController@create')->name('unit.create');
        Route::post('/store','UnitController@store')->name('unit.store');
        Route::get('/edit/{id}','UnitController@edit')->name('unit.edit');
        Route::put('/update/{id}','UnitController@update')->name('unit.update');
        Route::delete('/destroy/{id}','UnitController@destroy')->name('unit.destroy');
    });
    Route::group(['prefix'=>'category'], function (){
        Route::get('/view','CategoryController@index')->name('category.index');
        Route::get('/create','CategoryController@create')->name('category.create');
        Route::post('/store','CategoryController@store')->name('category.store');
        Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');
        Route::put('/update/{id}','CategoryController@update')->name('category.update');
        Route::delete('/destroy/{id}','CategoryController@destroy')->name('category.destroy');
    });


});


Route::group(['as'=>'user.', 'prefix'=>'user', 'namespace'=>'User', 'middleware'=>['auth','user']], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');



});

