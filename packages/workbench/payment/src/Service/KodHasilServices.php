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
use Workbench\Database\Model\Agency\ServiceKodHasil;
use Workbench\Database\Model\Agency\ServiceKodHasilDetail;
use Workbench\Database\Model\Lkp\LkpPerkhidmatan;
use Workbench\Database\Model\Agency\ServiceRateMgt;
use Workbench\Database\Model\Agency\ServiceRate;
use Workbench\Database\Model\Payment\ServiceMain;
use Workbench\Database\Model\Payment\ServiceMainDetail;
use Workbench\Database\Model\Bill\Payer;
use Workbench\Database\Model\Bill\PayerAccount;
use Workbench\Database\Model\Bill\PayerBill;
use Workbench\Database\Model\Bill\Troli;
use Workbench\Database\Model\Payment\PaymentGateway;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\PaymentDetail;
use Workbench\Database\Model\Bill\RunningFlag;




class KodHasilServices
{


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/

    // ------------------- Hasil ------------------- //

    public function lkpperkhidmatan(Request $request)
    {
        $lkpkhidmat = LkpPerkhidmatan::where('id', $request->lkpkhidmat)
                                     ->with('codehasil')
                                     ->first();

        // dd($lkpkhidmat);exit;

        return $lkpkhidmat;
    }

    public function servisRateMgt(Request $request)
    {
        $srvratemgt = ServiceRateMgt::where('fk_lkp_perkhidmatan', $request->lkpkhidmat)
                                    // ->where('fk_agency',$kodhasil->fk_agency)
                                    // ->where('fk_ptj',$kodhasil->fk_ptj)
                                    ->with('agency','ptj','lkpperkhidmatan','kodhasil','servicerate.fkcategory','servicerate.fkunit')
                                    ->get();

        // dd($srvratemgt);exit;

        return $srvratemgt;
    }

    public function searchsrvrate($request)
    {
        $data = ServiceRate::where('service_rate_mgt', $request->id)
                           ->with('fkcategory','fkunit')
                           ->whereHas('fkcategory', function ($query)
                                {
                                    $query->where('status', 1);
                                })
                           ->get();

        // dd($data);exit;

        return $data;
    }

    public function svForm($request)
    {
        // dd($request);exit;
        $servicerate = ServiceRate::where('id', $request->srvrate)
                                  ->with('serviceratemgt')
                                  ->first();

        // dd($servicerate);exit;

        // ---- service main
        $srvmain = new ServiceMain;
        $srvmain->fk_service_rate_mgt = data_get($servicerate, 'service_rate_mgt');
        $srvmain->fk_kod_hasil        = data_get($servicerate, 'serviceratemgt.fk_kod_hasil');
        $srvmain->tarikh_lawatan      = date('Y-m-d',strtotime($request->date_start));
        $srvmain->save();

        // ---- service main detail
        $srvmaindetail = new ServiceMainDetail;
        $srvmaindetail->fk_service_main = $srvmain->id;
        // $srvmaindetail->fk_category     = data_get($servicerate, 'category');
        $srvmaindetail->fk_category     = data_get($request, 'srvrate');
        $srvmaindetail->number          = data_get($request, 'bil');
        $srvmaindetail->perpax          = data_get($servicerate, 'rate');
        $srvmaindetail->total           = data_get($servicerate, 'rate') * data_get($request, 'bil');
        $srvmaindetail->save();


        $servicemain = ServiceMain::where('id', $srvmain->id)
                                  ->first();

        return $servicemain;
    }

    public function updTiket(Request $request)
    {
        // dd($request);exit;
        $srvratemgt = ServiceRateMgt::where('id', $request->srvratemgt)
                                    ->with('agency', 'ptj', 'lkpperkhidmatan', 'kodhasil', 'servicerate.fkcategory', 'servicerate.fkunit')
                                    ->first();

        $servicerate = ServiceRate::where('id', $request->category)
                                  ->first();

        // dd($srvratemgt, $servicerate, $request);

        $srvmaindetail = new ServiceMainDetail;
        $srvmaindetail->fk_service_main = $request->srvmain;
        $srvmaindetail->fk_category     = $request->category; //fk_tetapan
        $srvmaindetail->number          = $request->bil;
        $srvmaindetail->perpax          = $servicerate->rate;
        $srvmaindetail->total           = ($servicerate->rate) * ($request->bil);
        $srvmaindetail->save();


    }

