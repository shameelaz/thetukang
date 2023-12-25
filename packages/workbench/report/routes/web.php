<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Report\Http\Controllers\ReportController;

Route::group(
    [
        'namespace'  => '\Workbench\Report\Http\Controllers',
        'prefix'     => '',
        'as'         => 'report::',
        'middleware' => ['web', 'auth'],
    ],

    function () {

        // Laporan Terimaan Harian/Bulanan
        Route::get('/report/receipt','ReportController@receiptList');
        Route::get('/report/receipt/ajax/{sdate}/{edate}/{agencyid}/{ptjid}','ReportController@getAjaxReceipt');
        Route::get('/report/receipt/{exporttype}/{sdate}/{edate}/{agencyid}/{ptjid}','ReportController@getExportReceipt');
        Route::get('/report/receipt/ptj/{agencyid}', 'ReportController@ajaxReceiptPtj');


        // Laporan Terimaan Harian/Bulanan Mengikut Jenis
        Route::get('/report/receipttype','ReportController@receiptTypeList');
        Route::get('/report/receipttype/ajax/{sdate}/{edate}/{agencyid}/{ptjid}','ReportController@getAjaxReceiptType');
        Route::get('/report/receipttype/{exporttype}/{sdate}/{edate}/{agencyid}/{ptjid}','ReportController@getExportReceiptType');
        Route::get('/report/receipttype/ptj/{agencyid}', 'ReportController@ajaxReceiptTypePtj');

        // Laporan Buku Tunai Harian/Bulanan
        Route::get('/report/book','ReportController@bookList');
        Route::get('/report/book/ajax/{sdate}/{edate}/{agencyid}/{ptjid}','ReportController@getAjaxBook');
        Route::get('/report/book/{exporttype}/{sdate}/{edate}/{agencyid}/{ptjid}','ReportController@getExportBook');
        Route::get('/report/book/ptj/{agencyid}', 'ReportController@ajaxBookPtj');

        // Laporan Penyata Pemungut Harian/Bulanan
        Route::get('/report/penyatapemungut','ReportController@ppList');
        Route::get('/report/penyatapemungut/ajax/{sdate}/{edate}/{agencyid}/{ptjid}','ReportController@getAjaxPp');
        Route::get('/report/penyatapemungut/{exporttype}/{sdate}/{edate}/{agencyid}/{ptjid}','ReportController@getExportPp');
        Route::get('/report/penyatapemungut/ptj/{agencyid}', 'ReportController@ajaxPpPtj');

        // Laporan Senarai Pengguna
        Route::get('/report/users','ReportController@userList');
        Route::get('/report/users/ajax/{sdate}/{edate}/{role}','ReportController@getAjaxUser');
        Route::get('/report/users/{exporttype}/{sdate}/{edate}/{role}','ReportController@getExportUser');

        // Laporan Pelarasan Kod Hasil
        Route::get('/report/pelarasan','ReportController@pelarasanList');
        Route::get('/report/pelarasan/ajax/{sdate}/{edate}','ReportController@getAjaxPelarasan');
        Route::get('/report/pelarasan/{exporttype}/{sdate}/{edate}','ReportController@getExportPelarasan');

        // Laporan Kajian Kepuasan Pengguna
        Route::get('/report/survey','ReportController@surveyList');
        Route::get('/report/survey/ajax/{sdate}/{edate}/{level}','ReportController@getAjaxSurvey');
        Route::get('/report/survey/{exporttype}/{sdate}/{edate}/{level}','ReportController@getExportSurvey');



    }
);





