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
use Laravolt\Platform\Models\Role;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Workbench\Database\Model\User\Users;

class ReportUserExcelController extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder,ShouldAutoSize,FromView //,WithDrawings
{
	public function view() : View
	{
		$sd = request()->sdate;
		$ed = request()->edate;
		$ro = request()->role;

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

        if($ro == 'rol')
        {
            $ro = '0';
        }
        else
        {
            $ro = request()->role;
        }

        $data = Users::with('role','profile.userAgency','profile.userPtj')
                     ->where(function ($query) use ($ads, $ade)
                     {
                        $query->where('email_verified_at', '>=', $ads)
                            ->where('email_verified_at', '<=', $ade);
                     })
                     ->whereHas('role', function ($query) use ($ro)
                     {
                         if($ro != '0')
                             $query->where('role_id', '=', $ro);
                         else
                             $query;
                     })
                     ->get();

        if ($ro = request()->role)
        {
            $role = Role::where('id', request()->role)
                        ->first();
        }


		return view('report::report.user.excel', compact('data', 'sd', 'ed', 'ro', 'role'));
	}
}
