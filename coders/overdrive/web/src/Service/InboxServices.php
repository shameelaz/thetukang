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
use Workbench\Database\Model\User\Inbox;
use Session;
use App;
use Config;
use Auth;


class InboxServices
{


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function list(Request $request)
    {
        $user = Auth::user()->id;

        return $inbox = Inbox::where('kepada',$user)->where('status',0)->with('to','from')->get();

    }







}
