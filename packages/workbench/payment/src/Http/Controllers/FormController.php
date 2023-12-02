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
use Workbench\Payment\Service\UserServices;
use Workbench\Database\Model\Bill\Troli;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\Bank;
use Workbench\Database\Model\Payment\Bankb2b;
use Workbench\Database\Model\Payment\MerchantSetup;



class FormController extends Controller
{


    public function __construct()
    {

    }

    // public function tiket(Request $request)
    // {
    //     dd('sini');exit;
    //     $kodhasil = (new KodHasilServices())->kodhasil($request);
    //     $srvratemgt = (new KodHasilServices())->srvratemgt($request);
    //     // dump($srvratemgt);
       //  // return view('payment::payment.ticket.index',compact('srvratemgt','kodhasil'));
    //     return view('payment::payment.ticket.form',compact('srvratemgt','kodhasil'));
    // }

    public function formTiket(Request $request)
    {
        $lkpperkhidmatan = (new KodHasilServices())->lkpperkhidmatan($request);
        $srvratemgt      = (new KodHasilServices())->servisRateMgt($request);

        // $kodhasil = (new KodHasilServices())->kodhasil($request);

        return view('payment::payment.ticket.start',compact('lkpperkhidmatan', 'srvratemgt'));
    }

    public function search(Request $request)
    {
        $data = (new KodHasilServices())->searchsrvrate($request);

        return view('payment::payment.ticket.result', compact('data', 'request'));
    }

    public function svForm(Request $request)
    {
        $data = (new KodHasilServices())->svForm($request);

        return redirect('/bayaran/tiket/'.$data->fk_kod_hasil.'/1/edit/'.$data->id)->withSuccess('Berjaya mengemaskini tiket');
    }

    public function updTiket(Request $request)
    {
        $data = (new KodHasilServices())->updTiket($request);

        $tab    = $request->tab;
        $action = $request->action;

        return redirect('/bayaran/tiket/'.$request->kodhasil.'/'.$tab.'/edit/'.$request->srvmain)->withSuccess('Berjaya mengemaskini tiket');
    }

    public function delTicket(Request $request)
    {
        // dd($request);exit;
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $data       = (new KodHasilServices())->delTiket($request);

        $tab    = $request->tab;
        $action = $request->action;

        return redirect('/bayaran/tiket/'.$request->kodhasil.'/'.$tab.'/edit/'.$request->srvmain)->withSuccess('Berjaya mengemaskini tiket');
    }

