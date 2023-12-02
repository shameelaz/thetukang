<?php

namespace Workbench\Payment\Http\Controllers;

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
use Workbench\Payment\Service\StatementServices;

class StatementController extends Controller
{


    public function __construct()
    {

    }

    public function penyataList(Request $request)
    {
        $penyata = (new StatementServices())->senaraiPenyata($request)->where('status','!=',2);

        return view('payment::statement.list', compact('penyata'));
    }

    public function penyataHistory(Request $request)
    {
        $roleid = auth()->user()->roles['0']->id;
        $penyata = (new StatementServices())->senaraiPenyata($request)->where('status','=',2);

        return view('payment::statement.history', compact('penyata','roleid'));
    }

    public function penyataLog(Request $request)
    {
        $penyata = (new StatementServices())->viewPenyata($request);
        $penyatalog = (new StatementServices())->viewPenyataLog($request);
        return view('payment::statement.log', compact('penyata','request','penyatalog'));
    }

    public function penyataPreview(Request $request)
    {
        $penyata = (new StatementServices())->viewPenyata($request);
        $penyedia = (new StatementServices())->penyediaPenyata($request);
        $penyemak = (new StatementServices())->penyemakPenyata($request);
        $pelulus = (new StatementServices())->pelulusPenyata($request);

        return view('payment::statement.preview', compact('penyata','penyedia','penyemak','pelulus', 'request'));
    }

    public function svPenyata(Request $request)
    {
      $penyata = (new StatementServices())->penyataUpd($request);

      return redirect('/statement/preview/'.$request->id)->withSuccess('Berjaya');
    }

    public function exportPenyata(Request $request)
    {
        $now = Carbon::now();

        $data = (new StatementServices())->getexportPenyata($request);
        $penyata = (new StatementServices())->viewPenyata($request);
        $penyatapdf = (new StatementServices())->pdfPenyata($request);
        // dd($penyata);
        // return view('payment::statement.pdf',compact('data', 'request','penyata','penyatapdf'));

        $pdf = Pdf::loadView('payment::statement.pdf', compact('data', 'request','penyata','penyatapdf'))->setPaper('a4', 'potrait');

        return $pdf->stream("Penyata_Pemungut_".$now->format('d-M-y_His').".pdf");

    }

    // update status to paymentcontroller
    public function updStatus(Request $request)
    {
        return (new PaymentController())->genpp($request);
    }


}
