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
use Workbench\Admin\Service\KhidmatServices;

class KhidmatController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Perkhidmatan ------------------- //

    public function khidmatList(Request $request)
    {
      $khidmat = (new KhidmatServices())->perkhidmatanList($request);

      return view('admin::admin.khidmat.list',compact('khidmat'));
    }

    public function khidmatAdd(Request $request)
    {
      return view('admin::admin.khidmat.add');
    }

    public function khidmatSave(Request $request)
    {
      $khidmat = (new KhidmatServices())->perkhidmatanAdd($request);

      return redirect('/admin/khidmat/list')->withSuccess('Berjaya');
    }

    public function khidmatEdit(Request $request)
    {
      $khidmat = (new KhidmatServices())->perkhidmatanShow($request);

      return view('admin::admin.khidmat.edit',compact('khidmat'));
    }

    public function khidmatUpd(Request $request)
    {
      $khidmat = (new KhidmatServices())->perkhidmatanUpd($request);

      return redirect('/admin/khidmat/list')->withSuccess('Berjaya');
    }




}
