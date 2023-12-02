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
use Auth;
use Workbench\Payment\Service\KodHasilServices;
use Workbench\Payment\Service\UserServices;
use Workbench\Database\Model\Bill\Troli;
use Workbench\Database\Model\Payment\Bank;
use Workbench\Database\Model\Payment\Bankb2b;
use Workbench\Database\Model\Payment\MerchantSetup;

class UserController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Customer Booking--------------- //

    public function bookingList(Request $request)
    {

        $book = (new UserServices())->bookingList($request);

        return view('payment::user.booking.list', compact('book'));
    }

    public function bookingForm(Request $request)
    {
        $book = (new UserServices())->bookList($request);
        $service = (new UserServices())->bookList($request);

        return view('payment::user.booking.add', compact('book'));
    }

    public function bookingSave(Request $request)
    {
        $book = (new UserServices())->bookAdd($request);

        return redirect('/user/booking/list')->withSuccess('Add Data Successfully');
    }

    // ------------------- Customer Find Services--------------- //

    public function serviceIndex(Request $request)
    {
        $lkpservicetype = (new UserServices())->lkpservicetype($request);

        return view('payment::user.service.index', compact('lkpservicetype'));
    }

    public function serviceSearch(Request $request)
    {
        $search = (new UserServices())->searchServ($request);

        return view('payment::user.service.search', compact('search'));
    }

    public function serviceBooking(Request $request)
    {
        $booking = (new UserServices())->viewBooking($request);

        return view('payment::user.service.booking', compact('booking'));
    }

    public function servicebookingSave(Request $request)
    {
        $book = (new UserServices())->saveBooking($request);

        return redirect('/home')->withSuccess('Your Booking Successful! ');
    }


















    public function regList(Request $request)
    {
        $list =  (new UserServices())->regList($request);
        // dd($list);

        return view('payment::user.favourite.list',compact('list'));
    }

    public function favAdd(Request $request)
    {
        $listAgency = (new UserServices())->listAgency($request);
        // dd($listAgency);

        return view('payment::user.favourite.add',compact('listAgency'));
    }

    public function getKodHasil(Request $request)
    {
        $data = (new UserServices())->getKodHasil($request);
        return view('payment::user.favourite.kodhasil',compact('data'));
    }

    public function getPayerAcc(Request $request)
    {
        // dd($request);
        $data = (new UserServices())->getPayerAcc($request);
        return view('payment::user.favourite.payeracclist',compact('data'));
    }

    public function svFavAcc(Request $request)
    {
        $data = (new UserServices())->svFavAcc($request);

        return redirect('/user/berdaftar/list')->withSuccess('Berjaya menambah akaun berdaftar');
    }

    // for User Registered Tikect-------------------------------------
    public function userTicket(Request $request)
    {
        $lkpperkhidmatan = (new KodHasilServices())->lkpperkhidmatan($request);
        $srvratemgt      = (new KodHasilServices())->servisRateMgt($request);

        return view('payment::user.ticket.start',compact('lkpperkhidmatan', 'srvratemgt'));
    }

    public function search(Request $request)
    {
        $data = (new KodHasilServices())->searchsrvrate($request);

        return view('payment::payment.ticket.result', compact('data', 'request'));
    }

    public function svUserTicket(Request $request)
    {
        $data = (new KodHasilServices())->svForm($request);

        return redirect('/login/bayaran/tiket/'.$data->fk_kod_hasil.'/1/edit/'.$data->id)->withSuccess('Berjaya mengemaskini tiket');
    }

    public function usrUpdTiket(Request $request)
    {
        $data = (new KodHasilServices())->usrUpdTiket($request);

        $tab    = $request->tab;
        $action = $request->action;

        return redirect('/login/bayaran/tiket/'.$request->kodhasil.'/'.$tab.'/edit/'.$request->srvmain)->withSuccess('Berjaya mengemaskini tiket');
    }

    public function userNextTicket(Request $request)
    {
        // dd(Auth::user(), 'asdas');exit;
        $curuser = (new KodHasilServices())->getUser($request);
        $kodhasil = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $srvmain = (new KodHasilServices())->serviceMain($request);
        $paymentGtwy = (new KodHasilServices())->paymentGtwy($request);
        // dd($srvratemgt, $srvmain, $paymentGtwy);
        $tab = $request->tab;
        $action = $request->action;

        return view('payment::user.ticket.next',compact('srvratemgt','kodhasil','srvmain','tab','action','paymentGtwy', 'request', 'curuser'));
    }

    public function usrDelTicket(Request $request)
    {
        // dd($request);
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $data       = (new KodHasilServices())->delTiket($request);

        $tab    = $request->tab;
        $action = $request->action;

        return redirect('/login/bayaran/tiket/'.$request->kodhasil.'/'.$tab.'/edit/'.$request->srvmain)->withSuccess('Berjaya memadam');
    }

    public function userNext(Request $request)
    {
        if($request->buttonclicked == '2')
        {
            $trolidup = Troli::where('fk_service', $request->id)->count();

            if($trolidup >= 1)
            {
                return redirect('/login/bayaran/tiket/'.$request->kodhasil.'/2/edit/'.$request->id)->withWarning('Permohonan sudah berada didalam troli'); //seterusnya
            }
            else
            {
                $datatroli =  (new UserServices())->addToCart($request);
                $datapayer =  (new KodHasilServices())->addPayer($request);

                return redirect('/login/bayaran/tiket/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya ditambah ke troli'); //seterusnya
            }
        }
        else
        {
            // add
            if($request->next)
            {
                if(($request->tab == 1)&&($request->nexttab == 2))
                {
                    return redirect('/login/bayaran/tiket/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya mengemaskini'); //seterusnya
                }
                elseif(($request->tab == 2)&&($request->nexttab == 3))
                {
                    $data =  (new KodHasilServices())->addPayer($request);

                    return redirect('/login/bayaran/tiket/'.$request->kodhasil.'/3/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat pembayar'); //seterusnya
                }
                elseif(($request->tab == 3)&&($request->nexttab == 4))
                {
                    $data =  (new KodHasilServices())->addPaymentType($request);

                    return redirect('/login/bayaran/tiket/'.$request->kodhasil.'/4/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); //seterusnya

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
    }



    // start add to cart --------------------------------------------------------------------addToCart
    public function getCartAdd(Request $request)
    {
        $trolidup = Troli::where('fk_service', $request->servicemainid)->count();

        if($trolidup >= 1)
        {
            return redirect('/login/bayaran/tiket/'.$request->kodhasilid.'/2/edit/'.$request->servicemainid)->withWarning('Permohonan sudah berada didalam troli'); //seterusnya
        }
        else
        {
            $data =  (new UserServices())->addToCart($request);

            return redirect('/login/bayaran/tiket/'.$request->kodhasilid.'/2/edit/'.$request->servicemainid)->withSuccess('Berjaya ditambah ke troli'); //seterusnya
        }
    }

    public function getCartList(Request $request)
    {
        // dd('sini');exit;

        $list =  (new UserServices())->cartList($request);
        // dd($list);

        return view('payment::payment.cart.list',compact('list'));
    }

    public function postCartProceed(Request $request)
    {
        if($request->forpayment)
        {
            $data =  (new UserServices())->addFlagToTroli($request);
            // dd($data['payer']);
            // if($data['payer'] >= 1)
            // {
            //     return redirect('/login/bayaran/tiket/'.$data['troli']->fkservice->fk_kod_hasil.'/2/edit/'.$data['troli']->fk_service); //seterusnya
            // }
            // else
            // {
                return redirect('/login/cart/next/3/'.$data['current']->flag_running);
            // }
        }
        else
        {
            return redirect('/login/cart/list')->withWarning('Mohon Pilih Permohonan Untuk Di Bayar ');
        }
    }

    public function getCartNext(Request $request)
    {
        $paymentGtwy = (new KodHasilServices())->paymentGtwy($request);
        $tab = $request->tab;

        $list =  (new UserServices())->cartListTab4($request);

        return view('payment::payment.cart.next', compact('paymentGtwy', 'tab', 'request', 'list'));

    }

    public function postCartNext(Request $request)
    {
        // dd($request, 'atas');exit;

        if(($request->tab == 3)&&($request->nexttab == 4))
        {
            $data =  (new UserServices())->addPaymentType($request);

            return redirect('/login/cart/next/4/'.$request->troliflag)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran');
        }
    }

    public function postCartBayar(Request $request)
    {
        // dd($request);exit;
        $data =  (new UserServices())->cartBayar($request);

        $trolicek = Troli::where('flag', $request->troliflag)->first();

        // $srvmain = (new KodHasilServices())->serviceMain($request);
        // $kodhasil = (new KodHasilServices())->kodhasil($request);
        // $payment = (new KodHasilServices())->getPayment($request);
        // $flaglogin = $request->flaglogin;
        // $id  = $request->id;
        // $tab = $request->tab;
        // $flagpay = $request->flagpay;

        $list =  (new UserServices())->cartList($request);

        if( $trolicek->fkservice->fk_payment_gateway == 1)
        {
            // fpx
            return view('payment::payment.proceed.fpx_troli', compact('list', 'request'));
        }
        else
        {
            dd('under development');exit;
            // return view('payment::payment.proceed.fpx_card', compact('srvmain','kodhasil'));
        }
    }










    // hasil ------------------------------------------------------
    public function userHasil(Request $request)
    {
        $lkpperkhidmatan = (new KodHasilServices())->lkpperkhidmatan($request);
        $srvratemgt      = (new KodHasilServices())->servisRateMgt($request);

        return view('payment::user.others.start', compact('srvratemgt','lkpperkhidmatan'));
    }

    public function svFormOthers(Request $request)
    {
        $data = (new KodHasilServices())->svForm($request);

        return redirect('/login/bayaran/hasil/'.$data->fk_kod_hasil.'/1/edit/'.$data->id)->withSuccess('Berjaya mengemaskini');
    }

    public function userNextOthers(Request $request)
    {
        // dd(Auth::user(), 'asdas');exit;
        $curuser = (new KodHasilServices())->getUser($request);
        $kodhasil = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $srvmain = (new KodHasilServices())->serviceMain($request);
        $paymentGtwy = (new KodHasilServices())->paymentGtwy($request);
        // dump($srvmain);
        $tab = $request->tab;
        $action = $request->action;

        return view('payment::user.others.next', compact('srvratemgt','kodhasil','srvmain','tab','action','paymentGtwy', 'request', 'curuser'));
    }

    public function usrUpdOthers(Request $request)
    {
        $data = (new KodHasilServices())->usrUpdTiket($request);

        $tab    = $request->tab;
        $action = $request->action;

        return redirect('/login/bayaran/hasil/'.$request->kodhasil.'/'.$tab.'/edit/'.$request->srvmain)->withSuccess('Berjaya menambah');
    }

    public function userHasilNext(Request $request)
    {
        if($request->buttonclicked == '2')
        {
            $trolidup = Troli::where('fk_service', $request->id)->count();

            if($trolidup >= 1)
            {
                return redirect('/login/bayaran/hasil/'.$request->kodhasil.'/2/edit/'.$request->id)->withWarning('Permohonan sudah berada didalam troli'); //seterusnya
            }
            else
            {
                $datatroli =  (new UserServices())->addToCart($request);
                $datapayer =  (new KodHasilServices())->addPayer($request);

                return redirect('/login/bayaran/hasil/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya ditambah ke troli'); //seterusnya
            }
        }
        else
        {
            // add
            if($request->next)
            {
                if(($request->tab == 1)&&($request->nexttab == 2))
                {
                    return redirect('/login/bayaran/hasil/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya mengemaskini'); //seterusnya
                }
                elseif(($request->tab == 2)&&($request->nexttab == 3))
                {
                    $data =  (new KodHasilServices())->addPayer($request);

                    return redirect('/login/bayaran/hasil/'.$request->kodhasil.'/3/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat pembayar'); //seterusnya
                }
                elseif(($request->tab == 3)&&($request->nexttab == 4))
                {
                    $data =  (new KodHasilServices())->addPaymentType($request);

                    return redirect('/login/bayaran/hasil/'.$request->kodhasil.'/4/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); //seterusnya

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
    }

    public function usrDelOthers(Request $request)
    {
        // dd($request);
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $data       = (new KodHasilServices())->delTiket($request);

        $tab    = $request->tab;
        $action = $request->action;

        return redirect('/login/bayaran/hasil/'.$request->kodhasil.'/'.$tab.'/edit/'.$request->srvmain)->withSuccess('Berjaya memadam');
    }










    // Bil ------------------------------------------------------
    public function billForm(Request $request)
    {
        $lkpperkhidmatan = (new KodHasilServices())->lkpperkhidmatan($request);

        return view('payment::user.bill.start', compact('lkpperkhidmatan'));
    }

    public function billSearch(Request $request)
    {
        $data = (new KodHasilServices())->searchbill($request);

        return view('payment::user.bill.resultsearch', compact('data'));
    }

    public function billSave(Request $request)
    {
        // dd($request);
        $data = (new KodHasilServices())->saveBill($request);

        return redirect('/login/bayaran/bill/'.$data->fk_kod_hasil.'/1/edit/'.$data->id)->withSuccess('Berjaya mengemaskini data');
    }

    public function billNextBill(Request $request)
    {
        // dd($request);
        $curuser = (new KodHasilServices())->getUserBill($request);
        $kodhasil   = (new KodHasilServices())->kodhasil($request);
        // $srvratemgt = (new KodHasilServices())->srvratemgt($request);
        $srvmain    = (new KodHasilServices())->serviceMain($request);
        $paymentGtwy  = (new KodHasilServices())->paymentGtwy($request);
        $kodhasillist = (new KodHasilServices())->getKodHasilList($request);

        $tab    = $request->tab;
        $action = $request->action;

        return view('payment::user.bill.next', compact('curuser', 'kodhasil', 'srvmain', 'tab', 'action', 'paymentGtwy', 'kodhasillist'));
    }

    public function billUpdate(Request $request)
    {
        // dd($request);
        $data = (new KodHasilServices())->updBill($request);

        $tab = $request->tab;
        // $action = $request->action;
        // dd($data);

        return redirect('/login/bayaran/bill/'.$data->fk_kod_hasil.'/'.$tab.'/edit/'.$request->id)->withSuccess('Berjaya mengemaskini');

    }

    public function billNext(Request $request)
    {
        if($request->buttonclicked == '2')
        {
            $trolidup = Troli::where('fk_service', $request->id)->count();

            if($trolidup >= 1)
            {
                return redirect('/login/bayaran/bill/'.$request->kodhasil.'/2/edit/'.$request->id)->withWarning('Permohonan sudah berada didalam troli'); //seterusnya
            }
            else
            {
                $datatroli =  (new UserServices())->addBilToCart($request);
                $datapayer =  (new KodHasilServices())->addPayer($request);

                return redirect('/login/bayaran/bill/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya ditambah ke troli'); //seterusnya
            }
        }
        else
        {

            if($request->next)
            {
                if(($request->tab == 1)&&($request->nexttab == 2))
                {
                    return redirect('/login/bayaran/bill/'.$request->kodhasil.'/2/edit/'.$request->id)->withSuccess('Berjaya mengemaskini'); //seterusnya
                }
                elseif(($request->tab == 2)&&($request->nexttab == 3))
                {
                    // dd($request);
                    $data =  (new KodHasilServices())->addPayer($request);

                    return redirect('/login/bayaran/bill/'.$request->kodhasil.'/3/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat pembayar'); //seterusnya
                }
                elseif(($request->tab == 3)&&($request->nexttab == 4))
                {
                    $data =  (new KodHasilServices())->addPaymentType($request);

                    return redirect('/login/bayaran/bill/'.$request->kodhasil.'/4/edit/'.$request->id)->withSuccess('Berjaya mengemaskini maklumat cara pembayaran'); //seterusnya
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
    }

    public function billBayar(Request $request)
    {
        // dd($request);exit;
        $data      = (new KodHasilServices())->bayarTiket($request);
        $srvmain   = (new KodHasilServices())->serviceMain($request);
        $kodhasilval  = (new KodHasilServices())->kodhasil($request);
        $payment   = (new KodHasilServices())->getPayment($request);

        $paymentgateway = data_get($srvmain,'fk_payment_gateway');
        $total_bayar    = data_get($srvmain,'total');
        $fpxtype =data_get($srvmain,'fpx_type');
        $merchant=MerchantSetup::where('fk_ptj',data_get($kodhasilval,'fk_ptj'))->first();
        $paymentgateway_name = data_get($srvmain,'fkpaymentgateway.name');

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
            return view('payment::payment.proceed.fpx',compact('srvmain','kodhasilval','payment','flaglogin','id','tab','flagpay','list','paymentgateway','request','paymentid','total_bayar','troliflag','payment_no','fpxtype','merchant','paymentgateway_name','banklist'));
        }
        else
        {
            return view('payment::payment.proceed.fpx_card',compact('srvmain','kodhasilval'));
        }
    }








}
