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
use Workbench\Admin\Service\PtjServices;
use Workbench\Admin\Service\AgencyServices;

class PtjController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- ADMIN - see all PTJ ------------------- //

    public function ptjList(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        $ptj = (new PtjServices())->pusatList($request);
        $agency = (new AgencyServices())->agensiList($request);

        return view('admin::admin.ptj.listresult',compact('ptj','agency','request'));
    }

    public function adminList(Request $request)
    {
        // dd($request);
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        $userprofile = (new PtjServices())->userList($request);
        $ptj = (new PtjServices())->adminptjList($request);
        $agency = (new AgencyServices())->agensiList($request);

        return view('admin::admin.ptj.list',compact('ptj','agency','request', 'userprofile', 'roleid','request'));
    }

    public function show(Request $request)
    {
        // dd($request);
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        $userprofile = (new PtjServices())->userList($request);
        // $ptj = (new PtjServices())->listing($request);

        // $agency = (new AgencyServices())->agensiList($request);
        $agency = (new AgencyServices())->ptjSel($request);
        // dump($agency);
        $ptj = $agency->ptj;
        // dd($agency, $ptj);

        return view('admin::admin.ptj.list',compact('agency','request', 'userprofile', 'roleid','request','ptj'));
    }


    // ------------------- Agensi/PTJ ------------------- //

    public function ptjagensiList(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;
        // dd($roleid);


        $userprofile = (new PtjServices())->userList($request);
        $ptj = (new PtjServices())->pusatagensiList($request);
        // dd($ptj);
        $agency = (new AgencyServices())->agensiList($request);
        // dd($agency);

        return view('admin::admin.ptj.list',compact('ptj','agency','request', 'userprofile', 'roleid'));
    }

    public function ptjagensiAdd(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        $agency = (new AgencyServices())->agensiEditPtj($request);
        $ptj = (new PtjServices())->ptjSelect($request);
        // dd($ptj);

        return view('admin::admin.ptj.add',compact('request','agency','ptj','roleid'));
    }

    public function ptjagensiSave(Request $request)
    {
        // dd($request);exit;
        $ptj = (new PtjServices())->pusatagensiAdd($request);
        $agency = (new AgencyServices())->agensiEdit($request);

        return redirect('/admin/agency/ptj/list')->withSuccess('Berjaya Menambah Data');
    }

    public function ptjagensiEdit(Request $request)
    {
        //   dd($request->ptjid);
        $ptj = (new PtjServices())->pusatagensiShow($request);
        // dd($ptj);
        $agency = (new AgencyServices())->agensiEditPtj($request);
        $merchant = (new PtjServices())->getMerchant($request);
        $lkpptj = (new PtjServices())->getPtjList($request);
        $lkpbank = (new PtjServices())->getbankSelId($request);
        $getlkpbank = (new PtjServices())->getbank($request);

        // dd($lkpptj);

        return view('admin::admin.ptj.edit',compact('ptj','agency','merchant','lkpptj','lkpbank','request', 'getlkpbank'));
    }

    public function ptjagensiUpd(Request $request)
    {
      $ptj = (new PtjServices())->pusatagensiUpd($request);

      return redirect('/admin/agency/ptj/show/'.$request->fk_agency)->withSuccess('Berjaya Kemaskini Data');
    }

    public function getLkpPtjList(Request $request)
    {
        $ptj = (new PtjServices())->getlkpptjlist($request);
        // dd($ptj);

        return view('admin::admin.ptj.ajax.ptj',compact('ptj'));
    }

    public function getKodPtj(Request $request)
    {
        $kod = (new PtjServices())->getkodSel($request);
        $lkpbank = (new PtjServices())->getbank($request);
        // dd($kod);

        return view('admin::admin.ptj.ajax.kod',compact('kod','lkpbank'));
    }

    public function getKodSwift(Request $request)
    {
        $lkpbank = (new PtjServices())->getbankSel($request);

        return view('admin::admin.ptj.ajax.swiftbank',compact('lkpbank'));
    }



}
