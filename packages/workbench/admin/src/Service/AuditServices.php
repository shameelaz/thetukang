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
use Workbench\Database\Model\Audit\AuditTrail;
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


class AuditServices
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
    public function audit(Request $request)
    {
        return $audit = AuditTrail::with('user')->get();

    }













}
