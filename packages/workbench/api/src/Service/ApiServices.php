<?php

namespace Workbench\Api\Service;

use Illuminate\Routing\Controller;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\AclRoleUser;
use Workbench\Database\Model\User\APermission;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\UserRoles;
use Workbench\Database\Model\Base\BaseInfo;
use Workbench\Database\Model\Base\HubungiKami;
use Workbench\Database\Model\Survey\SurveyForm;
use Workbench\Database\Model\Agency\AgService;
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
use Workbench\Database\Model\Bill\Payer;
use Workbench\Database\Model\Bill\PayerAccount;
use Workbench\Database\Model\Bill\PayerBill;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\PaymentDetail;

class ApiServices
{




    public function validate(Request $request)
    {

        $data = AgService::where('userid',$request->userid)->where('token',$request->token)->first();

        return $data;
    }

    public function upload(Request $request)
    {
        $result = 0;

        // check bila ada data yang sama ke tidak
        $check_name = $request->name;
        $check_account_no = $request->account_no;
        $check_ic = str_replace('-', '', $request->identification_no);
        $check_reference = $request->reference_no;
        $check_amount = $request->amount;
        $check_bill_detail = $request->bill_detail;
        $check_bill_date = date('Y-m-d',strtotime($request->bill_date));
        $check_bill_end_date = date('Y-m-d',strtotime($request->bill_end_date));
        $check_status = $request->status;

        $payerbill = PayerBill::where('name',$check_name)
                                ->where('account_no',$check_account_no)
                                ->where('identification_no',$check_ic)
                                ->where('reference_no',$check_reference)
                                ->where('amount',$check_amount)
                                ->where('bill_detail',$check_bill_detail)
                                ->where('bill_date',$check_bill_date)
                                ->where('bill_end_date',$check_bill_end_date)
                                ->where('status',$check_status)
                                ->first();

        if(!$payerbill){
            $agservice = $this->validate($request);

            $bill = new PayerBill;
            $bill->fk_agency = data_get($agservice,'fk_agency');
            $bill->fk_ptj = data_get($agservice,'fk_ptj');
            $bill->fk_kod_hasil = data_get($agservice,'fk_kod_hasil');
            $bill->account_no = $request->account_no; // account_no
            $bill->name = $request->name; // name
            $bill->identification_no = str_replace('-', '', $request->identification_no); // identification_no
            $bill->reference_no = $request->reference_no; // reference_no
            $bill->amount = $request->amount; //amount
            $bill->bill_detail = $request->bill_detail; //bill_detail
            $bill->bill_end_date = date('Y-m-d',strtotime($request->bill_end_date)); //bill_end_date
            $bill->bill_date = date('Y-m-d',strtotime($request->bill_date)); //bill_date
            $bill->status = data_get($request,'status'); //1-aktif
            $bill->save();

            event(new \Workbench\Database\Events\AuditTrail(1,'Menambah Maklumat Pengurusan Pembayaran (Bil) melalui RestAPI'));

            $check = PayerAccount::where('account_no',$request->account_no)->first();

            if($check){
                $upd = PayerBill::where('id',$bill->id)->first();
                $upd->fk_payer_account = $check->id;
                $upd->fk_agency = $check->fk_agency;
                $upd->fk_ptj = $check->fk_ptj;
                $upd->fk_kod_hasil = $check->id;
                $upd->save();
            }else{
                $add = new PayerAccount;
                $add->name = $request->name;
                $add->fk_agency = data_get($agservice,'fk_agency');
                $add->fk_ptj = data_get($agservice,'fk_ptj');
                $add->fk_kod_hasil = data_get($agservice,'fk_kod_hasil');
                $add->account_no = $request->account_no;
                $add->identification_no = str_replace('-', '', $request->identification_no);
                $add->status = data_get($request,'status',1);
                $add->save();
            }

            $result = 1;
        }

        return $result;
    }

    public function account(Request $request)
    {
        $result = 0;

        // check bila ada data yang sama ke tidak
        $check_name = $request->name;
        $check_account_no = $request->account_no;
        $check_ic = str_replace('-', '', $request->identification_no);
        $check_address = $request->address;
        $check_city = $request->city;
        $check_state = $request->state;
        $check_status = $request->status;

        $payeraccount = PayerAccount::where('name',$check_name)
                                ->where('account_no',$check_account_no)
                                ->where('identification_no',$check_ic)
                                ->where('address',$check_address)
                                ->where('city',$check_city)
                                ->where('state',$check_state)
                                ->where('status',$check_status)
                                ->first();

        if(!$payeraccount){

            $agservice = $this->validate($request);

            $acc = new PayerAccount();
            $acc->fk_agency = data_get($agservice,'fk_agency');
            $acc->fk_ptj = data_get($agservice,'fk_ptj');
            $acc->fk_kod_hasil = data_get($agservice,'fk_kod_hasil');
            $acc->name = $request->name; // name
            $acc->account_no = $request->account_no; // account_no
            $acc->identification_no = str_replace('-', '', $request->identification_no); // identification_no
            $acc->address = $request->address; // address
            $acc->city = $request->city; // city
            $acc->state = $request->state; // state
            $acc->status = data_get($request,'status',1); //1-aktif
            $acc->save();

            event(new \Workbench\Database\Events\AuditTrail($this->validate($request)->id,'Menambah Maklumat Pengurusan Akaun melalui RestAPI'));

            $result = 1;
        }

        return $result;

    }

