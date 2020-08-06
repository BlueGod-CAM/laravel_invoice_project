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

Route::get('/get', function () {
    return view('layouts.index2');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/","DashboardController@index")->middleware("auth");

Route::prefix("/customer")->group(function(){
    Route::get("/","CustomerController@index")->middleware("auth");
    Route::get("/create","CustomerController@create")->middleware("auth");
    Route::post("/create","CustomerController@store")->middleware("auth");
    Route::get("/edit/{id}","CustomerController@edit")->middleware("auth");
    Route::post("/edit/{id}","CustomerController@update")->middleware("auth");
    Route::get("/delete/{id}","CustomerController@destroy")->middleware("auth");
});
Route::prefix("/category")->group(function(){
    Route::get("/","CategoryController@index")->middleware("auth");
    Route::get("/create","CategoryController@create")->middleware("auth");
    Route::post("/create","CategoryController@store")->middleware("auth");
    Route::get("/edit/{id}","CategoryController@edit")->middleware("auth");
    Route::post("/edit/{id}","CategoryController@update")->middleware("auth");
    Route::get("/delete/{id}","CategoryController@destroy")->middleware("auth");
    Route::get("/update/{status}/{id}","CategoryController@updateStatus")->middleware("auth");
});
Route::prefix("/item")->group(function(){
    Route::get("/","ItemController@index")->middleware("auth");
    Route::get("/create","ItemController@create")->middleware("auth");
    Route::post("/create","ItemController@store")->middleware("auth");
    Route::get("/edit/{id}","ItemController@edit")->middleware("auth");
    Route::post("/edit/{id}","ItemController@update")->middleware("auth");
    Route::get("/delete/{id}","ItemController@destroy")->middleware("auth");
    Route::get("/update/{status}/{id}","ItemController@updateStatus")->middleware("auth");
});

Route::prefix("/invoice")->group(function(){
    Route::get("/","InvoiceController@index")->middleware("auth");
    Route::get("/create","InvoiceController@create")->middleware("auth");
    Route::post("/create","InvoiceController@store")->middleware("auth");
    Route::get("/edit/{id}","InvoiceController@edit")->middleware("auth");
    Route::post("/edit/{id}","InvoiceController@update")->middleware("auth");
    Route::get("/delete/{id}","InvoiceController@destroy")->middleware("auth");
    Route::get("/show/{id}","InvoiceController@show")->middleware("auth");
});

Route::prefix("/invoice_item")->group(function(){
    Route::get("/","InvoiceItemController@index")->middleware("auth");
    Route::get("/create","InvoiceItemController@create")->middleware("auth");
    Route::post("/create","InvoiceItemController@store")->middleware("auth");
    Route::get("/edit/{id}","InvoiceItemController@edit")->middleware("auth");
    Route::post("/edit/{id}","InvoiceItemController@update")->middleware("auth");
    Route::get("/delete/{id}","InvoiceItemController@destroy")->middleware("auth");
});
Route::get("/dashboard","DashboardController@index")->middleware("auth");
