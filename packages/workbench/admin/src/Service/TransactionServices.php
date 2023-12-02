<?php

namespace Workbench\Admin\Service;

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
use Svg\Tag\Rect;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\Agency\KodHasil;
use Workbench\Database\Model\Payment\Pelarasan;
use Workbench\Database\Model\Agency\Ptj;
use Workbench\Database\Model\Bill\Payer;
use Workbench\Database\Model\Bill\PayerBill;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\PaymentDetail;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\Bill\Troli;
use Workbench\Database\Model\Lkp\LkpKodHasil;

class TransactionServices
{


    // ------------------- Transaction ------------------- //

    public function transList(Request $request)
    {
        // $user = Auth::user()->id;
        // $profile = Users::where('id',$user)->with('profile','role')->first();
        // // dd($user, $profile);

        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;

        if($roleid==7){

            $transaction = PaymentDetail::with('fkpayment','fkpayer','fkpayer.fkagency','fkpayer.fkptj','fkkodhasil','fkperkhidmatan')
                        ->whereHas('fkpayment', function ($query)
                            {
                                $query->where('status', '=', 1);
                            })
                        ->whereHas('fkpayment', function ($query) use ($user)
                            {
                                $query->where('fk_user',$user);
                            })
                        ->get();
        }else{

            if(($roleid==4) || ($roleid==5)){

                $userprofile=UserProfile::where('fk_users',$user)->first();
                $data_useragency=data_get($userprofile,'fk_agency');
                $data_useraptj=data_get($userprofile,'fk_ptj');

                $transaction = PaymentDetail::with('fkpayment','fkpayer','fkpayer.fkagency','fkpayer.fkptj','fkkodhasil','fkperkhidmatan')
                            ->whereHas('fkpayment', function ($query)
                                {
                                    $query->where('status', '=', 1);
                                })
                            ->whereHas('fkkodhasil', function ($query) use ($data_useragency,$data_useraptj)
                                {
                                    $query->where('fk_agency',$data_useragency)
                                          ->where('fk_ptj',$data_useraptj);
                                })
                            ->get();


            }else{
                $transaction = PaymentDetail::with('fkpayment','fkpayer','fkpayer.fkagency','fkpayer.fkptj','fkkodhasil','fkperkhidmatan')
                                            ->whereHas('fkpayment', function ($query)
                                                {
                                                    $query->where('status', '=', 1);
                                                })
                                            ->get();
            }
        }

        return $transaction;
    }

    public function agencySel(Request $request)
    {

        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;

        if($roleid==4 || $roleid==5){

            $useragency=UserProfile::where('fk_users',$user)->first();
            $data_useragency=data_get($useragency,'fk_agency');


            $agency = Agency::find($data_useragency);


        }else{
            $agency = Agency::with('ptj','profile','role')
                       ->get();

        }



       return $agency;
    }

    public function ptjSel(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;



        if($roleid==4 || $roleid==5){
            $userptj=UserProfile::where('fk_users',$user)->first();
            $data_ptj=data_get($userptj,'fk_ptj');

            $ptj = Ptj::find($data_ptj);

        }else{
            if($request->agencyid)
            {
                $ptj = Ptj::where('fk_agency',$request->agencyid)->get();
            }
            else
            {
                $ptj = Ptj::get();
            }
        }


        return $ptj;
    }

    public function kodhasilSel(Request $request)
    {

        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;

        $userprofile=UserProfile::where('fk_users',$user)->first();
        $data_useragency=data_get($userprofile,'fk_agency');
        $data_ptj=data_get($userprofile,'fk_ptj');

        if($roleid==4 || $roleid==5){

            $kodhasil = Kodhasil::with('lkpperkhidmatan')->where('fk_ptj',$data_ptj)->where('fk_agency',$data_useragency)->get();

        }else{

            if($request->ptjid)
            {
                $kodhasil = Kodhasil::with('lkpperkhidmatan')->where('fk_ptj',$request->ptjid)->get();
            }
            else if($request->agencyid)
            {
                $kodhasil = Kodhasil::with('lkpperkhidmatan')->where('fk_agency',$request->agencyid)->get();
            }
            else
            {
                $kodhasil = KodHasil::with('lkpperkhidmatan')->get();
            }


        }



        return $kodhasil;
    }


