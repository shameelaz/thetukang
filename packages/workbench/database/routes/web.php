<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Database\Http\Controllers\DatabaseController;

Route::group(
    [
        'namespace'  => '\Workbench\Database\Http\Controllers',
        'prefix'     => '',
        'as'         => 'database::',
        'middleware' => ['web', 'auth'],
    ],

    function () {

        //registry
        Route::get('/database/index','DatabaseController@index');
        



    }
);





