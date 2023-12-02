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
use Workbench\Admin\Service\ReportServices;
use Workbench\Database\Model\Payment\PaymentDetail;
use Workbench\Database\Model\Survey\SurveyForm;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\Users;


class ReportReceiptTypeExcelController extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder,ShouldAutoSize,FromView //,WithDrawings
{
	public function view() : View
	{
		$sd = request()->sdate;
		$ed = request()->edate;
		$ag = request()->agencyid;
		$pt = request()->ptjid;

        $now = Carbon::now();
        $user = Auth::user()->id;
        $userprofile = UserProfile::where('fk_users','=',$user)->with('userPtj','userAgency')->first();

		if($sd == 'start')
        {
            $ads = date('Y-m-d', strtotime('01-01-1970')) ;
        }
        else
        {
            $ads = date('Y-m-d', strtotime($sd)) ;
        }

		if($ed == 'end')
		{
			$ade = date('Y-m-d', strtotime(Carbon::now())) ;
		}
		else
		{
			$ade = date('Y-m-d', strtotime($ed)) ;
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

        $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkkodhasil.agency','fkkodhasil.ptj')
                            ->whereHas('fkpayment', function ($query)
                                {
                                    $query->where('status', 1);
                                })
                            ->whereHas('fkkodhasil.agency', function ($query) use ($ag)
                                {
                                    if($ag != '0')

                                        $query->where('id', '=', $ag);
                                    else
                                        $query;
                                })
                            ->whereHas('fkkodhasil.ptj', function ($query) use ($pt)
                                {
                                    if($pt != '0')

                                        $query->where('id', '=', $pt);
                                    else
                                        $query;
                                })
                            ->whereHas('fkpayment', function ($query) use ($ads, $ade)
                                {
                                    $query->where('transaction_date', '>=', $ads)
                                        ->where('transaction_date', '<=', $ade);
                                })
                            ->get();

        $query1 = "CALL prg_report_terimaan_jenis(".$ag.",".$pt.",'".$ads."', '".$ade."')";

        $tkh = DB::select($query1);

        $query2 = "CALL prg_report_terimaan_jenis_fpxcard(".$ag.",".$pt.",'".$ads."', '".$ade."')";

        $fpxcard = DB::select($query2);


		return view('report::report.receipttype.excel', compact('data', 'sd', 'ed','now','userprofile','tkh','fpxcard'));
	}
}
