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

class AgencyController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Agensi ------------------- //

    public function agencyList(Request $request)
    {
      $agency = (new AgencyServices())->agensiList($request);

      return view('admin::admin.agency.list',compact('agency'));
    }

    public function agencyAdd(Request $request)
    {
      return view('admin::admin.agency.add');
    }

    public function agencySave(Request $request)
    {
      $agency = (new AgencyServices())->agensiAdd($request);

      return redirect('/admin/agency/list')->withSuccess('Berjaya');
    }

    public function agencyEdit(Request $request)
    {
      $agency = (new AgencyServices())->agensiEdit($request);

      return view('admin::admin.agency.edit',compact('agency'));
    }

    public function agencyUpd(Request $request)
    {
      $agency = (new AgencyServices())->agensiUpd($request);

      return redirect('/admin/agency/list')->withSuccess('Berjaya');
    }




}
