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
use Workbench\Database\Model\Agency\LamanAgensi;
use Session;
use App;
use Config;
use Auth;


class SearchServices
{

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function search(Request $request)
    {
        // dd($request);

        $data = LamanAgensi::where('keterangan_ms','like','%'.$request->search.'%')->with('agensi')->get();



        return $data;
    }







}
