<?php

namespace Workbench\Report\Http\Controllers;

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
use Workbench\Database\Model\Payment\Pelarasan;
use Workbench\Database\Model\User\Users;

class ReportPelarasanExcelController extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder,ShouldAutoSize,FromView //,WithDrawings
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

        $data = Pelarasan::with('agency','ptj','lkpperkhidmatan')
                        ->where(function ($query) use ($ads, $ade)
                        {
                            $query->where('tarikh_pelarasan', '>=', $ads)
                                ->where('tarikh_pelarasan', '<=', $ade);
                        })
                        ->get();

		return view('report::report.pelarasan.excel', compact('data', 'sd', 'ed'));
	}
}
