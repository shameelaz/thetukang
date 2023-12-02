<?php

namespace Overdrive\Web\Service;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use Mail;
use Curl;
use Overdrive\Web\Model\Menus;
use Overdrive\Web\Model\Mpermission;
use Overdrive\Web\Model\ARole;
use Overdrive\Web\Model\Urole;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\AclRoleUser;
use Workbench\Database\Model\User\APermission;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\UserRoles;
use Session;
use App;
use Config;
use Auth;


class AuditServices 
{


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function lastlogin(Request $request)
    {
        $user = Auth::user()->id;
        $data = Users::where('id',$user)->first();
        $data->last_login = Carbon::now();
        $data->save();
    }
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function profile(Request $request)
    {
        $user = Auth::user()->id;
        $profile = Users::where('id',$user)->with('profile','role.name')->first();
        return $profile;

    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function update(Request $request)
    {
        
        $user = Users::where('id',$request->userid)->first();
        $user->name = $request->name;
        $user->save();


        $profile = UserProfile::where('fk_users',$request->userid)->first();

        if($profile->user_type == 1){
            $profile->refid = $request->refid;
            $profile->mobile_no = $request->phone_no;

        }else{
            $profile->refid = $request->refid;
            $profile->mobile_no = $request->phone_no;
            $profile->ref_name = data_get($request,'refname');
        }
        $profile->save();

    }


    

    

}
