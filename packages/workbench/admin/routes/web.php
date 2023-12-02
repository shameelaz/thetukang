<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Workbench\Admin\Http\Controllers\AdminController;

Route::group(
    [
        'namespace'  => '\Workbench\Admin\Http\Controllers',
        'prefix'     => '',
        'as'         => 'admin::',
        'middleware' => ['web', 'auth'],
    ],

    function () {

        //registry
        Route::get('/admin/index','AdminController@index');

        //pengurusan agensi
        Route::get('/admin/agency/list', 'AgencyController@agencyList');
        Route::get('/admin/agency/add', 'AgencyController@agencyAdd');
            Route::post('/admin/agency/save', 'AgencyController@agencySave');
        Route::get('/admin/agency/edit/{id}', 'AgencyController@agencyEdit');
            Route::post('/admin/agency/update', 'AgencyController@agencyUpd');

        // pengurusan ptj
        Route::get('/admin/agency/ptj/list', 'PtjController@ptjagensiList');
        Route::get('/admin/agency/ptj/show/{id}', 'PtjController@show');
            Route::post('/admin/agency/ptj/listresult', 'PtjController@adminList');
        Route::get('/admin/agency/ptj/add', 'PtjController@ptjagensiAdd');
            Route::post('/admin/agency/ptj/save', 'PtjController@ptjagensiSave');
        Route::get('/admin/agency/ptj/edit/{ptjid}', 'PtjController@ptjagensiEdit');
            Route::post('/admin/agency/ptj/update', 'PtjController@ptjagensiUpd');
            Route::get('/admin/agency/getptj/{id}','PtjController@getLkpPtjList');
            Route::get('/admin/agency/getkod/{id}','PtjController@getKodPtj');
            Route::get('/admin/agency/getswift/{id}','PtjController@getKodSwift');

        //pengurusan perkhidmatan
        Route::get('/admin/khidmat/list', 'KhidmatController@khidmatList');
        Route::get('/admin/khidmat/add', 'KhidmatController@khidmatAdd');
            Route::post('/admin/khidmat/save', 'KhidmatController@khidmatSave');
        Route::get('/admin/khidmat/edit/{id}', 'KhidmatController@khidmatEdit');
            Route::post('/admin/khidmat/update', 'KhidmatController@khidmatUpd');

        // pengurusan kod hasil
        Route::get('/admin/hasil/list', 'HasilController@hasilList');
        Route::get('/admin/hasil/ajax/ptj/{agency}', 'HasilController@hasilPtjAjax');
        Route::get('/admin/hasil/ajax/agency/{agency}', 'HasilController@hasilAjax');
        Route::get('/admin/hasil/result/{agency}/{ptj}', 'HasilController@hasilResult');
        Route::get('/admin/hasil/add/{agency}/{ptj}', 'HasilController@hasilForm');
            Route::post('/admin/hasil/save', 'HasilController@hasilSave');
        Route::get('/admin/hasil/edit/{agency}/{ptj}/{chid}', 'HasilController@hasilShow');
            Route::post('/admin/hasil/update', 'HasilController@hasilUpd');

        Route::get('/admin/hasil/ajax/{agencyid}/{ptjid}','HasilController@getAjaxHasil');
        Route::get('/admin/hasil/ptj/{agencyid}', 'HasilController@ajaxHasilPtj');
        Route::get('/admin/hasil/ptjliabiliti/{agencyid}', 'HasilController@getHasilPtj');

        // pengurusan kod liabiliti
        Route::get('/admin/liabiliti/list', 'LiabilitiController@liabilitiList');
        Route::get('/admin/liabiliti/ajax/ptj/{agency}', 'LiabilitiController@liabilitiPtjAjax');
        Route::get('/admin/liabiliti/ajax/agency/{agency}', 'LiabilitiController@liabilitiAjax');
        Route::get('/admin/liabiliti/result/{agency}/{ptj}', 'LiabilitiController@liabilitiResult');
        Route::get('/admin/liabiliti/add/{agency}/{ptj}', 'LiabilitiController@liabilitiForm');
            Route::post('/admin/liabiliti/save', 'LiabilitiController@liabilitiSave');
        Route::get('/admin/liabiliti/edit/{agency}/{ptj}/{lid}', 'LiabilitiController@liabilitiShow');
            Route::post('/admin/liabiliti/update', 'LiabilitiController@liabilitiUpd');

        Route::get('/admin/liabiliti/ajax/{agencyid}/{ptjid}','LiabilitiController@getAjaxLiabiliti');
        Route::get('/admin/liabiliti/ptj/{agencyid}', 'LiabilitiController@ajaxLiabilitiPtj');
        Route::get('/admin/liabiliti/ptjliabiliti/{agencyid}', 'LiabilitiController@getLiabilitiPtj');


        // pengurusan pengurusan servis
        Route::get('/admin/service/list', 'ServiceController@serviceList');
        Route::get('/admin/service/ajax/ptj/{agency}', 'ServiceController@servicePtjAjax');
        Route::get('/admin/service/ajax/agency/{agency}', 'ServiceController@serviceAjax');
        Route::get('/admin/service/result/{agency}/{ptj}', 'ServiceController@serviceResult');
        Route::get('/admin/service/add/{agency}/{ptj}', 'ServiceController@serviceForm');
            Route::post('/admin/service/save', 'ServiceController@serviceSave');
        Route::get('/admin/service/edit/{agency}/{ptj}/{agsid}', 'ServiceController@serviceShow');
            Route::post('/admin/service/update', 'ServiceController@serviceUpd');

        // pengurusan payment gateaway
        Route::get('/admin/payment/list', 'PaymentController@paymentList');
        Route::get('/admin/payment/add', 'PaymentController@paymentAdd');
            Route::post('/admin/payment/save', 'PaymentController@paymentSave');
        Route::get('/admin/payment/edit/{id}', 'PaymentController@paymentEdit');
            Route::post('/admin/payment/update', 'PaymentController@paymentUpd');


        // Sejarah Transaksi
        Route::get('/admin/transaction/list', 'TransactionController@transactionList');
        Route::get('/admin/transaction/ajax/{sdate}/{edate}/{agency}/{ptj}/{kodhasil}/{name}/{reference}/{receiptno}','TransactionController@getAjaxTransaction');
        Route::get('/admin/transaction/ptj/{agencyid}', 'TransactionController@ajaxPtj');
        Route::get('/admin/transaction/hasil/{agencyid}', 'TransactionController@ajaxHasil');
        Route::get('/admin/transaction/kodhasil/{ptjid}', 'TransactionController@ajaxKodhasil');
        Route::get('/admin/transaction/detail/{id}', 'TransactionController@detailTransaction');
        Route::get('/admin/transaction/export/{id}', 'TransactionController@exportTransaction');

        Route::get('/admin/transaction/pelarasan', 'TransactionController@pelarasan');
        Route::get('/admin/pelarasan/result/{id}', 'TransactionController@pelarasanResult');
            Route::post('/admin/pelarasan/save', 'TransactionController@pelarasanSave');
        Route::get('/admin/pelarasan/list', 'TransactionController@pelarasanList');

         // pengurusan maklumat agensi/ptj
        Route::get('/admin/agensiptj/list', 'AgencyptjController@agensiptjList');
        Route::get('/admin/agensiptj/add', 'AgencyptjController@agensiptjAdd');
            Route::post('/admin/agensiptj/save', 'AgencyptjController@agensiptjSave');
        Route::get('/admin/agensiptj/edit/{id}', 'AgencyptjController@agensiptjEdit');
            Route::post('/admin/agensiptj/update', 'AgencyptjController@agensiptjUpd');

            // pengurusan maklumat agensi/khidmat
        Route::get('/admin/agensiptj/khidmat/list/{id}', 'AgencyptjController@agkhidmatList');
        Route::get('/admin/agensiptj/khidmat/add/{id}', 'AgencyptjController@agkhidmatForm');
            Route::post('/admin/agensiptj/khidmat/save', 'AgencyptjController@agkhidmatSave');
        Route::get('/admin/agensiptj/khidmat/edit/{id}/{kid}', 'AgencyptjController@agkhidmatEdit');
            Route::post('/admin/agensiptj/khidmat/update', 'AgencyptjController@agkhidmatUpd');

        Route::get('/admin/agensiptj/khidmat/dalaman/list/{id}','AgencyptjController@khidmatDlmList');
        Route::get('/admin/agensiptj/khidmat/dalaman/add/{id}','AgencyptjController@khidmatDlmAdd');
        Route::post('/admin/agensiptj/khidmat/dalaman/save','AgencyptjController@khidmatDlmSave');
        Route::get('/admin/agensiptj/khidmat/dalaman/edit/{id}','AgencyptjController@khidmatDlmShow');
        Route::post('/admin/agensiptj/khidmat/dalaman/update','AgencyptjController@khidmatDlmUpd');

        //pengurusan panduan pengguna
        Route::get('/admin/userpdf/list', 'UserguideController@userpdfList');
        Route::get('/admin/userpdf/add', 'UserguideController@userpdfForm');
        Route::get('/admin/userpdf/khidmat/{agencyid}', 'UserguideController@ajaxKhidmat');
            Route::post('/admin/userpdf/save','UserguideController@userpdfSave');
        Route::get('/admin/userpdf/edit/{agency}/{id}', 'UserguideController@userpdfShow');
            Route::post('/admin/userpdf/update', 'UserguideController@userpdfUpd');


        //pengurusan faq
        Route::get('/admin/faq/list', 'FaqController@faqList')->name('admin.faq.faqList');
        // Route::get('/admin/faq/add', 'FaqController@faqAdd')->name('admin.faq.faqAdd');
        Route::get('/admin/faq/getagency/{id}','FaqController@getAgency');
        Route::get('/admin/faq/add/{fkagency}','FaqController@form');
        Route::get('/admin/faq/list/{fkagency}','FaqController@faqListAg'); //list base on agency
        Route::post('/admin/faq/save','FaqController@faqSave');
        Route::get('/admin/faq/edit/{fkagency}/{id}','FaqController@faqShow');
        Route::post('/admin/faq/update','FaqController@faqUpd');

        //pengurusan contact us
        // Route::get('/admin/contactus/edit', 'ContactusController@contactusEdit')->name('admin.contactus.contactusEdit');

        //pengurusan user awam
        Route::get('/admin/user/list', 'UserController@userList')->name('admin.user.userList');
        // Route::get('/admin/user/add', 'UserController@userAdd')->name('admin.user.userAdd');

        /*pengguna awam*/
        Route::get('/admin/user/awam','UserController@awamList');
        Route::get('/admin/user/awam/add','UserController@awamForm');
        Route::get('/admin/user/awam/edit/{id}','UserController@awamEdit');
        Route::post('/admin/user/awam/update','UserController@awamUpd');
        Route::post('/admin/user/awam/password','UserController@userPassword');

        /*pengguna agenci /PTJ*/
        Route::get('/admin/user/agency','UserController@agencyList');
        Route::get('/admin/user/agency/add','UserController@agencyForm');
        Route::post('/admin/user/agency/save','UserController@agencySave');
        Route::get('/admin/user/agency/edit/{id}','UserController@agencyEdit');
        Route::post('/admin/user/agency/update','UserController@agencyUpd');

        Route::get('/admin/user/getptj/{id}','UserController@getPtjList');

        /*pengguna dalaman*/
        Route::get('/admin/user/internal','UserController@internalList');
        Route::get('/admin/user/internal/add','UserController@internalForm');
        Route::post('/admin/user/internal/save','UserController@internalSave');
        Route::get('/admin/user/internal/edit/{id}','UserController@internalEdit');
        Route::post('/admin/user/internal/update','UserController@internalUpd');


        // base
        Route::get('/base/info','BaseController@getBase');
        Route::post('/base/update','BaseController@updBase');

        Route::post('/base/logo/update','BaseController@updLogo');
        Route::get('/base/logo','BaseController@getLogo');
        Route::post('/base/logo/update','BaseController@updLogo');

        Route::get('/admin/hubungi','BaseController@formHubungi');
        Route::post('/admin/hubungi','BaseController@updHubungi')->name('admin.update.hubungi');


        // banner/pengumuman
        Route::get('/admin/banner/list','BaseController@bannerList');
        Route::get('/admin/banner/add','BaseController@bannerAdd');
        Route::post('/admin/banner/save','BaseController@bannerSave');
        Route::get('/admin/banner/edit/{id}','BaseController@bannerEdit');
        Route::post('/admin/banner/update','BaseController@bannerUpd');
        Route::get('/admin/banner/order/{id}/{type}','BaseController@order');

        // Audit Trail
        Route::get('/admin/audit','BaseController@audit');

        // Survey
        Route::get('/admin/survey/list','SurveyController@list');
        Route::get('/admin/survey/add','SurveyController@add');
        Route::post('/admin/survey/save','SurveyController@save');
        Route::get('/admin/survey/show/{id}','SurveyController@show');
        Route::post('/admin/survey/update','SurveyController@update');

        // panduan pengguna video
        Route::get('/admin/manual/video/list','VideoController@list');
        Route::get('/admin/manual/video/add','VideoController@add');
        Route::post('/admin/manual/video/save','VideoController@save');
        Route::get('/admin/manual/video/show/{id}','VideoController@show');
        Route::post('/admin/manual/video/update','VideoController@update');

        // Laporan Senarai Pengguna
        // Route::get('/admin/report/users','ReportController@userList');
        // Route::get('/admin/report/users/ajax/{sdate}/{edate}/{role}','ReportController@getAjaxUser');
        // Route::get('/admin/report/users/{exporttype}/{sdate}/{edate}/{role}','ReportController@getExportUser');

        // // Laporan Kajian Kepuasan Pengguna
        // Route::get('/admin/report/survey','ReportController@surveyList');
        // Route::get('/admin/report/survey/ajax/{sdate}/{edate}','ReportController@getAjaxSurvey');
        // Route::get('/admin/report/survey/{exporttype}/{sdate}/{edate}','ReportController@getExportSurvey');

    }





);

