<?php

namespace Workbench\Payment\Http\Controllers;

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
use Workbench\Payment\Service\KodHasilServices;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\Bank;
use Workbench\Database\Model\Payment\Bankb2b;
use Workbench\Database\Model\Payment\MerchantSetup;



class BillController extends Controller
{
    public function __construct()
    {

    }

    public function form(Request $request)
    {
        $lkpperkhidmatan = (new KodHasilServices())->lkpperkhidmatan($request);

        return view('payment::payment.bill.form', compact('lkpperkhidmatan'));
    }

    public function search(Request $request)
    {
        $data = (new KodHasilServices())->searchbill($request);

        return view('payment::payment.bill.resultsearch', compact('data'));
    }

    public function save(Request $request)
    {
        // dd($request);
        $data = (new KodHasilServices())->saveBill($request);

        return redirect('/bayaran/bill/'.$data->fk_kod_hasil.'/1/edit/'.$data->id)->withSuccess('Berjaya mengemaskini data');
    }

    public function next(Request $request)
    {
        if($request->next)
        {
            if(($request->tab == 1)&&($request->nexttab == 2))
            {
                return redirect('/bayaran/bill/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya mengemaskini'); //seterusnya
            }
            elseif(($request->tab == 2)&&($request->nexttab == 3))
            {
                // dd($request);
                $data =  (new KodHasilServices())->addPayer($request);

                return redirect('/bayaran/bill/'.$request->kodhasil.'/3/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat pembayar'); //seterusnya
            }
            elseif(($request->tab == 3)&&($request->nexttab == 4))
            {
                $data =  (new KodHasilServices())->addPaymentType($request);

                return redirect('/bayaran/bill/'.$request->kodhasil.'/4/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); //seterusnya
            }
            else
            {

            }
        }
        else
        {
            dd('no next');
        }
    }

    public function nextBill(Request $request)
    {
        // dd($request);
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        // $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $srvmain    = (new KodHasilServices())->serviceMain($request);
        $paymentGtwy  = (new KodHasilServices())->paymentGtwy($request);
        $kodhasillist = (new KodHasilServices())->getKodHasilList($request);
        
        $tab    = $request->tab;
        $action = $request->action;

        return view('payment::payment.bill.next', compact('kodhasil', 'srvmain', 'tab', 'action', 'paymentGtwy', 'kodhasillist'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $data = (new KodHasilServices())->updBill($request);

        $tab = $request->tab;
        // $action = $request->action;
        // dd($data);

        return redirect('/bayaran/bill/'.$data->fk_kod_hasil.'/'.$tab.'/edit/'.$request->id)->withSuccess('Berjaya mengemaskini tiket');

    }

    public function bayar(Request $request)
    {
        // dd($request);exit;
        $data      = (new KodHasilServices())->bayarTiket($request);
        $srvmain   = (new KodHasilServices())->serviceMain($request);
        $kodhasilval  = (new KodHasilServices())->kodhasil($request);
        $payment   = (new KodHasilServices())->getPayment($request);

        $merchant=MerchantSetup::where('fk_ptj',data_get($kodhasilval,'fk_ptj'))->first();

        $paymentgateway = data_get($srvmain,'fk_payment_gateway');
        $paymentgateway_name = data_get($srvmain,'fkpaymentgateway.name');
        $total_bayar    = data_get($srvmain,'total');
        $fpxtype =data_get($srvmain,'fpx_type');
        
        $flaglogin = $request->flaglogin;
        $id        = $request->id;
        $tab       = $request->tab;
        $flagpay   = $request->flagpay;
        $list      = '';
        $troliflag = 0;

        $paymentid  = data_get($payment,'id');
        $payment_no = data_get($payment,'transaction_no');

          if($fpxtype=='01'){
                $banklist=Bank::all();

            }else{
                $banklist=Bankb2b::all();

            }

        if($paymentgateway == 1)
        {
            // fpx
            return view('payment::payment.proceed.fpx',compact('srvmain','kodhasilval','payment','flaglogin','id','tab','flagpay','list','paymentgateway','request','paymentid','total_bayar','troliflag','payment_no','fpxtype','banklist','paymentgateway_name','merchant'));
        }
        else
        {
            return view('payment::payment.proceed.fpx_card',compact('srvmain','kodhasil'));
        }
    }
}
