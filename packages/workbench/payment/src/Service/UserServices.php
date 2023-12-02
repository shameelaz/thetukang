<?php

namespace Workbench\Payment\Service;

use Illuminate\Routing\Controller;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\Agency\Ptj;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\AclRoleUser;
use Workbench\Database\Model\User\APermission;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\UserRoles;
use Workbench\Database\Model\Base\BaseInfo;
use Workbench\Database\Model\Base\HubungiKami;
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
use Workbench\Database\Model\Agency\KodHasil;
use Workbench\Database\Model\Lkp\LkpPerkhidmatan;
use Workbench\Database\Model\Agency\ServiceRateMgt;
use Workbench\Database\Model\Agency\ServiceRate;
use Workbench\Database\Model\Payment\ServiceMain;
use Workbench\Database\Model\Payment\ServiceMainDetail;
use Workbench\Database\Model\Bill\Payer;
use Workbench\Database\Model\Bill\PayerAccount;
use Workbench\Database\Model\Bill\PayerBill;
use Workbench\Database\Model\Bill\Troli;
use Workbench\Database\Model\Bill\RunningFlag;
use Workbench\Database\Model\Payment\PaymentGateway;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\PaymentDetail;
use Workbench\Database\Model\Payment\MainBooking;
use Workbench\Database\Model\Bill\FavouriteAccount;
use Workbench\Database\Model\Agency\LamanAgensi;
use Workbench\Database\Model\Agency\LamanAgensiPerkhidmatan;
use Workbench\Database\Model\Agency\ServiceKodHasil;
use Workbench\Database\Model\Agency\ServiceKodHasilDetail;
use Workbench\Database\Model\Agency\Tetapan;
use Workbench\Database\Model\Lkp\LkpMaster;
use Workbench\Database\Model\Agency\LamanAgensiPerkhidmatanDalaman;




class UserServices
{

    public function bookList(Request $request)
    {
        $user           = Auth::user()->id;
        $profile        = Users::where('id',$user)->with('profile','role')->first();

        $book            = MainBooking::get();

        return $book;
    }

    public function bookAdd(Request $request)
    {
        $user                           = Auth::user()->id;
        $profile                        = Users::where('id',$user)->with('profile','role')->first();

        $book                            = new MainBooking();
        $book->fk_lkp_service_type       = $request->fk_lkp_service_type;
        $book->desc                      = $request->desc;
        $book->price                     = $request->price;
        $book->location                  = $request->location;
        $book->save();

        // event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Perkhidmatan dan Kod Hasil'));

    }




























    public function regList($request)
    {
        $data = FavouriteAccount::where('fk_user',Auth::user()->id)
                                ->where('status',1)
                                ->with('fkpayeracc.codehasil.lkpperkhidmatan','fkpayeracc.fkagency','fkpayeracc.fkptj','fkpayeracc.fkpayerbill')
                                ->whereHas('fkpayeracc.fkpayerbill', function ($query) use ($request)
                                    {
                                        $query->where('status', '=', 1);
                                    })
                                ->get();
        // dd($data);
        return $data;
    }

    public function listAgency($request)
    {
        $list = Agency::where('status',1)->get();

        return $list;
    }

    public function getKodHasil($request)
    {
        $kodhasil = KodHasil::join('lkp_perkhidmatan','lkp_perkhidmatan.id','=','kod_hasil.fk_perkhidmatan')
        ->where('fk_agency',$request->id)
        ->where('kod_hasil.status',1)
        ->select('kod_hasil.*')
        ->with('lkpperkhidmatan','agency','ptj')->get();
        return $kodhasil;
    }


    public function getPayerAcc($request)
    {
        $kodhasil = KodHasil::where('id',$request->kodhasil)->first();

        $data = PayerAccount::where('fk_kod_hasil',$kodhasil->id)
                            ->where('fk_agency',$kodhasil->fk_agency)
                            ->where('fk_ptj',$kodhasil->fk_ptj)
                            ->where('status',1)
                            ->where('account_no','like','%'.$request->search.'%')
                            ->get();

        return $data;
    }

