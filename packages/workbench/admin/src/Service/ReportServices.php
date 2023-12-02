<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\AclRoleUser;
use Workbench\Database\Model\User\APermission;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\UserRoles;
use Workbench\Database\Model\Base\BaseInfo;
use Workbench\Database\Model\Base\HubungiKami;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Overdrive\Web\Model\Menus;
use Overdrive\Web\Model\Mpermission;
use Overdrive\Web\Model\ARole;
use Overdrive\Web\Model\Urole;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Session;
use App;
use Config;
use Auth;
use File;
use Redirect;
use Mail;
use Curl;
use DB;
use Laravolt\Platform\Models\Role;
use Workbench\Database\Model\Agency\Ptj;
use Workbench\Database\Model\Payment\PaymentDetail;
use Workbench\Database\Model\Payment\Pelarasan;
use Workbench\Database\Model\Payment\PenyataPemungutMain;
use Workbench\Database\Model\Survey\Survey;
use Workbench\Database\Model\Survey\SurveyForm;
use Workbench\Database\Model\View\Report\VWReportTerimaanJenis;
use Workbench\Database\Model\View\Report\VWReportTerimaanJenisFpxCard;

class ReportServices
{


    // ------------------- Laporan Terimaan Harian/ Bulanan ------------------- //

    public function terimaan(Request $request)
    {

        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $receipt = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkpayment.fkpaymentgateway','fkkodhasil.agency','fkkodhasil.ptj')
                                    ->whereHas('fkpayment', function ($query) use ($request)
                                        {
                                            $query->where('status', 1);
                                        })
                                    ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $profile = UserProfile::where('fk_users',Auth::user()->id)->first();


            $receipt = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkpayment.fkpaymentgateway','fkkodhasil.agency','fkkodhasil.ptj')
                                    ->whereHas('fkkodhasil', function ($query) use ($profile)
                                        {
                                            $query->where('fk_agency', '=', $profile->fk_agency);
                                        })
                                    ->whereHas('fkkodhasil', function ($query) use ($profile)
                                        {
                                            $query->where('fk_ptj', '=', $profile->fk_ptj);
                                        })
                                    ->whereHas('fkpayment', function ($query)
                                        {
                                            $query->where('status', 1);
                                        })
                                    ->get();

        }

