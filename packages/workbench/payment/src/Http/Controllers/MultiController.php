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



class MultiController extends Controller
{
    public function __construct()
    {

    }

    public function form(Request $request)
    {
        $lkpperkhidmatan = (new KodHasilServices())->lkpperkhidmatan($request);

        return view('payment::payment.multi.form', compact('lkpperkhidmatan'));
    }

    public function search(Request $request)
    {
        $data = (new KodHasilServices())->searchbill($request);

        return view('payment::payment.multi.resultsearch', compact('data'));
    }

    public function save(Request $request)
    {
        // dd($request);
        $data = (new KodHasilServices())->saveMulti($request);

        return redirect('/bayaran/multi/2/'.$data->flag)->withSuccess('Berjaya mengemaskini data');
    }

    public function nextMulti(Request $request)
    {
        // dd($request);
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        // $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $srvmain    = (new KodHasilServices())->serviceMain($request);
        $paymentGtwy  = (new KodHasilServices())->paymentGtwy($request);
        $kodhasillist = (new KodHasilServices())->getKodHasilList($request);
        $list =  (new UserServices())->cartMultiListTab4($request);

        $tab    = $request->tab;
        $action = $request->action;

        return view('payment::payment.multi.next', compact('kodhasil', 'srvmain', 'tab', 'action', 'paymentGtwy', 'kodhasillist', 'request', 'list'));
    }

