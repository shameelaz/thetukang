<?php

namespace Workbench\Dashboard\Service;

use Illuminate\Routing\Controller;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Overdrive\Web\Model\Menus;
use Overdrive\Web\Model\Mpermission;
use Overdrive\Web\Model\ARole;
use Overdrive\Web\Model\Urole;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Session;
use App;
use Config;
use Auth;
use File;
use Redirect;
use Mail;
use Curl;
use DB;
use Workbench\Database\Model\Agency\Ptj;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\Agency\KodHasil;
use Workbench\Database\Model\Bill\FavouriteAccount;
use Workbench\Database\Model\Bill\PayerAccount;
use Workbench\Database\Model\Bill\PayerBill;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\PaymentDetail;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\View\Chart\VWChartBayaranHarianPtj;
use Workbench\Database\Model\View\Chart\VWChartMonthlyPaymentByHasil;
use Workbench\Database\Model\View\Chart\VWChartMonthlyPaymentByYear;
use Workbench\Database\Model\View\Chart\VWChartPaymentGatewayXHasil;
use Workbench\Database\Model\View\Chart\VWChartHarianByAgency;
use Workbench\Database\Model\View\Chart\VWChartHarianByPtj;
use Workbench\Database\Model\View\Chart\VWChartBulananByAgency;
use Workbench\Database\Model\View\Chart\VWChartTahunanByAgency;
use Workbench\Database\Model\View\Chart\VWCaraBayaranXAgensi;
use Workbench\Database\Model\View\Chart\VWPendapatanByKodHasil;
use Illuminate\Support\Collection;
use Workbench\Database\Model\Bill\Payer;
use Workbench\Database\Model\Payment\ServiceMain;
use Workbench\Database\Model\Payment\ServiceMainDetail;
use Workbench\Database\Model\Bill\Troli;

class DashboardServices
{

    public function registeredAccount(Request $request)
    {
        $user = Auth::user()->id;
        $now = Carbon::now();
        // dd($user);

        // $account = FavouriteAccount::where('fk_user', $user)
        //                         ->where('status',1)
        //                         ->with('fkpayeracc.codehasil.lkpperkhidmatan','fkpayeracc.fkagency','fkpayeracc.fkptj','')
        //                         ->get();
            // dd($account);

        // $account = FavouriteAccount::with('fkpayeracc.fkpayerbill')
        //                         ->where('fk_user' , $user)
        //                         ->whereHas('fkpayeracc.fkpayerbill', function ($query) use ($request)
        //                             {
        //                             $query->where('status', '=', 1);
        //                             })
        //                         ->get();

        // dd($account);

        $account = PayerBill::with('payeraccount.fkfavouriteaccount')
                            ->whereHas('payeraccount.fkfavouriteaccount', function ($query) use ($user)
                                {
                                $query->where('fk_user', $user);
                                })
                            ->where('bill_end_date', '>=', $now)
                            ->where('status', 1)
                            ->get();

                                // dd($account);

        return $account;
    }


    public function transaction(Request $request)
    {

        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;

         if($roleid==7){//pelanggan

            $transaction = PaymentDetail::with('fkpayment','fkpayer')
                           ->whereHas('fkpayment', function ($query) use ($user)
                            {
                                $query->where('fk_user',$user);

                            })->get();


         }else{

            $transaction = PaymentDetail::with('fkpayment','fkpayer')
                            ->get();


         }




        return $transaction;
    }
    public function bil_transaction($id)
    {

         $user = Auth::user()->id;
         $bil_transaction = Payment::where('status',$id)
                            ->where('fk_user',$user)
                            ->count();


        return $bil_transaction;
    }
    public function jumlah()
    {

         $user = Auth::user()->id;
         $jumlah = Payment::where('status',1)
                            ->where('fk_user',$user)
                            ->sum('total_amount');


        return $jumlah;
    }
    public function payerAcc(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        // if(($roleid == 1)||($roleid == 2))
        // {
        //     $account = PayerAccount::count();
        // }
        // elseif(($roleid == 4)||($roleid == 5))
        // {
        //     $ptj = UserProfile::where('fk_users','=',$user)
        //                     ->with('userPtj','userPtj.payerAccount')
        //                     ->first();

        //                     // dd($ptj);

        //     $account = $ptj->userPtj->payerAccount->count();
        // }
        $account = PayerAccount::count();

        return $account;
    }

