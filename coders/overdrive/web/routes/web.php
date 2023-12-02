<?php

Route::group(
    [
        'namespace'  => '\Overdrive\Web\Http\Controllers\Frontend',
        'prefix'     => '',
        'as'         => 'perakepay.frontend::',
        'middleware' => ['web'],
    ],
    function () {

        Route::get('/', 'MainController@index')->name('perakepay.frontend.index');
        Route::get('/hubungi', 'MainController@hubungi')->name('perakepay.frontend.hubungi');

        Route::get('/panduan','MainController@panduan');
        Route::get('/faq','MainController@faq');
        Route::get('/faq/getagency/{id}','MainController@getFaq');
        //Route::get('/feedback','MainController@feedback'); //tukar ke admin


        // footer link
        Route::get('/petalaman','MainController@petalaman');
        Route::get('/desclaimer','MainController@desclaimer');
        Route::get('/privacy','MainController@privacy');
        Route::get('/security','MainController@security');

    }
);


Route::group(
    [
        'namespace'  => '\Overdrive\Web\Http\Controllers\Backend',
        'prefix'     => '',
        'as'         => 'backend::',
        'middleware' => ['web','auth'],
    ],
    function () {

        // Route::get('/home', 'MainController@index')->name('backend.index');
        Route::get('backend/notisread', 'MainController@readNotification')->name('backend.notisread');





    }
);

Route::group(
    [
        'namespace'  => '\Overdrive\Web\Http\Controllers',
        'prefix'     => '',
        'as'         => 'frontend::',
        'middleware' => ['web','auth'],
    ],
    function () {

         // user profiles

            Route::get('user/profile',['uses' => 'User\ProfileController@profile']);
            Route::post('update/profile',['uses'=>'User\ProfileController@updateProfile']);

            Route::get('test/email',['uses' => 'User\ProfileController@testEmail']);

        // inbox spesific for pelanggan
            Route::get('/inbox','User\InboxController@inbox');

        }
    );



Route::group(
    [
        'namespace'  => '\Overdrive\Web\Http\Controllers\User',
        'prefix'     => '',
        'as'         => 'user::',
        'middleware' => ['guest','web'],
    ],
    function () {



        Route::get('user/register', ['uses' => 'UserController@formRegister'])->name('user.register');
        Route::post('user/register',['uses' => 'UserController@svRegister'])->name('user.save.ind');
        // Route::post('user/register/company',['uses' => 'UserController@svRegComp'])->name('user.save.comp');

        // Route::get('reset-password/{token}', ['uses' => 'UserController@showResetPasswordForm'])->name('reset.password.get');
        // Route::post('reset-password', ['uses' => 'UserController@submitResetPasswordForm'])->name('reset.password.post');


        // Route::get('user/forgot',['uses' => 'UserController@formForgot'])->name('user.forgot');
        // Route::post('user/svforgot',['uses' => 'UserController@resetPassword'])->name('store.forgot');






        }
    );

    Route::group(
        [
            'namespace'  => '\Overdrive\Web\Http\Controllers\User',
            'prefix'     => '',
            'as'         => 'user::',
            'middleware' => ['guest'],
        ],
        function () {




            Route::get('reset-password/{token}', ['uses' => 'UserController@showResetPasswordForm'])->name('reset.password.get');
            Route::post('reset-password', ['uses' => 'UserController@submitResetPasswordForm'])->name('reset.password.post');


            Route::get('user/forgot',['uses' => 'UserController@formForgot'])->name('user.forgot');
            Route::post('user/svforgot',['uses' => 'UserController@resetPassword'])->name('store.forgot');






            }
        );
    Route::group(
        [
            'namespace'  => '\Overdrive\Web\Http\Controllers',
            'prefix'     => '',
            'as'         => 'public::',
            'middleware' => ['guest'],
        ],
        function () {

            Route::get('/carian/form','Frontend\SearchController@form');

        }
    );

