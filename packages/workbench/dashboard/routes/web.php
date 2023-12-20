<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Dashboard\Http\Controllers\DashboardController;

Route::group(
    [
        'namespace'  => '\Workbench\Dashboard\Http\Controllers',
        'prefix'     => '',
        'as'         => 'dashboard::',
        'middleware' => ['web', 'auth'],
    ],

    function () {

        // home 
        Route::get('/home','DashboardController@getHome');

        //registry
        Route::get('/dashboard/index','DashboardController@index');
        Route::get('/dashboard/pelanggan', 'DashboardController@pelanggan')->name('dashboard.pelanggan');
        Route::get('/dashboard/admin','DashboardController@admin');
        Route::get('/dashboard/agency','DashboardController@agency');
        Route::get('/dashboard/updatetroli/{payerbill}/{fkuser}','DashboardController@updatetroli');
        
    }
);


Route::group(
    [
        'namespace'  => '\Workbench\Dashboard\Http\Controllers',
        'prefix'     => '',
        'as'         => 'dashboard::',
        'middleware' => ['guest'],
    ],

    function () {

         //info qrcode
        Route::get('application/qrcodes/info/{id}','LicenseController@infoQrcode')->name('license.qrcode.info');


    }
);