    public function resultAjaxTransaction($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
        $ag = data_get($request, 'agency');
        $ptj = data_get($request, 'ptj');
        $kdh = data_get($request, 'kodhasil');
        $nam = data_get($request, 'name');
        $ref = data_get($request, 'reference');
        $receipt = data_get($request, 'receiptno');

        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;


        if($sd == 'start')
        {
            $ads = date('Y-m-d 00:00:00', strtotime('01-01-1970')) ;
        }
        else
        {
            $ads = date('Y-m-d 00:00:00', strtotime($sd)) ;
        }

		if($ed == 'end')
		{
			$ade = date('Y-m-d 23:59:59', strtotime(Carbon::now())) ;
		}
		else
		{
			$ade = date('Y-m-d 23:59:59', strtotime($ed)) ;
		}

        if(($roleid == 1)||($roleid == 2))
        {

            $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil.agency','fkkodhasil.ptj','fkperkhidmatan')
                                    ->whereHas('fkpayment', function ($query) use ($ads, $ade)
                                    {
                                        $query->where('transaction_date', '>=', $ads)
                                              ->where('transaction_date', '<=', $ade);

                                    })
                                    ->whereHas('fkpayment', function ($query)
                                        {
                                            $query->where('status', '=', 1);
                                        })
                                    ->whereHas('fkkodhasil.agency', function ($query) use ($ag)
                                        {
                                            if($ag != 'agency')
                                                $query->where('id', '=', $ag);
                                            else
                                                $query;
                                        })
                                    ->whereHas('fkkodhasil.ptj', function ($query) use ($ptj)
                                        {
                                            if($ptj != 'ptj')
                                                $query->where('id', '=', $ptj);
                                            else
                                                $query;
                                        })
                                    ->whereHas('fkkodhasil', function ($query) use ($kdh)
                                        {
                                            if($kdh != 'kodhasil')
                                                $query->where('id', '=', $kdh);
                                            else
                                                $query;
                                        })
                                    ->whereHas('fkpayer', function ($query) use ($nam)
                                        {
                                            if($nam != 'name')
                                                $query->where('name', 'LIKE', '%'.$nam.'%');
                                            else
                                                $query;
                                        })
                                    ->where(function ($query) use ($ref)
                                        {
                                            if($ref != 'reference')

                                                $query->where('reference_no', '=', $ref);
                                            else
                                                $query;
                                        })
                                    ->where(function ($query) use ($receipt)
                                        {
                                            if($receipt != 'receipt_no')

                                                $query->where('receipt_no', '=', $receipt);
                                            else
                                                $query;
                                        })
                                    ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();


            $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil.agency','fkkodhasil.ptj','fkperkhidmatan')
                                ->whereHas('fkkodhasil.agency', function ($query) use ($agency)
                                    {
                                        $query->where('id', '=', $agency->fk_agency);
                                    })
                                ->whereHas('fkkodhasil.ptj', function ($query) use ($agency)
                                    {
                                        $query->where('id', '=', $agency->fk_ptj);
                                    })
                                ->whereHas('fkpayment', function ($query) use ($ads, $ade, $roleid, $user)
                                {
                                    if($roleid == 7)
                                    {
                                        if($ads != 'sdate')
                                        {
                                            $query->where('transaction_date', '>=', $ads)
                                                    ->where('fk_user',$user);
                                        }
                                        elseif($ade != 'edate')
                                        {
                                            $query->where('transaction_date', '<=', $ade)
                                                    ->where('fk_user',$user);
                                        }
                                        else
                                        {
                                            $query->where('fk_user',$user);
                                        }
                                    }
                                    else
                                    {
                                        if($ads != 'sdate')
                                        {
                                            $query->where('transaction_date', '>=', $ads);
                                        }
                                        elseif($ade != 'edate')
                                        {
                                            $query->where('transaction_date', '<=', $ade);
                                        }
                                        else
                                        {
                                            $query;
                                        }
                                    }
                                })
                                ->whereHas('fkkodhasil', function ($query) use ($kdh)
                                {
                                    if($kdh != 'kodhasil')
                                        $query->where('id', '=', $kdh);
                                    else
                                        $query;
                                })
                                ->whereHas('fkpayer', function ($query) use ($nam)
                                {
                                    if($nam != 'name')
                                        $query->where('name', 'LIKE', '%'.$nam.'%');
                                    else
                                        $query;
                                })
                                ->where(function ($query) use ($ref)
                                {
                                    if($ref != 'reference')

                                        $query->where('reference_no', '=', $ref);
                                    else
                                        $query;
                                })
                                ->where(function ($query) use ($receipt)
                                {
                                    if($receipt != 'receipt_no')

                                        $query->where('receipt_no', '=', $receipt);
                                    else
                                        $query;
                                })
                                ->get();
            }
            elseif($roleid == 7)
            {

                $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil.agency','fkkodhasil.ptj','fkperkhidmatan')
                                    ->whereHas('fkpayment', function ($query) use ($ads, $ade, $roleid, $user)
                                    {
                                        if($ads != 'sdate')
                                        {
                                            $query->where('transaction_date', '>=', $ads)
                                                    ->where('fk_user',$user);
                                        }
                                        elseif($ade != 'edate')
                                        {
                                            $query->where('transaction_date', '<=', $ade)
                                                    ->where('fk_user',$user);
                                        }
                                        else
                                        {
                                            $query->where('fk_user',$user);
                                        }
                                    })
                                    ->whereHas('fkkodhasil', function ($query) use ($kdh)
                                        {
                                            if($kdh != 'kodhasil')
                                                $query->where('id', '=', $kdh);
                                            else
                                                $query;
                                        })
                                    ->whereHas('fkpayer', function ($query) use ($nam)
                                        {
                                            if($nam != 'name')
                                                $query->where('name', 'LIKE', '%'.$nam.'%');
                                            else
                                                $query;
                                        })
                                    ->where(function ($query) use ($ref)
                                        {
                                            if($ref != 'reference')

                                                $query->where('reference_no', '=', $ref);
                                            else
                                                $query;
                                        })
                                    ->where(function ($query) use ($receipt)
                                        {
                                            if($receipt != 'receipt_no')

                                                $query->where('receipt_no', '=', $receipt);
                                            else
                                                $query;
                                        })
                                    ->get();
            }

		return $data;

	}

