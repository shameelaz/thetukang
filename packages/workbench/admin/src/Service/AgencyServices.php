<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
use Workbench\Database\Model\Agency\Agency;
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
use Svg\Tag\Rect;
use Workbench\Database\Model\Agency\KodHasil;
use Workbench\Database\Model\Agency\LamanAgensi;
use Workbench\Database\Model\Agency\LamanAgensiPerkhidmatan;
use Workbench\Database\Model\Agency\ServiceKodHasil;
use Workbench\Database\Model\Agency\ServiceKodHasilDetail;
use Workbench\Database\Model\Agency\ServiceRate;
use Workbench\Database\Model\Agency\ServiceRateMgt;
use Workbench\Database\Model\Agency\Tetapan;
use Workbench\Database\Model\Lkp\LkpMaster;
use Workbench\Database\Model\Lkp\LkpPerkhidmatan;
use Workbench\Database\Model\Agency\LamanAgensiPerkhidmatanDalaman;
use Workbench\Database\Model\Agency\LkpServiceType;
use Workbench\Database\Model\Agency\MainService;
use Workbench\Database\Model\Agency\MainPromotion;
use Workbench\Database\Model\Agency\Ptj;
use Workbench\Database\Model\Payment\AttachmentHandymanBooking;
use Workbench\Database\Model\Payment\Booking;

class AgencyServices
{

    // ------------------- Service Handyman ------------------- //

    public function lkpserviceType(Request $request)
    {
        $lkp            = LkpServiceType::get();

        return $lkp;
    }

    public function srvList(Request $request)
    {
        $user           = Auth::user()->id;
        $profile        = Users::where('id',$user)->with('profile','role')->first();

        $srv            = MainService::with('lkpservicetype','user')
                                    ->whereHas('user', function ($q) use($user) {
                                        $q->where('id', $user);
                                    })
                                    ->get();
        
        return $srv;
    }

    public function srvAdd(Request $request)
    {
        $user                           = Auth::user()->id;
        $profile                        = Users::where('id',$user)->with('profile','role')->first();

        $srv                            = new MainService();
        $srv->fk_lkp_service_type       = $request->fk_lkp_service_type;
        $srv->fk_user                   = $user;
        $srv->desc                      = $request->desc;
        $srv->price                     = $request->price;
        $srv->location                  = $request->location;
        $srv->save();

        // event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Perkhidmatan dan Kod Hasil'));

    }

    public function srvView(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

       
        $srv = MainService::where('id', $request->id)->first();

        return $srv;
    }