    public function next(Request $request)
    {
        // dd($request);exit;

        if($request->next)
        {
            if(($request->tab == 1)&&($request->nexttab == 2))
            {
                return redirect('/bayaran/tiket/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya mengemaskini'); //seterusnya
            }
            elseif(($request->tab == 2)&&($request->nexttab == 3))
            {
                // dd($request);
                $data =  (new KodHasilServices())->addPayer($request);

                return redirect('/bayaran/tiket/'.$request->kodhasil.'/3/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat pembayar'); //seterusnya
            }
            elseif(($request->tab == 3)&&($request->nexttab == 4))
            {
                $data =  (new KodHasilServices())->addPaymentType($request);

                return redirect('/bayaran/tiket/'.$request->kodhasil.'/4/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); //seterusnya
            }
            else
            {

            }

        }
        else
        {
            dd('sni');
        }
    }

    public function bayar(Request $request)
    {
         // dd($request);exit;
        $flaglogin = $request->flaglogin;
        $id = $request->id;
        $tab = $request->tab;
        $flagpay = $request->flagpay;

        $kodhasilval = (new KodHasilServices())->kodhasil($request);

        $merchant=MerchantSetup::where('fk_ptj',data_get($kodhasilval,'fk_ptj'))->first();





        if($request->flagtroli)
        {
            // dd('troli');exit;
            $payment = 0;
            $srvmain = 0;



            if ($request->flagmulti == 1)
            {

                $data =  (new UserServices())->cartMultiBayar($request);
                $list =  (new UserServices())->cartMultiList($request);
            }
            else
            {
                $data =  (new UserServices())->cartBayar($request);
                $list =  (new UserServices())->cartListTab4($request);
            }

            $trolicek = Troli::where('flag', $request->troliflag)
                                ->with('fkservice')
                                ->first();



            $paymentgateway = $trolicek->fkservice->fk_payment_gateway;
            $paymentgateway_name = $trolicek->fkservice->fkpaymentgateway->name;
            $fpxtype = $trolicek->fkservice->fpx_type;
            $total_bayar    = data_get($data,'total_amount');
            $paymentid      = data_get($data,'id');
            $payment_no     = data_get($data,'transaction_no');

            $troliflag      = data_get($trolicek, 'flag');





            if($fpxtype=='01'){
                $banklist=Bank::all();

            }else{
                $banklist=Bankb2b::all();

            }


        }
        else
        {
            // dd('stret');exit;
            $data    = (new KodHasilServices())->bayarTiket($request);
            $payment = (new KodHasilServices())->getPayment($request);
            $srvmain = (new KodHasilServices())->serviceMain($request);




            $paymentgateway = data_get($srvmain,'fk_payment_gateway');
            $paymentgateway_name = data_get($srvmain,'fkpaymentgateway.name');
            $fpxtype =data_get($srvmain,'fpx_type');
            $total_bayar    = data_get($srvmain,'total');
            $list       = '';
            $troliflag  = 0;

            $paymentid  = data_get($payment,'id');
            $payment_no = data_get($payment,'transaction_no');

             if($fpxtype=='01'){
                $banklist=Bank::all();

            }else{
                $banklist=Bankb2b::all();

            }
        }






        if($paymentgateway == 1)
        {
            // fpx

             if($fpxtype=='01'){

                 return view('payment::payment.proceed.fpx', compact('srvmain', 'kodhasilval', 'payment', 'flaglogin', 'id', 'tab', 'flagpay', 'list', 'paymentgateway', 'request', 'paymentid', 'total_bayar', 'troliflag', 'payment_no','fpxtype','banklist','paymentgateway_name','merchant'));

            }else{
                  return view('payment::payment.proceed.fpx_b2b', compact('srvmain', 'kodhasilval', 'payment', 'flaglogin', 'id', 'tab', 'flagpay', 'list', 'paymentgateway', 'request', 'paymentid', 'total_bayar', 'troliflag', 'payment_no','fpxtype','banklist','paymentgateway_name','merchant'));

            }





        }
        else
        {
            return view('payment::payment.proceed.fpx_card',compact('srvmain', 'kodhasilval', 'payment', 'flaglogin', 'id', 'tab', 'flagpay', 'list', 'paymentgateway', 'request', 'paymentid', 'total_bayar', 'troliflag', 'payment_no','fpxtype','paymentgateway_name'));
        }
    }

    public function svTiket(Request $request)
    {
        $data = (new KodHasilServices())->svTiket($request);
        $kodhasil = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);

        return redirect('/bayaran/tiket/'.$request->kodhasil.'/1/edit/'.$data)->withSuccess('Berjaya mengemaskini tiket');
    }

    public function nextTicket(Request $request)
    {

        $kodhasil = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $srvmain = (new KodHasilServices())->serviceMain($request);
        $paymentGtwy = (new KodHasilServices())->paymentGtwy($request);
        // dump($srvmain);
        $tab = $request->tab;
        $action = $request->action;

        return view('payment::payment.ticket.next',compact('srvratemgt','kodhasil','srvmain','tab','action','paymentGtwy', 'request'));
    }

    // others or timbang -------------------
    public function formOthers(Request $request)
    {
        $lkpperkhidmatan = (new KodHasilServices())->lkpperkhidmatan($request);
        $srvratemgt      = (new KodHasilServices())->servisRateMgt($request);

        return view('payment::payment.others.start', compact('srvratemgt','lkpperkhidmatan'));
    }

    public function searchOthers(Request $request)
    {
        $data = (new KodHasilServices())->searchsrvrate($request);

        return view('payment::payment.others.result',compact('data','request'));
    }

    public function svFormOthers(Request $request)
    {
        $data = (new KodHasilServices())->svForm($request);

        return redirect('/bayaran/hasil/'.$data->fk_kod_hasil.'/1/edit/'.$data->id)->withSuccess('Berjaya mengemaskini pembelian');
    }

    public function updOthers(Request $request)
    {
        $data = (new KodHasilServices())->updTiket($request);

        $tab    = $request->tab;
        $action = $request->action;

        return redirect('/bayaran/hasil/'.$request->kodhasil.'/'.$tab.'/edit/'.$request->srvmain)->withSuccess('Berjaya mengemaskini');
    }

    public function delOthers(Request $request)
    {
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $data       = (new KodHasilServices())->delTiket($request);

        $tab    = $request->tab;
        $action = $request->action;

        return redirect('/bayaran/hasil/'.$request->kodhasil.'/'.$tab.'/edit/'.$request->srvmain)->withSuccess('Berjaya mengemaskini');

    }