    public function kodhasil(Request $request)
    {
       $kodhasil = KodHasil::where('id', $request->kodhasil)
                           ->with('lkpperkhidmatan', 'agency', 'ptj')
                           ->first();

       return $kodhasil;
    }

    public function srvratemgt(Request $request)
    {
        $kodhasil = $this->kodhasil($request);

        $srvratemgt = ServiceRateMgt::where('fk_kod_hasil', $kodhasil->id)
                                    ->where('fk_agency', $kodhasil->fk_agency)
                                    ->where('fk_ptj', $kodhasil->fk_ptj)
                                    ->with('agency', 'ptj', 'lkpperkhidmatan', 'kodhasil', 'servicerate.fkcategory', 'servicerate.fkunit')
                                    ->first();

        // dd($srvratemgt);

        return $srvratemgt;
    }

    public function delTiket(Request $request)
    {
        $data = ServiceMainDetail::where('id', $request->servicedetail)
                                 ->delete();
    }

    public function addPayer(Request $request)
    {
        $data = new Payer;
        $data->name              = strtoupper($request->name);
        $data->identification_no = strtoupper($request->identification_no);
        $data->no_tel   = $request->no_tel;
        $data->email    = $request->email;
        $data->address  = strtoupper($request->address);
        $data->city     = strtoupper($request->city);
        $data->state    = $request->state;
        $data->status   = 1;
        $data->save();

        if($request->troliflag)
        {
            $troli = Troli::where('flag', $request->troliflag)
                          ->get();

            foreach ($troli as $key => $trolis)
            {
                $trolis->fk_payer = $data->id;
                $trolis->update();

                $srvmain = ServiceMain::where('id', $trolis->fk_service)
                                      ->get();

                foreach ($srvmain as $key => $srvmains)
                {
                    $srvmains->fk_payer = $data->id;
                    $srvmains->update();
                }
            }
        }
        else
        {
            $srvmain = ServiceMain::where('id', $request->id)->update(['fk_payer' => $data->id]);
            $troli = Troli::where('fk_service', $request->id)->update(['fk_payer' => $data->id]);
        }
    }

    public function addPaymentType(Request $request)
    {
        $data = ServiceMain::where('id',$request->id)
                           ->first();

        $data->fk_payment_gateway = $request->paytype;
        if($request->paytype==1)
        {
            //fpx
            $data->fpx_type= $request->akauntype;
        }
        else
        {
            $data->card_type= $request->kadtype;
        }

        $data->save();
    }

