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
use Workbench\Admin\Service\BaseServices;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\KhidmatServices;
use Mail;
use Curl;



class FaqController extends Controller
{


    public function __construct()
    {

    }


    public function faqList(Request $request)
    {
        $agencyList = (new AgencyServices())->agensiList($request);
        $faq = (new BaseServices())->faqList($request);
		return view('admin::admin.faq.list',compact('faq','agencyList','request'));

    }

    public function faqAdd(Request $request)
    {
        $agencyList = (new AgencyServices())->agensiList($request);

		return view('admin::admin.faq.add',compact('agencyList','request'));

    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function getAgency(Request $request)
    {
      $faq = (new BaseServices())->faqGet($request);

      return view('admin::admin.faq.ajaxlist',compact('faq','request'));
    }


    public function form(Request $request)
    {

        $lkpperkhidmatan = (new KhidmatServices())->perkhidmatanSel($request);
        $agencyList = (new AgencyServices())->agensiList($request);
        //   dd($lkpperkhidmatan);

      return view('admin::admin.faq.add',compact('lkpperkhidmatan','agencyList','request'));
    }

    public function add(Request $request)
    {
      $faq = (new BaseServices())->save($request);

      return redirect('/admin/faq/list/'.$request->fk_agency)->withSuccess('Berjaya menambah data');
    }

    public function faqListAg(Request $request)
    {
      $agencyList = (new AgencyServices())->agensiList($request);
      $faq = (new BaseServices())->faqList($request);

      return view('admin::admin.faq.list',compact('faq','agencyList','request'));
    }

    public function faqSave(Request $request)
    {

      $faq = (new BaseServices())->save($request);
      return redirect('/admin/faq/list/'.$request->fk_agency)->withSuccess('Berjaya menambah data ');
    }

    public function faqShow(Request $request)
    {
      $faq = (new BaseServices())->faqShow($request);
      $agencyList = (new AgencyServices())->agensiList($request);
      $lkpperkhidmatan = (new KhidmatServices())->perkhidmatanSel($request);
    //   dd($lkpperkhidmatan);
      return view('admin::admin.faq.show',compact('faq','agencyList','lkpperkhidmatan'));
    }

    public function faqUpd(Request $request)
    {
    //   dd($request);
      $faq = (new BaseServices())->faqUpd($request);

      return redirect('/admin/faq/list/'.$request->fk_agency)->withSuccess('Berjaya mengemaskini data ');
    }




}
