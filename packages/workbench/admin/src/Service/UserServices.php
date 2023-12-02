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
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\Agency\Ptj;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Overdrive\Web\Model\Menus;
use Overdrive\Web\Model\Mpermission;
use Overdrive\Web\Model\ARole;
use Overdrive\Web\Model\Urole;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

use Session;
use App;
use Config;
use Auth;
use File;
use Redirect;
use Mail;
use Curl;
use DB;
use Workbench\Database\Model\Lkp\LkpPosition;

class UserServices
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
    public function awamList(Request $request)
    {
        $user = Users::join('acl_role_user','users.id','=','acl_role_user.user_id')
                    ->where('acl_role_user.role_id',7)
                    ->info()
                    ->get();
        return $user;

    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function userGet(Request $request)
    {
        $user = Users::join('acl_role_user','users.id','=','acl_role_user.user_id')
                    // ->where('acl_role_user.role_id',7)
                    ->where('users.id',$request->id)
                    ->select('users.*')
                    ->info()
                    ->first();

        return $user;

    }


    public function userUpdate(Request $request)
    {


        $user = Users::where('id',$request->id)->first();
        $user->name = $request->name;
        $user->status = data_get($request,'status',1);
        $user->save();


        $profile = UserProfile::where('fk_users',$request->id)->first();


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
            $newprofile->fk_users = $request->id;
            $newprofile->user_level = $request->userlevel;
            $newprofile->reftype = 1;
            $newprofile->refid = $request->refid;
            $newprofile->mobile_no = $request->phone_no;
            $newprofile->save();

        }

        event(new \Workbench\Database\Events\AuditTrail($request->id,'Mengemaskini Profil Pengguna'));
    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function agencyList(Request $request)
    {

        $role = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;

        if(($role == 2)||($role == 1))
        {

            $user = Users::join('acl_role_user','users.id','=','acl_role_user.user_id')
                    ->whereIn('acl_role_user.role_id',[4,5])
                    ->select('users.*')
                    ->info()
                    ->get();
        }
        elseif(($role == 4)|| ($role == 5))
        {
            //admin ptj
            $profile = UserProfile::where('fk_users',Auth::user()->id)->first();

            $user = Users::join('user_profile','user_profile.fk_users','=','users.id')
                    ->join('acl_role_user','users.id','=','acl_role_user.user_id')
                    ->whereIn('acl_role_user.role_id',[4,5])
                    ->where('user_profile.fk_agency',data_get($profile,'fk_agency'))
                    ->select('users.*')
                    ->info()
                    ->get();

        }
        else
        {

        }

        return $user;

    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function internalList(Request $request)
    {
        $user = Users::join('acl_role_user','users.id','=','acl_role_user.user_id')
                    ->whereIn('acl_role_user.role_id',[2,3,6])
                    ->info()
                    ->get();
        return $user;

    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function internalSave(Request $request)
    {
        $email = data_get($request,'email');
        $check = Users::where('email',$email)->first();

        if($check){
            return 0;
            // return redirect('/admin/user/agency/add')->withWarning('Sistem mendapati pengguna dengan email sudah wujud');
        }else{

            // $expired = date('Y-m-d',strtotime(data_get($request,'expired_date')));
            // $user = User::create(
            //     [
            //         'name' => strtoupper($request->name),
            //         'email' => $request->email,
            //         'status' => 0,
            //         'password'=>'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            //         'expired_date' => $expired

            //     ]
            // );
            $user = new Users;
            $user->name = strtoupper($request->name);
            $user->email = $request->email;
            $user->status = 0;
            $user->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
            // $user->expired_date = date('Y-m-d',strtotime(data_get($request,'expired_date')));
            $user->save();


            // 'email_verified_at' => date('Y-m-d h:i:s')

            $up = new UserProfile;
            $up->fk_users = $user->id;
            $up->user_level = $request->userlevel; //pengguna sistem
            $up->flag_ptj = $request->adminptj;
            $up->user_type = data_get($request,'seltype');
            $up->ref_type = data_get($request,'selrefid');
            $up->fk_agency = data_get($request,'agency');
            $up->fk_ptj = data_get($request,'ptj');
            $up->fk_position = data_get($request,'position');
            $up->ispek_role = data_get($request,'ispek');
            // $up->expired_date = date('Y-m-d',strtotime(data_get($request,'expired_date')));
            // $up->refid = data_get($request,'refid');
            // $up->ref_name = data_get($request,'refname');
            // $up->mobile_no = data_get($request,'phone_no');
            $up->save();

            //--- role
            $r  = new Urole;
            $r->role_id = $request->role;
            $r->user_id = $user->id;
            $r->save();


            $token = Str::random(64);

            DB::table('password_resets')->insert([
              'email' => $user->email,
              'token' => $token,
              'user_id'=> $user->id,
              'created_at' => Carbon::now()
            ]);


            Mail::send('web::email.user.newregister', ['token' => $token,'user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('The Tukang : PENGESAHAN EMEL PENDAFTARAN PENGGUNA');
            });

            event(new \Workbench\Database\Events\LogResetPassword($user->email,$user->name));

            // return redirect('/admin/user/agency')->withSuccess('Pengesahan Emel telah dihantar ke email pengguna '.$user->email.' .');
            return 1;

        }


    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function resetPassword(Request $request)
    {
        $user = Users::where('id',$request->id)->first();

        if($user){

            $token = Str::random(64);

            DB::table('password_resets')->insert([
              'email' => $user->email,
              'token' => $token,
              'user_id'=> $user->id,
              'created_at' => Carbon::now()
            ]);


            Mail::send('web::email.user.forgotpassword', ['token' => $token,'user' => $user], function($message) use($request,$user){
              $message->to($user->email);

              $message->subject('The Tukang Tukar Kata Laluan');
            });

            event(new \Workbench\Database\Events\LogResetPassword($user->email,$user->name));

            event(new \Workbench\Database\Events\AuditTrail($user->id,'Tetapan semula katalaluan'));

            return 1;




        }else{

            return 0;

        }
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function agencySel(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles['0']->id;

        if(($roleid == 2)||($roleid == 1)){
            $agency = Agency::where('status',1)->pluck('name','id');
        }elseif($roleid == 4){
            // $agency = Agency::join('user_profile','user_profile.fk_agency','=','agency.id')
            // ->join('users','users.id','=','user_profile.fk_users')
            // ->where('users.id',$user)
            // ->where('agency.status',1)
            // // ->select('agency.*')
            // ->select('agency.name','agency.id');
            $agency = Agency::where('status',1)->pluck('name','id');
        }

        return $agency;

    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function ptjSel(Request $request)
    {
        $ptj = Ptj::where('status',1)->pluck('name','id');
        return $ptj;
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function roleSel(Request $request)
    {
        $role  = ARole::whereNotIn('id',[1])->pluck('name','id');
        return $role;
    }

    public function roleNotPtj(Request $request)
    {
        $role  = ARole::whereNotIn('id',[1, 4, 5])->pluck('name','id');
        return $role;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function positionSel(Request $request)
    {
        $position  = LkpPosition::where('status',1)->pluck('description','id');
        return $position;
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function roleAgency(Request $request)
    {
        $role = ARole::whereIn('id',[4,5])->pluck('name','id');
        return $role;
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function getptjlist(Request $request)
    {

        $ptj = Ptj::where('status',1)->where('fk_agency',$request->id)->pluck('name','id');
        return $ptj;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function agencySave(Request $request)
    {
        $email = data_get($request,'email');
        $check = Users::where('email',$email)->first();

        if($check){
            return 0;
            // return redirect('/admin/user/agency/add')->withWarning('Sistem mendapati pengguna dengan email sudah wujud');
        }else{


            // dd(date('Y-m-d',strtotime(data_get($request,'expired_date'))));
            // dd(date('Y-m-d',$request->expired_date));




            $user = new Users;
            $user->name = strtoupper($request->name);
            $user->email = $request->email;
            $user->status = 1;
            $user->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
            // $user->expired_date = date('Y-m-d',strtotime(data_get($request,'expired_date')));
            $user->save();




            // 'email_verified_at' => date('Y-m-d h:i:s')

            $up = new UserProfile;
            $up->fk_users = $user->id;
            $up->user_level = $request->userlevel; //pengguna sistem
            $up->flag_ptj = $request->adminptj;
            $up->user_type = data_get($request,'seltype');
            $up->ref_type = data_get($request,'selrefid');
            $up->fk_agency = data_get($request,'agency');
            $up->fk_ptj = data_get($request,'ptj');
            $up->fk_position = data_get($request,'position');
            $up->ispek_role = data_get($request,'ispek');
            // $up->expired_date = date('Y-m-d',strtotime(data_get($request,'expired_date')));
            // $up->refid = data_get($request,'refid');
            // $up->ref_name = data_get($request,'refname');
            // $up->mobile_no = data_get($request,'phone_no');
            $up->save();


            //--- role
            $r  = new Urole;
            $r->role_id = $request->role;
            $r->user_id = $user->id;
            $r->save();


            $token = Str::random(64);

            DB::table('password_resets')->insert([
              'email' => $user->email,
              'token' => $token,
              'user_id'=> $user->id,
              'created_at' => Carbon::now()
            ]);


            Mail::send('web::email.user.newregister', ['token' => $token,'user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('The Tukang : PENGESAHAN EMEL PENDAFTARAN PENGGUNA');
            });

            event(new \Workbench\Database\Events\LogResetPassword($user->email,$user->name));

            event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Pengguna Agensi/PTJ'));

            // return redirect('/admin/user/agency')->withSuccess('Pengesahan Emel telah dihantar ke email pengguna '.$user->email.' .');
            return 1;



        }


    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function agencyUpdate(Request $request)
    {
        // dump($request);

        $user = User::where('id',$request->id)->first();

        $user->name = data_get($request,'name');
        // $user->expired_date = date('Y-m-d',strtotime(data_get($request,'expired_date')));
        $user->status = data_get($request,'status');
        $user->save();
        // dd($user);

        $role = AclRoleUser::where('user_id',$request->id)->update(['role_id' => data_get($request,'role')]);


        $profile = UserProfile::where('fk_users',$request->id)->first();
        $profile->flag_ptj = data_get($request,'adminptj');
        $profile->fk_agency = data_get($request,'agency');
        $profile->fk_ptj = data_get($request,'ptj');
        $profile->fk_position = data_get($request,'position');
        $profile->ispek_role = data_get($request,'ispek');
        $profile->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Profil Pengguna Agensi/PTJ '));
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function internalUpd(Request $request)
    {
        // dd($request);

        $user = User::where('id',$request->id)->first();

        $user->name = data_get($request,'name');
        // $user->expired_date = date('Y-m-d',strtotime(data_get($request,'expired_date')));
        $user->status = data_get($request,'status');
        $user->save();


        $role = AclRoleUser::where('user_id',$request->id)->update(['role_id' => data_get($request,'role')]);


        $profile = UserProfile::where('fk_users',$request->id)->first();
        $profile->ispek_role = data_get($request,'ispek');
        $profile->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Profil Pengguna Dalaman'));
    }

    public function userProfile(Request $request)
    {
        $user = Auth::user()->id;
        $profile = Users::where('id',$user)->with('profile','role')->first();
        return $profile;
    }











}
