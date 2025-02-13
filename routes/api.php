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
Route::middleware('auth:sanctum')->group(function() {
    Route::apiresource('customer', 'CustomerController');
    Route::apiresource('presentation', 'PresentationController');
    Route::apiresource('laboratory', 'LaboratoryController');
    Route::apiresource('location', 'LocationController');
    Route::apiresource('order', 'OrderController')->except(['update']);
    Route::apiresource('product', 'ProductController');
    Route::apiresource('sale', 'SaleController')->except(['update']);
    Route::apiresource('supplier', 'SupplierController');
    Route::apiresource('type', 'TypeController');
    Route::apiresource('usage', 'UsageController');
    Route::apiResource('user', 'UserController');
    Route::apiResource('role', 'RoleController');
    Route::apiResource('reimbursement', 'ReimbursementController')->except(['update']);
    Route::get('select-customer/{customer}', 'CustomerController@findSelect');
    Route::get('find-orders/{supplier}', 'OrderController@findSupplier');
    Route::get('find-reimbursements/{supplier}', 'ReimbursementController@findSupplier');
    Route::get('findcustomer/{id}', 'CustomerController@findId');
    Route::get('presentation-all', 'PresentationController@getAll');
    Route::get('laboratory-all', 'LaboratoryController@getAll');
    Route::get('location-all', 'LocationController@getAll');
    Route::get('supplier-all', 'SupplierController@getAll');
    Route::get('type-all', 'TypeController@getAll');
    Route::get('usage-all', 'UsageController@getAll');
    Route::get('product-search', 'ProductController@search');
    Route::get('all_product', 'ProductController@reportAll');
    Route::put('bonus/{product}', 'ProductController@addBonus');
    Route::get('invoice/{sale}/{type?}', 'SaleController@invoice')->name('invoice');
    Route::get('document-order/{order}', 'OrderController@document')->name('document-order');
    Route::get('permissions', function () {
        return \App\Models\Permission::all('id', 'label');
    });
    Route::get('dashboard', 'DashboardController@index');
    Route::get('report_sale', 'SaleController@reportSale')->name('reportSale');
    Route::get('report_order', 'OrderController@reportOrder')->name('reportOrder');
    Route::get('verified/{user}', 'LoginController@verified');
});

Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');
