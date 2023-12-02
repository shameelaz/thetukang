<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Agency\Http\Controllers\AgencyController;

Route::group(
    [
        'namespace'  => '\Workbench\Agency\Http\Controllers',
        'prefix'     => '',
        'as'         => 'agency::',
        'middleware' => ['web', 'auth'],
    ],

    function () {

        // Service Handyman
        Route::get('/handyman/service/list','AgencyController@serviceList');
        Route::get('/handyman/service/add','AgencyController@serviceForm');
            Route::post('/handyman/service/save','AgencyController@serviceSave');
        Route::get('/handyman/service/edit/{id}','AgencyController@serviceShow');
            Route::post('/handyman/service/update','AgencyController@serviceUpdate');
        Route::get('/handyman/service/delete/{id}','AgencyController@serviceDelete');

        // Promotion Handyman
        Route::get('/handyman/promotion/list','AgencyController@promotionList');
        Route::get('/handyman/promotion/add','AgencyController@promotionForm');
            Route::post('/handyman/promotion/save','AgencyController@promotionSave');
        Route::get('/handyman/promotion/edit/{id}','AgencyController@promotionShow');
            Route::post('/handyman/promotion/update','AgencyController@promotionUpdate');
        Route::get('/handyman/promotion/delete/{id}','AgencyController@promotionDelete');

        // Booking Handyman
        Route::get('/handyman/booking/list','AgencyController@bookingList');
        Route::get('/handyman/booking/edit/{id}','AgencyController@bookingShow');
        Route::get('/handyman/booking/modal/{id}','AgencyController@bookingModal');
            Route::post('/handyman/booking/update','AgencyController@bookingUpdate');
































        //registry
        Route::get('/agency/index','AgencyController@index');

        // Pengurusan Tetapan
        Route::get('/ptj/tetapan/list','AgencyController@tetapanList');
        Route::get('/ptj/tetapan/add','AgencyController@tetapanForm');
            Route::post('/ptj/tetapan/save','AgencyController@tetapanSave');
        Route::get('/ptj/tetapan/edit/{id}','AgencyController@tetapanShow');
            Route::post('/ptj/tetapan/update','AgencyController@tetapanUpdate');

        Route::get('/ptj/tetapan/ajax/{agencyid}/{ptjid}','AgencyController@getAjaxTetapan');
        Route::get('/ptj/tetapan/ptj/{agencyid}', 'AgencyController@ajaxTetapanPtj');
        Route::get('/ptj/tetapan/ptjtetapan/{agencyid}', 'AgencyController@getTetapanPtj');
        Route::get('/ptj/tetapan/hasiltetapan/{ptjid}', 'AgencyController@getTetapanHasil');

        // Pengurusan Perkhidmatan
        Route::get('/ptj/servicerate/list','AgencyController@servicerateList');
        Route::get('/ptj/servicerate/addMgt','AgencyController@mgtForm');
            Route::post('/ptj/servicerate/saveMgt','AgencyController@mgtSave');
        Route::get('/ptj/servicerate/editMgt/{svrid}','AgencyController@mgtShow');
            Route::post('/ptj/servicerate/updMgt','AgencyController@mgtUpd');

        Route::get('/ptj/servicerate/ajax/{agencyid}/{ptjid}','AgencyController@getAjaxServiceRate');
        Route::get('/ptj/servicerate/ptj/{agencyid}', 'AgencyController@ajaxServiceRatePtj');
        Route::get('/ptj/servicerate/ptjkhidmat/{agencyid}', 'AgencyController@ajaxKhidmatPtj');
        Route::get('/ptj/servicerate/hasilkhidmat/{ptjid}', 'AgencyController@ajaxKhidmatHasil');

        // Pengurusan Kadar Bayaran
        Route::get('/ptj/servicerate/listkadar/{id}','AgencyController@kadarList');
        Route::get('/ptj/servicerate/addkadar/{id}','AgencyController@kadarForm');
            Route::post('/ptj/servicerate/savekadar','AgencyController@kadarSave');
        Route::get('/ptj/servicerate/editkadar/{id}/{kadarid}','AgencyController@kadarShow');
            Route::post('/ptj/servicerate/updkadar','AgencyController@kadarUpd');

        // perkhidmatan dan kadar byaran base on agency
        Route::get('/ptj/kadarbayaran/list','AgencyController@ptjKadarList');

        // Pengurusan Kod Hasil
        Route::get('/ptj/kodhasil/list','AgencyController@kodhasilList');
        Route::get('/ptj/kodhasil/add','AgencyController@kodhasilForm');
            Route::post('/ptj/kodhasil/save','AgencyController@kodhasilSave');
        Route::get('/ptj/kodhasil/edit/{id}','AgencyController@kodhasilShow');
            Route::post('/ptj/kodhasil/update','AgencyController@kodhasilUpdate');

        // Pengurusan Kod Hasil Detail
        Route::get('/ptj/kodhasil/listdetail/{id}','AgencyController@detailList');
        Route::get('/ptj/kodhasil/adddetail/{id}','AgencyController@detailForm');
            Route::post('/ptj/kodhasil/savedetail','AgencyController@detailSave');
        Route::get('/ptj/kodhasil/editdetail/{id}/{khdid}','AgencyController@detailShow');
            Route::post('/ptj/kodhasil/updatedetail','AgencyController@detailUpdate');

        // Pengurusan Akaun
        // Route::get('/ptj/account/list','BillController@accountList');
        // Route::get('/ptj/account/add','BillController@accountForm');

        Route::get('/ptj/account/list/{kodhasil}','BillController@payerAccList');
        Route::get('/ptj/account/add/{kodhasil}','BillController@payerAccForm');

            Route::post('/ptj/account/save','BillController@accountSave');
        Route::get('/ptj/account/edit/{kodhasil}/{id}','BillController@accountShow');
            Route::post('/ptj/account/update','BillController@accountUpdate');

        // Pengurusan Akaun Import Excel
            Route::post('/ptj/account/import', 'ImportController@import')->name('account.import');

        // Pengurusan Maklumat Pembayaran Bil
        // Route::get('/ptj/bill/list','BillController@billList');
        // Route::get('/ptj/bill/add','BillController@billForm');

        Route::get('/ptj/bill/list/{kodhasil}','BillController@payerBillList');
        Route::get('/ptj/bill/add/{kodhasil}','BillController@payerBillForm');
        Route::get('/ptj/getstatus/{status}','BillController@loadStatus');

            Route::post('/ptj/bill/save','BillController@billSave');
        Route::get('/ptj/bill/edit/{kodhasil}/{id}','BillController@billShow');
            Route::post('/ptj/bill/update','BillController@billUpdate');

        // Pengurusan Maklumat Pembayaran Bil Import Excel
            Route::post('/ptj/bill/import', 'ImportController@importBill')->name('bill.import');
        Route::get('/ptj/bill/temporary', 'ImportController@importTemp');
            Route::post('/ptj/bill/temporarySave', 'ImportController@importSave')->name('bill.importAdd');


    }
);





