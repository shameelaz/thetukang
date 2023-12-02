<?php

namespace Workbench\Payment\Service;

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
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\PenyataPemungutDetail;
use Workbench\Database\Model\Payment\PenyataPemungutMain;
use Workbench\Database\Model\Payment\PenyataPemungutLog;

class StatementServices
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

    // -------------------  ------------------- //

    public function senaraiPenyata($request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $data = PenyataPemungutMain::with('agency','ptj')->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            $data = PenyataPemungutMain::where('fk_agency', $agency->fk_agency)
                                        ->where('fk_ptj', $agency->fk_ptj)
                                        ->get();
        }

        return $data;
    }

    public function viewPenyata($request)
    {
        $data = PenyataPemungutMain::with('agency','ptj','penyatapemungutdetail','userprofile.user','merchantsetup')
                                    ->where('id',$request->id)
                                    ->first();
        return $data;
    }

    public function viewPenyataLog($request)
    {
        $data = PenyataPemungutLog::where('fk_penyata_pemungut',$request->id)
                                    ->first();
        return $data;
    }

    public function penyediaPenyata($request)
    {
        $user = Auth::user()->id;

        $penyedia = UserProfile::with('user','position')
                                ->where('ispek_role', 1)
                                ->where('fk_users','=',$user)
                                ->first();
        return $penyedia;
    }

    public function penyemakPenyata($request)
    {
        $user = Auth::user()->id;
        $agency = UserProfile::where('fk_users', $user)->first();

        $penyemak = UserProfile::with('user','position')
                                ->where('fk_agency', $agency->fk_agency)
                                ->where('fk_ptj', $agency->fk_ptj)
                                ->where('ispek_role', 2)
                                ->get();

        return $penyemak;
    }

    public function pelulusPenyata($request)
    {
        $user = Auth::user()->id;
        $agency = UserProfile::where('fk_users', $user)->first();

        $pelulus = UserProfile::with('user','position')
                              ->where('fk_agency', $agency->fk_agency)
                              ->where('fk_ptj', $agency->fk_ptj)
                              ->where('ispek_role', 3)
                              ->get();
        return $pelulus;
    }

    public function penyataUpd(Request $request)
    {
        $penyemak = UserProfile::with('user','position')
                               ->where('fk_users', $request->penyemak)
                               ->first();

        $pelulus = UserProfile::with('user','position')
                               ->where('fk_users', $request->pelulus)
                               ->first();

        $now = Carbon::now();
        $penyata = PenyataPemungutMain::where('id', $request->id)->first();
        $penyata->penyedia = $request->penyedia;
        $penyata->penyedia_name = $request->penyedia_name;
        $penyata->penyedia_position = $request->penyedia_position;
        $penyata->penyedia_date = $now;

        $penyata->penyemak = $request->penyemak;
        $penyata->penyemak_name = $penyemak->user->name;
        $penyata->penyemak_position = $penyemak->position->description;
        $penyata->penyemak_date = $now;

        $penyata->pelulus = $request->pelulus;
        $penyata->pelulus_name = $pelulus->user->name;
        $penyata->pelulus_position = $pelulus->position->description;
        $penyata->pelulus_date = $now;
        $penyata->status = $request->action;

        $penyata->update();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menyimpan Penyata Pemungut'));

    }

    public function getexportPenyata($request)
    {
        $data = PenyataPemungutMain::with('agency','ptj','penyatapemungutdetail','userprofile.user')
                                    ->where('id',$request->id)
                                    ->first();
        // dd($data);
        return $data;
    }

    public function pdfPenyata($request)
    {
        $data = PenyataPemungutDetail::with('penyatapemungutmain','penyatapemungutmain.agency','penyatapemungutmain.ptj','payment','payment.fkpaymentgateway')
                                    ->where('fk_penyata_pemungut',$request->id)
                                    ->get();
        return $data;
    }

}
