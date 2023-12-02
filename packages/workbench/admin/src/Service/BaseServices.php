<?php

namespace Workbench\Admin\Service;

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
use Workbench\Database\Model\Base\BaseInfo;
use Workbench\Database\Model\Base\HubungiKami;
use Workbench\Database\Model\Base\Logo;
use Workbench\Database\Model\Feedback\FeedbackForm;
use Workbench\Database\Model\Banner\Pengumuman;
use Session;
use App;
use Config;
use Auth;
use Dflydev\DotAccessData\Data;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\Lkp\Faq;

class BaseServices
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
    public function getBase(Request $request)
    {
        $base = BaseInfo::first();
        return $base;
    }

    public function updBase(Request $request)
    {
        $base = BaseInfo::first();

        $base->abbr = data_get($request,'abbr');
        $base->name = data_get($request,'name');
        $base->desc = data_get($request,'desc');
        $base->contact = data_get($request,'contact');
        $base->footer = data_get($request,'footer');
        $base->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Sistem'));
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

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Profil Pengguna'));

    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function hubungi(Request $request)
    {
        $hubungi = HubungiKami::firstOrCreate(
            ['id' => 1]
        );

        return $hubungi;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function updateHubungi(Request $request)
    {
        $data = HubungiKami::find($request->id);

        $data->nama = $request->name;
        $data->alamat = $request->alamat;
        $data->phone_no = $request->phone_no;
        $data->faks = $request->faks_no;
        $data->emel = $request->emel;
        $data->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Tetapan Hubungi Kami'));
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
    public function logo(Request $request)
    {
        // $logo = Logo::firstorCreate(
        //     ['logo_negeri' =>  NULL],
        //     ['logo_sistem' => NULL],
        //     ['status' => 1]
        // );

        $logo = Logo::where('id',1)->first();

        return $logo;
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
    public function updlogo(Request $request)
    {
        // dd($request->logo_negeri);
        if($request->logo_negeri){

            $files=$request->logo_negeri;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/logo')) {

                mkdir(public_path()."/uploads/base/logo");
            }

            $path = public_path()."/uploads/base/logo/";


            $filename= $files->getClientOriginalName();
            $fullpath = "/uploads/base/logo/".$filename;
            $extension = $files->getClientOriginalExtension();


            $files->move($path, $files->getClientOriginalName());

            $logo = Logo::where('id',1)->first();
            $logo->logo_negeri = $fullpath;
            $logo->save();

            event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Logo Negeri'));


        }

        if($request->logo_sistem){

            $fail=$request->logo_sistem;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/logo')) {

                mkdir(public_path()."/uploads/base/logo");
            }

            $path = public_path()."/uploads/base/logo/";

            $filename2= $fail->getClientOriginalName();
            $fullpath2 = "/uploads/base/logo/".$filename2;
            $extension = $fail->getClientOriginalExtension();



            $fail->move($path, $fail->getClientOriginalName());

            $logo = Logo::where('id',1)->first();
            $logo->logo_sistem = $fullpath2;
            $logo->save();

            event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Logo Sistem'));

        }
    }



    public function feedback(Request $request)
    {
        // dd($request);
        $feedback = new FeedbackForm;
        $feedback->fk_agency = $request->agency;
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->subject = $request->subject;
        $feedback->message = $request->message;
        $feedback->save();

        $agency = Agency::where('id',$request->agency)->first();

        $emailagensi = data_get($agency,'email');



        Mail::send('admin::public.maklumbalas.email', ['feedback' => $feedback], function($message) use($request,$feedback,$emailagensi){
            $message->to($emailagensi);
            $message->subject('The Tukang Maklum Balas Pelanggan');
          });

    }

    public function bannerList(Request $request)
    {
        $banner = Pengumuman::orderBy('order','ASC')
                            ->get();
        return $banner;
    }

    public function bannerView(Request $request)
    {
        $now = Carbon::now();

        $banner = Pengumuman::where('status',1)
                            ->whereDate('tarikh_mula','<=', $now)
                            ->whereDate('tarikh_tamat','>=', $now)
                            ->orderBy('order','ASC')
                            ->get();
        return $banner;
    }

    public function bannerSave(Request $request)
    {
        if($request->banner){

            $files=$request->banner;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/banner')) {

                mkdir(public_path()."/uploads/base/banner");
            }

            $path = public_path()."/uploads/base/banner/";


            $filename= $files->getClientOriginalName();
            $fullpath = "/uploads/base/banner/".$filename;
            $extension = $files->getClientOriginalExtension();


            $files->move($path, $files->getClientOriginalName());

            $banner = new Pengumuman;
            $banner->fk_user = Auth::user()->id;
            $banner->tajuk = data_get($request,'tajuk');
            $banner->penerangan = data_get($request,'message');
            $banner->url = data_get($request,'url');
            $banner->image = $fullpath;
            $banner->tarikh_mula = date('Y-m-d',strtotime($request->date_start));
            $banner->tarikh_tamat = date('Y-m-d',strtotime($request->date_end));
            $banner->status = 1;
            $banner->order = data_get($request,'order');
            $banner->save();

            event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Banner Pengumuman Baru'));


        }
    }

    public function bannerShow($request)
    {
        $banner = Pengumuman::where('id',$request->id)->with('user')->first();
        return $banner;

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
    public function bannerUpdData(Request $request)
    {

        $banner = Pengumuman::where('id',$request->id)->first();

        $banner->tajuk = $request->tajuk;
        $banner->penerangan = $request->message;
        $banner->url = $request->url;
        $banner->tarikh_mula = date('Y-m-d',strtotime($request->date_start));
        $banner->tarikh_tamat = date('Y-m-d',strtotime($request->date_end));
        $banner->status = $request->status;
        $banner->order = $request->order;
        $banner->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Banner / Pengumuman '));
    }

    public function bannerUpdImg(Request $request)
    {
        if($request->banner){

            $files=$request->banner;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/banner')) {

                mkdir(public_path()."/uploads/base/banner");
            }

            $path = public_path()."/uploads/base/banner/";


            $filename= $files->getClientOriginalName();
            $fullpath = "/uploads/base/banner/".$filename;
            $extension = $files->getClientOriginalExtension();


            $files->move($path, $files->getClientOriginalName());

            $banner = Pengumuman::where('id',$request->id)->first();
            $banner->fk_user = Auth::user()->id;
            $banner->tajuk = data_get($request,'tajuk');
            $banner->penerangan = data_get($request,'message');
            $banner->url = data_get($request,'url');
            $banner->image = $fullpath;
            $banner->tarikh_mula = date('Y-m-d',strtotime($request->date_start));
            $banner->tarikh_tamat = date('Y-m-d',strtotime($request->date_end));
            $banner->status = 1;
            $banner->order = data_get($request,'order');
            $banner->save();

            event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Banner / Pengumuman'));


        }
    }

    public function order(Request $request)
    {
        $banner = Pengumuman::where('id',$request->id)->first();

        $current = data_get($banner,'order');

        if($request->type == 1)
        {
            //atas
            $neworder = $current-1;

        }
        else
        {
            //bawawh
            $neworder = $current+1;
        }

        $oldbanner = Pengumuman::where('order',$neworder)->first();
        $oldbanner->order = $current;
        $oldbanner->update();

        $banner->order = $neworder;
        $banner->update();

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
    public function faqList(Request $request)
    {
        return $faq = Faq::with('fkagency')->get();
    }


    /**
     *
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function faqGet(Request $request)
    {
        return Faq::where('fk_agency',$request->id)->get();
    }

    public function save(Request $request)
    {
        // dd($request);
        $faq = new Faq;
        $faq->fk_agency = $request->fk_agency;
        $faq->fk_perkhidmatan = data_get($request,'fk_perkhidmatan');
        $faq->soalan_ms = data_get($request,'soalan_ms');
        $faq->jawapan_ms = data_get($request,'jawapan_ms');
        $faq->status = data_get($request,'status',1);
        $faq->save();
    }

    public function faqUpd(Request $request)
    {
        // dd($request);
        $faq = Faq::where('fk_agency',$request->fk_agency)->where('id',$request->id)->first();
        // $faq->fk_agency = $request->fk_agency;
        $faq->fk_perkhidmatan = data_get($request,'fk_perkhidmatan');
        $faq->soalan_ms = data_get($request,'soalan_ms');
        $faq->jawapan_ms = data_get($request,'jawapan_ms');
        $faq->status = data_get($request,'status');
        $faq->save();
    }

    public function faqShow(Request $request)
    {
        return Faq::where('id',$request->id)->first();
    }

    // public function faqList(Request $request)
    // {
    //     $faq = Faq::where('')
    // }






}