    public function srvUpd(Request $request)
    {
        $srv                            = MainService::where('id', $request->id)->first();
        $srv->fk_lkp_service_type       = $request->fk_lkp_service_type;
        $srv->desc                      = $request->desc;
        $srv->price                     = $request->price;
        $srv->location                  = $request->location;
        $srv->save();

        // event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

    public function srvDelete(Request $request)
    {
        $srv                            = MainService::where('id', $request->id)->first();
        $srv->delete();

        // event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

    // ------------------- Promotion Handyman ------------------- //

    public function promoList(Request $request)
    {
        $user           = Auth::user()->id;
        $profile        = Users::where('id',$user)->with('profile','role')->first();

        $promo            = MainPromotion::with('user')
                                        ->whereHas('user', function ($q) use($user) {
                                            $q->where('id', $user);
                                        })
                                        ->get();

        return $promo;
    }

    public function promoAdd(Request $request)
    {
        $user                           = Auth::user()->id;
        $profile                        = Users::where('id',$user)->with('profile','role')->first();

        $promo                            = new MainPromotion();
        $promo->fk_user                   = $user;
        $promo->title                     = $request->title;
        $promo->desc                      = $request->desc;
        $promo->start_date                = date($request->start_date);
        $promo->end_date                  = date($request->end_date);
        $promo->status                    = $request->status;
        $promo->save();

        // event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Perkhidmatan dan Kod Hasil'));

    }

    public function promoView(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

    
        $promo = MainPromotion::where('id', $request->id)->first();

        return $promo;
    }


    public function promoUpd(Request $request)
    {
        $promo                            = MainPromotion::where('id', $request->id)->first();
        $promo->title                     = $request->title;
        $promo->desc                      = $request->desc;
        $promo->start_date                = date($request->start_date);
        $promo->end_date                  = date($request->end_date);
        $promo->status                    = $request->status;
        $promo->save();

        // event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

    public function promoDelete(Request $request)
    {
        $promo                            = MainPromotion::where('id', $request->id)->first();
        $promo->delete();

        // event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

     // ------------------- Booking Handyman ------------------- //

     public function bookingList(Request $request)
    {
        $user               = Auth::user()->id;
        $profile            = Users::where('id',$user)->with('profile','role')->first();

        $booking            = Booking::with('mainservice','attachmentbooking','attachmenthandymanbooking')->get();

        return $booking;
    }

    public function bookingView(Request $request)
    {
        $user               = Auth::user()->id;
        $profile            = Users::where('id',$user)->with('profile','role')->first();

        $booking            = Booking::with('mainservice','attachmentbooking')->where('id', $request->id)->first();

        return $booking;
    }
 
    public function bookingUpd(Request $request)
    {
        // dd($request->all());
        $user                           = Auth::user()->id;
        $profile                        = Users::where('id',$user)->with('profile','role')->first();

        $booking                            = Booking::where('id', $request->id)->first();
        $booking->desc_handyman             = $request->desc_handyman;
        $booking->date_handyman             = date($request->date_handyman);
        $booking->status                    = 2;
        $booking->save();
        $bookingId = $booking->id;

        if(isset($request->files))
            {
                $update_attachment = $this->StoreFilesBooking($request,$bookingId);
            }

        return redirect()->back();
    }

    public function StoreFilesBooking($request, $bid)
    {
        $files = $request->files->all();
        $file_names = $request->file_names;

        $folder='booking';
        $booking_id = $bid;

        if (!file_exists(public_path().'/uploads/base/booking/'))
        {
            mkdir(public_path()."/uploads/base/".$folder);
        }

        if (!file_exists(public_path().'/uploads/base/booking/'.$booking_id))
        {

            mkdir(public_path()."/uploads/base/booking/".$booking_id);
        }

        $path = public_path()."/uploads/base/booking/".$booking_id;

        $shortpath = "/uploads/base/booking/".$booking_id."/";


        foreach ($files as $key => $file1)
        {
            foreach ($file1 as $key => $file)
            {
                $namafile = $file_names[$key];

                $filename= $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $size= $file->getSize();
                $file->move($path, $file->getClientOriginalName());

                $svdt                           = new AttachmentHandymanBooking();
                $svdt->fk_booking               = $booking_id;
                $svdt->dir                      = $namafile;
                $svdt->full_path                = $shortpath.$filename;
                $svdt->file_name                = $filename;
                $svdt->file_size                = $size;
                $svdt->save();
            }
        }

        return 0;
    }





















    // ------------------- Agensi ------------------- //

    public function agensiList(Request $request)
    {
        $agency = Agency::with('ptj','profile','role')->get();

        return $agency;
    }

    public function ptjSel(Request $request)
    {
        $agency = Agency::where('id',$request->id)->with('ptj')->first();
        return $agency;
    }

    public function agensiAdd(Request $request)
    {
        $agency = new Agency;
        $agency->name = $request->name;
        $agency->code = $request->code;
        $agency->add = $request->add;
        $agency->email = $request->email;
        $agency->phone_no = $request->phone_no;
        $agency->status = data_get($request,'status',1);
        $agency->save();

        // insert to laman agensi table
        $newLA = new LamanAgensi;
        $newLA->fk_agency = data_get($agency,'id');
        $newLA->status = 0; // tidak aktif
        $newLA->save();



    }

    public function agensiEdit(Request $request)
    {
        $agency = Agency::where('id',$request->id)->first();

        return $agency;
    }

    public function agensiEditPtj(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2))
        {
            $agency = Agency::with('ptj')
                      ->get();
        }
        elseif($roleid == 4)
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            // dd($agency);exit;
            $agency = Agency::where('id', $agency->fk_agency)
                      ->first();
        }

        return $agency;
    }

    public function agensiUpd(Request $request)
    {
        $agency = Agency::where('id',$request->id)->first();
        $agency->name = $request->name;
        $agency->code = $request->code;
        $agency->add = $request->add;
        $agency->email = $request->email;
        $agency->phone_no = $request->phone_no;
        $agency->status = data_get($request,'status',1);
        $agency->save();
    }

    // ------------------- Laman Agensi / PTJ ------------------- //


    public function agptjList(Request $request)
    {
        $agptj = LamanAgensi::with('agensi','kodhasil','lamanagensiperkhidmatan','perkhidmatandalaman')
                            // ->where('status', 1)
                            ->get();

        return $agptj;
    }

    public function agptjAdd(Request $request)
    {
        $agptj = new LamanAgensi;
        $agptj->fk_agency = $request->fk_agency;
        $agptj->keterangan_ms = $request->keterangan_ms;
        $agptj->logo_agensi = $request->logo_agensi;
        $agptj->status = data_get($request,'status',1);
        $agptj->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Tambah Maklumat Agensi di pengurusan laman'));

    }

    public function agptjEdit(Request $request)
    {
        $agptj = LamanAgensi::where('id',$request->id)->with('agensi','kodhasil','lamanagensiperkhidmatan','perkhidmatandalaman.codehasil','perkhidmatandalaman.lkpperkhidmatan')->first();
        // dd($agptj);

        return $agptj;
    }

    public function agptjUpd(Request $request)
    {
        // dd($request);
        $agptj = LamanAgensi::where('id',$request->id)->first();
        // $agptj->fk_agency = $request->fk_agency;
        $agptj->keterangan_ms = $request->keterangan_ms;
        // $agptj->logo_agensi = $request->logo_agensi;
        $agptj->status = data_get($request,'status',1);
        $agptj->save();

        if($request->logo_agensi){

            $fail=$request->logo_agensi;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/logoagensi')) {

                mkdir(public_path()."/uploads/base/logoagensi");
            }
            if (!file_exists(public_path().'/uploads/base/logoagensi/'.$agptj->id)) {

                mkdir(public_path()."/uploads/base/logoagensi/".$agptj->id);
            }

            $path = public_path()."/uploads/base/logoagensi/".$agptj->id;

            $filename2= $fail->getClientOriginalName();
            $fullpath2 = "/uploads/base/logoagensi/".$agptj->id."/".$filename2;
            $extension = $fail->getClientOriginalExtension();



            $fail->move($path, $fail->getClientOriginalName());

            // $logo = Logo::where('id',1)->first();
            // $logo->logo_sistem = $fullpath2;
            // $logo->save();
            $upd = LamanAgensi::where('id',$request->id)->first();
            $upd->logo_agensi = $fullpath2;
            $upd->save();



        }

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Agensi di pengurusan laman'));


    }