    public function payerandbill(Request $request)
    {
        $result = 0;

        // check bila ada data yang sama ke tidak
        $check_name = $request->name;
        $check_no_tel = $request->no_tel;
        $check_email = $request->email;
        $check_ic = str_replace('-', '', $request->identification_no);
        $check_address = $request->address;
        $check_city = $request->city;
        $check_state = $request->state;
        $check_status = $request->status;

        $bcheck_name = $request->name;
        $bcheck_ic = str_replace('-', '', $request->identification_no);
        $bcheck_reference = $request->reference_no;
        $bcheck_amount = $request->amount;
        $bcheck_bill_detail = $request->bill_detail;
        $bcheck_bill_date = date('Y-m-d',strtotime($request->bill_date));
        $bcheck_bill_end_date = date('Y-m-d',strtotime($request->bill_end_date));


        $payer = Payer::where('name',$check_name)
                            ->where('no_tel',$check_no_tel)
                            ->where('email',$check_email)
                            ->where('address',$check_address)
                            ->where('city',$check_city)
                            ->where('state',$check_state)
                            ->where('identification_no',$check_ic)
                            ->where('status',$check_status)
                            ->first();

        $payerbill = PayerBill::where('name',$bcheck_name)
                            ->where('reference_no',$bcheck_reference)
                            ->where('identification_no',$bcheck_ic)
                            ->where('amount',$bcheck_amount)
                            ->where('bill_detail',$bcheck_bill_detail)
                            ->where('bill_date',$bcheck_bill_date)
                            ->where('bill_end_date',$bcheck_bill_end_date)
                            ->first();

        if(!$payer){

            $agservice = $this->validate($request);

            $pyr = new Payer();
            $pyr->fk_agency = data_get($agservice,'fk_agency');
            $pyr->fk_ptj = data_get($agservice,'fk_ptj');
            $pyr->name = $request->name; // name
            $pyr->email = $request->email; // email
            $pyr->no_tel = $request->no_tel; // no_tel
            $pyr->account_no = $request->account_no; // account_no
            $pyr->identification_no = str_replace('-', '', $request->identification_no); // identification_no
            $pyr->address = $request->address; // address
            $pyr->city = $request->city; // city
            $pyr->state = $request->state; // state
            $pyr->status = data_get($request,'status',1); //1-aktif
            $pyr->save();

            event(new \Workbench\Database\Events\AuditTrail($this->validate($request)->id,'Menambah Maklumat Pengurusan Akaun melalui RestAPI'));

            $result = 1;

        }

        if(!$payerbill){

            $agservice = $this->validate($request);

            $bill = new PayerBill;
            $bill->fk_agency = data_get($agservice,'fk_agency');
            $bill->fk_ptj = data_get($agservice,'fk_ptj');
            $bill->fk_kod_hasil = data_get($agservice,'fk_kod_hasil');
            $bill->account_no = $request->account_no; // account_no
            $bill->name = $request->name; // name
            $bill->identification_no = str_replace('-', '', $request->identification_no); // identification_no
            $bill->reference_no = $request->reference_no; // reference_no
            $bill->amount = $request->amount; //amount
            $bill->bill_detail = $request->bill_detail; //bill_detail
            $bill->bill_end_date = date('Y-m-d',strtotime($request->bill_end_date)); //bill_end_date
            $bill->bill_date = date('Y-m-d',strtotime($request->bill_date)); //bill_date
            $bill->status = data_get($request,'status'); //1-aktif
            $bill->save();

            event(new \Workbench\Database\Events\AuditTrail($this->validate($request)->id,'Menambah Maklumat Pengurusan Pembayaran (Bil) melalui RestAPI'));

            $result = 1;

        }

        return $result;

    }


    public function statusBayaran($request)
    {
        $status = 0;

        $payment = PaymentDetail::with('fktroli.fkpayer','fktroli.fkpayerbill')
                                ->whereNotNull('reference_no')
                                ->whereHas('fkpayment', function ($query)
                                {
                                    $query->where('status', '1');
                                })
                                ->first();

        $reference_no = $request->reference_no;
        $ic = $request->identification_no;

        if($reference_no != null || $reference_no != '')
        {
            $payment->where('reference_no',$reference_no);
        }

        if($ic != null || $ic != '')
        {
            $payment->whereHas('fktroli.fkpayer', function ($query) use ($ic)
            {
                $query->where('identification_no', $ic);
            });
        }


        $exec = $payment->get();

        foreach($exec as $key => $value){

            $filter = $value->fktroli->fk_payer_bill;

            if($filter)
            {
                // payer bill - ni form untuk bil
                $sd = [
                    'account_no'    => data_get($value, 'fktroli.fkpayerbill.account_no'),
                    'reference_no'  => data_get($value, 'reference_no'),
                    'transaction_date'  => data_get($value, 'fkpayment.transaction_date'),
                    'receipt_no'        => data_get($value, 'receipt_no'),
                    'payment_status'    => 1,
                ];

            }
            else
            {
                // payer - ni form untuk tiket n hasil
                $sd = [
                    'name'          => data_get($value, 'fktroli.fkpayer.name'),
                    'identification_no' => data_get($value, 'fktroli.fkpayer.identification_no'),
                    'reference_no'  => data_get($value, 'reference_no'),
                    'transaction_date'  => data_get($value, 'fkpayment.transaction_date'),
                    'receipt_no'        => data_get($value, 'receipt_no'),
                    'payment_status'    => 1,
                ];


            }

            // $status[$key] = $sd;

        }

        return $sd;
    }


}
