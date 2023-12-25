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


class UsersServices
{

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


        if($profile){

            if($profile->user_type == 1){
                $profile->refid = $request->refid;
                $profile->mobile_no = $request->phone_no;

            }else{
                $profile->refid = $request->refid;
                $profile->mobile_no = $request->phone_no;
                $profile->ref_name = data_get($request,'refname');
            }
            $profile->save();

        }else{
            $newprofile = new UserProfile;
            $newprofile->fk_users = $request->userid;
            $newprofile->user_level = $request->userlevel;
            $newprofile->reftype = 1;
            $newprofile->refid = $request->refid;
            $newprofile->mobile_no = $request->phone_no;
            $newprofile->save();

        }

        event(new \Workbench\Database\Events\AuditTrail($request->userid,'Mengemaskini Profil Pengguna'));



    }


    // public function create(Request $request)
    // {

    //     $neworder = $this->mainorder();

    //     $newmenu = new Menus;
    //     $newmenu->name_bm = $request->title_ms;
    //     $newmenu->name_en = $request->title_en;
    //     $newmenu->permission = json_encode($request->permission);
    //     $newmenu->route = $request->url;
    //     $newmenu->status = 2;
    //     $newmenu->type = 2;
    //     $newmenu->order = $neworder+1;
    //     $newmenu->save();

    //     return redirect()->route('menum::menu.index')->withSuccess('Menu Baharu Ditambah');
    // }


    // public function update(Request $request)
    // {


    //     $newmenu = Menus::where('id',$request->mid)->first();
    //     $newmenu->name_bm = $request->title_ms;
    //     $newmenu->name_en = $request->title_en;
    //     $newmenu->permission = json_encode($request->permission);
    //     $newmenu->route = $request->url;
    //     $newmenu->update();

    //     return redirect()->route('menum::menu.index')->withSuccess('Menu Dikemaskini');
    // }



}
