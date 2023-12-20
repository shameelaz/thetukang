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
use Workbench\Admin\Service\AdminServices;



class AdminController extends Controller
{


    public function __construct()
    {

    }


    public function index()
    {
      // dd('sini');
		  return view('admin::admin.index');


    }

    // ------------------- Lookup Service Type ------------------- //
    public function servicetypeList(Request $request)
    {
      $srvtype = (new AdminServices())->srvtypeList($request);

      return view('admin::admin.srvtype.list', compact('srvtype'));
    }

    public function servicetypeAdd(Request $request)
    {
      $srvtype = (new AdminServices())->srvtypeList($request);

      return view('admin::admin.srvtype.add', compact('srvtype'));
    }

    public function servicetypeSave(Request $request)
    {
      $srvtype = (new AdminServices())->srvtypeAdd($request);

      return redirect('/admin/servicetype/list')->withSuccess('Add Data Successfully');
    }

    public function servicetypeEdit(Request $request)
    {
        $viewsrvtype = (new AdminServices())->srvtypeView($request);

    return view('admin::admin.srvtype.edit',compact('viewsrvtype'));
    }

    public function servicetypeUpd(Request $request)
    {
        $srvtype = (new AdminServices())->srvtypeUpd($request);

        return redirect('/admin/servicetype/list')->withSuccess('Successfully Update');
    }

    public function servicetypeDelete(Request $request)
    {
        $srvtype = (new AdminServices())->srvtypeDelete($request);

        return redirect('/admin/servicetype/list')->withSuccess('Successfully Delete');
    }


    // ------------------- Lookup Rating ------------------- //
    public function ratingList(Request $request)
    {
      $rate = (new AdminServices())->rateList($request);

      return view('admin::admin.rating.list', compact('rate'));
    }

    public function ratingAdd(Request $request)
    {
      $rate = (new AdminServices())->rateList($request);

      return view('admin::admin.rating.add', compact('rate'));
    }

    public function ratingSave(Request $request)
    {
      $rate = (new AdminServices())->rateAdd($request);

      return redirect('/admin/rating/list')->withSuccess('Add Data Successfully');
    }

    public function ratingEdit(Request $request)
    {
        $viewrate = (new AdminServices())->rateView($request);

    return view('admin::admin.rating.edit',compact('viewrate'));
    }

    public function ratingUpd(Request $request)
    {
        $rate = (new AdminServices())->rateUpd($request);

        return redirect('/admin/rating/list')->withSuccess('Successfully Update');
    }

    public function ratingDelete(Request $request)
    {
        $rate = (new AdminServices())->rateDelete($request);

        return redirect('/admin/rating/list')->withSuccess('Successfully Delete');
    }


    


}
