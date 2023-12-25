<?php

namespace Workbench\Agency\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Mail;
use Curl;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\BillServices;
use Workbench\Admin\Service\KhidmatServices;

class BillController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Akaun--------------- //

    public function accountList(Request $request)
    {
        $acc = (new BillServices())->accList($request);
        // dd($acc);
        return view('agency::account.list', compact('acc'));
    }

    public function accountForm(Request $request)
    {
        $acc = (new BillServices())->agencyRole($request);
        $state = (new BillServices())->stateList($request);

        return view('agency::account.add', compact('acc','state'));
    }

    public function payerAccList(Request $request)
    {
        $account = (new BillServices())->getPayerAccount($request);
        $kodhasil = (new BillServices())->getKodHasil($request);

        return view('agency::account.list', compact('account','kodhasil'));
    }

    public function payerAccForm(Request $request)
    {
        $kodhasil = (new BillServices())->getKodHasil($request);
        $state = (new BillServices())->stateList($request);

        return view('agency::account.add', compact('kodhasil','state'));
    }

    public function accountSave(Request $request)
    {
        // dd($request);
        $acc = (new BillServices())->accAdd($request);

        return redirect('/ptj/account/list/'.$request->fk_kod_hasil)->withSuccess('Berjaya Menambah Data');
    }

    public function accountShow(Request $request)
    {
        $acc = (new BillServices())->accountResult($request);
        $state = (new BillServices())->stateList($request);
        $kodhasil = (new BillServices())->getKodHasil($request);

      return view('agency::account.edit',compact('state','acc','kodhasil'));
    }

    public function accountUpdate(Request $request)
    {
        $acc = (new BillServices())->accUpd($request);

        return redirect('/ptj/account/list/'.$request->fk_kod_hasil)->withSuccess('Berjaya Kemaskini Data');
    }

    // ------------------- Pembayaran Bil--------------- //

    // public function billList(Request $request)
    // {
    //     $bill = (new BillServices())->bilList($request);
    //     // dd($bil);

    //     return view('agency::bill.list', compact('bill'));
    // }

    // public function billForm(Request $request)
    // {
    //     $acc = (new BillServices())->accList($request);

    //     return view('agency::bill.add', compact('acc'));
    // }

    public function payerBillList(Request $request)
    {
        $bill = (new BillServices())->getPayerBill($request);
        $kodhasil = (new BillServices())->getKodHasil($request);

        return view('agency::bill.list', compact('bill','kodhasil'));
    }

    public function payerBillForm(Request $request)
    {
        $kodhasil = (new BillServices())->getKodHasil($request);

        return view('agency::bill.add', compact('kodhasil'));
    }

    public function billSave(Request $request)
    {
        $bil = (new BillServices())->bilAdd($request);

        return redirect('/ptj/bill/list/'.$request->fk_kod_hasil)->withSuccess('Berjaya Menambah Data');
    }

    public function billShow(Request $request)
    {
        $result = (new BillServices())->bilResult($request);
        $kodhasil = (new BillServices())->getKodHasil($request);
        // dd($result);

      return view('agency::bill.edit',compact('result','kodhasil'));
    }

    public function billUpdate(Request $request)
    {
        // dd($request);
        $bil = (new BillServices())->bilUpd($request);

        return redirect('/ptj/bill/list/'.$request->fk_kod_hasil)->withSuccess('Berjaya Kemaskini Data');
    }

    public function loadStatus($status)
    {
        return view('agency::bill.catatan');
    }


}
