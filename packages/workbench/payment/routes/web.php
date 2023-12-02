<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Payment\Http\Controllers\PaymentController;
use Workbench\Admin\Http\Controllers\TransactionController;

Route::group(
    [
        'namespace'  => '\Workbench\Payment\Http\Controllers',
        'prefix'     => '',
        'as'         => 'payment::',
        'middleware' => ['web', 'auth'],
    ],

    function () {


        // Booking Customer
        Route::get('/user/booking/list','UserController@bookingList');
        Route::get('/user/booking/add','UserController@bookingForm');
            Route::post('/user/booking/save','UserController@bookingSave');
        Route::get('/user/booking/edit/{id}','UserController@bookingShow');
            Route::post('/user/booking/update','UserController@bookingUpdate');
        Route::get('/user/booking/delete/{id}','UserController@bookingDelete');


      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
        //registry
        Route::get('/payment/index','PaymentController@index');

        // akaun berdaftar
        Route::get('/user/berdaftar/list','UserController@regList');
        Route::get('/user/favourite/add','UserController@favAdd');
        Route::get('/user/favourite/getcodehasil/{id}','UserController@getKodHasil');
        Route::get('/user/favourite/getpayeracc/{kodhasil}/{search}','UserController@getPayerAcc');
        Route::post('/user/favourite/payeracc/save','UserController@svFavAcc');

        //Tiket utk login user
        Route::get('/login/bayaran/tiket/{lkpkhidmat}/form','UserController@userTicket');
        Route::get('/login/bayaran/tiket/servicerate/search/{id}','UserController@search');
        Route::post('/login/bayaran/tiket/save','UserController@svUserTicket');
        Route::get('/login/bayaran/tiket/{kodhasil}/{tab}/{action}/{id}','UserController@userNextTicket');
        Route::post('/login/bayaran/tiket/{kodhasil}/{tab}/{action}/{id}/delete','UserController@usrDelTicket');
        Route::post('/login/bayaran/tiket/update','UserController@usrUpdTiket');
        Route::post('/login/bayaran/tiket/next','UserController@userNext');
        Route::post('/login/bayaran/tiket/bayar','FormController@bayar');

        // bill untuk login user
        Route::get('/login/bayaran/bil/{lkpkhidmat}/form','UserController@billForm');
        Route::get('/login/bayaran/bill/search/{lkpkhidmat}/{refno}/{refid}','UserController@billSearch');
        Route::post('/login/bayaran/bill/save','UserController@billSave');
        Route::get('/login/bayaran/bill/{kodhasil}/{tab}/{action}/{id}','UserController@billNextBill');
        Route::post('/login/bayaran/bill/update','UserController@billUpdate');
        Route::post('/login/bayaran/bill/next','UserController@billNext');
        Route::post('/login/bayaran/bill/bayar','UserController@billBayar');

        // multi untuk login user
        Route::get('/login/bayaran/multi/{lkpkhidmat}/form','MultiController@userForm');
        Route::get('/login/bayaran/multi/search/{lkpkhidmat}/{refno}/{refid}','MultiController@userSearch');
        Route::post('/login/bayaran/multi/save','MultiController@userSave');
        Route::get('/login/bayaran/multi/{tab}/{troli_flag}','MultiController@userNextMulti');
        Route::post('/login/bayaran/multi/next','MultiController@postUserMultiNext');
        Route::post('/login/bayaran/multi/bayar','FormController@bayar');


        // hasil untuk login user
        Route::get('/login/bayaran/hasil/{lkpkhidmat}/form','UserController@userHasil');
        Route::post('/login/bayaran/hasil/save','UserController@svFormOthers');
        Route::get('/login/bayaran/hasil/{kodhasil}/{tab}/{action}/{id}','UserController@userNextOthers');
        Route::post('/login/bayaran/hasil/update','UserController@usrUpdOthers');
        Route::post('/login/bayaran/hasil/next','UserController@userHasilNext');
        Route::post('/login/bayaran/hasil/bayar','FormController@bayar');
        Route::post('/login/bayaran/hasil/{kodhasil}/{tab}/{action}/{id}/delete','UserController@usrDelOthers');

        // fpx banking 
        Route::post('/login/bayaran/fpx/updateBank','PaymentController@updateBank');
        Route::get('/login/bayaran/banklist','PaymentController@banklist');
        Route::get('/login/bayaran/fpxsummary/{paymentid}/{kodhasil}/{tab}/{flaglogin}/{flagpay}/{troliflag}/{flagtroli}/{id}','PaymentController@summarytiket');
        Route::get('/login/bayaran/fpx/{paymentid}/{flaglogin}/{flagpay}/{fpxtrans}','PaymentController@tiketFpx');
        Route::post('/login/bayaran/fpx/update','PaymentController@updateFpx');
        Route::get('/login/bayaran/fpxsucess/success/{paymentid}','PaymentController@successFpx');

        // Penyata Pemungut
        Route::get('/statement/list','StatementController@penyataList');
        Route::get('/statement/preview/{id}','StatementController@penyataPreview');
        Route::post('/statement/preview/save','StatementController@svPenyata');
        Route::get('/statement/pdf/{id}', 'StatementController@exportPenyata');

        //fezrul penyata pemungut
        Route::get('/statement/history','StatementController@penyataHistory');
        Route::get('/statement/log/{id}','StatementController@penyataLog');
        Route::get('/statement/status/{id}', 'StatementController@updStatus');

        // troli cart
        Route::get('/login/cart/add/{servicemainid}/{kodhasilid}','UserController@getCartAdd');
        Route::get('/login/cart/list','UserController@getCartList');
        Route::post('/login/cart/proceed','UserController@postCartProceed');
        Route::get('/login/cart/next/{tab}/{troli_flag}','UserController@getCartNext');
        Route::post('/login/cart/next','UserController@postCartNext');
        Route::post('/login/cart/next/bayar','UserController@postCartBayar');




         Route::any('/fpx/indirect','PaymentController@indirect');

       



    }
);