    public function bayarTiket(Request $request)
    {
        $srvmain = ServiceMain::where('id', $request->id)
                              ->with('fkpayer', 'srvmaindetail.category.serviceratemgt', 'srvmainmgt.lkpperkhidmatan', 'codehasil', 'fkpaymentgateway', 'fkpayer', 'fkpayerbill', 'srvmaindetail.tetapan')
                              ->first();

        $trolidup = Troli::where('fk_service', $request->id)
                         ->count();
// dd($trolidup);exit;
        $total = 0.0;

        foreach(data_get($srvmain, 'srvmaindetail') as $key => $value)
        {
            $total += data_get($value,'total');
        }

        $srvmain->total = number_format($total, 2, ".", "");
        $srvmain->save();

        /**********************************************/

        if($trolidup >= 1)
        {
            $troli = Troli::where('fk_service', $request->id)->first();
        }
        else
        {
            $troli = new Troli;

            if($request->flaglogin==0)
            {
                //tak login
                if($request->flagpay==1)
                {
                    //ticket
                    $troli->fk_payer_bill = NULL; //bukan bill
                    $troli->type = 2; // 1-bill,2-selain bil
                }
                else
                {
                    //bill
                    $troli->fk_payer_bill = data_get($srvmain,'fk_payer_bill'); //bill
                    $troli->type = 1; // 1-bill,2-selain bil
                }

                $troli->fk_user = NULL; //bukan login user

            }
            else
            {
                // login
                if($request->flagpay==1)
                {
                    // ticket
                    $troli->fk_payer_bill = NULL; //bukan bill
                    $troli->type = 2; // 1-bill,2-selain bil
                }
                else
                {
                    // bill
                    $troli->fk_payer_bill = data_get($srvmain,'fk_payer_bill'); //bill
                    $troli->type = 1; // 1-bill,2-selain bil
                }

                $troli->fk_user = Auth::user()->id; //login user
            }


            $troli->fk_service  = $srvmain->id; // fk_service_main
            $troli->fk_payer    = data_get($srvmain, 'fk_payer');
            $troli->amount      = number_format($total, 2, ".", "");
            $troli->status      = 1; // 0-troli,1-ready payment,3-paid
            $troli->save();
        }

        /**********************************************/

        $payment = new Payment;
        // $payment->fk_troli = $troli->id;
        $payment->fk_payment_gateway = data_get($srvmain,'fk_payment_gateway'); // 1-fpx, 2-card

        if($request->flaglogin==0)
        {
            // tak login
            $payment->fk_user = NULL; // user tak login
        }
        else
        {
            $payment->fk_user = Auth::user()->id; //login user
        }

        $payment->transaction_no = date('YmdHis');
        $payment->total_amount   = number_format($total,2,".","");
        $payment->status         = 0;
        $payment->fpx_type       = data_get($srvmain,'fpx_type'); //01-individu 02-korporat
        $payment->save();

        foreach(data_get($srvmain,'srvmaindetail') as $x => $y)
        {
            // if()
            $ayat  = data_get($srvmain, 'srvmainmgt.lkpperkhidmatan.name');
            $harga = data_get($y, 'category.fkcategory.description');
            $quote = data_get($y, 'number').' X '.data_get($y, 'perpax');

            $details = $ayat.' - '.$harga.' ('.$quote.') ';

            $paymentdetail = new PaymentDetail;
            $paymentdetail->fk_payment = $payment->id;
            $paymentdetail->fk_troli   = $troli->id;
            $paymentdetail->fk_payer   = data_get($srvmain, 'fk_payer');
            $paymentdetail->amount     = data_get($y, 'total');
            $paymentdetail->kod_hasil  = data_get($srvmain, 'codehasil.name');
            $paymentdetail->reference_no = NULL;

            // tiket n other ----------------------
            if($request->flagpay==1)
            {
                $paymentdetail->fk_lkp_perkhidmatan = data_get($y, 'category.serviceratemgt.fk_lkp_perkhidmatan'); // tak jumpa bill. bill amek dari payer bill
                $paymentdetail->fk_kod_hasil        = data_get($y, 'category.serviceratemgt.fk_kod_hasil');
                $paymentdetail->details      = $details;
                $paymentdetail->reference_no = NULL;
            }

            // bill -------------------------------
            elseif($request->flagpay==2)
            {
                $paymentdetail->fk_lkp_perkhidmatan = data_get($srvmain, 'fkpayerbill.fkkodhasil.lkpperkhidmatan.id'); // tak jumpa bill. bill amek dari payer bill
                $paymentdetail->fk_kod_hasil = data_get($srvmain, 'fkpayerbill.fkkodhasil.id');
                $paymentdetail->details      = data_get($srvmain, 'fkpayerbill.bill_detail');
                $paymentdetail->reference_no = data_get($srvmain, 'fkpayerbill.reference_no');
            }

            elseif($request->flagpay==3)
            {
                $paymentdetail->fk_lkp_perkhidmatan = data_get($y,'category.serviceratemgt.fk_lkp_perkhidmatan'); // tak jumpa bill. bill amek dari payer bill
                $paymentdetail->fk_kod_hasil        = data_get($y,'category.serviceratemgt.fk_kod_hasil');
                $paymentdetail->details      = $details;
                $paymentdetail->reference_no = NULL;
            }

            $paymentdetail->save();
        }
        return $payment;
    }

    public function getPayment(Request $request)
    {
        $datatroli = Troli::select('id')
                          ->where('fk_service',$request->id)
                          ->orderby('id','desc')
                          ->first();

        $troliid = data_get($datatroli,'id');

        $datapaydetail = PaymentDetail::select('fk_payment')
                                      ->where('fk_troli', $troliid)
                                      ->orderby('id', 'desc')
                                      ->first();

        $paymentid = data_get($datapaydetail,'fk_payment');
        $datapayment = Payment::find($paymentid);

        return $datapayment;
    }

    public function serviceMain(Request $request)
    {
        $data = ServiceMain::where('id',$request->id)
                           ->with('srvmaindetail.tetapan', 'srvmaindetail.category.fkcategory','srvmainmgt','codehasil.lkpperkhidmatan','fkpaymentgateway','fkpayer','fkpayerbill')
                           ->first();

        return $data;
    }

