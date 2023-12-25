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
use Workbench\Database\Model\Base\PanduanPdf;
use Workbench\Database\Model\Lkp\LkpPerkhidmatan;
use Workbench\Database\Model\Lkp\LkpPtj;

class UserguideServices
{


    // ------------------- PDF ------------------- //

    public function pdfList(Request $request)
    {
        $usrgd = PanduanPdf::get();

        return $usrgd;
    }

    public function pdfAdd(Request $request)
    {

        $usrpdf = new PanduanPdf;
        $usrpdf->fk_agensi = $request->fk_agensi;
        $usrpdf->fk_perkhidmatan = $request->fk_perkhidmatan;
        // $usrpdf->fail = $request->fail;
        $usrpdf->status = data_get($request,'status',1);
        $usrpdf->save();


        if($request->fail){

            $fail_pdf=$request->fail;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/manual')) {

                mkdir(public_path()."/uploads/base/manual");
            }
            if (!file_exists(public_path().'/uploads/base/manual/'.$usrpdf->id)) {

                mkdir(public_path()."/uploads/base/manual/".$usrpdf->id);
            }

            $path = public_path()."/uploads/base/manual/".$usrpdf->id;

            $filename2= $fail_pdf->getClientOriginalName();
            $fullpath2 = "/uploads/base/manual/".$usrpdf->id."/".$filename2;
            $extension = $fail_pdf->getClientOriginalExtension();



            $fail_pdf->move($path, $fail_pdf->getClientOriginalName());


            $upd = PanduanPdf::where('id',$usrpdf->id)->first();
            $upd->fail = $fullpath2;
            $upd->save();

        }


        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Panduan Pengguna PDF'));

    }

    public function pdfShow(Request $request)
    {
        $usrpdf = PanduanPdf::where('id',$request->id)->with('agensi')->first();

        return $usrpdf;
    }

    public function pdfUpd(Request $request)
    {
        $usrpdf = PanduanPdf::where('id',$request->id)->first();
        $usrpdf->fk_agensi = $request->fk_agensi;
        $usrpdf->fk_perkhidmatan = $request->fk_perkhidmatan;
        // $usrpdf->fail = $request->fail;
        $usrpdf->status = data_get($request,'status');
        $usrpdf->save();


        if($request->fail){

            $fail_pdf=$request->fail;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/manual')) {

                mkdir(public_path()."/uploads/base/manual");
            }
            if (!file_exists(public_path().'/uploads/base/manual/'.$usrpdf->id)) {

                mkdir(public_path()."/uploads/base/manual/".$usrpdf->id);
            }

            $path = public_path()."/uploads/base/manual/".$usrpdf->id;

            $filename2= $fail_pdf->getClientOriginalName();
            $fullpath2 = "/uploads/base/manual/".$usrpdf->id."/".$filename2;
            $extension = $fail_pdf->getClientOriginalExtension();



            $fail_pdf->move($path, $fail_pdf->getClientOriginalName());

            // $logo = Logo::where('id',1)->first();
            // $logo->logo_sistem = $fullpath2;
            // $logo->save();
            $upd = PanduanPdf::where('id',$request->id)->first();
            $upd->fail = $fullpath2;
            $upd->save();

        }

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Panduan Pengguna PDF'));

    }

    public function agensiSel(Request $request)
    {
        $agency = Agency::where('id',$request->agency)->first();

        return $agency;
    }

    public function khidmatSel(Request $request)
    {
        $khidmat = LkpPerkhidmatan::where('id',$request->kid)->first();
        // dd($khidmat);
        return $khidmat;
    }

    public function listActive(Request $request)
    {
        $panduan = PanduanPdf::where('status',1)->get();
        return $panduan;
    }

    public function getKhidmat(Request $request)
    {
        $khidmat = LkpPerkhidmatan::with('codehasil')
                                  ->whereHas('codehasil', function ($query)use ($request)
                                    {
                                        $query->where('fk_agency', '=', $request->agencyid);
                                    })
                                  ->where('status',1)
                                  ->get();
        // dd($khidmat);

        return $khidmat;
    }

    public function perkhidmatanSelect(Request $request)
    {

        $usrpdf = PanduanPdf::where('id',$request->id)->with('agensi')->first();

        $khidmat = LkpPerkhidmatan::with('codehasil')
                                    ->whereHas('codehasil', function ($query)use ($usrpdf)
                                        {
                                            $query->where('fk_agency', '=', $usrpdf->fk_agensi);
                                        })
                                    ->where('status',1)
                                    ->get();
        // dd($usrpdf, $khidmat);

        return $khidmat;
    }




    // ------------------- Video ------------------- //

}