    public function payment(Request $request)
    {
        $payment = Payment::where('status', 1)->count();

        return $payment;
    }

    public function noPayment(Request $request)
    {
        $payment = PayerBill::where('status', 0)->count();

        return $payment;
    }

    public function barChartTotalPayment(Request $request)
    {
        $totalpayment = VWChartBayaranHarianPtj::get();

        $totalpayment_label = array();
        $totalpayment_data = array();

        foreach($totalpayment as $key => $value){
            array_push($totalpayment_label, $value->labels);
            array_push($totalpayment_data, $value->data);
        }

        return compact('totalpayment_label', 'totalpayment_data');
    }

    public function lineChartDiffHasil(Request $request)
    {
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        $current = date('Y');
        $pre = $current-1;

        $a = array();

        foreach($month as $key => $value)
        {
            $query = Payment::where('status',1)->whereYear('transaction_date',$current)->whereMonth('transaction_date',$value)->sum('total_amount');
            if($value == '01'){
                $text = 'Januari';
            }
            elseif($value == '02')
            {
                $text = 'Februari';
            }
            elseif($value == '03')
            {
                $text = 'Mac';
            }
            elseif($value == '04')
            {
                $text = 'April';
            }
            elseif($value == '05')
            {
                $text = 'Mei';
            }
            elseif($value == '06')
            {
                $text = 'Jun';
            }
            elseif($value == '07')
            {
                $text = 'Julai';
            }
            elseif($value == '08')
            {
                $text = 'Ogos';
            }
            elseif($value == '09')
            {
                $text = 'September';
            }
            elseif($value == '10')
            {
                $text = 'Oktober';
            }
            elseif($value == '11')
            {
                $text = 'November';
            }
            else
            {
                $text = 'Disember';
            }

            $a[$current][$text] = $query;

            $query2 = Payment::where('status',1)->whereYear('transaction_date',$pre)->whereMonth('transaction_date',$value)->sum('total_amount');

            if($value == '01'){
                $text2 = 'Januari';
            }
            elseif($value == '02')
            {
                $text2 = 'Februari';
            }
            elseif($value == '03')
            {
                $text2 = 'Mac';
            }
            elseif($value == '04')
            {
                $text2 = 'April';
            }
            elseif($value == '05')
            {
                $text2 = 'Mei';
            }
            elseif($value == '06')
            {
                $text2 = 'Jun';
            }
            elseif($value == '07')
            {
                $text2 = 'Julai';
            }
            elseif($value == '08')
            {
                $text2 = 'Ogos';
            }
            elseif($value == '09')
            {
                $text2 = 'September';
            }
            elseif($value == '10')
            {
                $text2 = 'Oktober';
            }
            elseif($value == '11')
            {
                $text2 = 'November';
            }
            else
            {
                $text2 = 'Disember';
            }


            $a[$pre][$text2] = $query2;
        }

        return $a;

    }

    public function hasilList(Request $request)
    {
        $user = UserProfile::where('fk_users', Auth::id())->first();
        $ptjKodHasil =  KodHasil::where('fk_ptj', $user->fk_ptj)->get();

        $kod = [];
        foreach ($ptjKodHasil as $key => $value) {
            $kod[] = $value->id;
        }

        $hasil = KodHasil::where('status', 1)
                         ->whereIn('id', $kod)
                         ->get();

        return $hasil;
    }

    public function monthlyPayment(Request $request)
    {
        $enddate = date("Y-m-d");
        $startdate = date('Y-m-d', strtotime($enddate. ' - 1 months'));

        $user = UserProfile::where('fk_users', Auth::id())->first();
        $ptjKodHasil =  KodHasil::where('fk_ptj', $user->fk_ptj)->get();

        $kod = [];
        foreach ($ptjKodHasil as $key => $value) {
            $kod[] = $value->id;
        }

        $data= VWChartMonthlyPaymentByHasil::whereBetween('date', [$startdate, $enddate])
                                           ->whereIn('fk_kod_hasil', $kod)
                                           ->get();

        $date = VWChartMonthlyPaymentByHasil::select('date')
                                            ->whereBetween('date', [$startdate, $enddate])
                                            ->distinct()
                                            ->get();
        $mpdate = array();
        foreach($date as $key => $value){
            array_push($mpdate, $value->date);
        }

        return compact('data', 'enddate', 'startdate', 'mpdate');
    }