    // bill ------------------------------------
    public function searchbill(Request $request)
    {
        $now = date('Y-m-d');

        $lkpkhidmat = LkpPerkhidmatan::where('id', $request->lkpkhidmat)
                                     ->with('codehasil')
                                     ->first();

        if( data_get($lkpkhidmat, 'type') == 3 )
        {
            $skh = ServiceKodHasil::where('fk_lkp_perkhidmatan', $request->lkpkhidmat)
                                  ->get();

            // $tempawal = array();
            $temp = array();

            foreach ($skh as $key => $skhs)
            {
                $skhd = ServiceKodHasilDetail::where('fk_service_kod_hasil', $skhs->id)
                                             ->get();

                foreach($skhd as $key => $value)
                {
                    array_push($temp, $value->fk_kod_hasil);
                }
            }
        }
        else
        {
            $temp = array();

            foreach(data_get($lkpkhidmat, 'codehasil') as $key => $value)
            {
                array_push($temp, $value->id);
            }
        }

        $kodhasillist = implode(",", $temp);

        $bil = PayerBill::where('status', 1)
                        ->where('bill_end_date', '>=', $now)
                        ->whereIn('fk_kod_hasil', explode(',', $kodhasillist))
                        ->where(function ($query) use ($request)
                        {
                            // $query->where('reference_no','like','%'.$request->refno.'%')
                                  // ->orWhere('identification_no','like','%'.$request->refid.'%');
                            $query->where('reference_no', $request->refno)
                                  ->orWhere('identification_no', $request->refid);
                        })
                        ->get();

        return $bil;

        // $refno = $request->refno;
        // $refid = $request->refid;

        // if(($refid > 0) && ($refno > 0))
        // {
        //     $data = PayerBill::where('status',1)
        //                      ->where('bill_end_date','>=',$now)
        //                      ->whereIn('fk_kod_hasil',[$kodhasillist])
        //                      ->where('reference_no','like','%'.$request->refno.'%')
        //                      ->orWhere('identification_no','like','%'.$request->refid.'%')
        //                      ->get();

        // }
        // elseif(($refid > 0) && ($refno == 0))
        // {
        //     $data = PayerBill::where('status',1)
        //                      ->where('bill_end_date','>=',$now)
        //                      ->whereIn('fk_kod_hasil',[$kodhasillist])
        //                      ->where('identification_no','like','%'.$request->refid.'%')
        //                      ->get();

        // }
        // elseif(($refid == 0) && ($refno > 0))
        // {
        //     $data = PayerBill::where('status',1)
        //                      ->where('bill_end_date','>=',$now)
        //                      ->whereIn('fk_kod_hasil',[$kodhasillist])
        //                      ->where('reference_no','like','%'.$request->refno.'%')
        //                      ->get();

        // }
        // else
        // {
        //     $data = array();
        // }

        // return $data;
    }

    public function saveBill(Request $request)
    {
        $payerbill = PayerBill::where('id', $request->billid)->first();
        // dd($payerbill);

        $srvmain = new ServiceMain;
        $srvmain->fk_payer_bill = data_get($payerbill, 'id');
        $srvmain->fk_kod_hasil  = data_get($payerbill, 'fk_kod_hasil');
        $srvmain->save();

        // ---- service main detail
        $srvmaindetail = new ServiceMainDetail;
        $srvmaindetail->fk_service_main = $srvmain->id;
        $srvmaindetail->total           = data_get($payerbill,'amount');
        $srvmaindetail->save();

        return $srvmain;
    }

    public function saveMulti(Request $request)
    {
        // dd($request);exit;
        // perkhidmatan_type = 3 multi item
        foreach(data_get($request, 'foradd') as $key => $value)
        {
            $payerbill = PayerBill::where('id', $value)
                                  ->first();

            $srvmain = new ServiceMain;
            $srvmain->fk_payer_bill = data_get($payerbill, 'id');
            $srvmain->fk_kod_hasil  = data_get($payerbill, 'fk_kod_hasil');
            if($request->flaglogin)
            {
                $srvmain->fk_user = Auth::user()->id;
            }
            $srvmain->save();

            // ---- service main detail
            $srvmaindetail = new ServiceMainDetail;
            $srvmaindetail->fk_service_main = $srvmain->id;
            $srvmaindetail->total           = data_get($payerbill,'amount');
            $srvmaindetail->save();

            $total = 0.0;
            $total += data_get($srvmaindetail, 'total');

            $current = RunningFlag::orderBy('id', 'desc')
                                  ->first();

            $troli = new Troli;
            $troli->fk_payer_bill = $payerbill->id;
            if($request->flaglogin)
            {
                $troli->fk_user = Auth::user()->id;
            }
            $troli->type = 1;
            $troli->fk_service = $srvmain->id;
            // $troli->fk_payer = 1;
            $troli->flag = $current->flag_running;
            $troli->amount = number_format($total, 2, ".", "");
            $troli->status = 1;
            $troli->save();
        }

        $use = $current->flag_running+1;

        $runflag = new RunningFlag;
        $runflag->flag_running = $use;
        $runflag->save();

        return $troli;
    }

