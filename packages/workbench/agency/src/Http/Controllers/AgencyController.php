<?php

namespace Workbench\Agency\Http\Controllers;

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
use Illuminate\Support\Facades\Auth;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\KhidmatServices;
use Workbench\Database\Model\Agency\Tetapan;

class AgencyController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Service Handyman--------------- //

    public function serviceList(Request $request)
    {

        $srv = (new AgencyServices())->srvList($request);

        return view('agency::service.list', compact('srv'));
    }

    public function serviceForm(Request $request)
    {
        $srv = (new AgencyServices())->srvList($request);
        $lkpservicetype = (new AgencyServices())->lkpserviceType($request);

        return view('agency::service.add', compact('srv','lkpservicetype'));
    }

    public function serviceSave(Request $request)
    {
        $srv = (new AgencyServices())->srvAdd($request);

        return redirect('/handyman/service/list')->withSuccess('Add Data Successfully');
    }

    public function serviceShow(Request $request)
    {
        $viewsrv = (new AgencyServices())->srvView($request);
        $lkpservicetype = (new AgencyServices())->lkpserviceType($request);

    return view('agency::service.edit',compact('viewsrv','lkpservicetype'));
    }

    public function serviceUpdate(Request $request)
    {
        $srv = (new AgencyServices())->srvUpd($request);

        return redirect('/handyman/service/list')->withSuccess('Successfully Update');
    }

    public function serviceDelete(Request $request)
    {
        $srv = (new AgencyServices())->srvDelete($request);

        return redirect('/handyman/service/list')->withSuccess('Successfully Delete');
    }


    // ------------------- Promotion Handyman--------------- //

    public function promotionList(Request $request)
    {

        $promo = (new AgencyServices())->promoList($request);

        return view('agency::promotion.list', compact('promo'));
    }

    public function promotionForm(Request $request)
    {
        $promo = (new AgencyServices())->promoList($request);

        return view('agency::promotion.add', compact('promo'));
    }

    public function promotionSave(Request $request)
    {
        $promo = (new AgencyServices())->promoAdd($request);

        return redirect('/handyman/promotion/list')->withSuccess('Add Data Successfully');
    }

    public function promotionShow(Request $request)
    {
        $viewpromo = (new AgencyServices())->promoView($request);

    return view('agency::promotion.edit',compact('viewpromo'));
    }

    public function promotionUpdate(Request $request)
    {
        $promo = (new AgencyServices())->promoUpd($request);

        return redirect('/handyman/promotion/list')->withSuccess('Successfully Update');
    }

    public function promotionDelete(Request $request)
    {
        $promo = (new AgencyServices())->promoDelete($request);

        return redirect('/handyman/promotion/list')->withSuccess('Successfully Delete');
    }










































    







     // ------------------- PTJ Tetapan ------------------- //

    public function tetapanList(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $agency = (new AgencyServices())->agencyRole($request);
        $ptj = (new AgencyServices())->ptjRole($request);
        $ttp = (new AgencyServices())->ttpList($request);

        return view('agency::tetapan.list', compact('agency','ptj','ttp','roleid'));
    }

    public function getAjaxTetapan(Request $request) {

		$data = (new AgencyServices())->resultAjaxTetapan($request);

        return view('agency::tetapan.ajax',compact('data'));
    }

    public function ajaxTetapanPtj(Request $request)
    {
        $ptj = (new AgencyServices())->ptjRole($request);

        return view('agency::tetapan.ptj',compact('ptj'));
    }

    public function getTetapanPtj(Request $request)
    {
        $ptj = (new AgencyServices())->ptjRole($request);

        return view('agency::tetapan.ptjtetapan',compact('ptj'));
    }

    public function getTetapanHasil (Request $request)
    {
        $hasil = (new AgencyServices())->hasilRole($request);

        return view('agency::tetapan.hasiltetapan',compact('hasil'));
    }

    public function tetapanForm(Request $request)
    {
        $agency = (new AgencyServices())->agencyRole($request);
        $ptj = (new AgencyServices())->ptjRole($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $lkpmaster = (new AgencyServices())->jenisList($request);

        return view('agency::tetapan.add', compact('khidmat','lkpmaster','agency','ptj'));
    }

    public function tetapanSave(Request $request)
    {
      $ttp = (new AgencyServices())->ttpAdd($request);

      return redirect('/ptj/tetapan/list')->withSuccess('Berjaya Menambah Data');
    }

    public function tetapanShow(Request $request)
    {

        $khidmat = (new AgencyServices())->khidmatsel($request);
        $lkpmaster = (new AgencyServices())->jenisList($request);
        $ttp = (new AgencyServices())->ttpSel($request);

        return view('agency::tetapan.edit',compact('ttp','khidmat','lkpmaster'));
    }

    public function tetapanUpdate(Request $request)
    {
        // dd($request);
      $ttp = (new AgencyServices())->ttpUpdate($request);

      return redirect('/ptj/tetapan/list')->withSuccess('Berjaya');
    }


    // ------------------- Perkhidmatan dan Kadar Bayaran ----ptjRole--------------- //


    public function servicerateList(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $agency = (new AgencyServices())->agencyRole($request);
        $ptj = (new AgencyServices())->ptjRole($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $servrate = (new AgencyServices())->servrateList($request);

        return view('agency::servicerate.list', compact('agency','ptj','roleid','khidmat','servrate'));
    }

    public function getAjaxServiceRate(Request $request) {

		$data = (new AgencyServices())->resultAjaxServiceRate($request);

        return view('agency::servicerate.ajax',compact('data'));
    }

    public function ajaxServiceRatePtj(Request $request)
    {
        $ptj = (new AgencyServices())->ptjRole($request);

        return view('agency::servicerate.ptj',compact('ptj'));
    }

    public function ajaxKhidmatPtj(Request $request)
    {
        $ptj = (new AgencyServices())->ptjRole($request);

        return view('agency::servicerate.ptjkhidmat',compact('ptj'));
    }

    public function ajaxKhidmatHasil(Request $request)
    {
        $hasil = (new AgencyServices())->hasilRole($request);

        return view('agency::servicerate.hasilkhidmat',compact('hasil'));
    }

    public function mgtForm(Request $request)
    {
        $agency = (new AgencyServices())->agencyRole($request);
        $ptj = (new AgencyServices())->ptjRole($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $hasil = (new AgencyServices())->hasilRole($request);

        return view('agency::servicerate.addMgt', compact('agency','ptj','khidmat','hasil'));
    }

    public function mgtSave(Request $request)
    {
      $mgt = (new AgencyServices())->mgtAdd($request);

      return redirect('/ptj/servicerate/list')->withSuccess('Berjaya Menambah Data');
    }

    public function mgtShow(Request $request)
    {
        $agency = (new AgencyServices())->agencyRole($request);
        $ptj = (new AgencyServices())->ptjRole($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        $hasil = (new AgencyServices())->hasilList($request);
        $servrate = (new AgencyServices())->mgtresultShow($request);
        // dd($servrate);

      return view('agency::servicerate.editMgt',compact('request','agency','ptj','khidmat','hasil','servrate'));
    }

    public function mgtUpd(Request $request)
    {
        $mgt = (new AgencyServices())->mgtUpd($request);

        return redirect('/ptj/servicerate/list')->withSuccess('Berjaya Kemaskini Data');
    }

     // ------------------- Kadar Bayaran ------------------- //

    public function kadarList(Request $request)
    {
        $servrate = (new AgencyServices())->servrateList($request);
        $kadar = (new AgencyServices())->kdrSel($request);

        return view('agency::servicerate.listkadar', compact('servrate','kadar'));
    }

    public function kadarForm(Request $request)
    {
        $servrate = (new AgencyServices())->servratelistResult($request);
        $category = (new AgencyServices())->catSel($request);
        $unit = (new AgencyServices())->unitSel($request);
        $kadar = (new AgencyServices())->kdrResult($request);

        return view('agency::servicerate.add', compact('servrate','category','unit','kadar'));
    }

    public function kadarSave(Request $request)
    {
        $kadar = (new AgencyServices())->kdrAdd($request);

        return redirect('/ptj/servicerate/listkadar/'.$request->service_rate_mgt)->withSuccess('Berjaya Menambah Data');
    }

    public function kadarShow(Request $request)
    {
        $servrate = (new AgencyServices())->servratelistResult($request);
        $category = (new AgencyServices())->catSel($request);
        $unit = (new AgencyServices())->unitSel($request);
        $kadar = (new AgencyServices())->kdrshowId($request);

      return view('agency::servicerate.edit',compact('servrate','category','unit','kadar'));
    }

    public function kadarUpd(Request $request)
    {
        $kadar = (new AgencyServices())->kdrUpd($request);

        return redirect('/ptj/servicerate/listkadar/'.$request->service_rate_mgt)->withSuccess('Berjaya Kemaskini Data');
    }

    // ------------------- Kod Hasil--------------- //

    public function kodhasilList(Request $request)
    {

        $kdh = (new AgencyServices())->kdhList($request);

        return view('agency::kodhasil.list', compact('kdh'));
    }

    public function kodhasilForm(Request $request)
    {
        $khidmat = (new AgencyServices())->khidmatList($request);

        return view('agency::kodhasil.add', compact('khidmat'));
    }

    public function kodhasilSave(Request $request)
    {
        $kdh = (new AgencyServices())->kdhAdd($request);

        return redirect('/ptj/kodhasil/list')->withSuccess('Berjaya Menambah Data');
    }

    public function kodhasilShow(Request $request)
    {
        $khidmat = (new AgencyServices())->khidmatList($request);
        // $kdh = (new AgencyServices())->kdhResult($request);
        $kdh = (new AgencyServices())->kodhasilShow($request);
        // dd($kdh);

      return view('agency::kodhasil.edit',compact('khidmat','kdh'));
    }

    public function kodhasilUpdate(Request $request)
    {
        $kdh = (new AgencyServices())->kdhUpd($request);

        return redirect('/ptj/kodhasil/list')->withSuccess('Berjaya Kemaskini Data');
    }

    // ------------------- Kod Hasil Detail --------------- //

    public function detailList(Request $request)
    {
        $kdhd = (new AgencyServices())->kdhdList($request);
        // dump($kdhd);
        return view('agency::kodhasil.listdetail', compact('kdhd'));
    }

    public function detailForm(Request $request)
    {
        $khidmat = (new AgencyServices())->khidmatList($request);
        $hasil = (new AgencyServices())->hasilList($request);
        $kdh = (new AgencyServices())->kodhasilShow($request);

        return view('agency::kodhasil.adddetail', compact('khidmat','hasil','kdh'));
    }

    public function detailSave(Request $request)
    {
        $kdhd = (new AgencyServices())->kdhdAdd($request);

        return redirect('/ptj/kodhasil/listdetail/'.$request->fk_service_kod_hasil)->withSuccess('Berjaya Menambah Data');
    }

    public function detailShow(Request $request)
    {
        $khidmat = (new AgencyServices())->khidmatList($request);
        $hasil = (new AgencyServices())->hasilList($request);
        $kdhd = (new AgencyServices())->kodhasilShow($request);
        // dd($khidmat, $kdhd);
        $servicekodhasildetail = (new AgencyServices())->kodhasildetailShow($request);

      return view('agency::kodhasil.editdetail',compact('khidmat','hasil','kdhd','servicekodhasildetail'));
    }

    public function detailUpdate(Request $request)
    {
        $kdhd = (new AgencyServices())->kdhdUpd($request);
        // $kdhd = (new AgencyServices())->kdhdUpd($request);

        return redirect('/ptj/kodhasil/listdetail/'.$request->skhid)->withSuccess('Berjaya Kemaskini Data');
    }

    public function ptjKadarList(Request $request)
    {
        $kadar = (new AgencyServices())->ptjKadarList($request);


        return view('agency::servicerate.agency.list',compact('kadar'));

    }


}
