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
use Laravolt\Suitable\Columns\Raw;
use Svg\Tag\Rect;
use Workbench\Admin\Service\UserServices;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\AgserviceServices;
use Workbench\Admin\Service\PtjServices;
use Workbench\Admin\Service\KhidmatServices;
use Workbench\Database\Model\Agency\Agency;

class ServiceController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Agency Service ------------------- //

    public function serviceList(Request $request)
    {
        $agency = (new AgencyServices())->agensiList($request);
        $ptj = (new PtjServices())->pusatList($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $agserv = (new AgserviceServices())->agservList($request);

      return view('admin::admin.serv.list',compact('ptj','agency','khidmat','request','agserv'));
    }

    public function servicePtjAjax(Request $request)
    {
        // dd($request);
        $ptj = (new AgserviceServices())->ptjResult($request);

        return view('admin::admin.serv.ajax.ptj', compact('ptj'));
    }

    public function serviceAjax(Request $request)
    {
        $agserv = (new AgserviceServices())->agservResult($request);

        return view('admin::admin.serv.ajax.result', compact('agserv'));
    }

    public function serviceResult(Request $request)
    {

        $agency = (new AgencyServices())->agensiList($request);
        // $ptj = (new AgserviceServices())->ptjList($request);
        $ptj = (new AgserviceServices())->ptjByAgency($request);

        $agserv = (new AgserviceServices())->agservResultList($request);
        $khidmat = (new KhidmatServices())->serviceList($request);

        return view('admin::admin.serv.result',compact('ptj','agency','agserv','request','khidmat'));
    }

    public function serviceForm(Request $request)
    {
        $agency = (new AgserviceServices())->agensiSel($request);
        $ptj = (new AgserviceServices())->ptjSel($request);
        // $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $khidmat = (new KhidmatServices())->serviceList($request);
        $agserv = (new AgserviceServices())->agservResultList($request);
        // dd($khidmat);
        return view('admin::admin.serv.add',compact('ptj','agency','agserv','request','khidmat'));
    }

    public function serviceSave(Request $request)
    {
        // dd($request);
        $agserv = (new AgserviceServices())->agservAdd($request);

        return redirect('/admin/service/result/'.$request->fk_agency.'/'.$request->fk_ptj)->withSuccess('Berjaya Menambah Data');
    }

    public function serviceShow(Request $request)
    {
        $agency = (new AgserviceServices())->agensiSel($request);
        $ptj = (new AgserviceServices())->ptjSel($request);
        // $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $khidmat = (new KhidmatServices())->serviceList($request);
        $agserv = (new AgserviceServices())->agservResultShow($request);

      return view('admin::admin.serv.edit',compact('request','ptj','agency','khidmat','agserv'));
    }

    public function serviceUpd(Request $request)
    {
        $agserv = (new AgserviceServices())->agservUpd($request);

        return redirect('/admin/service/result/'.$request->fk_agency.'/'.$request->fk_ptj)->withSuccess('Berjaya Kemaskini Data');
    }


}