    public function monthlypaymentbyyear(Request $request)
    {
        $year = date('Y');
        $month_names = array("Januari","Februari","Mac","April","Mei","Jun","Julai","Ogos","September","Oktober","November","Disember");
        $months = [];
        foreach ($month_names as $key => $value) {
            $months[$key+1] = $value;
        }

        $user = UserProfile::where('fk_users', Auth::id())->first();
        $ptjKodHasil =  KodHasil::where('fk_ptj', $user->fk_ptj)->get();
        $kod = [];
        foreach ($ptjKodHasil as $key => $value) {
            $kod[] = $value->id;
        }
        // dd($kod);

        $data = VWChartMonthlyPaymentByYear::where('year', $year)
                                           ->whereIn('fk_kod_hasil', $kod)
                                           ->get();

        $kod_hasil = VWChartMonthlyPaymentByYear::select('fk_kod_hasil', 'kod_hasil')
                                                ->where('year', $year)
                                                ->whereIn('fk_kod_hasil', $kod)
                                                ->distinct()
                                                ->get();
        // dd($kod_hasil);
        return compact('year', 'data', 'months', 'kod_hasil');
    }

    public function paygatewayxhasil(Request $request)
    {
        $roleid = auth()->user()->roles['0']->id;
        $year = date('Y');

        if ($roleid == '4' || $roleid == '5') {
            $user = UserProfile::where('fk_users', Auth::id())->first();
            $ptjKodHasil =  KodHasil::where('fk_ptj', $user->fk_ptj)->get();
        }
        elseif ($roleid == '2')
        {
            $ptjKodHasil =  KodHasil::all();
        }

        $kod = [];
        foreach ($ptjKodHasil as $key => $value) {
            $kod[] = $value->id;
        }

        $data = VWChartPaymentGatewayXHasil::whereIn('fk_kod_hasil', $kod)
                                           ->where('year', $year)
                                           ->get();

        $kod_hasil = VWChartPaymentGatewayXHasil::select('fk_kod_hasil', 'kod_hasil')
                                                ->whereIn('fk_kod_hasil', $kod)
                                                ->where('year', $year)
                                                ->distinct()
                                                ->get();
        // dd($kod_hasil);
        $carabayar = VWChartPaymentGatewayXHasil::select('fk_payment_gateway','name')
                                                ->whereIn('fk_kod_hasil', $kod)
                                                ->where('year', $year)
                                                ->distinct()
                                                ->get();

        return compact('year', 'data', 'kod_hasil', 'carabayar');
    }

    public function chartdailypaymentbyptj(Request $request)
    {
        $roleid = auth()->user()->roles['0']->id;
        $today = date("Y-m-d");

        $user = UserProfile::where('fk_users', Auth::id())->first();
        $ptjKodHasil =  KodHasil::where('fk_ptj', $user->fk_ptj)->get();

        $kod = [];
        foreach ($ptjKodHasil as $key => $value) {
            $kod[] = $value->id;
        }

        $data = VWChartHarianByPtj::whereIn('fk_kod_hasil', $kod)
                                  ->where('date', $today)
                                  ->get();

        $dailyptj_label = array();
        $dailyptj_data = array();

        foreach($data as $key => $value){
            array_push($dailyptj_label, $value->kod_hasil);
            array_push($dailyptj_data, $value->amount);
        }

        return compact('ptjKodHasil', 'data', 'today', 'dailyptj_label', 'dailyptj_data');
    }

    public function chartdailypaymentbyagency(Request $request)
    {
        $roleid = auth()->user()->roles['0']->id;
        $today = date("Y-m-d");

        $user = UserProfile::where('fk_users', Auth::id())->first();

        $data = VWChartHarianByAgency::where('date', $today)->get();

        $dailyagency_label = array();
        $dailyagency_amount = array();
        $dailyagency_name = array();

        foreach ($data as $key => $value) {
            array_push($dailyagency_label, $value->agensi_kod);
            array_push($dailyagency_amount, $value->amount);
            array_push($dailyagency_name, $value->agensi_name);
        }

        return compact('dailyagency_name', 'dailyagency_amount', 'dailyagency_label', 'today');
    }

