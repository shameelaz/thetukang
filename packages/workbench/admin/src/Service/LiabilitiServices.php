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
use Workbench\Database\Model\Agency\KodLiabiliti;
use Workbench\Database\Model\Lkp\LkpPerkhidmatan;
use Workbench\Database\Model\User\UserProfile;

class LiabilitiServices
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

    // ------------------- Liabiliti ------------------- //

    public function liaList(Request $request)
    {
       $lia = KodLiabiliti::with('agency','ptj','lkpperkhidmatan')->get();

       return $lia;
    }

    // ------------------- Agensi/PTJ/Liabiliti ------------------- //

    public function ptjResult(Request $request)
    {
        $ptj = Ptj::where('status',1)->where('fk_agency',$request->agency)->get();

        return $ptj;
    }

    public function ptjList(Request $request)
    {
        $ptj = Ptj::where('fk_agency', $request->agency)->get();

        return $ptj;
    }

    public function liaResult(Request $request)
    {
        $result = KodLiabiliti::where('fk_agency', $request->agency)
                              ->get();

        return $result;
    }


    public function liaResultList(Request $request)
    {
       $lia = KodLiabiliti::where('fk_agency', $request->agency)
                          ->where('fk_ptj', $request->ptj)
                          ->with('agency','ptj','lkpperkhidmatan')
                          ->get();

       return $lia;
    }

    public function liaResultShow(Request $request)
    {
       $lia = KodLiabiliti::where('id', $request->lid)
                          ->first();

       return $lia;
    }

    public function liaAdd(Request $request)
    {
        // dd($request);
        $lia = new KodLiabiliti();
        $lia->fk_agency = $request->fk_agency;
        $lia->fk_ptj = $request->fk_ptj;
        $lia->fk_perkhidmatan = $request->fk_perkhidmatan;
        $lia->name = $request->name;
        $lia->reference_name = $request->reference_name;
        $lia->status = data_get($request,'status',1);
        $lia->save();
    }

    public function liaUpd(Request $request)
    {

        $lia = KodLiabiliti::where('id',$request->lid)->first();
        $lia->fk_perkhidmatan = $request->fk_perkhidmatan;
        $lia->name = $request->name;
        $lia->reference_name = $request->reference_name;
        $lia->status = data_get($request,'status',1);
        $lia->save();
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

    public function resultAjaxLiabiliti($request)
	{

		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');
        // dd($ag, $pt);

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

        $data = KodLiabiliti::with('agency','ptj','lkpperkhidmatan')
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
                        // dd($data);

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
