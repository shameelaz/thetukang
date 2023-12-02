<?php

namespace Workbench\Report\Http\Controllers;

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
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Workbench\Report\Http\Controllers\ReportSurveyExcelController;
use Workbench\Report\Http\Controllers\ReportUserExcelController;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\ReportServices;
use Workbench\Admin\Service\UserServices;
use Workbench\Database\Model\User\UserProfile;

class ReportController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Laporan Terimaan Harian/ Bulanan ------------------- //

    public function receiptList(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $receipt = (new ReportServices())->terimaan($request);
        $agency = (new ReportServices())->agencySel($request);
        $ptj = (new ReportServices())->ptjSel($request);

      return view('report::report.receipt.list',compact('roleid','receipt','agency','ptj'));
    }

    public function ajaxReceiptPtj(Request $request)
    {
        $ptj = (new ReportServices())->ptjSel($request);

        return view('report::report.receipt.ptj',compact('ptj'));
    }

    public function getAjaxReceipt(Request $request) {

		$data = (new ReportServices())->resultAjaxReceipt($request);

        return view('report::report.receipt.ajax',compact('data'));

    }

    public function getExportReceipt(Request $request)
	{
		$now = Carbon::now();
        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;
        $userprofile = UserProfile::where('fk_users','=',$user)->with('userPtj','userAgency')->first();
        $agency = (new ReportServices())->agencySel($request);
        $ptj = (new ReportServices())->ptjSel($request);

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->receiptPdf($request);

            // if(sizeof($data) > 0){
            //     $agencyptj = $data[0];
            //     // dd('hapsa');
            //     }
            // else
            //     {
            //     $agencyptj = null;
            //     // dd('yamseng');
            //     }


            // return view('report::report.receipt.pdf',compact('data', 'request'));

			$pdf = Pdf::loadView('report::report.receipt.pdf', compact('data','request','now','userprofile','roleid','agency','ptj'))->setPaper('a4', 'landscape');

			return $pdf->stream("Laporan_Terimaan_Harian_Bulanan_".$now->format('d-M-y_His').".pdf");
		}
		elseif($request->exporttype=='2') // excel
		{
			$type="xlsx";

			return Excel::download(new ReportReceiptExcelController, "Laporan_Terimaan_Harian_Bulanan_".$now->format('d-M-y_His').".".$type);
		}
		else
		{
			// dd('No Data');
		}
	}

    // ------------------- Laporan Terimaan Harian/ Bulanan Mengikut Jenis ------------------- //

    public function receiptTypeList(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $receipttype = (new ReportServices())->terimaanJenis($request);
        $agency = (new ReportServices())->agencySel($request);
        $ptj = (new ReportServices())->ptjSel($request);

      return view('report::report.receipttype.list',compact('roleid','receipttype','agency','ptj'));
    }

    public function ajaxReceiptTypePtj(Request $request)
    {
        $ptj = (new ReportServices())->ptjSel($request);

        return view('report::report.receipt.ptj',compact('ptj'));
    }

    public function getAjaxReceiptType(Request $request) {

		$data = (new ReportServices())->resultAjaxReceiptType($request);

        return view('report::report.receipttype.ajax',compact('data'));
    }

    public function getExportReceiptType(Request $request)
	{
		$now = Carbon::now();
        $user = Auth::user()->id;
        $userprofile = UserProfile::where('fk_users','=',$user)->with('userPtj','userAgency')->first();

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->receipttypePdf($request);
            $totalkodhasil = (new ReportServices())->ringkasanPdf($request);
            $fpxcard = (new ReportServices())->fpxcardPdf($request);

			// return view('report::report.receipttype.pdf', compact('data', 'request','now','userprofile''totalkodhasil','fpxcard'));

			$pdf = Pdf::loadView('report::report.receipttype.pdf', compact('data','request','now','userprofile','totalkodhasil','fpxcard'))->setPaper('a4', 'landscape');

			return $pdf->stream("Laporan_Terimaan_Harian_Bulanan_Jenis".$now->format('d-M-y_His').".pdf");
		}
		elseif($request->exporttype=='2') // excel
		{
			$type="xlsx";

			return Excel::download(new ReportReceiptTypeExcelController, "Laporan_Terimaan_Harian_Bulanan_Jenis".$now->format('d-M-y_His').".".$type);
		}
		else
		{
			// dd('No Data');
		}
	}

    // ------------------- Laporan Buku Tunai Harian/ Bulanan ------------------- //

    public function bookList(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $book = (new ReportServices())->bukuTunai($request);
        $agency = (new ReportServices())->agencySel($request);
        $ptj = (new ReportServices())->ptjSel($request);

        return view('report::report.book.list',compact('roleid','book','agency','ptj'));
    }

    public function getAjaxbook(Request $request) {

		$data = (new ReportServices())->resultAjaxbook($request);


        return view('report::report.book.ajax',compact('data'));

    }


    public function ajaxBookPtj(Request $request)
    {
        $ptj = (new ReportServices())->ptjSel($request);

        return view('report::report.book.ptj',compact('ptj'));
    }


    public function getExportBook(Request $request)
	{
		$now = Carbon::now();
        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;
        $userprofile = UserProfile::where('fk_users','=',$user)->with('userPtj','userAgency')->first();
        $agency = (new ReportServices())->agencySel($request);
        $ptj = (new ReportServices())->ptjSel($request);

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->bookPdf($request);
            // dd($data);

			// return view('report::report.book.pdf', compact('data', 'request','now','userprofile'));

			$pdf = Pdf::loadView('report::report.book.pdf', compact('data', 'request','now','userprofile','roleid'))->setPaper('a4', 'landscape');

			return $pdf->stream("Laporan_Buku_Tunai_Harian_Bulanan_".$now->format('d-M-y_His').".pdf");
		}
		elseif($request->exporttype=='2') // excel
		{
			$type="xlsx";

			return Excel::download(new ReportBookExcelController, "Laporan_Buku_Tunai_Harian_Bulanan_".$now->format('d-M-y_His').".".$type);
		}
		else
		{
			// dd('No Data');
		}
	}


    // ------------------- Laporan Penyata Pemungut Harian/ Bulanan ------------------- //

    public function ppList(Request $request)
    {
        $roleid = Auth::user()->roles[0]->id;
        $ppenyata = (new ReportServices())->penyatapemungut($request);
        $agency = (new ReportServices())->agencySel($request);
        $ptj = (new ReportServices())->ptjSel($request);

        return view('report::report.penyatapemungut.list',compact('roleid','ppenyata','agency','ptj'));
    }

    public function getAjaxPp(Request $request) {

		$data = (new ReportServices())->resultAjaxPp($request);

        return view('report::report.penyatapemungut.ajax',compact('data'));
    }

    public function ajaxPpPtj(Request $request)
    {
        $ptj = (new ReportServices())->ptjSel($request);

        return view('report::report.penyatapemungut.ptj',compact('ptj'));
    }

    public function getExportPp(Request $request)
	{
		$now = Carbon::now();
        $roleid = Auth::user()->roles[0]->id;
        $user = Auth::user()->id;
        $userprofile = UserProfile::where('fk_users','=',$user)->with('userPtj','userAgency')->first();
        $agency = (new ReportServices())->agencySel($request);
        $ptj = (new ReportServices())->ptjSel($request);

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->ppPdf($request);

			// return view('report::report.book.pdf', compact('data', 'request','now','userprofile'));

			$pdf = Pdf::loadView('report::report.penyatapemungut.pdf', compact('data', 'request','now','userprofile','roleid'))->setPaper('a4', 'landscape');

			return $pdf->stream("Laporan_Penyata_Pemungut_Harian_Bulanan_".$now->format('d-M-y_His').".pdf");
		}
		elseif($request->exporttype=='2') // excel
		{
			$type="xlsx";

			return Excel::download(new ReportPenyataPemungutExcelController, "Laporan_Penyata_Pemungut_Harian_Bulanan_".$now->format('d-M-y_His').".".$type);
		}
		else
		{
			// dd('No Data');
		}
	}


    // ------------------- Laporan Senarai Pengguna ------------------- //

    public function userList(Request $request)
    {
        $user = (new ReportServices())->user($request);
        $agency = (new AgencyServices())->agensiList($request);
        $role = (new UserServices())->roleSel($request);
        // dd($role);

      return view('report::report.user.list',compact('user','agency','role'));
    }

    public function getAjaxUser(Request $request) {

		$data = (new ReportServices())->resultAjaxUser($request);

		// return compact('data');

        return view('report::report.user.ajax',compact('data'));

    }

    public function getExportUser(Request $request)
	{
		$now = Carbon::now();

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->userPdf($request);
            $role = (new ReportServices())->roleView($request);

			// return view('report::report.user.pdf',compact('data', 'request'));

			$pdf = Pdf::loadView('report::report.user.pdf', compact('data', 'request','role'))->setPaper('a4', 'landscape');

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

    // ------------------- Laporan Pelarasan Kod Hasil ------------------- //

    public function pelarasanList(Request $request)
    {
        $pelarasan = (new ReportServices())->pelarasan($request);

        return view('report::report.pelarasan.list',compact('pelarasan'));
    }

    public function getAjaxPelarasan(Request $request) {

		$data = (new ReportServices())->resultAjaxPelarasan($request);

        return view('report::report.pelarasan.ajax',compact('data'));

    }

    public function getExportPelarasan(Request $request)
	{
		$now = Carbon::now();

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->pelarasanPdf($request);

			// return view('report::report.pelarasan.pdf',compact('data', 'request'));

			$pdf = Pdf::loadView('report::report.pelarasan.pdf', compact('data', 'request'))->setPaper('a4', 'landscape');

			return $pdf->stream("Laporan_Pelarasan_Kod_Hasil_".$now->format('d-M-y_His').".pdf");
		}
		elseif($request->exporttype=='2') // excel
		{
			$type="xlsx";

			return Excel::download(new ReportPelarasanExcelController, "Laporan_Pelarasan_Kod_Hasil_".$now->format('d-M-y_His').".".$type);
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
        $surveysel = (new ReportServices())->surveySel($request);

        return view('report::report.survey.list',compact('survey','surveysel'));
    }

    public function getAjaxSurvey(Request $request) {

		$data = (new ReportServices())->resultAjaxSurvey($request);

        return view('report::report.survey.ajax',compact('data'));
    }

    public function getExportSurvey(Request $request)
	{
		$now = Carbon::now();
        $leveltype = (new ReportServices())->kepuasan($request);

		if($request->exporttype=='1') // pdf
		{
            $data = (new ReportServices())->surveyPdf($request);

			// return view('report::report.survey.pdf',compact('data', 'request'));

			$pdf = Pdf::loadView('report::report.survey.pdf', compact('data', 'request', 'leveltype'))->setPaper('a4', 'landscape');

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
