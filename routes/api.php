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

Route::apiresource('customer', 'CustomerController');
Route::apiresource('presentation', 'PresentationController');
Route::apiresource('laboratory', 'LaboratoryController');
Route::apiresource('location', 'LocationController');
Route::apiresource('order', 'OrderController')->except(['update']);
Route::apiresource('product', 'ProductController');
Route::apiresource('sale', 'SaleController');
Route::apiresource('supplier', 'SupplierController');
Route::apiresource('type', 'TypeController');
Route::apiresource('usage', 'UsageController');
Route::apiResource('user', 'UserController');
Route::apiResource('role', 'RoleController');
Route::get('customer-all', 'CustomerController@getAll');
Route::get('presentation-all', 'PresentationController@getAll');
Route::get('laboratory-all', 'LaboratoryController@getAll');
Route::get('location-all', 'LocationController@getAll');
Route::get('supplier-all', 'SupplierController@getAll');
Route::get('type-all', 'TypeController@getAll');
Route::get('usage-all', 'UsageController@getAll');
Route::get('product-search', 'ProductController@search');
Route::get('all_product', 'ProductController@reportAll');
Route::get('invoice/{sale}/{type?}', 'SaleController@invoice')->name('invoice');


Route::post('login', 'LoginController@login');
Route::get('verified', function (Request $request){
    return $request->user();
});
Route::post('logout', 'LoginController@logout');
