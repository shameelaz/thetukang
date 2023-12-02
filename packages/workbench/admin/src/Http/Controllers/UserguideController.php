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
use Workbench\Database\Model\Lkp\LkpPerkhidmatan;

class UserguideController extends Controller
{


    public function __construct()
    {

    }


    public function userpdfList(Request $request)
    {
        $usrpdf = (new UserguideServices())->pdfList($request);

		return view('admin::admin.userpdf.list', compact('usrpdf'));

    }

    public function userpdfForm(Request $request)
    {
        $agency = (new AgencyServices())->agensiList($request);
        $khidmat = (new KhidmatServices())->perkhidmatanList($request);
        // $usrpdf = (new UserguideServices())->pdfAdd($request);

        return view('admin::admin.userpdf.add',compact('agency','request','khidmat'));
    }


    public function ajaxKhidmat(Request $request)
    {
        $khidmat = (new UserguideServices())->getKhidmat($request);

        return view('admin::admin.userpdf.khidmat',compact('khidmat'));
    }

    public function userpdfSave(Request $request)
    {
        // dd($request);
        $request->validate([
                'fail' => 'required|mimes:pdf|max:5048',
            ],
            [
                'fail.required' => 'Perlu upload pdf ',
                'fail.mimes' => 'Hanya format pdf sahaja yang boleh dimuatnaik',
                'fail.max' => 'Saiz mestilah tidak lebih dari 2MB',
            ]
        );

        $usrpdf = (new UserguideServices())->pdfAdd($request);

        return redirect('/admin/userpdf/list')->withSuccess('Berjaya Menambah Data');
    }

    public function userpdfShow(Request $request)
    {
        // dd($request);
        $agency = (new AgencyServices())->agensiList($request);
        // $khidmat = (new UserguideServices())->khidmatSel($request);
        $khidmat = (new UserguideServices())->perkhidmatanSelect($request);
        $usrpdf = (new UserguideServices())->pdfShow($request);

        // dump($agency);dd($usrpdf);

        return view('admin::admin.userpdf.edit',compact('request','agency','usrpdf','khidmat'));
    }

    public function userpdfUpd(Request $request)
    {
        $usrpdf = (new UserguideServices())->pdfUpd($request);

        return redirect('/admin/userpdf/list')->withSuccess('Berjaya Kemaskini Data');
    }






}