    public function svFavAcc($request)
    {
        // dd($request);
        $new = new FavouriteAccount;
        $new->fk_payer_account = $request->payeraccid;
        $new->fk_user = Auth::user()->id;
        $new->tarikh = date('Y-m-d');
        $new->status = 1;
        $new->save();

        // dd($new);
    }



    // start add to cart --------------------------------------------------------------------
    public function addToCart($request)
    {
        // dd( Auth::user()->id );exit;

        $srvmain = ServiceMain::where('id',$request->id)
                              ->with('fkpayer','srvmaindetail.category.serviceratemgt','srvmainmgt.lkpperkhidmatan','codehasil','fkpaymentgateway','fkpayer','fkpayerbill', 'srvmaindetail.tetapan')
                              ->first();

        $total = 0.0;

        foreach(data_get($srvmain,'srvmaindetail') as $key => $value)
        {
            $total += data_get($value,'total');
        }

        $troli = new Troli;
        // $troli->fk_payer_bill = 1;
        $troli->fk_user = Auth::user()->id;
        $troli->type = 2;       // 1-bill, 2-selain bil
        $troli->fk_service = data_get($request, 'id');
        // $troli->fk_payer = jap sedang kaji;
        // $troli->flag = 1;
        $troli->status = 1;
        $troli->amount = number_format($total, 2, ".", "");
        $troli->save();
    }

    public function addBilToCart($request)
    {
        // dd( Auth::user()->id );exit;
// dd('sini', $request);exit;

        $srvmain = ServiceMain::where('id', $request->id)
                              ->with('fkpayer', 'srvmaindetail.category.serviceratemgt', 'srvmainmgt.lkpperkhidmatan', 'codehasil', 'fkpaymentgateway', 'fkpayer', 'fkpayerbill', 'srvmaindetail.tetapan')
                              ->first();
        $total = 0.0;

        foreach(data_get($srvmain, 'srvmaindetail') as $key => $value)
        {
            $total += data_get($value,'total');
        }

        $troli = new Troli;

        $troli->fk_payer_bill = data_get($srvmain, 'fk_payer_bill'); // bill
        $troli->fk_user = Auth::user()->id;
        $troli->type = 1; // 1-bill, 2-selain bil
        $troli->fk_service  = $srvmain->id; // fk_service_main
        $troli->fk_payer    = data_get($srvmain, 'fk_payer');
        $troli->amount      = number_format($total, 2, ".", "");
        $troli->status      = 1; // 0-troli,1-ready payment,3-paid
        $troli->save();
    }

    public function cartList()
    {
        $data = Troli::with('fkservice.fkkodhasil.lkpperkhidmatan', 'fkpayerbill')
                     ->where('fk_user', '=', Auth::user()->id) // auth login = fk_user
                     ->where('status', '=', '1') // auth login = fk_user
                     ->get();

        return $data;
    }

    public function cartListTab4($request)
    {
        $data = Troli::with('fkservice.fkkodhasil.lkpperkhidmatan', 'fkpayerbill')
                     ->where('fk_user', '=', Auth::user()->id) // auth login = fk_user
                     ->where('flag', '=', $request->troli_flag) // auth login = fk_user
                     ->get();

        return $data;
    }

    public function cartMultiList($request)
    {


        $data = Troli::with('fkservice.fkkodhasil.lkpperkhidmatan', 'fkpayerbill')
                     ->where('status', '=', '1') // auth login = fk_user
                     ->where('flag', '=', $request->troliflag) // auth login = fk_user
                     ->get();

        return $data;
    }

    public function cartMultiListTab4($request)
    {
        $data = Troli::with('fkservice.fkkodhasil.lkpperkhidmatan', 'fkpayerbill')
                     ->where('flag', '=', $request->troli_flag) // auth login = fk_user
                     ->get();

        return $data;
    }

    public function addFlagToTroli($request)
    {
        $current = RunningFlag::orderBy('id', 'desc')
                              ->first();

        $payer = 0;

        foreach ($request->forpayment as $key => $value)
        {
            // dump($value);
            $troli = Troli::where('id', $value)->first();
            $troli->flag = $current->flag_running;
            $troli->update();

            if ($troli->fk_payer == null)
            {
                $payer += 1;
            }
        }

        $use = $current->flag_running+1;

        $runflag = new RunningFlag;
        $runflag->flag_running = $use;
        $runflag->save();

        return compact('current', 'payer', 'troli');
    }

