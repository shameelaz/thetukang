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
use Illuminate\Support\Facades\Auth;
use Workbench\Admin\Service\BillServices;
use Workbench\Admin\Service\RinggitServices;
use Workbench\Admin\Service\TransactionServices;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\Agency\Ptj;
use Workbench\Database\Model\Payment\PenyataPemungutMain;
use Workbench\Database\Model\Payment\PenyataPemungutDetail;

class TransactionController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Transaction ------------------- //

    public function transactionList(Request $request)
    {
        // $user = Auth::user()->id;
        // $profile = Users::where('id',$user)->with('profile','role')->first();
        $roleid = Auth::user()->roles[0]->id;
        // dd($roleid);


        $transaction = (new TransactionServices())->transList($request);
        $agency = (new TransactionServices())->agencySel($request);
        $ptj = (new TransactionServices())->ptjSel($request);
        $kodhasil = (new TransactionServices())->kodhasilSel($request);



        if($roleid==7){
            return view('admin::admin.user.transactionlist',compact('transaction','agency','ptj','kodhasil','roleid'));

        }else{
            return view('admin::admin.transaction.list',compact('transaction','agency','ptj','kodhasil','roleid'));

        }
    }

    public function ajaxPtj(Request $request)
    {
        $ptj = (new TransactionServices())->ptjSel($request);

        return view('admin::admin.transaction.ptj',compact('ptj'));
    }

    public function ajaxHasil(Request $request)
    {
        $kodhasil = (new TransactionServices())->kodhasilSel($request);

        return view('admin::admin.transaction.kodhasil',compact('kodhasil'));
    }

    public function ajaxKodhasil(Request $request)
    {
        $kodhasil = (new TransactionServices())->kodhasilSel($request);

        return view('admin::admin.transaction.kodhasil',compact('kodhasil'));
    }

    public function getAjaxTransaction(Request $request)
    {
        $transaction = (new TransactionServices())->resultAjaxTransaction($request);
        $roleid = Auth::user()->roles[0]->id;

        return view('admin::admin.transaction.ajax',compact('transaction','roleid'));
    }

    public function detailTransaction(Request $request)
    {
        $transaction = (new TransactionServices())->getTransaction($request);

        return view('admin::admin.transaction.detail',compact('transaction'));
    }

    public function exportTransaction(Request $request)
    {
        $now = Carbon::now();
        // dd($now);

        $total = 0;

        $data = (new TransactionServices())->getexportTransactionmulti($request);
        
        foreach($data['payment'][0]->paymentdetail as $key =>$value)
        {
            $total += data_get($value, 'amount');
        }

        $ringgitmalaysia = (new RinggitServices())->convertEjaan($total);

        // dd($ringgitmalaysia);

        // return view('admin::admin.report.user.pdf',compact('data', 'request'));

        $pdf = Pdf::loadView('admin::admin.transaction.pdf', compact('data','now','request','ringgitmalaysia'))->setPaper('a4', 'potrait');

        return $pdf->stream("Butiran_Sejarah_Transaksi_".$now->format('d-M-y_His').".pdf");

    }

    public function pelarasanResult(Request $request)
    {
        $pelarasan = (new TransactionServices())->pelarasanEdit($request);
        $kodhasilbaru = (new TransactionServices())->getKodHasil($request);

        $agency=Agency::find(data_get($pelarasan,'fkkodhasil.fk_agency'));
        $ptj=Ptj::find(data_get($pelarasan,'fkkodhasil.fk_ptj'));

        // data_get($list, '0.fkservice.fpx_type')

        $penyatapemungutdetail=PenyataPemungutDetail::where('fk_payment_detail',data_get($pelarasan,'id'))->first();

        $penyatamain=PenyataPemungutMain::find(data_get($penyatapemungutdetail,'fk_penyata_pemungut'));


        return view('admin::admin.transaction.pelarasan',compact('pelarasan','kodhasilbaru','agency','ptj','penyatamain'));
    }

    public function pelarasanSave(Request $request)
    {
      $pelarasan = (new TransactionServices())->pelarasanSimpan($request);

      return redirect('/admin/pelarasan/list')->withSuccess('Berjaya Menyimpan Data');
    }

    public function pelarasanList(Request $request)
    {
        $pelarasan = (new TransactionServices())->getPelarasan($request);

        return view('admin::admin.transaction.listresult',compact('pelarasan'));

    }



}
