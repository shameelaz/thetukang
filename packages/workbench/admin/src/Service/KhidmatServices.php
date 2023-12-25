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
use Workbench\Database\Model\Agency\KodHasil;
use Workbench\Database\Model\Lkp\LkpPerkhidmatan;

class KhidmatServices
{


    // ------------------- Perkhidmatan ------------------- //

    public function perkhidmatanList(Request $request)
    {

        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2))
        {
            $khidmat = LkpPerkhidmatan::get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            $khidmat = LkpPerkhidmatan::with('codehasil')
                                      ->whereHas('codehasil', function ($query) use ($agency)
                                            {
                                                $query->where('fk_agency', '=', $agency->fk_agency);
                                            })
                                        ->whereHas('codehasil', function ($query) use ($agency)
                                            {
                                                $query->where('fk_ptj', '=', $agency->fk_ptj);
                                            })
                                      ->get();
        }

        return $khidmat;
    }

    public function perkhidmatanAdd(Request $request)
    {
        $khidmat = new LkpPerkhidmatan;
        $khidmat->name = $request->name;
        $khidmat->status = data_get($request,'status',1);
        $khidmat->type = data_get($request,'type');
        $khidmat->type_rate = data_get($request,'type_rate');
        $khidmat->save();
    }

    public function perkhidmatanShow(Request $request)
    {
        $khidmat = LkpPerkhidmatan::where('id',$request->id)->first();

        return $khidmat;
    }

    public function perkhidmatanUpd(Request $request)
    {
        $khidmat = LkpPerkhidmatan::where('id',$request->id)->first();
        $khidmat->name = $request->name;
        $khidmat->type = data_get($request,'type');
        $khidmat->type_rate = data_get($request,'type_rate');
        $khidmat->status = data_get($request,'status');
        $khidmat->save();
    }

    public function khidmatSel(Request $request)
    {
        return LkpPerkhidmatan::where('status',1)->pluck('name','id');
    }

    public function perkhidmatanSel(Request $request)
    {
        $khidmatid = LkpPerkhidmatan::with('codehasil')
                                    ->whereHas('codehasil', function ($query) use ($request)
                                        {
                                            $query->where('fk_agency', '=', $request->fkagency);
                                        })
                                    // ->where('id',$request->id)
                                    ->get();


        return $khidmatid;
    }

    public function serviceList(Request $request)
    {
        // return $khidmat = LkpPerkhidmatan::whereHas('codehasil',function ($query) use ($request)
        // {
        //     $query->where('fk_agency',$request->agency)->where('fk_ptj',$request->ptj);

        // })
        // ->with('codehasil')
        // ->get();

        return $codehasil  = KodHasil::where('fk_agency',$request->agency)
        ->where('fk_ptj',$request->ptj)
        ->with('lkpperkhidmatan')
        ->get();

    }


}
