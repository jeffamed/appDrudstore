<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('customer', 'CustomerController')->except(['create, edit']);
Route::resource('presentation', 'PresentationController')->except(['create, edit']);
Route::resource('laboratory', 'LaboratoryController')->except(['create, edit']);
Route::resource('location', 'LocationController')->except(['create, edit']);
Route::resource('order', 'OrderController')->except(['create, edit']);
Route::resource('product', 'ProductController')->except(['create, edit']);
Route::resource('sale', 'SaleController')->except(['create, edit']);
Route::resource('supplier', 'SupplierController')->except(['create, edit']);
Route::resource('type', 'TypeController')->except(['create, edit']);
Route::resource('usage', 'UsageController')->except(['create, edit']);
Route::get('usage-all', 'UsageController@getAll');
