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
use Workbench\Database\Model\Base\PanduanVideo;

class VideoServices
{




    public function list(Request $request)
    {
        $video = PanduanVideo::get();

        return $video;
    }

    public function save(Request $request)
    {
        $video = new PanduanVideo;
        $video->nama = $request->nama;
        $video->url = $request->url;
        $video->status = $request->status;
        $video->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Berjaya menambah panduan video baru'));
    }

    public function show(Request $request)
    {
        return $video = PanduanVideo::where('id',$request->id)->first();
    }

    public function update(Request $request)
    {
        // dd($request);
        $video = PanduanVideo::where('id',$request->id)->first();
        $video->nama = $request->nama;
        $video->url = $request->url;
        $video->status = $request->status;
        $video->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Berjaya mengemaskini panduan video'));
    }


    public function latest(Request $request)
    {
        return $video = PanduanVideo::where('status',1)->orderBy('id','DESC')->first();
    }





    // ------------------- Video ------------------- //

}