Route::group(
    [
        'namespace'  => '\Workbench\Payment\Http\Controllers',
        'prefix'     => '',
        'as'         => 'payment::',
        'middleware' => ['guest'],
    ],

    function (){

        // Bayaran Tiket
        // Route::get('/bayaran/tiket/{kodhasil}/form','FormController@tiket');
        Route::get('/bayaran/tiket/{lkpkhidmat}/form','FormController@formTiket');
        Route::get('/bayaran/tiket/servicerate/search/{id}','FormController@search');
        Route::post('/bayaran/tiket/save','FormController@svForm');

        Route::post('/bayaran/tiket/{kodhasil}/save','FormController@svTiket');
        Route::get('/bayaran/tiket/{kodhasil}/{tab}/{action}/{id}','FormController@nextTicket');
        Route::post('/bayaran/tiket/{kodhasil}/{tab}/{action}/{id}/delete','FormController@delTicket');
        Route::post('/bayaran/tiket/update','FormController@updTiket');
        Route::post('/bayaran/tiket/next','FormController@next');
        Route::post('/bayaran/tiket/bayar','FormController@bayar');
        // Route::get('/bayaran/tiket/{kodhasil}/{tab}/{action}/{id}/delete/{servicedetail}','FormController@delTicket');

        // Bayaran Bil
        Route::get('/bayaran/bil/{lkpkhidmat}/form','BillController@form');
        Route::get('/bayaran/bill/search/{lkpkhidmat}/{refno}/{refid}','BillController@search');
        Route::post('/bayaran/bill/save','BillController@save');
        Route::post('/bayaran/bill/update','BillController@update');

        Route::get('/bayaran/bill/{kodhasil}/{tab}/{action}/{id}','BillController@nextBill');
        Route::post('/bayaran/bill/next','BillController@next');
        Route::post('/bayaran/bill/bayar','BillController@bayar');

        Route::get('/bayaran/bill/test','PaymentController@testFpx');
        Route::post('/bayaran/bill/confirm','PaymentController@testConfirm');

        // Bayaran Multi Bil
        Route::get('/bayaran/multi/{lkpkhidmat}/form','MultiController@form');
        Route::get('/bayaran/multi/search/{lkpkhidmat}/{refno}/{refid}','MultiController@search');
        Route::post('/bayaran/multi/save','MultiController@save');
        Route::get('/bayaran/multi/{tab}/{troli_flag}','MultiController@nextMulti');
        Route::post('/bayaran/multi/next','MultiController@postMultiNext');
        // Route::post('/bayaran/multi/bayar','MultiController@postMultiBayar');
        Route::post('/bayaran/multi/bayar','FormController@bayar');


        // Bayaran Selain Tiket
        Route::get('/bayaran/hasil/{lkpkhidmat}/form','FormController@formOthers');
        Route::get('/bayaran/hasil/servicerate/search/{id}','FormController@searchOthers');
        Route::post('/bayaran/hasil/save','FormController@svFormOthers');

        Route::get('/bayaran/hasil/{kodhasil}/{tab}/{action}/{id}','FormController@nextOthers');
        Route::post('/bayaran/hasil/update','FormController@updOthers');
        Route::post('/bayaran/hasil/{kodhasil}/{tab}/{action}/{id}/delete','FormController@delOthers');
        Route::post('/bayaran/hasil/next','FormController@nextHasilOthers');
        Route::post('/bayaran/hasil/bayar','FormController@bayarOthers');

        // -------- Payment Return----FPX--CARD--------
        // whoever yang sambung please sambung dari route ni sebab dah register dengan PAYNET
        //https::dev-epay.perak.gov.my
        //https::epay.perak.gov.my
        // -- Diwang- 17FEB23

        // indirect
        Route::any('/fpx/indirect','PaymentController@indirect');

        //direct payment
        Route::any('/fpx/direct','PaymentController@direct');

        //bayaran
        Route::post('/bayaran/fpx/updateBank','PaymentController@updateBank');
        Route::get('/bayaran/banklist','PaymentController@banklist');
        Route::get('/bayaran/fpxsummary/{paymentid}/{kodhasil}/{tab}/{flaglogin}/{flagpay}/{troliflag}/{flagtroli}/{id}','PaymentController@summarytiket');
        Route::get('/bayaran/fpx/{paymentid}/{flaglogin}/{flagpay}/{fpxtrans}','PaymentController@tiketFpx');
        Route::post('/bayaran/fpx/update','PaymentController@updateFpx');
        Route::get('/bayaran/fpxsucess/success/{paymentid}','PaymentController@successFpx');
        //demo bank
        Route::get('/test/demobank/{paymentid}/{flaglogin}/{flagpay}/{troliflag}/{tab}/{srvmain}/{kodhasil}/{flagtroli}','PaymentController@demobank');

        // resit
        Route::get('/bayaran/receipt/{id}', 'PaymentController@exportTransaction');
        Route::get('/bayaran/email/{paymentid}', 'PaymentController@getSendEmail');

        //test generate pp file
        Route::get('/test/pp','PaymentController@genpp');

        Route::post('/bayaran/card','PaymentController@bayarancard');



    }

);



