    public function chartmonthlypaymentbyagency(Request $request)
    {
        $year = date('Y');
        $month = date('n');

        $data = VWChartBulananByAgency::where('year', $year)
                                      ->where('month', $month)
                                      ->get();

        $monthlyagency_label = array();
        $monthlyagency_amount = array();
        $monthlyagency_name = array();

        foreach ($data as $key => $value) {
            array_push($monthlyagency_label, $value->agensi_kod);
            array_push($monthlyagency_amount, $value->amount);
            array_push($monthlyagency_name, $value->agensi_nama);
        }

        return compact('year', 'month', 'monthlyagency_amount', 'monthlyagency_label', 'monthlyagency_name');
    }
    public function updatetroli(Request $request)
    {
        $user = Auth::user()->id;
        //create service main & service main detail

        $payerbill=PayerBill::find($request->payerbill);

        $ptjpayerbill=data_get($payerbill,'fk_ptj');

        $ptjtroli=Troli::with('fkservice','fkservice.fkkodhasil.ptj','fkuser','fkpayerbill')
                        ->whereHas('fkservice.fkkodhasil.ptj', function ($query) use ($ptjpayerbill)
                                    {
                                    $query->where('id', '=', $ptjpayerbill);
                                    })
                        ->whereHas('fkuser', function ($query) use ($user)
                                    {
                                        $query->where('id', $user);
                                    })
                        ->whereHas('fkpayerbill', function ($query) use ($payerbill)
                                    {
                                        $query->where('fk_payer_bill', $payerbill->id);
                                    })
                        ->count();
        // dd($ptjtroli);





        $servicemain = new ServiceMain;
        $servicemain->fk_user=$request->fkuser;
        $servicemain->fk_payer_bill=$request->payerbill;
        $servicemain->fk_kod_hasil=data_get($payerbill,'fk_kod_hasil');
        $servicemain->total=data_get($payerbill,'amount');
        $servicemain->save();

        $servicedetail = new ServiceMainDetail;
        $servicedetail->fk_service_main=$servicemain->id;
        $servicedetail->total=data_get($payerbill,'amount');
        $servicedetail->save();

        $check = PayerAccount::where('account_no',$payerbill->account_no)->first();
        // dd($check);

        if($check){
            $addpayer = new Payer;
            $addpayer->name = $check->name;
            $addpayer->account_no = $check->account_no;
            $addpayer->address = $check->address;
            $addpayer->city = $check->city;
            $addpayer->state = $check->state;
            $addpayer->identification_no = str_replace('-', '', $check->identification_no);
            $addpayer->status = data_get($check,'status',1);
            $addpayer->save();
        }

        //create troli

        //cek ptj dah ade kebelum dulu


        if($ptjtroli>0){
            // dd('1');
            return 1;

        }else{

            $troli = new Troli;
            $troli->fk_payer_bill=$request->payerbill;
            $troli->fk_user=$request->fkuser;
            $troli->fk_payer=$addpayer->id;
            $troli->type=1;
            $troli->fk_service=$servicemain->id;
            $troli->amount=data_get($payerbill,'amount');
            $troli->status=1;
            $troli->save();

        return 0;


       }

    }

     public function chartannualpaymentbyagency(Request $request)
    {
        $year = date('Y');
        $months = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Mac',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Jun',
                    7 => 'Julai',
                    8 => 'Ogos',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Disember'
                ];

        $colors = [
                    1 => '#DFFF00',
                    2 => '#4169E1',
                    3 => '#FF7F50',
                    4 => '#DE3163',
                    5 => '#9FE2BF',
                    6 => '#40E0D0',
                    7 => '#6495ED',
                    8 => '#CCCCFF',
                    9 => '#000080',
                    10 => '#800080',
                    11 => '#00FF00',
                    12 => ' #800000'
                ];

