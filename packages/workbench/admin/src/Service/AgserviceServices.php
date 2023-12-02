<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
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

use Session;
use App;
use Config;
use Auth;
use File;
use Redirect;
use Mail;
use Curl;
use DB;
use Workbench\Database\Model\Agency\AgService;
use Workbench\Database\Model\Agency\KodHasil;

class AgserviceServices
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

    // ------------------- Agency Service ------------------- //

    public function agservList(Request $request)
    {
       $agserv = AgService::where('status',1)->get();

       return $agserv;
    }

    public function ptjResult(Request $request)
    {
        $ptj = Ptj::where('status',1)->where('fk_agency',$request->agency)->get();

        return $ptj;
    }

    public function agservResult(Request $request)
    {

        $result = Agency::where('id', $request->agency)
                              ->get();

        return $result;
    }

    public function ptjList(Request $request)
    {
        $ptj = Ptj::where('id',$request->ptj)->get();

        return $ptj;
    }

    public function ptjByAgency(Request $request)
    {
        $ptj = Ptj::where('fk_agency',$request->agency)->get();


        return $ptj;
    }

    public function agservResultList(Request $request)
    {
        if($request->ptj == 0){
            $agserv = AgService::where('fk_agency', $request->agency)

                          ->get();
        }else{
            $agserv = AgService::where('fk_agency', $request->agency)
                          ->where('fk_ptj', $request->ptj)
                          ->with('lkpperkhidmatan','agency','ptj','codehasil')
                          ->get();
        }


       return $agserv;
    }

    public function agservResultShow(Request $request)
    {
       $agserv = AgService::where('id', $request->agsid)
                          ->with('codehasil','lkpperkhidmatan','agency','ptj')
                          ->first();

       return $agserv;
    }

    public function agservAdd(Request $request)
    {
        // dd($request);

        $string = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(64))), 0, 64); // 46 characters, without /=+


        $kodhasil = KodHasil::where('id',$request->fk_kod_hasil)->first();

        $agserv = new AgService();
        $agserv->fk_agency = $request->fk_agency;
        $agserv->fk_ptj = $request->fk_ptj;
        $agserv->fk_perkhidmatan = data_get($kodhasil,'fk_perkhidmatan');
        $agserv->fk_kod_hasil = data_get($kodhasil,'id');
        $agserv->system_name = $request->system_name;
        $agserv->userid = $request->userid;
        $agserv->token = $string;

        // $agserv->service_type = $request->service_type;
        // $agserv->url = $request->url;

        $agserv->status = data_get($request,'status',1);
        $agserv->save();
    }

    public function agservUpd(Request $request)
    {
        $kodhasil = KodHasil::where('id',$request->fk_kod_hasil)->first();

        $agserv = AgService::where('id',$request->agsid)->first();
        $agserv->fk_perkhidmatan = data_get($kodhasil,'fk_perkhidmatan');
        $agserv->fk_kod_hasil = data_get($kodhasil,'id');
        $agserv->system_name = $request->system_name;
        $agserv->userid = $request->userid;
        // $agserv->service_type = $request->service_type;
        // $agserv->url = $request->url;
        $agserv->status = data_get($request,'status',1);
        $agserv->save();
    }

    public function agensiSel(Request $request)
    {
        $agency = Agency::where('id',$request->agency)->first();

        return $agency;
    }

    public function ptjSel(Request $request)
    {
        $ptj = Ptj::where('id',$request->ptj)->first();

        return $ptj;
    }


}
