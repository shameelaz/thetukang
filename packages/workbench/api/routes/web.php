<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Report\Http\Controllers\ReportController;

Route::group(
    [
        'namespace'  => '\Workbench\Api\Http\Controllers',
        'prefix'     => '',
        'as'         => 'api::',
        'middleware' => ['web', 'auth'],
    ],

    function () {

        //api
        Route::get('/api/index','ApiController@index');


    }
);


Route::group(
    [
        'namespace'  => '\Workbench\Api\Http\Controllers',
        'prefix'     => '',
        'as'         => 'api::',
        'middleware' => ['guest'],
    ],

    function () {

        //api
        Route::post('/api/run','ApiController@runFunc');

        Route::post('/api/single/run','ApiController@SingleRun');

        Route::get('/api/jalan','ApiController@exeJalan');
        Route::get('/api/single/jalan','ApiController@jalan');

        Route::get('/api/test/single','ApiController@testApiSingle');

    }
);





