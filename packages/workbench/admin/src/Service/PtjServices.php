<?php

namespace Workbench\Admin\Service;

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
use Workbench\Database\Model\Lkp\LkpBank;
use Workbench\Database\Model\Lkp\LkpPtj;
use Workbench\Database\Model\Payment\MerchantSetup;

class PtjServices
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

    // ------------------- PTJ ------------------- //

    public function pusatList(Request $request)
    {
        $ptj = Ptj::with('agency')
                    ->get();

        return $ptj;
    }

    public function adminptjList(Request $request)
    {
        // dd($request);
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 3)||($roleid == 2)||($roleid == 1))
        {
            if($request->agencyid)
            {
                $ptj = Ptj::with('agency')->where('fk_agency',$request->agency)->where('status',1)->get();
            }
            else
            {
                $ptj = Ptj::where('status',1)->get();
            }
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            // dd($agency);exit;
            $ptj = Ptj::where('fk_agency', $agency->agency)
                      ->get();
        }

        return $ptj;
    }

    public function listing(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 3)||($roleid == 2)||($roleid == 1))
        {
            $ptj = Ptj::get();
                    //   dd($ptj);
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            // dd($agency);exit;
            $ptj = Ptj::where('fk_agency', $agency->fk_agency)
                      ->get();
        }

        return $ptj;
    }




    // ------------------- Agensi/PTJ ------------------- //

    public function pusatagensiList(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $ptj = Ptj::with('agency')
                      ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            // dd($agency);exit;
            $ptj = Ptj::where('fk_agency', $agency->fk_agency)
                      ->get();
        }

        return $ptj;
    }

    public function pusatagensiAdd(Request $request)
    {
        $kod = LkpPtj::where('id',$request->ptj)->first();
        $lkpbank = LkpBank::where('id',$request->lkp_bank)->first();

        $ptj = new Ptj;
        $ptj->fk_agency = $request->agency;
        $ptj->name = $kod->ptj_name;
        $ptj->code = $request->ptj_code;
        $ptj->prefix = $request->ptj_prefix;
        $ptj->seller_id = $request->seller_id;
        $ptj->running_no = 0;
        $ptj->status = data_get($request,'status',1);
        $ptj->save();

        $merchant = new MerchantSetup();
        $merchant->fk_agency = $request->agency;
        $merchant->fk_ptj = $ptj->id;
        $merchant->fk_lkp_bank = $lkpbank->id;
        $merchant->bank_name = $lkpbank->bank_name;
        $merchant->bank_swift_code = $request->bank_swift_code;
        $merchant->bank_account_no = $request->bank_account_no;
        $merchant->seller_id = $request->seller_id;
        $merchant->exchange_id = $request->exchange_id;
        $merchant->merchant_id = $request->merchant_id;
        $merchant->save();
    }

    public function pusatagensiShow(Request $request)
    {
        $ptj = Ptj::where('id', $request->ptjid)->first();

        return $ptj;
    }

    public function pusatagensiUpd(Request $request)
    {
        // dd($request);
        $kod = LkpPtj::where('id',$request->ptj)->first();
        $lkpbank = LkpBank::where('id',$request->lkp_bank)->first();

        // dd($request);
        $ptj = Ptj::where('id',$request->id)->first();
        // $ptj->fk_agency = $request->fk_agency;
        $ptj->name = $kod->ptj_name;
        $ptj->code = $request->code;
        $ptj->prefix = $request->prefix;
        $ptj->seller_id = $request->seller_id;
        $ptj->status = data_get($request,'status',1);
        // dd($ptj);
        $ptj->update();

        $merchant = MerchantSetup::where('fk_ptj',$request->id)->first();
        // dd($merchant);
        // $merchant->fk_agency = $request->agency;
        $merchant->fk_ptj = $ptj->id;
        $merchant->fk_lkp_bank = $lkpbank->id;
        $merchant->bank_name = $lkpbank->bank_name;
        $merchant->bank_swift_code = $request->bank_swift_code;
        $merchant->bank_account_no = $request->bank_account_no;
        $merchant->seller_id = $request->seller_id;
        $merchant->exchange_id = $request->exchange_id;
        $merchant->merchant_id = $request->merchant_id;
        // dd($merchant);

        $merchant->update();
    }

    public function userList(Request $request)
    {
        $user = Auth::user()->id;

        $profile = UserProfile::with('userPtj')
                              ->where('fk_users', $user)
                              ->first();

        return $profile;

    }

    public function ptjSelect(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;


        $lkpptj = LkpPtj::with('agency')
                        ->get();

        return $lkpptj;

    }

    public function getlkpptjlist(Request $request)
    {

        $ptj = LkpPtj::where('fk_agency',$request->id)->get();

        return $ptj;
    }

    public function getkodSel(Request $request)
    {
        $kod = LkpPtj::where('id',$request->id)->first();

        return $kod;
    }

    public function getbank(Request $request)
    {
        $bank = LkpBank::get();

        return $bank;
    }

    public function getMerchant(Request $request)
    {
        $merchant = MerchantSetup::where('fk_ptj',$request->ptjid)->first();

        return $merchant;
    }

    public function getPtjList(Request $request)
    {
        $ptj = Ptj::where('id', $request->ptjid)->first();

        $lkpptj = LkpPtj::where('fk_agency', $ptj->fk_agency)->get();

        return $lkpptj;
    }

    public function getbankSel(Request $request)
    {
        $bank = LkpBank::where('id',$request->id)->first();

        return $bank;
    }

    public function getbankSelId(Request $request)
    {
        $merchant = MerchantSetup::where('fk_ptj', $request->ptjid)->first();
        // dd($merchant);exit;

        $lkpbank = LkpBank::where('id', $merchant->fk_lkp_bank)->first();

        return $lkpbank;
    }



}
