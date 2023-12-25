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
use Workbench\Database\Model\Payment\PaymentGateway;

class PaymentServices
{


    // ------------------- Payment ------------------- //

    public function payList(Request $request)
    {
        $payment = PaymentGateway::get();

        return $payment;
    }

    public function payAdd(Request $request)
    {
        $payment = new PaymentGateway;
        $payment->name = $request->name;
        $payment->url = $request->url;
        $payment->status = data_get($request,'status',1);
        $payment->save();
    }

    public function payShow(Request $request)
    {
        $payment = PaymentGateway::where('id',$request->id)->first();

        return $payment;
    }

    public function payUpd(Request $request)
    {
        $payment = PaymentGateway::where('id',$request->id)->first();
        $payment->name = $request->name;
        $payment->url = $request->url;
        $payment->status = data_get($request,'status',1);
        $payment->save();
    }


}
