<?php

namespace Workbench\Dashboard\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Mail;
use Curl;
use Workbench\Dashboard\Service\DashboardServices;

class DashboardController extends Controller
{


    public function __construct()
    {

    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function getHome(Request $request)
    {
        $user = auth()->user();
        $userid = auth()->user()->id;
        $roleid = auth()->user()->roles['0']->id;

        switch ($roleid) {
            case 1:
                //super admin
                // return view('web::backend.dashboard.index');
            return view('dashboard::dashboard.superadmin');
                break;


            case 2:
                // admin system
                // return view('web::backend.dashboard.index');
                // return redirect(url('dashboard/admin'));
                $account = (new DashboardServices())->payerAcc($request);
                $payment = (new DashboardServices())->payment($request);
                $nopayment = (new DashboardServices())->noPayment($request);
                // $totalpayment = (new DashboardServices())->barChartTotalPayment($request);
                // $barChartTotalPaymentLabel = $totalpayment['totalpayment_label'];
                // $barChartTotalPaymentData = $totalpayment['totalpayment_data'];
                $diffhasil = (new DashboardServices())->lineChartDiffHasil($request);
                // $paygatewayxhasil = (new DashboardServices())->paygatewayxhasil($request);
                // $chartdailypaymentbyptj = (new DashboardServices())-> chartdailypaymentbyptj($request);
                // $chartdailypaymentbyagency = (new DashboardServices())-> chartdailypaymentbyagency($request);
                // $chartmonthlypaymentbyagency = (new DashboardServices())-> chartmonthlypaymentbyagency($request);
                // $chartannualpaymentbyagency = (new DashboardServices())-> chartannualpaymentbyagency($request);
                // $charthighestpendapatan = (new DashboardServices())-> charthighestpendapatan($request);
                // $chartlowestpendapatan = (new DashboardServices())-> chartlowestpendapatan($request);

                return view('dashboard::dashboard.admin', compact('account','payment','nopayment','diffhasil'));

                break;

            case 3:
                //admin kewangan
                // return view('web::backend.dashboard.index');
                // $totalpayment = (new DashboardServices())->barChartTotalPayment($request);
                // $barChartTotalPaymentLabel = $totalpayment['totalpayment_label'];
                // $barChartTotalPaymentData = $totalpayment['totalpayment_data'];
                // $diffhasil = (new DashboardServices())->lineChartDiffHasil($request);
                // $chartdailypaymentbyagency = (new DashboardServices())-> chartdailypaymentbyagency($request);
                // $chartmonthlypaymentbyagency = (new DashboardServices())-> chartmonthlypaymentbyagency($request);
                // $chartannualpaymentbyagency = (new DashboardServices())-> chartannualpaymentbyagency($request);
                // $carabayaranxagensi = (new DashboardServices())-> carabayaranxagensi($request);
                // $charthighestpendapatan = (new DashboardServices())-> charthighestpendapatan($request);
                // $chartlowestpendapatan = (new DashboardServices())-> chartlowestpendapatan($request);

                return view('dashboard::dashboard.kewangan');
                break;

            case 4:
                //admin ptj/agensi
                // return view('web::backend.dashboard.index');
                // return redirect(url('dashboard/agency'));
                $account = (new DashboardServices())->payerAcc($request);
                $payment = (new DashboardServices())->payment($request);
                $nopayment = (new DashboardServices())->noPayment($request);
                $srv = (new DashboardServices())->handybookingList($request);
                $statusNew = (new DashboardServices())->statusNew($request);
                $statusSuccess = (new DashboardServices())->statusSuccess($request);
                $statusRejected = (new DashboardServices())->statusRejected($request);
                $user = (new DashboardServices())->user($request);

                return view('dashboard::dashboard.agency', compact('account','payment','nopayment','srv','statusNew','statusSuccess','statusRejected','user'));
                break;

            case 5:
                //pegawai agensi
                // return view('web::backend.dashboard.index');
                $account = (new DashboardServices())->payerAcc($request);
                $payment = (new DashboardServices())->payment($request);
                $nopayment = (new DashboardServices())->noPayment($request);

                return view('dashboard::dashboard.agency', compact('account','payment','nopayment','totalpayment'));
                break;

            case 6:
                //vvip pengurasan tertinggi

                $totalpayment = (new DashboardServices())->barChartTotalPayment($request);
                $barChartTotalPaymentLabel = $totalpayment['totalpayment_label'];
                $barChartTotalPaymentData = $totalpayment['totalpayment_data'];
                $diffhasil = (new DashboardServices())->lineChartDiffHasil($request);
                $chartdailypaymentbyagency = (new DashboardServices())-> chartdailypaymentbyagency($request);
                $chartmonthlypaymentbyagency = (new DashboardServices())-> chartmonthlypaymentbyagency($request);
                $chartannualpaymentbyagency = (new DashboardServices())-> chartannualpaymentbyagency($request);
                $carabayaranxagensi = (new DashboardServices())-> carabayaranxagensi($request);
                $charthighestpendapatan = (new DashboardServices())-> charthighestpendapatan($request);
                $chartlowestpendapatan = (new DashboardServices())-> chartlowestpendapatan($request);

                return view('dashboard::dashboard.vvip', compact('chartdailypaymentbyagency', 'barChartTotalPaymentLabel', 'barChartTotalPaymentData', 'diffhasil', 'chartmonthlypaymentbyagency', 'chartannualpaymentbyagency', 'carabayaranxagensi', 'charthighestpendapatan', 'chartlowestpendapatan'));
                // return view('web::backend.dashboard.vvip');
                break;


            case 7:
                // return view('web::backend.dashboard.index');
                $data = array();
                $booking = (new DashboardServices())->bookingList($request);
                $transaction = (new DashboardServices())->transaction($request);
                $transberjaya= (new DashboardServices())->bil_transaction(1);
                $transpendding= (new DashboardServices())->bil_transaction(3);
                $transgagal= (new DashboardServices())->bil_transaction(2);
                $jumlah= (new DashboardServices())->jumlah();



                return view('dashboard::dashboard.pelanggan',compact('data','booking','transaction','transberjaya','transpendding','transgagal','jumlah','userid'));

                break;


            default:
                // code...
                break;
        }
    }


    public function index()
    {
      // dd('sini');
		  return view('dashboard::dashboard.index');


    }



    public function administrator()
    {
        return view('dashboard::dashboard.administrator');
    }

    public function admin()
    {
        return view('dashboard::dashboard.admin');
    }

    public function pelanggan()
    {
        $data = array();
        return view('dashboard::dashboard.pelanggan',compact('data'));
    }

    public function agency()
    {
       
        return view('dashboard::dashboard.agency');
    }
    public function updatetroli(Request $request)
    {

        $updatetroli= (new DashboardServices())->updatetroli($request);

        if($updatetroli==1){
             return redirect('/home')->withError('Data telah wujud dalam troli');


        }else{
             return redirect('/login/cart/list')->withSuccess('Berjaya mengemaskini data');


        }


    }





}
