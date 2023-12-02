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
use Workbench\Database\Model\Payment\PaymentGateway;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\PaymentDetail;




class PaymentServices
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

    // -------------------  ------------------- //

    public function paymentDetail($request)
    {
        $data = Payment::where('id', $request->paymentid)
                       ->with('paymentdetail.fkperkhidmatan','paymentdetail.fkkodhasil','fkpaymentgateway','paymentdetail.fktroli.fkservice.servicemaindetail.category.fkcategory', 'paymentdetail.fkpayer')
                       ->first();

                       // dd($data->status);exit;

        return $data;
    }

    public function updatePayment($request)
    {
        if($request->status == '00')
        {
            //success
            $status = 1;
        }
        elseif($request->status == '09')
        {
            //pending
            $status = 2; //failed
        }
        elseif($request->status == '99')
        {
            //Pending for Authorization
            $status = 3; //pending
        }
        else
        {
            $status = 0;
        }

        $data = Payment::where('id',$request->paymentid)
                       ->first();

        $data->transaction_id = $request->txnId;
        $data->transaction_date = $request->txnTime;
        $data->status = $status;
        $data->save();

        $paymentdetail=PaymentDetail::where('fk_payment',$request->paymentid)
                                    ->get();

        foreach ($paymentdetail as $key => $value)
        {
            //update troli

            $troli=Troli::find(data_get($value,'fk_troli'));
            $troli->status=2;
            $troli->update();

            //update payer bill
            if(data_get($troli,'fk_payer_bill')!=null)
            {
                $payerbill=PayerBill::find(data_get($troli,'fk_payer_bill'));
                $payerbill->status=4;
                $payerbill->Save();
            }

            if($status == 1 )
            {
                $now = Carbon::now();
                $date = $now->format('y');

                $prefix = data_get($value, 'fkkodhasil.ptj.prefix');

                $currun = data_get($value, 'fkkodhasil.ptj.running_no');
                $new_rn = sprintf('%06d', $currun + '1');

                $resitno = $date.$prefix.$new_rn;
                $value->receipt_no = $resitno;
                $value->save();

                $ptj_id = data_get($value, 'fkkodhasil.ptj.id');

                $ptjcur = Ptj::where('id', $ptj_id)
                             ->first();

                $add_rn = $currun + '1';
                $ptjcur->running_no = $add_rn;
                $ptjcur->save();


            }
        }







    }

    public function updateBank($request)
    {

        $data = Payment::where('id',$request->paymentid)->first();
        $data->bank = $request->typebank;
        $data->save();
    }

    public function dataEmail($id)
    {
        // dd($id, 'dsadsasda');exit;
        $data = Payment::where('id', $id)
                       ->with('paymentdetail.fkperkhidmatan','paymentdetail.fkkodhasil','fkpaymentgateway','paymentdetail.fktroli.fkservice.servicemaindetail.category.fkcategory', 'paymentdetail.fkpayer')
                       ->first();

                       // dd($data->status);exit;

        return $data;
    }
    public function updatepaymentfpx($request)
    {

        if ($request->fpx_debitAuthCode == '00' && $request->fpx_debitAuthCode == '00')
        {
           $payment_status=1;
        }
        elseif ($request->fpx_debitAuthCode == '99')
        {
           $payment_status=3;
        }
        elseif ($request->fpx_debitAuthCode != '00' || $request->fpx_debitAuthCode != '' || $request->fpx_debitAuthCode != '99' )
        {
           $payment_status=2;
        }

        $transdate = date('Y-m-d H:i:s', strtotime($request->fpx_fpxTxnTime));

        $data = Payment::where('transaction_no',$request->fpx_sellerOrderNo)->first();
        $data->transaction_id=$request->fpx_fpxTxnId;
        $data->transaction_date=$transdate;
        $data->status = $payment_status;
        $data->save();

        $paymentdetail=PaymentDetail::where('fk_payment',$data->id)
                                    ->get();

        foreach ($paymentdetail as $key => $value)
        {
            //update troli

            $troli=Troli::find(data_get($value,'fk_troli'));
            $troli->status=2;
            $troli->update();

            //update payer bill
            if(data_get($troli,'fk_payer_bill')!=null)
            {
                $payerbill=PayerBill::find(data_get($troli,'fk_payer_bill'));
                $payerbill->status=4;
                $payerbill->Save();
            }

            if($payment_status == 1 )
            {
                $now = Carbon::now();
                $date = $now->format('y');

                $prefix = data_get($value, 'fkkodhasil.ptj.prefix');

                $currun = data_get($value, 'fkkodhasil.ptj.running_no');
                $new_rn = sprintf('%06d', $currun + '1');

                $resitno = $date.$prefix.$new_rn;
                $value->receipt_no = $resitno;
                $value->save();

                $ptj_id = data_get($value, 'fkkodhasil.ptj.id');

                $ptjcur = Ptj::where('id', $ptj_id)
                             ->first();

                $add_rn = $currun + '1';
                $ptjcur->running_no = $add_rn;
                $ptjcur->save();


            }
        }

        return $data->id;
    }











}
