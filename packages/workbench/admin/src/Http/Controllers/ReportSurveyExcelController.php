<?php

namespace Workbench\Admin\Http\Controllers;

use Auth;
use DB;
use Event;
use File;
use Mail;
use PDF;
use Redirect;

use Illuminate\Contracts\View\View;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Workbench\Database\Model\Survey\SurveyForm;
use Workbench\Database\Model\User\Users;

class ReportSurveyExcelController extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder,ShouldAutoSize,FromView //,WithDrawings
{
	public function view() : View
	{
		$sd = request()->sdate;
		$ed = request()->edate;

		if($sd == 'start')
        {
            $ads = date('Y-m-d 00:00:00', strtotime('01-01-1970')) ;
        }
        else
        {
            $ads = date('Y-m-d 00:00:00', strtotime($sd)) ;
        }

		if($ed == 'end')
		{
			$ade = date('Y-m-d 23:59:59', strtotime(Carbon::now())) ;
		}
		else
		{
			$ade = date('Y-m-d 23:59:59', strtotime($ed)) ;
		}

        $data = SurveyForm::with('user','survey')
                            ->where(function ($query) use ($ads, $ade)
                            {
                                $query->where('created_at', '>=', $ads)
                                    ->where('created_at', '<=', $ade);
                            })
                            ->get();

		return view('admin::admin.report.survey.excel', compact('data', 'sd', 'ed'));
	}
}