        $data = array(1,2,3,4,5,6,7,8,9,10,11,12);
        $label = array();

        $kod_hasil = VWChartTahunanByAgency::where('year', $year)->groupBy('agensi_kod')->get();

        foreach ($kod_hasil as $i => $kod) {
            $label[] = $kod->agensi_kod;
        }

        for($ii = 0, $kk = 1; $ii < 12; $ii++, $kk++){

            $data[$ii] = array();
            $data[$ii]['data'] = array();

            for($jj = 0; $jj < count($label); $jj++){

                $data_query = VWChartTahunanByAgency::where('year', $year)->where('agensi_kod',$label[$jj])->where('month', $kk)->first();

                $data[$ii]['label'] =   $months[$kk];
                $data[$ii]['backgroundColor'] = $colors[$kk];
                $data[$ii]['data'][$jj] = 0;

                if($data_query)
                {
                    $data[$ii]['label'] =   $months[$kk];
                    $data[$ii]['backgroundColor'] = $colors[$kk];
                    $data[$ii]['data'][$jj] = $data_query->amount;

                }
            }
        }

        return compact('year', 'data', 'label');
    }

    public function carabayaranxagensi(Request $request)
    {
        $year = date('Y');

        $colors = [
                    0 => '#800000',
                    1 => '#DFFF00',
                    2 => '#4169E1',
                    3 => '#FF7F50',
                    4 => '#DE3163',
                    5 => '#9FE2BF',
                    6 => '#40E0D0',
                    7 => '#6495ED',
                    8 => '#CCCCFF',
                    9 => '#000080',
                    10 => '#800080',
                    11 => '#00FF00'
                ];

        $bayaran = VWCaraBayaranXAgensi::select('payment_gateway')->where('year', $year)->groupBy('payment_gateway')->get();

        $cara = array();

        foreach ($bayaran as $key => $pg) {
            $cara[] = $pg->payment_gateway;
        }

        $agensi = VWCaraBayaranXAgensi::select('kod_agensi')->where('year', $year)->groupBy('kod_agensi')->get();

        $agencies = array();
        $data = array();
        $n = 0;

        foreach ($agensi as $key => $ag) {
            $n++;
            $agencies[] = $ag->kod_agensi;
            $data[] = $n;
        }

        // dd($cara);
        for ($agc=0; $agc < count($agencies); $agc++) {

            $data[$agc] = array();
            $data[$agc]['data'] = array();

            $num = 0;

            foreach ($cara as $key => $value) {

                $data_query = VWCaraBayaranXAgensi::where('year', $year)->where('payment_gateway',$cara[$num])->where('kod_agensi', $agencies[$agc])->first();

                $data[$agc]['label'] = $agencies[$agc];
                $data[$agc]['backgroundColor'] = $colors[$agc];
                $data[$agc]['data'][$num] = 0;

                if($data_query)
                {
                    $data[$agc]['label'] = $agencies[$agc];
                    $data[$agc]['backgroundColor'] = $colors[$agc];
                    $data[$agc]['data'][$num] = $data_query->amount;

                }

                $num++;
            }
        }

        return compact('year', 'data', 'cara');
    }

    public function charthighestpendapatan(Request $request)
    {
        $year = date('Y');
        $month = date('n');

        $data = VWPendapatanByKodHasil::where('year', $year)
                                      ->where('month', $month)
                                      ->orderBy('amount' ,'DESC')
                                      ->take('10')
                                      ->get();

        $label = array();
        $amount = array();

        foreach ($data as $key => $value) {
            array_push($label, $value->kod_hasil);
            array_push($amount, $value->amount);
        }

        return compact('year', 'month', 'label', 'amount');
    }

    public function chartlowestpendapatan(Request $request)
    {
        $year = date('Y');
        $month = date('n');

        $data = VWPendapatanByKodHasil::where('year', $year)
                                      ->where('month', $month)
                                      ->orderBy('amount' ,'ASC')
                                      ->take('10')
                                      ->get();

        $label = array();
        $amount = array();

        foreach ($data as $key => $value) {
            array_push($label, $value->kod_hasil);
            array_push($amount, $value->amount);
        }

        return compact('year', 'month', 'label', 'amount');
    }
}
