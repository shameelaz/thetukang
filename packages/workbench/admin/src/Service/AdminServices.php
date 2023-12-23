<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
use Workbench\Database\Model\Agency\LkpRating;
use Workbench\Database\Model\Agency\LkpServiceType;
use Workbench\Database\Model\User\AclRoleUser;
use Workbench\Database\Model\User\ARole;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\Users;

class AdminServices
{
    // ------------------- Lookup Users ------------------- //
    public function ursList(Request $request)
    {
        $user           = Auth::user()->id;
        
        $urs            = Users::with('profile','aclroleuser.arole')->get();
        
        return $urs;
    }

    public function ursAdd(Request $request)
    {
        $user                           = Auth::user()->id;

        $urs                            = new Users();
        $urs->name                      = $request->name;
        $urs->desc                      = $request->desc;
        $urs->status                    = $request->status;
        $urs->save();

    }

    public function ursView(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;
       
        $urs = Users::with('profile','aclroleuser.arole')->where('id', $request->id)->first();
        
        return $urs;
    }


    public function ursUpd(Request $request)
    {
        $urs                            = Users::with('profile','aclroleuser.arole')->where('id', $request->id)->first();
        $urs->name                      = $request->name;
        $urs->email                     = $request->email;
        $urs->status                    = $request->status;
        $urs->aclroleuser->role_id      = $request->role_id;
        $urs->save();

        $profile                        = UserProfile::where('fk_users', $urs->id)->first();
        $profile->mobile_no             = $request->mobile_no;
        $profile->save();
        
        // $role                           = AclRoleUser::where('user_id', $urs->id)->first();
        // $role->role_id                  = $request->role_id;
        // $role->save();

    }

    public function ursDelete(Request $request)
    {
        $urs                            = Users::with('profile','aclroleuser.arole')->where('id', $request->id)->first();
        $urs->delete();

    }

    // ------------------- Lookup Service Type ------------------- //
    public function srvtypeList(Request $request)
    {
        $user           = Auth::user()->id;

        $srvtype        = LkpServiceType::get();
        
        return $srvtype;
    }

    public function srvtypeAdd(Request $request)
    {
        $user                               = Auth::user()->id;

        $srvtype                            = new LkpServiceType();
        $srvtype->name                      = $request->name;
        $srvtype->desc                      = $request->desc;
        $srvtype->status                    = $request->status;
        $srvtype->save();

    }

    public function srvtypeView(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

       
        $srvtype = LkpServiceType::where('id', $request->id)->first();

        return $srvtype;
    }


    public function srvtypeUpd(Request $request)
    {
        $srvtype                            = LkpServiceType::where('id', $request->id)->first();
        $srvtype->name                      = $request->name;
        $srvtype->desc                      = $request->desc;
        $srvtype->status                    = $request->status;
        $srvtype->save();

    }

    public function srvtypeDelete(Request $request)
    {
        $srvtype                            = LkpServiceType::where('id', $request->id)->first();
        $srvtype->delete();

    }

    // ------------------- Lookup Rating ------------------- //
    public function rateList(Request $request)
    {
        $user           = Auth::user()->id;

        $rate           = LkpRating::get();
        
        return $rate;
    }

    public function rateAdd(Request $request)
    {
        $user                            = Auth::user()->id;

        $rate                            = new LkpRating();
        $rate->desc                      = $request->desc;
        $rate->rate                      = $request->rate;
        $rate->status                    = $request->status;
        $rate->save();

    }

    public function rateView(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

       
        $rate = LkpRating::where('id', $request->id)->first();

        return $rate;
    }


    public function rateUpd(Request $request)
    {
        $rate                            = LkpRating::where('id', $request->id)->first();
        $rate->desc                      = $request->desc;
        $rate->rate                      = $request->rate;
        $rate->status                    = $request->status;
        $rate->save();

    }

    public function rateDelete(Request $request)
    {
        $rate                            = LkpRating::where('id', $request->id)->first();
        $rate->delete();

    }
  
}
