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
use Auth;
use Workbench\Admin\Service\UserServices;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\PtjServices;
use Workbench\Admin\Service\KhidmatServices;
use Workbench\Admin\Service\HasilServices;
use Workbench\Database\Model\Agency\Agency;

class HasilController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Hasil ------------------- //

    public function hasilList(Request $request)
    {
        $agency = (new AgencyServices())->agensiList($request);
        $ptj = (new PtjServices())->pusatList($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $hasil = (new HasilServices())->kdhasilList($request);

      return view('admin::admin.hasil.list',compact('ptj','agency','khidmat','hasil','request'));
    }

    public function hasilResult(Request $request)
    {
        $agency = (new AgencyServices())->agensiList($request);
        $ptj = (new HasilServices())->ptjList($request);
        $hasil = (new HasilServices())->kdhasilResultList($request);

        return view('admin::admin.hasil.result',compact('ptj','agency','hasil','request'));
    }

    public function hasilPtjAjax(Request $request)
    {
        $ptj = (new HasilServices())->ptjResult($request);

        return view('admin::admin.hasil.ajax.ptj', compact('ptj'));
    }

    public function hasilAjax(Request $request)
    {
        $hasil = (new HasilServices())->kdhasilResult($request);

        return view('admin::admin.hasil.ajax.result', compact('hasil'));
    }

    public function hasilForm(Request $request)
    {
        $agency = (new HasilServices())->agensiSel($request);
        $ptj = (new HasilServices())->ptjSel($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $lkpkodhasil = (new HasilServices())->lkpkodhasil($request);

        // dd($hasil);
        return view('admin::admin.hasil.add',compact('ptj','agency','request','khidmat','lkpkodhasil'));
    }

    public function hasilSave(Request $request)
    {
      $hasil = (new HasilServices())->kdhasilAdd($request);

      return redirect('/admin/hasil/result/'.$request->fk_agency.'/'.$request->fk_ptj)->withSuccess('Berjaya Menambah Data');
    }

    public function hasilShow(Request $request)
    {
        $agency = (new HasilServices())->agensiSel($request);
        $ptj = (new HasilServices())->ptjSel($request);
        $khidmat = (new HasilServices())->kdhasilResultList($request);
        $hasil = (new HasilServices())->kdhasilResultShow($request);
        $lkpkodhasil = (new HasilServices())->lkpkodhasil($request);

      return view('admin::admin.hasil.edit',compact('request','ptj','agency','khidmat','hasil','lkpkodhasil'));
    }

    public function hasilUpd(Request $request)
    {
        $hasil = (new HasilServices())->kdhasilUpd($request);

        return redirect('/admin/hasil/result/'.$request->fk_agency.'/'.$request->fk_ptj)->withSuccess('Berjaya Kemaskini Data');
    }

    public function getAjaxHasil(Request $request) {

		$data = (new HasilServices())->resultAjaxHasil($request);

        return view('admin::admin.hasil.ajax',compact('data'));
    }

    public function ajaxHasilPtj(Request $request)
    {
        $ptj = (new HasilServices())->ptjRole($request);

        return view('admin::admin.hasil.ajax.ptj',compact('ptj'));
    }

    public function getHasilPtj(Request $request)
    {
        $ptj = (new HasilServices())->ptjRole($request);

        return view('admin::admin.hasil.ptjhasil',compact('ptj'));
    }


}