    public function nextOthers(Request $request)
    {
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $srvmain    = (new KodHasilServices())->serviceMain($request);
        $paymentGtwy = (new KodHasilServices())->paymentGtwy($request);

        $tab = $request->tab;
        $action = $request->action;

        return view('payment::payment.others.next',compact('srvratemgt','kodhasil','srvmain','tab','action','paymentGtwy', 'request'));


    }

    public function nextHasilOthers(Request $request)
    {
        if($request->next)
        {
            if(($request->tab == 1)&&($request->nexttab == 2))
            {
                return redirect('/bayaran/hasil/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya mengemaskini'); //seterusnya
            }
            elseif(($request->tab == 2)&&($request->nexttab == 3))
            {
                // dd($request);
                $data =  (new KodHasilServices())->addPayer($request);

                return redirect('/bayaran/hasil/'.$request->kodhasil.'/3/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat pembayar'); //seterusnya

            }
            elseif(($request->tab == 3)&&($request->nexttab == 4))
            {
                $data =  (new KodHasilServices())->addPaymentType($request);

                return redirect('/bayaran/hasil/'.$request->kodhasil.'/4/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); //seterusnya

            }
            else
            {

            }

        }
        else
        {
            dd('sni');
        }
    }

    public function bayarOthers(Request $request)
    {

        $flaglogin  = $request->flaglogin;
        $id         = $request->id;
        $tab        = $request->tab;
        $flagpay    = $request->flagpay;

        $kodhasilval = (new KodHasilServices())->kodhasil($request);
        $merchant=MerchantSetup::where('fk_ptj',data_get($kodhasilval,'fk_ptj'))->first();

        if($request->flagtroli)
        {
            // dd('if', $request);exit;
            $payment = 0;
            $srvmain = 0;

            $data = (new UserServices())->cartBayar($request);
            $list = (new UserServices())->cartList($request);

            $trolicek = Troli::where('flag', $request->troliflag)
                             ->first();

            $paymentgateway = $trolicek->fkservice->fk_payment_gateway;
            $paymentgateway_name = $trolicek->fkservice->fkpaymentgateway->name;
             $fpxtype = $trolicek->fkservice->fpx_type;

            $total_bayar = data_get($data,'total_amount');
            $paymentid   = data_get($data,'id');
            $payment_no  = data_get($data,'transaction_no');
            $troliflag   = data_get($trolicek,'flag');


            if($fpxtype=='01'){
                $banklist=Bank::all();

            }else{
                $banklist=Bankb2b::all();

            }
        }
        else
        {
            // dd('else', $request);exit;
            $data    = (new KodHasilServices())->bayarTiket($request);
            $payment = (new KodHasilServices())->getPayment($request);
            $srvmain = (new KodHasilServices())->serviceMain($request);

            $paymentgateway = data_get($srvmain,'fk_payment_gateway');
            $paymentgateway_name = data_get($srvmain,'fkpaymentgateway.name');
            $total_bayar    = data_get($srvmain,'total');

            $list       = '';
            $troliflag  = 0;

            $paymentid  = data_get($payment,'id');
            $payment_no = data_get($payment,'transaction_no');
            $fpxtype =data_get($srvmain,'fpx_type');


            if($fpxtype=='01'){
                $banklist=Bank::all();

            }else{
                $banklist=Bankb2b::all();

            }
        }

        if($paymentgateway == 1)
        {
            // fpx
           if($fpxtype=='01'){

                 return view('payment::payment.proceed.fpx', compact('srvmain', 'kodhasilval', 'payment', 'flaglogin', 'id', 'tab', 'flagpay', 'list', 'paymentgateway', 'request', 'paymentid', 'total_bayar', 'troliflag', 'payment_no','fpxtype','banklist','paymentgateway_name','merchant'));

            }else{
                  return view('payment::payment.proceed.fpx_b2b', compact('srvmain', 'kodhasilval', 'payment', 'flaglogin', 'id', 'tab', 'flagpay', 'list', 'paymentgateway', 'request', 'paymentid', 'total_bayar', 'troliflag', 'payment_no','fpxtype','banklist','paymentgateway_name','merchant'));

            }
        }
        else
        {
            return view('payment::payment.proceed.fpx_card',compact('srvmain','kodhasil'));
        }
    }
}