    // ------------------- Laman Agensi Perkhidmatan ------------------- //


    public function khidResult(Request $request)
    {
        $khid = LamanAgensiPerkhidmatan::where('fk_laman_agensi',$request->id)->with('lamanagensi')->get();

        return $khid;
    }

    public function khidAdd(Request $request)
    {
        $khid = new LamanAgensiPerkhidmatan();
        $khid->fk_laman_agensi = $request->fk_laman_agensi;
        $khid->nama = $request->nama;
        $khid->url = $request->url;
        $khid->status = data_get($request,'status',1);
        $khid->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Tambah Maklumat Agensi Perkhidmatan di pengurusan laman'));

    }

    public function khidUpd(Request $request)
    {
        // dd($request);
        $khid = LamanAgensiPerkhidmatan::where('id',$request->kid)->first();
        // $khid->fk_laman_agensi = $request->fk_laman_agensi;
        $khid->nama = $request->nama;
        $khid->url = $request->url;
        $khid->status = data_get($request,'status',1);
        $khid->save();
    }

    public function khidShow(Request $request)
    {
       $khid = LamanAgensiPerkhidmatan::where('id', $request->kid)->first();

       return $khid;
    }

    public function agensiResult(Request $request)
    {
        $agensi = LamanAgensi::where('id',$request->id)->with('agensi','kodhasil','lamanagensiperkhidmatan')->first();

        return $agensi;
    }

