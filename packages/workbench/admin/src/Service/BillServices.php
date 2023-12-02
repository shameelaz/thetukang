<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
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
use Workbench\Database\Model\Bill\Payer;
use Workbench\Database\Model\Bill\PayerAccount;
use Workbench\Database\Model\Bill\PayerBill;
use Workbench\Database\Model\Lkp\LkpState;

class BillServices
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

    // ------------------- Akaun ------------------- //

    public function agencyRole(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1)){

            $acc = PayerAccount::with('state','fkagency','fkptj')->get();

        }elseif(($roleid == 4)||($roleid == 5)){

            $acc = UserProfile::where('fk_users','=',$user)->first();

        }

        return $acc;

    }

    public function accList(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;


        if(($roleid == 2)||($roleid == 1))
        {
            $acc = PayerAccount::with('state','fkagency','fkptj')
                             ->get();

        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users','=',$user)->first();
            // dd($agency);
            $acc = PayerAccount::where('fk_ptj', $agency->fk_ptj)
                             ->with('fkptj')
                             ->get();
        }

        return $acc;
    }

    public function stateList(Request $request)
    {
        $state = LkpState::all();

        return $state;
    }

    public function accAdd(Request $request)
    {
        $acc = new PayerAccount();
        $acc->fk_agency = $request->fk_agency;
        $acc->fk_ptj = $request->fk_ptj;
        $acc->fk_kod_hasil = $request->fk_kod_hasil;
        $acc->name = $request->name;
        $acc->account_no = $request->account_no;
        $acc->identification_no = str_replace('-', '', $request->identification_no);
        $acc->address = $request->address;
        $acc->city = $request->city;
        $acc->state = $request->state;
        $acc->status = data_get($request,'status',1);
        $acc->save();

        // dd($acc);

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Akaun'));

    }

    public function accountResult(Request $request)
    {
        $acc = PayerAccount::where('id', $request->id)->first();

        return $acc;
    }

    public function accUpd(Request $request)
    {
        $acc = PayerAccount::where('id', $request->id)->first();
        $acc->name = $request->name;
        $acc->account_no = $request->account_no;
        $acc->identification_no = str_replace('-', '', $request->identification_no);
        $acc->address = $request->address;
        $acc->city = $request->city;
        $acc->state = $request->state;
        $acc->status = data_get($request,'status',1);
        $acc->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Akaun'));

    }

    public function getPayerAccount(Request $request)
    {
        $user = Auth::user()->id;
        $profile = Users::where('id',$user)->with('profile','role')->first();

        $kodhasil = KodHasil::where('id',$request->kodhasil)->where('fk_agency',$profile->profile->fk_agency)->where('fk_ptj',$profile->profile->fk_ptj)->first();

        $acc = PayerAccount::where('fk_kod_hasil',$request->kodhasil)->where('fk_ptj',$profile->profile->fk_ptj)->get();

        return $acc;
    }

    // ------------------- Pembayaran Bil ------------------- //

    public function bilList(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1))
        {
            $bil = PayerBill::with('payeraccount')->get();

        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $acc = UserProfile::where('fk_users','=',$user)->with('userPtj')->first();

            $bil = PayerBill::where('fk_ptj', $acc->fk_ptj)
                            ->with('payeraccount')
                            ->get();
        }

        return $bil;
    }

    public function bilAdd(Request $request)
    {
        $bill_dates = date('Y-m-d',strtotime($request->bill_date));
        $bill_end_dates = date('Y-m-d',strtotime($request->bill_end_date));

        $user = Auth::user()->id;
        $acc = UserProfile::where('fk_users','=',$user)->first();
        $kodhasil = KodHasil::with('agency','ptj')->where('id',$request->fk_kod_hasil)->first();
        $billexist = PayerBill::where('account_no','=', $request->account_no)
                              ->where('name','=', $request->name)
                              ->where('identification_no','=', $request->identification_no)
                              ->where('reference_no','=', $request->reference_no)
                              ->where('amount','=', $request->amount)
                              ->where('bill_detail','=', $request->bill_detail)
                              ->where('bill_date','=', $bill_dates)
                              ->where('bill_end_date','=', $bill_end_dates)
                            // //   ->where('catatan','=', $request->catatan)
                              ->where('status','=', $request->status)
                              ->where('fk_agency','=', $request->fk_agency)
                              ->where('fk_ptj','=', $request->fk_ptj)
                              ->where('fk_kod_hasil','=', $request->fk_kod_hasil)
                              ->count();

        if($billexist >= 1){
            return redirect('/ptj/bill/add/'.$request->fk_kod_hasil)->withWarning('Maklumat ini telah wujud');
        }else{
            $bill = new PayerBill;
            $bill->fk_agency = $acc->fk_agency;
            $bill->fk_ptj = $acc->fk_ptj;
            $bill->fk_kod_hasil = $kodhasil->id;
            $bill->account_no = $request->account_no;
            $bill->name = $request->name;
            $bill->identification_no = str_replace('-', '', $request->identification_no);
            $bill->reference_no = $request->reference_no;
            $bill->amount = $request->amount;
            $bill->bill_detail = $request->bill_detail;
            $bill->bill_end_date = date('Y-m-d',strtotime($request->bill_end_date));
            $bill->bill_date = date('Y-m-d',strtotime($request->bill_date));
            $bill->catatan = $request->catatan;
            $bill->status =  $request->status;
            $bill->save();
        }


        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Pembayaran (Bil)'));


        $check = PayerAccount::where('account_no',$request->account_no)->first();

        if($check){
            $upd = PayerBill::where('id',$bill->id)->first();
            $upd->fk_payer_account = $check->id;
            // $upd->fk_agency = $check->fk_agency;
            // $upd->fk_ptj = $check->fk_ptj;
            $upd->fk_kod_hasil = $kodhasil->id;
            $upd->save();
        }else{
            $add = new PayerAccount;
            $add->name = $request->name;
            $add->fk_agency = $request->fk_agency;
            $add->fk_ptj = $request->fk_ptj;
            $add->fk_kod_hasil = $request->fk_kod_hasil;
            $add->account_no = $request->account_no;
            $add->identification_no = str_replace('-', '', $request->identification_no);
            $add->status = data_get($request,'status',1);
            $add->save();


        }
    }

    public function bilResult(Request $request)
    {
        $bil = PayerBill::where('id', $request->id)->first();

        return $bil;
    }

    public function bilUpd(Request $request)
    {

        $bill = PayerBill::where('id', $request->id)->first();
        $bill->fk_kod_hasil = $request->fk_kod_hasil;
        $bill->account_no = $request->account_no;
        $bill->name = $request->name;
        $bill->identification_no = str_replace('-', '', $request->identification_no);
        $bill->reference_no = $request->reference_no;
        $bill->amount = $request->amount;
        $bill->bill_detail = $request->bill_detail;
        $bill->bill_end_date = date('Y-m-d',strtotime($request->bill_end_date));
        $bill->bill_date = date('Y-m-d',strtotime($request->bill_date));
        $bill->catatan = $request->catatan;
        $bill->status = $request->status;
        $bill->save();


        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Pembayaran (Bil)'));


        $check = PayerAccount::where('account_no',$request->account_no)->first();

        if($check){
            $upd = PayerBill::where('id',$bill->id)->first();
            $upd->fk_payer_account = $check->id;
            $upd->save();
        }else{
            $add = new PayerAccount;
            $add->name = $request->name;
            $add->fk_agency = $request->fk_agency;
            $add->fk_ptj = $request->fk_ptj;
            $add->fk_kod_hasil = $request->fk_kod_hasil;
            $add->account_no = $request->account_no;
            $add->identification_no = str_replace('-', '', $request->identification_no);
            $add->status = data_get($request,'status',1);
            $add->save();
        }

    }

    public function getPayerBill(Request $request)
    {
        $user = Auth::user()->id;
        $profile = Users::where('id',$user)->with('profile','role')->first();
        $kodhasil = KodHasil::where('id',$request->kodhasil)->where('fk_agency',$profile->profile->fk_agency)->where('fk_ptj',$profile->profile->fk_ptj)->first();

        $bill = PayerBill::where('fk_kod_hasil',$request->kodhasil)
                          ->where('fk_ptj',$profile->profile->fk_ptj)
                          ->groupBy(['fk_kod_hasil','account_no','name','identification_no','reference_no','amount','bill_detail','bill_date','bill_end_date','catatan','status'])
                          ->get();

        return $bill;
    }

    public function getKodHasil(Request $request)
    {
        $kodhasil = KodHasil::where('id',$request->kodhasil)->first();
        // dd($kodhasil);

        return $kodhasil;
    }

}