    public function addPaymentType(Request $request)
    {
        // dd($request, 'soni');exit;

        $troli = Troli::where('flag', $request->troliflag)
                      ->with('fkservice')
                      ->get();

        foreach ($troli as $key => $value)
        {
            $data = ServiceMain::where('id', $value->fk_service)->first();
            $data->fk_payment_gateway = $request->paytype;
            $data->fpx_type= $request->akauntype;
            $data->save();
        }
    }

    public function cartBayar(Request $request)
    {
        // dd($request);exit;
        $troli = Troli::where('flag', $request->troliflag)
                      ->with('fkservice')
                      ->get();

        // -----------------------
        $total = 0;

        foreach ($troli as $key => $trolis)
        {
            $srvmain = ServiceMain::where('id', $trolis->fk_service)->first();
            $srvmain->total = $trolis->amount;
            $srvmain->update();

            // dd($request->flagpay);exit;

            $total += data_get($trolis, 'amount');

            foreach ($srvmain->srvmaindetail as $key => $srvmains)
            {
                $ayat  = data_get($srvmain, 'srvmainmgt.lkpperkhidmatan.name');
                $harga = data_get($srvmains, 'tetapan.description');
                $quote = data_get($srvmains, 'number').' X '.data_get($srvmains, 'perpax');

                $details = $ayat.' - '.$harga.' ('.$quote.') ';

                $paymentdetail = new PaymentDetail;
                // $paymentdetail->fk_payment  = $payment->id;
                $paymentdetail->fk_troli    = $trolis->id;
                // $paymentdetail->fk_payer    = data_get($srvmain,'fk_payer');
                $paymentdetail->fk_payer    = data_get($trolis,'fk_payer');
                $paymentdetail->amount       = data_get($srvmains,'total');
                $paymentdetail->kod_hasil    = data_get($srvmain,'codehasil.name');

                // tiket n other ----------------------
                if($request->flagpay==1)
                {
                    $paymentdetail->fk_lkp_perkhidmatan = data_get($srvmain, 'fkpayerbill.fkkodhasil.lkpperkhidmatan.id'); // tak jumpa bill. bill amek dari payer bill
                    $paymentdetail->fk_kod_hasil = data_get($srvmain, 'fkpayerbill.fkkodhasil.id');
                    $paymentdetail->details      = data_get($srvmain, 'fkpayerbill.bill_detail');
                    $paymentdetail->reference_no = data_get($srvmain, 'fkpayerbill.reference_no');
                }

                // bill -------------------------------
                elseif($request->flagpay==2)
                {
                    $paymentdetail->fk_lkp_perkhidmatan = data_get($srvmains,'category.serviceratemgt.fk_lkp_perkhidmatan'); // tak jumpa bill. bill amek dari payer bill
                    $paymentdetail->fk_kod_hasil        = data_get($srvmains,'category.serviceratemgt.fk_kod_hasil');
                    $paymentdetail->details      = $details;
                    $paymentdetail->reference_no = NULL;
                }

                elseif($request->flagpay==3)
                {
                    $paymentdetail->fk_lkp_perkhidmatan = data_get($srvmains,'category.serviceratemgt.fk_lkp_perkhidmatan'); // tak jumpa bill. bill amek dari payer bill
                    $paymentdetail->fk_kod_hasil        = data_get($srvmains,'category.serviceratemgt.fk_kod_hasil');
                    $paymentdetail->details      = $details;
                    $paymentdetail->reference_no = NULL;
                }

                $paymentdetail->save();
            }
        }

        $payment = new Payment;
        $payment->fk_payment_gateway = $troli[0]->fkservice->fk_payment_gateway;
        $payment->fk_user = Auth::user()->id;
        $payment->transaction_no = date('YmdHis');
        $payment->total_amount = number_format($total, 2, ".", "");
        $payment->status = 0;
        $payment->fpx_type = $troli[0]->fkservice->fpx_type; // 01-individu 02-korporat
        $payment->save();

        foreach ($troli as $key => $trolis)
        {
            $pdlast = PaymentDetail::where('fk_troli', $trolis->id)->get();

            foreach ($pdlast as $key => $pdlasts)
            {
                $pdlasts->fk_payment = $payment->id;
                $pdlasts->save();
            }
        }

        return $payment;
    }