    public function agensiFront(Request $request)
    {
        return LamanAgensi::where('status',1)->limit(9)->get();
    }

     // ------------------- PTJ Tetapan ------------------- //

    public function ttpList(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2))
        {
            $tetap = Tetapan::with('agency','ptj','lkpperkhidmatan')->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            $tetap = Tetapan::with('agency','ptj','lkpperkhidmatan')
                            ->whereHas('agency', function ($query) use ($agency)
                                {
                                    $query->where('id', '=', $agency->fk_agency);
                                })
                            ->whereHas('ptj', function ($query) use ($agency)
                                {
                                    $query->where('id', '=', $agency->fk_ptj);
                                })
                            ->get();

        }

        return $tetap;
    }

    public function agencyRole(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1)){

            $agency = Agency::where('status',1)->get();

        }elseif(($roleid == 4)||($roleid == 5)){

            $agency = UserProfile::where('fk_users','=',$user)->first();

        }

        return $agency;

    }

    public function ptjRole(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1)){

            if($request->agencyid)
            {
                $ptj = Ptj::where('fk_agency',$request->agencyid)->where('status',1)->get();
            }
            else
            {
                $ptj = Ptj::where('status',1)->get();
            }

        }elseif(($roleid == 4)||($roleid == 5)){

            $ptj = UserProfile::where('fk_users','=',$user)->first();

        }

        return $ptj;

    }

    public function hasilRole(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1)){

            $hasil = KodHasil::where('fk_ptj', $request->ptjid)
                             ->where('status',1)
                             ->get();

        }elseif(($roleid == 4)||($roleid == 5)){

            // $ptj = UserProfile::where('fk_users','=',$user)->first();

        }

        return $hasil;

    }

    public function khidmatSel(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        $ttp = Tetapan::with('agency','ptj')->where('id',$request->id)->first();

        $khidmat = LkpPerkhidmatan::with('codehasil')
                                  ->whereHas('codehasil', function ($query)use ($ttp)
                                    {
                                        $query->where('fk_ptj', '=', $ttp->fk_ptj);
                                    })
                                //   ->where('fk_ptj', $request->ptjid)
                                  ->where('status',1)
                                  ->get();
        // dd($khidmat);

        return $khidmat;

    }

    public function resultAjaxTetapan($request)
	{
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

        if( $ag == 'agen')
        {
            $ag = '0';
        }
        else
        {
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $data = Tetapan::with('agency','ptj','lkpperkhidmatan')
                        ->whereHas('agency', function ($query) use ($ag)
                            {
                                if($ag != '0')

                                    $query->where('id', '=', $ag);
                                else
                                    $query;
                            })
                        ->whereHas('ptj', function ($query) use ($pt)
                            {
                                if($pt != '0')

                                    $query->where('id', '=', $pt);
                                else
                                    $query;
                            })
                        ->get();

		return $data;

	}

    public function ttpAdd(Request $request)
    {
        $ttp = new Tetapan();
        $ttp->fk_agency = $request->fk_agency;
        $ttp->fk_ptj = $request->fk_ptj;
        $ttp->fk_lkp_perkhidmatan = $request->fk_lkp_perkhidmatan;
        $ttp->jenis = $request->jenis;
        $ttp->description = $request->description;
        $ttp->status = data_get($request,'status', 1);
        $ttp->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Tetapan'));

    }

    public function jenisList(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1))
        {
            $lkpmaster = LkpMaster::all();

        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $lkpmaster = LkpMaster::where('fk_lkp_master_type', 2)
                                  ->get();
        }

       return $lkpmaster;
    }

    public function ttpSel(Request $request)
    {
        $ttp = Tetapan::with('agency','ptj')->where('id',$request->id)->first();

        return $ttp;
    }

    public function ttpUpdate(Request $request)
    {
        $ttp = Tetapan::where('id',$request->id)->first();
        // $ttp->fk_agency = $request->fk_agency;
        // $ttp->fk_ptj = $request->fk_ptj;
        $ttp->fk_lkp_perkhidmatan = $request->fk_lkp_perkhidmatan;
        $ttp->jenis = $request->jenis;
        $ttp->description = $request->description;
        $ttp->status = data_get($request,'status',1);
        $ttp->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Tetapan'));

    }

    // ------------------- Perkhidmatan dan Kadar Bayaran ------------------- //

    public function servrateList(Request $request)
    {
        $role = Auth::user()->roles[0]->id;
        if(($role == 1)||($role ==2)){
            $servrate = ServiceRateMgt::with('agency','ptj','lkpperkhidmatan','kodhasil')->get();
        }else{
            $profile = UserProfile::where('fk_users',Auth::user()->id)->first();
            $servrate = ServiceRateMgt::where('fk_agency',$profile->fk_agency)->where('fk_ptj',$profile->fk_ptj)->with('agency','ptj','lkpperkhidmatan','kodhasil')->get();
        }


        return $servrate;
    }

    public function resultAjaxServiceRate($request)
	{
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

        if( $ag == 'agen')
        {
            $ag = '0';
        }
        else
        {
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $data = ServiceRateMgt::with('agency','ptj','lkpperkhidmatan','kodhasil')
                              ->whereHas('agency', function ($query) use ($ag)
                                    {
                                        if($ag != '0')

                                            $query->where('id', '=', $ag);
                                        else
                                            $query;
                                    })
                              ->whereHas('ptj', function ($query) use ($pt)
                                    {
                                        if($pt != '0')

                                            $query->where('id', '=', $pt);
                                        else
                                            $query;
                                    })
                              ->get();

		return $data;

	}

    public function khidmatList(Request $request)
    {

        $user = Auth::user()->id;
        $profile = Users::where('id',$user)->with('profile','role')->first();
        $kodhasil = KodHasil::where('fk_agency',$profile->profile->fk_agency)->where('fk_ptj',$profile->profile->fk_ptj)->first();

        $khidmat = LkpPerkhidmatan::with('codehasil')
                                    ->where('id', $kodhasil->fk_perkhidmatan)
                                    ->get();

        return $khidmat;
    }

    public function hasilList(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1))
        {
            // $agency = Agency::where('status',1)->get();
            $hasil = KodHasil::with('agency','ptj')->get();
        }
        elseif(($roleid == 4)||($roleid ==5))
        {
            $agency = UserProfile::where('fk_users','=',$user)->first();

            $hasil = KodHasil::where('fk_ptj', $agency->fk_ptj)
                             ->get();
        }

        return $hasil;
    }

    public function mgtAdd(Request $request)
    {

        $kodhasil = KodHasil::where('id', $request->fk_kod_hasil)
                            ->first();

        $servrate = new ServiceRateMgt();
        $servrate->fk_agency = data_get($request, 'fk_agency');
        $servrate->fk_ptj = data_get($request, 'fk_ptj');
        $servrate->fk_lkp_perkhidmatan = data_get($kodhasil, 'fk_perkhidmatan');
        $servrate->fk_kod_hasil = data_get($request, 'fk_kod_hasil');
        $servrate->status = data_get($request,'status',1);
        $servrate->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

    public function mgtresultShow(Request $request)
    {
       $servrate = ServiceRateMgt::with('agency','ptj','kodhasil')
                                ->where('id', $request->svrid)
                                ->first();

       return $servrate;
    }

    public function mgtUpd(Request $request)
    {
        $kodhasil = KodHasil::where('id', $request->fk_kod_hasil)->first();

        $servrate = ServiceRateMgt::where('id', $request->svrid)->first();
        $servrate->fk_lkp_perkhidmatan = data_get($kodhasil, 'fk_perkhidmatan');
        $servrate->fk_kod_hasil = data_get($request, 'fk_kod_hasil');
        $servrate->status = data_get($request,'status',1);
        $servrate->save();


        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

    // ------------------- Kadar Bayaran ------------------- //


    public function kdrList(Request $request)
    {
        $kadar = ServiceRate::with('serviceratemgt.agency','serviceratemgt.ptj',
        'serviceratemgt.lkpperkhidmatan','serviceratemgt.kodhasil','serviceratemgt.servicerate','fkcategory','fkunit')
        ->get();

        return $kadar;
    }

    public function kdrSel(Request $request)
    {
        $kadar = ServiceRate::where('service_rate_mgt',$request->id)->with('serviceratemgt.agency','serviceratemgt.ptj',
        'serviceratemgt.lkpperkhidmatan','serviceratemgt.kodhasil','serviceratemgt.servicerate','fkcategory','fkunit')
        ->get();

        return $kadar;
    }


    public function servratelistResult(Request $request)
    {
        $kadar = ServiceRateMgt::where('id', $request->id)
                                ->first();

        return $kadar;
    }


    public function kdrAdd(Request $request)
    {
        $kadar = new ServiceRate();
        $kadar->service_rate_mgt = $request->service_rate_mgt;
        $kadar->location = $request->location;
        $kadar->category = $request->category;
        $kadar->unit = $request->unit;
        $kadar->rate = $request->rate;
        $kadar->status = data_get($request,'status',1);
        $kadar->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

    public function kdrshowId(Request $request)
    {
       $kadar = ServiceRate::where('id', $request->kadarid)->first();

       return $kadar;
    }

    public function kdrUpd(Request $request)
    {
        $kadar = ServiceRate::where('id', $request->kadarid)->first();
        // $kadar->service_rate_mgt = $request->service_rate_mgt;
        $kadar->location = $request->location;
        $kadar->category = $request->category;
        $kadar->unit = $request->unit;
        $kadar->rate = $request->rate;
        $kadar->status = data_get($request,'status',1);
        $kadar->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

    public function kdrResult(Request $request)
    {
        $kadar = ServiceRate::where('id', $request->id)->first();

        return $kadar;
    }

    public function servrateSel(Request $request)
    {
        $servrate = ServiceRateMgt::where('id',$request->id)->first();

        return $servrate;
    }

    public function catSel(Request $request)
    {
        // 5 = Kategori

        $kadar = ServiceRateMgt::where('id', $request->id)->first();

        $tetapan = Tetapan::with('agency','ptj','lkpperkhidmatan')
                          ->whereHas('agency', function ($query) use ($kadar)
                            {
                                $query->where('fk_agency', '=', $kadar->fk_agency);
                            })
                          ->whereHas('ptj', function ($query) use ($kadar)
                            {
                                $query->where('fk_ptj', '=', $kadar->fk_ptj);
                            })
                          ->whereHas('lkpperkhidmatan', function ($query) use ($kadar)
                            {
                                $query->where('fk_lkp_perkhidmatan', '=', $kadar->fk_lkp_perkhidmatan);
                            })
                          ->where('status',1)
                          ->where('jenis',5)
                          ->get();

        return $tetapan;
    }

    public function unitSel(Request $request)
    {
        // 6 = Unit selection
        return $tetapan = Tetapan::where('status',1)->where('jenis',6)->get();

    }


    // ------------------- Kod Hasil ------------------- //


    public function kdhList(Request $request)
    {
        $user = Auth::user()->id;
        $profile = Users::where('id',$user)->with('profile','role')->first();

        $kdh = ServiceKodHasil::where('fk_agency',$profile->profile->fk_agency)->where('fk_ptj',$profile->profile->fk_ptj)->get();

        return $kdh;
    }

    public function kdhAdd(Request $request)
    {
        $user = Auth::user()->id;
        $profile = Users::where('id',$user)->with('profile','role')->first();

        $kdh = new ServiceKodHasil();
        $kdh->fk_lkp_perkhidmatan = data_get($request, 'fk_lkp_perkhidmatan');
        $kdh->fk_agency = data_get($profile,'profile.fk_agency');
        $kdh->fk_ptj = data_get($profile,'profile.fk_ptj');
        $kdh->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Perkhidmatan dan Kod Hasil'));

    }

    public function kdhResult(Request $request)
    {
        // dd($request->id, $request->khdid);
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1))
        {
            $kdh = ServiceKodHasil::where('id', $request->id)->first();

        }
        elseif($roleid == 4)
        {
            $acc = UserProfile::where('fk_users','=',$user)->with('userPtj')->first();

            $kdh = ServiceKodHasil::where('id', $acc->fk_ptj)
                                        ->first();
        }
        // dd($kdh);exit;
        return $kdh;
    }


    public function kdhUpd(Request $request)
    {
        $kdh = ServiceKodHasil::where('id', $request->id)->first();
        $kdh->fk_lkp_perkhidmatan = data_get($request, 'fk_lkp_perkhidmatan');
        $kdh->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }

    // ------------------- Kod Hasil Detail ------------------- //

    public function kdhdList(Request $request)
    {

        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1))
        {
            $kdhd = ServiceKodHasilDetail::with('servicekodhasil','hasil')
                                         ->whereHas('servicekodhasil', function ($query) use ($request)
                                         {
                                            $query->where('fk_service_kod_hasil', '=', $request->id);
                                         })
                                         ->get();

        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $acc = UserProfile::where('fk_users','=',$user)->with('userPtj')->first();

            $kdhd = ServiceKodHasilDetail::whereHas('hasil', function ($query) use ($acc)
                                         {
                                            $query->where('fk_ptj', '=', $acc->fk_ptj);
                                         })
                                         ->where('id', $request->id)
                                         ->with('servicekodhasil.lkpperkhidmatan','hasil')
                                         ->get();
        }
// dd($kdhd);exit;
        return $kdhd;
    }

    public function kdhdAdd(Request $request)
    {
        $kdhd = new ServiceKodHasilDetail();
        $kdhd->fk_service_kod_hasil = data_get($request, 'fk_service_kod_hasil');
        $kdhd->fk_kod_hasil = data_get($request, 'fk_kod_hasil');
        $kdhd->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Pengurusan Perkhidmatan dan Kod Hasil'));

    }

    public function kdhdResult(Request $request)
    {
        // dd($request->id, $request->khdid);
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1))
        {

            $kdhd = ServiceKodHasilDetail::with('servicekodhasil')->where('id', $request->id)->first();
            // dd($kdhd);

        }
        elseif($roleid == 4)
        {
            $acc = UserProfile::where('fk_users','=',$user)->with('userPtj')->first();

            $kdhd = ServiceKodHasilDetail::where('id', $acc->fk_ptj)
                                        ->first();

        }

        return $kdhd;
    }


    public function kdhdUpd(Request $request)
    {
        $kdhd = ServiceKodHasilDetail::where('id', $request->kdhdid)->first();
        // $kdhd->fk_service_kod_hasil = data_get($request, 'fk_service_kod_hasil');
        $kdhd->fk_kod_hasil = data_get($request, 'fk_kod_hasil');
        $kdhd->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Pengurusan Perkhidmatan dan Kadar Bayaran'));

    }



    public function kodHasilList(Request $request)
    {
        $lamanagency = LamanAgensi::where('id',$request->id)->with('agensi','kodhasil','lamanagensiperkhidmatan','perkhidmatandalaman')->first();

        $dalaman = LamanAgensiPerkhidmatanDalaman::where('fk_laman_agensi',$request->id)->get();

        $iddalaman = array();
        if($dalaman){

            foreach($dalaman as $key => $value ){
                array_push($iddalaman,$value->fk_kod_hasil);
            }

        }else{


        }
        // dd($iddalaman);

        if(count($iddalaman) == 0){
            // dd('a');
            // $internal = $dalaman;
            $kodhasil = KodHasil::where('fk_agency',data_get($lamanagency,'fk_agency'))->where('status',1)->with('lkpperkhidmatan')->get();
        }else{
            // dd('b');
            $kodhasil =  KodHasil::where('fk_agency',data_get($lamanagency,'fk_agency'))->where('status',1)->whereNotIn('id',$iddalaman)->with('lkpperkhidmatan')->get();
            // $internal = LamanAgensiPerkhidmatanDalaman::where('status',1)->where('fk_laman_agensi',$request->id)->whereNotIn('id',$iddalaman)->get();
        }

        // dd($internal);



        // $kodhasil = KodHasil::where('status',1)->where('fk_agency',$request->id)->with('agency','ptj','lkpperkhidmatan')->get();

        return $kodhasil;
    }


    public function addKodHasilLmnAgensi(Request $request)
    {
        foreach($request->vid as $key => $value){

            $kodhasil = KodHasil::where('id',$value)->first();

            $up = new LamanAgensiPerkhidmatanDalaman;
            $up->fk_laman_agensi = $request->fk_laman_agensi;
            $up->fk_kod_hasil = $value;
            $up->fk_lkp_perkhidmatan = data_get($kodhasil,'fk_perkhidmatan');
            $up->status = 1;
            $up->save();
        }


        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Maklumat Kod Hasil Dalaman Laman Agensi Utama'));

    }


    public function ptjKadarList(Request $request)
    {
        $profile = UserProfile::where('fk_users',Auth::user()->id)->first();

        // $kadar = ServiceRateMgt::where('fk_ptj',data_get($profile,'fk_ptj'))
        // ->with('agency','ptj','lkpperkhidmatan','kodhasil')
        // ->get();

        $kadar = ServiceRate::join('service_rate_mgt','service_rate_mgt.id','=','service_rate.service_rate_mgt')
        ->where('service_rate_mgt.fk_ptj',$profile->fk_ptj)
        ->select('service_rate.*')
        ->with('serviceratemgt.agency','serviceratemgt.ptj',
        'serviceratemgt.lkpperkhidmatan','serviceratemgt.kodhasil','serviceratemgt.servicerate','fkcategory','fkunit')
        ->get();


        return $kadar;

    }


    public function kodhasilShow(Request $request)
    {
        $kdh = ServiceKodHasil::where('id', $request->id)->with('lkpperkhidmatan','hasil','detail')->first();
        return $kdh;
    }

    public function kodhasildetailShow(Request $request)
    {

        $kdh = ServiceKodHasilDetail::where('id', $request->khdid)->with('servicekodhasil','hasil')->first();
        return $kdh;
    }

    public function khidmatDalaman(Request $request)
    {
        $dalaman = LamanAgensiPerkhidmatanDalaman::where('fk_laman_agensi',$request->id)
                                                // ->select('laman_agensi_perkhidmatan_dalaman.fk_lkp_perkhidmatan')
                                                ->with('lkpperkhidmatan')
                                                ->whereHas('lkpperkhidmatan', function ($query)
                                                    {
                                                        $query->where('status', '=', 1 );
                                                    })
                                                ->groupBy('fk_lkp_perkhidmatan')
                                                ->get();

        // dd($dalaman);

        return $dalaman;
    }

    public function khidmatDlmShow(Request $request)
    {
        $dalaman = LamanAgensiPerkhidmatanDalaman::where('id',$request->id)
        ->with('lkpperkhidmatan','lamanagensi.agensi','codehasil')
        ->first();
        return $dalaman;
    }

    public function khidmatDlmUpd(Request $request)
    {
        // dd($request);
        $dalaman = LamanAgensiPerkhidmatanDalaman::where('id',$request->id)->first();
        $dalaman->status = $request->status;
        $dalaman->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Status Perkhidmatan Dalaman Laman Agensi Utama'));
    }


}
