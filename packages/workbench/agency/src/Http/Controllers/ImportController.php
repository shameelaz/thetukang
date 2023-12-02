<?php

namespace Workbench\Agency\Http\Controllers;

use App\Imports\UsersImport;
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
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Workbench\Admin\Service\BillServices;
use Workbench\Admin\Service\ExcelServices;
use Workbench\Admin\Service\ImportServices;
use Workbench\Database\Imports\ParamImport;
use Workbench\Database\Model\Bill\PayerAccount;
use Workbench\Database\Model\User\UserProfile;

class ImportController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Excel--------------- //

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',

        ],
        [
            'file.required' => 'Perlu upload fail Excel ',
            'file.mimes' => 'Hanya format imej xlsx sahaja yang boleh dimuatnaik',

        ]
        );

        $imp = (new ImportServices())->importAccount($request);

        return redirect('/ptj/account/list/'.$request->kodhasilid)->withSuccess('Berjaya Menambah Data');

    }

    public function importBill(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',

        ],
        [
            'file.required' => 'Perlu upload fail Excel ',
            'file.mimes' => 'Hanya format imej xlsx sahaja yang boleh dimuatnaik',

        ]
        );

        $imp = (new ImportServices())->payerBill($request);

        return redirect('/ptj/bill/temporary')->withInfo('Sila semak senarai yang telah dimuatnaik.');
    }

    public function importTemp(Request $request)
    {
        $temp = (new ImportServices())->tempList($request);
        $roleid = Auth::user()->roles[0]->id;

        return view('agency::bill.templist', compact('temp','roleid'));
    }


    public function importSave(Request $request)
    {
        $temp = (new ImportServices())->tempAdd($request);

        if($temp == '1')
        {
            return redirect('/ptj/bill/list/'.$request->fkkodhasil)->withSuccess('Berjaya Kemaskini Data');
        }
        else
        {
            return redirect('/ptj/bill/temporary')->withWarning('Tarikh tamat telah melepasi tarikh hari ini. Sila tidak sahkan maklumat ini. Kemaskini excel dan upload semula. ');
        }
    }





}