    public function paymentGtwy(Request $request)
    {
        // $data = PaymentGateway::where('id', 1)
        //                       ->where('status', 1)
        //                       ->get();

         $data = PaymentGateway::where('status', 1)
                                ->get();

        return $data;
    }


    public function getKodHasilList(Request $request)
    {
        $kodhasil     = KodHasil::where('id',$request->kodhasil)
                                ->first();

        $kodhasillist = KodHasil::where('fk_perkhidmatan', data_get($kodhasil,'fk_perkhidmatan'))
                                ->get();

        return $kodhasillist;
    }

    public function usrUpdTiket(Request $request)
    {
        // dd($request);
        $srvratemgt = ServiceRateMgt::where('id', $request->srvratemgt)
                                    ->with('agency','ptj','lkpperkhidmatan','kodhasil','servicerate.fkcategory','servicerate.fkunit')
                                    ->first();

        $servicerate = ServiceRate::where('id', $request->category)
                                  ->first();

        // dd($srvratemgt, $servicerate, $request);

        $srvmaindetail = new ServiceMainDetail;
        $srvmaindetail->fk_service_main = $request->srvmain;
        $srvmaindetail->fk_category     = $request->category; //fk_tetapan
        $srvmaindetail->number          = $request->bil;
        $srvmaindetail->perpax          = $servicerate->rate;
        $srvmaindetail->total           = ($servicerate->rate) * ($request->bil);
        $srvmaindetail->save();

    }































    public function svTiket(Request $request)
    {
        // dump($request);

        $srvmain = new ServiceMain;
        $srvmain->fk_service_rate_mgt = $request->srvratemgt;
        $srvmain->fk_kod_hasil = $request->kodhasil;
        $srvmain->tarikh_lawatan = date('Y-m-d',strtotime($request->date_start));
        $srvmain->save();

        $srvratemgt = ServiceRateMgt::where('id',$request->srvratemgt)
        ->with('agency','ptj','lkpperkhidmatan','kodhasil','servicerate.fkcategory','servicerate.fkunit')
        ->first();

        $servicerate = ServiceRate::where('id',$request->category)->first();

        // dd($srvratemgt);

        // ---- service main detail
        $srvmaindetail = new ServiceMainDetail;
        $srvmaindetail->fk_service_main = $srvmain->id;
        $srvmaindetail->fk_category = $request->category; //fk_tetapan
        $srvmaindetail->number = $request->bil;
        $srvmaindetail->perpax = $servicerate->rate;
        $srvmaindetail->total = ($servicerate->rate) * ($request->bil);
        $srvmaindetail->save();

        return $srvmain->id;


    }

    public function updBill(Request $request)
    {
        $payerbill = PayerBill::where('id',$request->billid)->first();

        $srvmain = ServiceMain::where('id',$request->id)->first();
        $srvmain->fk_payer_bill = data_get($payerbill,'id');
        $srvmain->fk_kod_hasil = data_get($payerbill,'fk_kod_hasil');
        $srvmain->save();

        // ---- service main detail
        $srvmaindetail = new ServiceMainDetail;
        // $srvmaindetail->fk_service_main = $srvmain->id;
        $srvmaindetail->total = data_get($payerbill,'amount');
        $srvmaindetail->save();

        return $srvmain;
    }

    public function getUser(Request $request)
    {
        $data = Users::where('id', Auth::user()->id)
                     ->with('profile', 'role')
                     ->first();

                     // dd($data);exit;
        return $data;
    }

    public function getUserBill(Request $request)
    {
        $data = ServiceMain::where('id', $request->id)
                           ->with('fkpayerbill')
                           ->first();

        // dd($data->fkpayerbill);exit;


        // $data = Users::where('id', Auth::user()->id)
        //              ->with('profile', 'role')
        //              ->first();

        return $data;
    }

    public function getUserMulti(Request $request)
    {
        $data = Troli::where('flag', $request->troli_flag)
                     ->with('fkpayerbill')
                     ->first();

                     // dd($data, 'asd');exit;

        return $data;
    }







}
