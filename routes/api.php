<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'Auth\LoginController@login')->middleware('cookies');

Route::get('paypal/capture', 'PayPalController@captureOrder');

Route::resources([
    'menu' => 'MenuController',
    'metas' => 'MetaController',
    'opening_hours' => 'OpeningHourController',
    'orders' => 'OrderController',
    'postcodes' => 'PostcodeController',
    'rates' => 'RateController',
    'regions' => 'RegionController',
    'invoices' => 'InvoiceController',
    'restaurant' => 'RestaurantController',
    'reports' => 'ReportController',
]);