        return $receipt;
    }

    public function agencySel(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;

        if($roleid==4 || $roleid==5){

            $useragency=UserProfile::where('fk_users',$user)->first();
            $data_useragency=data_get($useragency,'fk_agency');

            $agency = Agency::find($data_useragency);

        }
        else
        {
            $agency = Agency::with('ptj','profile','role')->get();
        }

       return $agency;
    }

    public function ptjSel(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;

        if($roleid==4 || $roleid==5){

            $userptj=UserProfile::where('fk_users',$user)->first();
            $data_ptj=data_get($userptj,'fk_ptj');
            $ptj = Ptj::find($data_ptj);

        }
        else
        {
            if($request->agencyid)
            {
                $ptj = Ptj::where('fk_agency',$request->agencyid)->get();
            }
            else
            {
                $ptj = Ptj::get();
            }
        }

        return $ptj;
    }

    public function resultAjaxReceipt($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkpayment.fkpaymentgateway','fkkodhasil.agency','fkkodhasil.ptj')
                            ->whereHas('fkpayment', function ($query) use ($request)
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

		return $data;

	}

    public function receiptPdf($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkpayment.fkpaymentgateway','fkkodhasil.agency','fkkodhasil.ptj')
                            ->whereHas('fkpayment', function ($query) use ($request)
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

		return $data;

	}

    // ------------------- Laporan Terimaan Harian/ Bulanan Mengikut Jenis ------------------- //

    public function terimaanJenis(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $receipttype = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkpayment.fkpaymentgateway','fkkodhasil.agency','fkkodhasil.ptj')
                                    ->whereHas('fkpayment', function ($query) use ($request)
                                        {
                                            $query->where('status', 1);
                                        })
                                    ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $profile = UserProfile::where('fk_users',Auth::user()->id)->first();


            $receipttype = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkpayment.fkpaymentgateway','fkkodhasil.agency','fkkodhasil.ptj')
                                    ->whereHas('fkkodhasil', function ($query) use ($profile)
                                        {
                                            $query->where('fk_agency', '=', $profile->fk_agency);
                                        })
                                    ->whereHas('fkkodhasil', function ($query) use ($profile)
                                        {
                                            $query->where('fk_ptj', '=', $profile->fk_ptj);
                                        })
                                    ->whereHas('fkpayment', function ($query)
                                        {
                                            $query->where('status', 1);
                                        })
                                    ->get();

        }


        return $receipttype;
    }

    public function resultAjaxReceiptType($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkkodhasil.agency','fkkodhasil.ptj')
                            ->whereHas('fkpayment', function ($query) use ($request)
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

		return $data;

	}

    public function receipttypePdf($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
        $ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkkodhasil.agency','fkkodhasil.ptj')
                            ->whereHas('fkpayment', function ($query) use ($request)
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

		return $data;

	}

    public function ringkasanPdf($request)
    {
        $sd = data_get($request, 'sdate');
        $ed = data_get($request, 'edate');
        $ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        // dd($ag, 'adssad');exit;

        // $tkh = VWReportTerimaanJenis::with('fkagency','fkptj')
        //                             ->whereHas('fkagency', function ($query) use ($ag)
        //                                 {
        //                                     if($ag != 'id')

        //                                         $query->where('id', '=', $ag);
        //                                     else
        //                                         $query;
        //                                 })
        //                             ->whereHas('fkptj', function ($query) use ($pt)
        //                                 {
        //                                     if($pt != 'id')

        //                                         $query->where('id', '=', $pt);
        //                                     else
        //                                         $query;
        //                                 })
        //                             ->where('transaction_date', '>=', $ads)
        //                             ->where('transaction_date', '<=', $ade)
        //                             ->get();

        $query = "CALL prg_report_terimaan_jenis(".$ag.",".$pt.",'".$ads."', '".$ade."')";
        // dd($ads, $ade);

        $tkh = DB::select($query);

        return $tkh;

    }

    public function fpxcardPdf($request)
	{
        $sd = data_get($request, 'sdate');
        $ed = data_get($request, 'edate');
        $ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            // dd('atas');exit;
            $ag = '0';
        }
        else
        {
            // dd('else');exit;
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        // $fpxcard = VWReportTerimaanJenisFpxCard::with('fkagency','fkptj')
        //                                         ->whereHas('fkagency', function ($query) use ($ag)
        //                                             {
        //                                                 if($ag != 'id')

        //                                                     $query->where('id', '=', $ag);
        //                                                 else
        //                                                     $query;
        //                                             })
        //                                         ->whereHas('fkptj', function ($query) use ($pt)
        //                                             {
        //                                                 if($pt != 'id')

        //                                                     $query->where('id', '=', $pt);
        //                                                 else
        //                                                     $query;
        //                                             })
        //                                         ->where('transaction_date', '>=', $ads)
        //                                         ->where('transaction_date', '<=', $ade)
        //                                         ->get();

        $query = "CALL prg_report_terimaan_jenis_fpxcard(".$ag.",".$pt.",'".$ads."', '".$ade."')";

        $fpxcard = DB::select($query);

        // dd($fpxcard);

		return $fpxcard;

	}

    // ------------------- Laporan Buku Tunai Harian/ Bulanan ------------------- //

    public function bukuTunai(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $book = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkkodhasil.agency','fkkodhasil.ptj','fkpayment.fkpaymentgateway','fkpenyatapemungutdetail.penyatapemungutmain')
                                ->whereHas('fkpayment', function ($query) use ($request)
                                    {
                                    $query->where('status', 1);
                                    })
                                ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $profile = UserProfile::where('fk_users',Auth::user()->id)->first();

            $book = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkkodhasil.agency','fkkodhasil.ptj','fkpayment.fkpaymentgateway','fkpenyatapemungutdetail.penyatapemungutmain')
                                    ->whereHas('fkkodhasil', function ($query) use ($profile)
                                        {
                                            $query->where('fk_agency', '=', $profile->fk_agency);
                                        })
                                    ->whereHas('fkkodhasil', function ($query) use ($profile)
                                        {
                                            $query->where('fk_ptj', '=', $profile->fk_ptj);
                                        })
                                    ->whereHas('fkpayment', function ($query)
                                        {
                                            $query->where('status', 1);
                                        })
                                    ->get();

        }

        return $book;
    }

    public function resultAjaxBook($request)
    {
        $sd = data_get($request, 'sdate');
        $ed = data_get($request, 'edate');
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkkodhasil.agency','fkkodhasil.ptj','fkpayment.fkpaymentgateway','fkpenyatapemungutdetail.penyatapemungutmain')
                            ->whereHas('fkpayment', function ($query) use ($request)
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

        return $data;

    }

    public function bookPdf($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');


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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $data = PaymentDetail::with('fkpayment','fkpayer','fkkodhasil','fkkodhasil.agency','fkkodhasil.ptj','fkpayment.fkpaymentgateway','fkpenyatapemungutdetail.penyatapemungutmain')
                            ->whereHas('fkpayment', function ($query) use ($request)
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

		return $data;

	}


    // ------------------- Laporan Penyata Pemungut Harian/ Bulanan ------------------- //

    public function penyatapemungut(Request $request)
    {

        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $ppenyata = PenyataPemungutMain::with('penyatapemungutdetail','agency','ptj')
                                            ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $profile = UserProfile::where('fk_users',Auth::user()->id)->first();

            $ppenyata = PenyataPemungutMain::with('penyatapemungutdetail','agency','ptj')
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


        return $ppenyata;
    }

    public function resultAjaxPp($request)
    {
        $sd = data_get($request, 'sdate');
        $ed = data_get($request, 'edate');
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $roleid = Auth::user()->roles[0]->id;

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

        return $data;

    }

    public function ppPdf($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
		$ag = data_get($request, 'agencyid');
		$pt = data_get($request, 'ptjid');

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
            $ag = data_get($request, 'agencyid');
        }

        if($pt == 'pt')
        {
            $pt = '0';
        }
        else
        {
            $pt = data_get($request, 'ptjid');
        }

        $roleid = Auth::user()->roles[0]->id;

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

		return $data;

	}

    // ------------------- Laporan Senarai Pengguna ------------------- //

    public function user(Request $request)
    {
        $user = Users::with('role','profile.userAgency','profile.userPtj')->whereNot('id',1)->get();

        return $user;
    }

    public function resultAjaxUser($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
        $ro = data_get($request, 'role');

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
            $ro = data_get($request, 'role');
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

		return $data;

	}

    public function userPdf($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
        $ro = data_get($request, 'role');

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
            $ro = data_get($request, 'role');
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

		return $data;

	}

    public function roleView($request)
    {
        $role = Role::where('id', $request->role)
                            ->first();

        return $role;
    }


     // ------------------- Laporan Pelarasan Kod Hasil ------------------- //

     public function pelarasan(Request $request)
     {

        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $pelarasan = Pelarasan::with('agency','ptj','lkpperkhidmatan')->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            $pelarasan = Pelarasan::with('agency','ptj','lkpperkhidmatan')
                                    ->where('fk_agency', $agency->fk_agency)
                                    ->where('fk_ptj', $agency->fk_ptj)
                                    ->get();
        }

         return $pelarasan;
     }

     public function resultAjaxPelarasan($request)
	{
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');

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

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $data = Pelarasan::with('agency','ptj','lkpperkhidmatan')
                             ->where(function ($query) use ($ads, $ade)
                                {
                                    $query->where('tarikh_pelarasan', '>=', $ads)
                                        ->where('tarikh_pelarasan', '<=', $ade);
                                })
                             ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            $data = Pelarasan::with('agency','ptj','lkpperkhidmatan')
                             ->where('fk_agency', $agency->fk_agency)
                             ->where('fk_ptj', $agency->fk_ptj)
                             ->where(function ($query) use ($ads, $ade)
                                {
                                $query->where('tarikh_pelarasan', '>=', $ads)
                                    ->where('tarikh_pelarasan', '<=', $ade);
                                })
                             ->get();
;
        }



		return $data;
    }

    public function pelarasanPdf($request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        $sd = data_get($request, 'sdate');
        $ed = data_get($request, 'edate');

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

        if(($roleid == 1)||($roleid == 2)||($roleid == 3))
        {
            $data = Pelarasan::with('agency','ptj','lkpperkhidmatan')
                             ->where(function ($query) use ($ads, $ade)
                                {
                                    $query->where('tarikh_pelarasan', '>=', $ads)
                                        ->where('tarikh_pelarasan', '<=', $ade);
                                })
                             ->get();
        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users', $user)->first();

            $data = Pelarasan::with('agency','ptj','lkpperkhidmatan')
                             ->where('fk_agency', $agency->fk_agency)
                             ->where('fk_ptj', $agency->fk_ptj)
                             ->where(function ($query) use ($ads, $ade)
                                {
                                $query->where('tarikh_pelarasan', '>=', $ads)
                                    ->where('tarikh_pelarasan', '<=', $ade);
                                })
                             ->get();

        }



        return $data;

	}

    // ------------------- Laporan Kajian Kepuasan Pengguna ------------------- //

    public function survey(Request $request)
    {
        $survey = SurveyForm::with('user','survey')->get();

        return $survey;
    }

    public function surveySel(Request $request)
    {
        $survey = Survey::get();
        // dd($survey);

        return $survey;
    }

    public function resultAjaxSurvey($request)
	{
		$sd = data_get($request, 'sdate');
		$ed = data_get($request, 'edate');
		$lv = data_get($request, 'level');

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

        if( $lv == 'lev')
        {
            $lv = '0';
        }
        else
        {
            $lv = data_get($request, 'level');
        }

        $data = SurveyForm::with('user','survey')
                          ->where(function ($query) use ($ads, $ade)
                            {
                                $query->where('created_at', '>=', $ads)
                                    ->where('created_at', '<=', $ade);
                            })
                          ->where(function ($query) use ($lv)
                            {
                                if($lv != '0')
                                    $query->where('fk_survey', '=', $lv);
                                else
                                    $query;
                            })
                          ->get();

        // dd($data);


		return $data;
    }

    public function surveyPdf($request)
    {
        $sd = data_get($request, 'sdate');
        $ed = data_get($request, 'edate');
        $lv = data_get($request, 'level');

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

        if( $lv == 'lev')
        {
            $lv = '0';
        }
        else
        {
            $lv = data_get($request, 'level');
        }

        $data = SurveyForm::with('user','survey')
                          ->where(function ($query) use ($ads, $ade)
                            {
                                $query->where('created_at', '>=', $ads)
                                    ->where('created_at', '<=', $ade);
                            })
                          ->where(function ($query) use ($lv)
                            {
                                if($lv != '0')
                                    $query->where('fk_survey', '=', $lv);
                                else
                                    $query;
                            })
                          ->get();

        return $data;

	}

    public function kepuasan($request)
    {
        $leveltype = Survey::where('id', $request->level)
                            ->first();

        return $leveltype;
    }



}
