<?php 

Route::group(
    [
        'namespace'  => '\Overdrive\Web\Http\Controllers\Backend',
        'prefix'     => '',
        'as'         => 'menum::',
        'middleware' => ['web', 'auth'],
    ],

    function () {
 
         Route::get('/menu/index/', 'MenuController@index')->name('menu.index');
         Route::post('/menu/add/', 'MenuController@add')->name('menu.add');
         Route::post('/menu/addsub/', 'MenuController@addsub')->name('menu.addsub');
         Route::get('/menu/action/{id}', 'MenuController@togle')->name('menu.togle');
         Route::get('/menu/order/{id}/{type}', 'MenuController@order')->name('menu.order');
         Route::post('/menu/edit/', 'MenuController@edit')->name('menu.edit');
         Route::get('/menu/delete/{id}', 'MenuController@delete')->name('menu.delete');
         Route::get('/menu/icon/{id}/{icon}', 'MenuController@icon')->name('menu.delete');

         Route::get('/menu/ajax/icon/{id}', 'MenuController@loadicon')->name('menu.loadicon');
         Route::get('/menu/ajax/addsubs/{id}', 'MenuController@addsubs')->name('menu.addsubs');
          
     
    }
);