    public function cartMultiBayar(Request $request)
    {
        // dd($request);exit;
        $troli = Troli::where('flag', $request->troliflag)
                      ->with('fkservice')
                      ->get();

        // -----------------------
        $total = 0;

        foreach ($troli as $key => $trolis)
        {
            $srvmain = ServiceMain::where('id', $trolis->fk_service)->first();
            $srvmain->total = $trolis->amount;
            $srvmain->update();

            // dd($request->flagpay);exit;

            $total += data_get($trolis, 'amount');

            foreach ($srvmain->srvmaindetail as $key => $srvmains)
            {
                $ayat  = data_get($srvmain, 'srvmainmgt.lkpperkhidmatan.name');
                $harga = data_get($srvmains, 'tetapan.description');
                $quote = data_get($srvmains, 'number').' X '.data_get($srvmains, 'perpax');

                $details = $ayat.' - '.$harga.' ('.$quote.') ';

                $paymentdetail = new PaymentDetail;
                // $paymentdetail->fk_payment  = $payment->id;
                $paymentdetail->fk_troli    = $trolis->id;
                $paymentdetail->fk_payer    = data_get($srvmain,'fk_payer');
                $paymentdetail->amount       = data_get($srvmains,'total');
                $paymentdetail->kod_hasil    = data_get($srvmain,'codehasil.name');

                // tiket n other ----------------------
                if($request->flagpay==1)
                {
                    $paymentdetail->fk_lkp_perkhidmatan = data_get($srvmain, 'fkpayerbill.fkkodhasil.lkpperkhidmatan.id'); // tak jumpa bill. bill amek dari payer bill
                    $paymentdetail->fk_kod_hasil = data_get($srvmain, 'fkpayerbill.fkkodhasil.id');
                    $paymentdetail->details      = data_get($srvmain, 'fkpayerbill.bill_detail');
                    $paymentdetail->reference_no = data_get($srvmain, 'fkpayerbill.reference_no');
                }

                // bill -------------------------------
                elseif($request->flagpay==2)
                {
                    $paymentdetail->fk_lkp_perkhidmatan = data_get($srvmains,'category.serviceratemgt.fk_lkp_perkhidmatan'); // tak jumpa bill. bill amek dari payer bill
                    $paymentdetail->fk_kod_hasil        = data_get($srvmains,'category.serviceratemgt.fk_kod_hasil');
                    $paymentdetail->details      = $details;
                    $paymentdetail->reference_no = NULL;
                }

                elseif($request->flagpay==3)
                {
                    $paymentdetail->fk_lkp_perkhidmatan = data_get($srvmains,'category.serviceratemgt.fk_lkp_perkhidmatan'); // tak jumpa bill. bill amek dari payer bill
                    $paymentdetail->fk_kod_hasil        = data_get($srvmains,'category.serviceratemgt.fk_kod_hasil');
                    $paymentdetail->details      = $details;
                    $paymentdetail->reference_no = NULL;
                }

                $paymentdetail->save();
            }
        }

        $payment = new Payment;
        $payment->fk_payment_gateway = $troli[0]->fkservice->fk_payment_gateway;
        if($request->flaglogin)
        {
            $payment->fk_user = Auth::user()->id;
        }
        $payment->transaction_no = date('YmdHis');
        $payment->total_amount = number_format($total, 2, ".", "");
        $payment->status = 0;
        $payment->fpx_type = $troli[0]->fkservice->fpx_type; // 01-individu 02-korporat
        $payment->save();

        foreach ($troli as $key => $trolis)
        {
            $pdlast = PaymentDetail::where('fk_troli', $trolis->id)->get();

            foreach ($pdlast as $key => $pdlasts)
            {
                $pdlasts->fk_payment = $payment->id;
                $pdlasts->save();
            }
        }

        return $payment;
    }

}
