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
use Workbench\Database\Model\Agency\KodHasil;
use Workbench\Database\Model\Lkp\LkpKodHasil;
use Workbench\Database\Model\Lkp\LkpMaster;
use Workbench\Database\Model\Lkp\LkpPerkhidmatan;

class HasilServices
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

    // ------------------- Hasil ------------------- //

    public function kdhasilList(Request $request)
    {
       $kdhasil = KodHasil::with('lkpkodhasil')->get();

       return $kdhasil;
    }


    // public function hasilresultList(Request $request)
    // {
    //    return  $hasil = KodHasil::with('lkpperkhidmatan')->get();
    // }

    // // ------------------- Agensi/PTJ/Hasil ------------------- //

    public function ptjList(Request $request)
    {
        $ptj = Ptj::where('fk_agency', $request->agency)->get();

        return $ptj;
    }

    public function kdhasilResultList(Request $request)
    {
       $kdhasil = KodHasil::where('fk_agency', $request->agency)
                          ->where('fk_ptj', $request->ptj)
                          ->with('agency','ptj','lkpperkhidmatan','lkpkodhasil')
                          ->get();
        // dd($kdhasil);

       return $kdhasil;
    }

    public function ptjResult(Request $request)
    {
        $ptj = Ptj::where('status',1)->where('fk_agency',$request->agency)->get();

        return $ptj;
    }

    public function kdhasilResult(Request $request)
    {
        $result = KodHasil::where('fk_agency', $request->agency)
                              ->get();

        return $result;
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

    public function kdhasilResultShow(Request $request)
    {
       $hasil = KodHasil::where('id', $request->chid)
                          ->first();

       return $hasil;
    }

    public function kdhasilAdd(Request $request)
    {
        // dd($request);

        $lkp = LkpKodHasil::where('id',$request->lkp_kod_hasil)->first();

        $hasil = new KodHasil();
        $hasil->fk_agency = $request->fk_agency;
        $hasil->fk_ptj = $request->fk_ptj;
        $hasil->fk_perkhidmatan = $request->fk_perkhidmatan;
        $hasil->fk_lkp_kod_hasil = data_get($lkp,'id');
        $hasil->name = data_get($lkp,'kod_hasil');
        $hasil->description = data_get($lkp,'description');
        $hasil->reference_name = $request->reference_name;
        $hasil->status = data_get($request,'status',1);
        $hasil->save();
    }

    public function kdhasilUpd(Request $request)
    {
        $lkp = LkpKodHasil::where('id',$request->lkp_kod_hasil)->first();
        $hasil = KodHasil::where('id',$request->chid)->first();

        $hasil->fk_perkhidmatan = $request->fk_perkhidmatan;
        $hasil->fk_lkp_kod_hasil = data_get($lkp,'id');
        $hasil->name = data_get($lkp,'kod_hasil');
        $hasil->description = data_get($lkp,'description');
        $hasil->reference_name = $request->reference_name;
        $hasil->status = data_get($request,'status');
        $hasil->save();
    }

    public function lkpkodhasil(Request $request)
    {
       $lkpkodhasil = LkpKodHasil::get();

       return $lkpkodhasil;
    }

    public function resultAjaxHasil($request)
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

        $data = KodHasil::with('agency','ptj','lkpperkhidmatan')
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



}
