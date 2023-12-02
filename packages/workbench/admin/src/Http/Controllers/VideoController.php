<?php

namespace Workbench\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Mail;
use Curl;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\KhidmatServices;
use Workbench\Admin\Service\UserguideServices;
use Workbench\Admin\Service\VideoServices;

class VideoController extends Controller
{


    public function list(Request $request)
    {
        $video = (new VideoServices())->list($request);
        return view('admin::admin.manual.video.list',compact('video'));
    }

    public function add(Request $request)
    {
        return view('admin::admin.manual.video.add');
    }

    public function save(Request $request)
    {
        $video = (new VideoServices())->save($request);
        return redirect('/admin/manual/video/list')->withSuccess('Berjaya menambah data video');
    }

    public function show(Request $request)
    {
        $video = (new VideoServices())->show($request);
        return view('admin::admin.manual.video.show',compact('video'));
    }

    public function update(Request $request)
    {
        $video = (new VideoServices())->update($request);
        return redirect('/admin/manual/video/list')->withSuccess('Berjaya mengemaskini data video');
    }









}
