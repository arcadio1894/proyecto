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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'role:1']], function (){

    Route::get('/products', 'ProductsController@index');

    Route::group(['prefix' => 'product'], function (){
        Route::get('/create', 'ProductsController@create');
        Route::post('/store', 'ProductsController@store');
        Route::get('/edit/{id}', 'ProductsController@edit');
        Route::post('/update', 'ProductsController@update');
        Route::post('/delete', 'ProductsController@destroy');
    });

    Route::get('/categories', 'CategoryController@index');

    Route::group(['prefix' => 'category'], function (){
        Route::get('/create', 'CategoryController@create');
        Route::post('/store', 'CategoryController@store');
        Route::get('/edit/{id}', 'CategoryController@edit');
        Route::post('/update', 'CategoryController@update');
        Route::post('/delete', 'CategoryController@destroy');
    });

    Route::get('/brands', 'BrandController@index');

    Route::group(['prefix' => 'brand'], function (){
        Route::get('/create', 'BrandController@create');
        Route::post('/store', 'BrandController@store');
        Route::get('/edit/{id}', 'BrandController@edit');
        Route::post('/update', 'BrandController@update');
        Route::post('/delete', 'BrandController@destroy');
    });

    Route::get('/productos', 'ProductsController@getProducts');
    Route::get('/product/reportPDF', 'ProductsController@reportPDF');
    Route::post('/sale/report', 'SaleController@reportPDF');
    Route::post('/sale/reportE', 'SaleController@reportEXCEL');

    Route::get('/sales', 'SaleController@index');

    Route::get('/product/reportEXCEL', 'ProductsController@reportEXCEL');
});

Route::group(['middleware' => 'auth'], function (){

    Route::get('/sales', 'SaleController@index');

    Route::group(['prefix' => 'sale'], function (){
        Route::get('/create', 'SaleController@create');
        Route::post('/store', 'SaleController@store');
    });
    Route::get('/getPriceById/{id}', 'ProductsController@getPriceById');
});




