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
use Workbench\Database\Model\Payment\PaymentDetail;
use Workbench\Database\Model\Payment\PenyataPemungutMain;
use Workbench\Database\Model\Survey\SurveyForm;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\Users;


class ReportPenyataPemungutExcelController extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder,ShouldAutoSize,FromView //,WithDrawings
{
	public function view() : View
	{
		$sd = request()->sdate;
		$ed = request()->edate;
        $ag = request()->agencyid;
		$pt = request()->ptjid;

        $now = Carbon::now();
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

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


        if( $ag == 'agen')
        {
            $ag = '0';
        }
        else
        {
            $ag = request()->agencyid;
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = request()->ptjid;
        }

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $data = PenyataPemungutMain::with('penyatapemungutdetail','agency','ptj')
                                        ->where('tarikh_pp', '>=', $ads)
                                        ->where('tarikh_pp', '<=', $ade)
                                        ->whereHas('agency', function ($query) use ($ag)
                                            {
                                                if($ag != '0')

                                                    $query->where('id', '=', $ag);
                                                else
                                                    $query;
                                            })
                                        ->whereHas('ptj', function ($query) use ($pt)
                                            {
                                                if($pt != '0')

                                                    $query->where('id', '=', $pt);
                                                else
                                                    $query;
                                            })
                                        ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $profile = UserProfile::where('fk_users',Auth::user()->id)->first();

            $data = PenyataPemungutMain::with('penyatapemungutdetail','agency','ptj')
                                        ->where('tarikh_pp', '>=', $ads)
                                        ->where('tarikh_pp', '<=', $ade)
                                        ->whereHas('agency', function ($query) use ($profile)
                                            {
                                                $query->where('id', '=', $profile->fk_agency);
                                            })
                                        ->whereHas('ptj', function ($query) use ($profile)
                                            {
                                                $query->where('id', '=', $profile->fk_ptj);
                                            })

                                        ->get();
        }

		return view('report::report.penyatapemungut.excel', compact('data','sd', 'ed','ag','pt','now','roleid'));
	}
}
