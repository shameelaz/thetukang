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
use Workbench\Admin\Service\PtjServices;
use Workbench\Admin\Service\KhidmatServices;
use Workbench\Admin\Service\HasilServices;
use Workbench\Admin\Service\LiabilitiServices;
use Workbench\Database\Model\Agency\Agency;

class LiabilitiController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Liabiliti ------------------- //

    public function liabilitiList(Request $request)
    {
        $agency = (new AgencyServices())->agensiList($request);
        $ptj = (new PtjServices())->pusatList($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $lia = (new LiabilitiServices())->liaList($request);
        // dd($lia);

      return view('admin::admin.liabiliti.list',compact('ptj','agency','khidmat','lia','request'));
    }

    public function liabilitiPtjAjax(Request $request)
    {
        $ptj = (new LiabilitiServices())->ptjResult($request);

        return view('admin::admin.liabiliti.ajax.ptj', compact('ptj'));
    }

    public function liabilitiAjax(Request $request)
    {
        $lia = (new LiabilitiServices())->liaResult($request);

        return view('admin::admin.liabiliti.ajax.result', compact('lia'));
    }


    // ------------------- Agensi/PTJ/Liabiliti ------------------- //

    public function liabilitiResult(Request $request)
    {
        $agency = (new AgencyServices())->agensiList($request);
        $ptj = (new LiabilitiServices())->ptjList($request);
        $lia = (new LiabilitiServices())->liaResultList($request);

        return view('admin::admin.liabiliti.result',compact('ptj','agency','lia','request'));
    }

    public function liabilitiForm(Request $request)
    {
        $agency = (new LiabilitiServices())->agensiSel($request);
        $ptj = (new LiabilitiServices())->ptjSel($request);
        $khidmat = (new HasilServices())->kdhasilResultList($request);
        $lia = (new LiabilitiServices())->liaResultList($request);

        return view('admin::admin.liabiliti.add',compact('ptj','agency','lia','request','khidmat'));
    }

    public function liabilitiSave(Request $request)
    {
      $lia = (new LiabilitiServices())->liaAdd($request);

      return redirect('/admin/liabiliti/result/'.$request->fk_agency.'/'.$request->fk_ptj)->withSuccess('Berjaya Menambah Data');
    }

    public function liabilitiShow(Request $request)
    {
        $agency = (new LiabilitiServices())->agensiSel($request);
        $ptj = (new LiabilitiServices())->ptjSel($request);
        $khidmat = (new HasilServices())->kdhasilResultList($request);
        $lia = (new LiabilitiServices())->liaResultShow($request);

      return view('admin::admin.liabiliti.edit',compact('request','ptj','agency','khidmat','lia'));
    }

    public function liabilitiUpd(Request $request)
    {
        $lia = (new LiabilitiServices())->liaUpd($request);

        return redirect('/admin/liabiliti/result/'.$request->fk_agency.'/'.$request->fk_ptj)->withSuccess('Berjaya Kemaskini Data');
    }

    public function getAjaxLiabiliti(Request $request) {

		$data = (new LiabilitiServices())->resultAjaxLiabiliti($request);

        return view('admin::admin.liabiliti.ajax',compact('data'));
    }

    public function ajaxLiabilitiPtj(Request $request)
    {
        $ptj = (new LiabilitiServices())->ptjRole($request);

        return view('admin::admin.liabiliti.ajax.ptj',compact('ptj'));
    }

    public function getLiabilitiPtj(Request $request)
    {
        $ptj = (new LiabilitiServices())->ptjRole($request);

        return view('admin::admin.liabiliti.ptjliabiliti',compact('ptj'));
    }



}
