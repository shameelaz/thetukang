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
use Barryvdh\DomPDF\Facade\Pdf;
use Mail;
use Curl;
use Laravolt\Suitable\Columns\Raw;
use Maatwebsite\Excel\Facades\Excel;
use Svg\Tag\Rect;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\ReportServices;
use Workbench\Admin\Service\UserServices;

class ReportController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Laporan Senarai Pengguna ------------------- //

    public function userList(Request $request)
    {
        $user = (new ReportServices())->user($request);
        $agency = (new AgencyServices())->agensiList($request);
        $role = (new UserServices())->roleSel($request);
        // dd($role);

      return view('admin::admin.report.user.list',compact('user','agency','role'));
    }

    public function getAjaxUser(Request $request) {

		$data = (new ReportServices())->resultAjaxUser($request);

		// return compact('data');

        return view('admin::admin.report.user.ajax',compact('data'));

    }

    public function getExportUser(Request $request)
	{
		$now = Carbon::now();

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->userPdf($request);

			// return view('admin::admin.report.user.pdf',compact('data', 'request'));

			$pdf = Pdf::loadView('admin::admin.report.user.pdf', compact('data', 'request'))->setPaper('a4', 'potrait');

			return $pdf->stream("Laporan_Senarai_Pengguna_".$now->format('d-M-y_His').".pdf");
		}
		elseif($request->exporttype=='2') // excel
		{
			$type="xlsx";

			return Excel::download(new ReportUserExcelController, "Laporan_Senarai_Pengguna_".$now->format('d-M-y_His').".".$type);
		}
		else
		{
			// dd('No Data');
		}
	}

    // ------------------- Laporan Kajian Kepuasan Pengguna ------------------- //

    public function surveyList(Request $request)
    {
        $survey = (new ReportServices())->survey($request);

        return view('admin::admin.report.survey.list',compact('survey'));
    }

    public function getAjaxSurvey(Request $request) {

		$data = (new ReportServices())->resultAjaxSurvey($request);

        return view('admin::admin.report.survey.ajax',compact('data'));
    }

    public function getExportSurvey(Request $request)
	{
		$now = Carbon::now();

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->surveyPdf($request);

			// return view('admin::admin.report.survey.pdf',compact('data', 'request'));

			$pdf = Pdf::loadView('admin::admin.report.survey.pdf', compact('data', 'request'))->setPaper('a4', 'potrait');

			return $pdf->stream("Laporan_Kajian_Kepuasan_Pengguna_".$now->format('d-M-y_His').".pdf");
		}
		elseif($request->exporttype=='2') // excel
		{
			$type="xlsx";

			return Excel::download(new ReportSurveyExcelController, "Laporan_Kajian_Kepuasan_Pengguna_".$now->format('d-M-y_His').".".$type);
		}
		else
		{
			// dd('No Data');
		}
	}




}