    public function postMultiNext(Request $request)
    {
        if($request->next)
        {
            if(($request->tab == 2)&&($request->nexttab == 3))
            {
                // dd($request);
                $data =  (new KodHasilServices())->addPayer($request);

                return redirect('/bayaran/multi/3/'.$request->troliflag)->withSuccess('Berjaya mengemaskini maklumat pembayar'); //seterusnya
            }
            elseif(($request->tab == 3)&&($request->nexttab == 4))
            {
                $data =  (new UserServices())->addPaymentType($request);

                return redirect('/bayaran/multi/4/'.$request->troliflag)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); //seterusnya
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

    public function postMultiBayar(Request $request)
    {
        // dd($request);exit;
        $data =  (new UserServices())->cartMultiBayar($request);

        $trolicek = Troli::where('flag', $request->troliflag)->first();

        // $srvmain = (new KodHasilServices())->serviceMain($request);
        // $kodhasil = (new KodHasilServices())->kodhasil($request);
        // $payment = (new KodHasilServices())->getPayment($request);
        // $flaglogin = $request->flaglogin;
        // $id  = $request->id;
        // $tab = $request->tab;
        // $flagpay = $request->flagpay;

        $list =  (new UserServices())->cartMultiList($request);

        if( $trolicek->fkservice->fk_payment_gateway == 1)
        { 
            // fpx
            return view('payment::payment.proceed.fpx_multi', compact('list', 'request'));
        }
        else
        {
            dd('under development');exit;
            // return view('payment::payment.proceed.fpx_card', compact('srvmain','kodhasil'));
        }
    }


    // user logged in ---------------------------------------------------------------------------------------
    public function userForm(Request $request)
    {
        $lkpperkhidmatan = (new KodHasilServices())->lkpperkhidmatan($request);

        return view('payment::user.multi.form', compact('lkpperkhidmatan'));
    }

    public function userSearch(Request $request)
    {
        $data = (new KodHasilServices())->searchbill($request);

        return view('payment::user.multi.resultsearch', compact('data'));
    }

    public function userSave(Request $request)
    {
        // dd($request);
        $data = (new KodHasilServices())->saveMulti($request);

        return redirect('/login/bayaran/multi/2/'.$data->flag)->withSuccess('Berjaya mengemaskini data');
    }

    public function userNextMulti(Request $request)
    {
        // dd($request);
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        // $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $srvmain    = (new KodHasilServices())->serviceMain($request);
        $paymentGtwy  = (new KodHasilServices())->paymentGtwy($request);
        $kodhasillist = (new KodHasilServices())->getKodHasilList($request);
        $list =  (new UserServices())->cartMultiListTab4($request);
        $curuser = (new KodHasilServices())->getUserMulti($request);

        $tab    = $request->tab;
        $action = $request->action;

        return view('payment::user.multi.next', compact('kodhasil', 'srvmain', 'tab', 'action', 'paymentGtwy', 'kodhasillist', 'request', 'list', 'curuser'));
    }

    public function postUserMultiNext(Request $request)
    {
        if($request->next)
        {
            if(($request->tab == 2)&&($request->nexttab == 3))
            {
                // dd($request);
                $data =  (new KodHasilServices())->addPayer($request);

                return redirect('/login/bayaran/multi/3/'.$request->troliflag)->withSuccess('Berjaya mengemaskini maklumat pembayar'); // seterusnya
            }
            elseif(($request->tab == 3)&&($request->nexttab == 4))
            {
                $data =  (new UserServices())->addPaymentType($request);

                return redirect('/login/bayaran/multi/4/'.$request->troliflag)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); // seterusnya
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























    // public function next(Request $request)
    // {
    //     if($request->next)
    //     {
    //         if(($request->tab == 1)&&($request->nexttab == 2))
    //         {
    //             return redirect('/bayaran/bill/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya mengemaskini'); //seterusnya
    //         }
    //         elseif(($request->tab == 2)&&($request->nexttab == 3))
    //         {
    //             // dd($request);
    //             $data =  (new KodHasilServices())->addPayer($request);

    //             return redirect('/bayaran/bill/'.$request->kodhasil.'/3/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat pembayar'); //seterusnya
    //         }
    //         elseif(($request->tab == 3)&&($request->nexttab == 4))
    //         {
    //             $data =  (new KodHasilServices())->addPaymentType($request);

    //             return redirect('/bayaran/bill/'.$request->kodhasil.'/4/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); //seterusnya
    //         }
    //         else
    //         {

    //         }
    //     }
    //     else
    //     {
    //         dd('no next');
    //     }
    // }

    // public function nextBill(Request $request)
    // {
    //     // dd($request);
    //     $kodhasil   = (new KodHasilServices())->kodhasil($request);
    //     // $srvratemgt = (new KodHasilServices())->srvratemgt($request);
    //     $srvmain    = (new KodHasilServices())->serviceMain($request);
    //     $paymentGtwy  = (new KodHasilServices())->paymentGtwy($request);
    //     $kodhasillist = (new KodHasilServices())->getKodHasilList($request);
        
    //     $tab    = $request->tab;
    //     $action = $request->action;

    //     return view('payment::payment.bill.next', compact('kodhasil', 'srvmain', 'tab', 'action', 'paymentGtwy', 'kodhasillist'));
    // }

    // public function update(Request $request)
    // {
    //     // dd($request);
    //     $data = (new KodHasilServices())->updBill($request);

    //     $tab = $request->tab;
    //     // $action = $request->action;
    //     // dd($data);

    //     return redirect('/bayaran/bill/'.$data->fk_kod_hasil.'/'.$tab.'/edit/'.$request->id)->withSuccess('Berjaya mengemaskini tiket');

    // }

    // public function bayar(Request $request)
    // {
    //     // dd($request);exit;
    //     $data      = (new KodHasilServices())->bayarTiket($request);
    //     $srvmain   = (new KodHasilServices())->serviceMain($request);
    //     $kodhasil  = (new KodHasilServices())->kodhasil($request);
    //     $payment   = (new KodHasilServices())->getPayment($request);

    //     $paymentgateway = data_get($srvmain,'fk_payment_gateway');
    //     $total_bayar    = data_get($srvmain,'total');
        
    //     $flaglogin = $request->flaglogin;
    //     $id        = $request->id;
    //     $tab       = $request->tab;
    //     $flagpay   = $request->flagpay;
    //     $list      = '';
    //     $troliflag = 0;

    //     $paymentid  = data_get($payment,'id');
    //     $payment_no = data_get($payment,'transaction_no');

    //     if($paymentgateway == 1)
    //     {
    //         // fpx
    //         return view('payment::payment.proceed.fpx',compact('srvmain','kodhasil','payment','flaglogin','id','tab','flagpay','list','paymentgateway','request','paymentid','total_bayar','troliflag','payment_no'));
    //     }
    //     else
    //     {
    //         return view('payment::payment.proceed.fpx_card',compact('srvmain','kodhasil'));
    //     }
    // }
}