    public function getTransaction(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;

        if(($roleid == 1)||($roleid == 2)||($roleid == 7))
        {
            $transaction = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil.agency','fkkodhasil.ptj','fkperkhidmatan')
                                        ->where('id', $request->id)
                                        ->first();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();


            $transaction = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil.agency','fkkodhasil.ptj','fkperkhidmatan')
                                ->whereHas('fkkodhasil.agency', function ($query) use ($agency)
                                    {
                                        $query->where('id', '=', $agency->fk_agency);
                                    })
                                ->whereHas('fkkodhasil.ptj', function ($query) use ($agency)
                                    {
                                        $query->where('id', '=', $agency->fk_ptj);
                                    })
                                ->where('id', $request->id)
                                ->first();
        }

        // $transaction = PaymentDetail::with('fkpayment','fkpayment.fkpaymentgateway','fkpayer','fkpayer.fkagency','fkpayer.fkptj','fkkodhasil','fkperkhidmatan')
        //                             ->where('id', $request->id)
        //                             ->first();

        return $transaction;
    }

    public function getexportTransaction(Request $request)
    {
        $transaction = PaymentDetail::with('fkpayment','fkpayment.fkpaymentgateway','fkpayer','fkpayer.fkagency','fkpayer.fkptj','fkkodhasil','fkperkhidmatan')
                                    ->where('id', $request->id)
                                    ->first();

        return $transaction;
    }

    public function getexportTransactionmulti(Request $request)
    {
        $transaction = PaymentDetail::with('fkpayment','fkpayment.fkpaymentgateway','fkpayer','fkpayer.fkagency','fkpayer.fkptj','fkkodhasil','fkperkhidmatan')
                                    ->where('id', $request->id)
                                    ->first();

        $payment = Payment::where('id', $transaction->fk_payment)
                          ->with('paymentdetail.fkpayer.fkagency', 'paymentdetail.fkpayer.fkptj', 'paymentdetail.fkkodhasil', 'paymentdetail.fkperkhidmatan', 'fkpaymentgateway')
                          ->get();

        return compact('payment' , 'transaction');
    }

    public function pelarasanEdit(Request $request)
    {
        $pelarasan = PaymentDetail::with('fkpayment','fkpayment.fkpaymentgateway','fkpayer','fkpayer.fkagency','fkpayer.fkptj','fkkodhasil','fkperkhidmatan')
                                    ->where('id', $request->id)
                                    ->first();



        return $pelarasan;
    }

    public function getKodHasil(Request $request)
    {
        $frompaymentdetail = PaymentDetail::where('id', $request->id)
                                          ->first();
        $kodhasil=Kodhasil::find(data_get($frompaymentdetail,'fk_kod_hasil'));

        // $kodhasilbaru = KodHasil::with('lkpperkhidmatan')->where('fk_perkhidmatan', $frompaymentdetail->fk_lkp_perkhidmatan)
        //                          ->get();

        $kodhasilbaru = KodHasil::where('fk_ptj',data_get($kodhasil,'fk_ptj'))->get();

        return $kodhasilbaru;
    }

    public function pelarasanSimpan(Request $request)
    {

        $troli=Troli::find($request->troli);
        $payerbil=data_get($troli,'fk_payer_bill');


        $kodhasil=Kodhasil::find($request->kod_hasil_baru);





        $kodhasilbaru = new Pelarasan;
        $kodhasilbaru->fk_agency = $request->fk_agency;
        $kodhasilbaru->fk_ptj = $request->fk_ptj;
        $kodhasilbaru->fk_lkp_perkhidmatan = $request->fk_lkp_perkhidmatan;
        $kodhasilbaru->no_penyata_pemungut = $request->no_penyata_pemungut;
        $kodhasilbaru->receipt_no = $request->receipt_no;
        $kodhasilbaru->kod_hasil_lama = $request->kod_hasil_lama;
        $kodhasilbaru->kod_hasil_baru =data_get($kodhasil,'name');
        $kodhasilbaru->tarikh_pelarasan = date('Y-m-d',strtotime($request->tarikh_pelarasan));
        $kodhasilbaru->save();

        if($payerbil!= null){
        $updatepayerbil=PayerBill::find($payerbil);
        $updatepayerbil->fk_kod_hasil=$request->kod_hasil_baru;
        $updatepayerbil->save();
        }



        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Pelarasan Kod Hasil'));
    }

    public function getPelarasan(Request $request)
    {
        $pelarasan = Pelarasan::with('agency','ptj','lkpperkhidmatan')
                              ->get();
        // dd($pelarasan);

        return $pelarasan;
    }



}