Route::group(
    [
        'namespace'  => '\Workbench\Admin\Http\Controllers',
        'prefix'     => '',
        'as'         => 'user::',
        'middleware' => ['web', 'auth'],
    ],

    function () {

         //sejarah transaksi

        Route::get('/user/transaction/list', 'TransactionController@transactionList');
        Route::get('/user/transaction/ajax/{sdate}/{edate}/{agency}/{ptj}/{kodhasil}/{name}/{reference}/{receiptno}','TransactionController@getAjaxTransaction');


        }

    );


Route::group(
    [
        'namespace'  => '\Workbench\Admin\Http\Controllers',
        'prefix'     => '',
        'as'         => 'admin::',
        'middleware' => ['web'],
    ],

    function () {

        // feedback form
        Route::get('/feedback','BaseController@feedback');
        Route::get('/feedback/getagency/{id}','BaseController@getAgency');
        Route::post('/feedback/store','BaseController@sendFeedback');

        // agensi ptj Laman Utama
        Route::get('/agensi/{id}','AgencyptjController@agensiShow');

        // survey public
        Route::get('/public/survey','SurveyController@public');
        Route::post('/public/survey/save','SurveyController@saveSurvey');

        //laman utama agensi list
        Route::get('/public/agensi/list','AgencyptjController@pubAgencyList');

    }
);





