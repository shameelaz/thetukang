<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
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
use Maatwebsite\Excel\Facades\Excel;
use Workbench\Database\Imports\ParamImport;
use Workbench\Database\Model\Agency\KodHasil;
use Workbench\Database\Model\Bill\PayerAccount;
use Workbench\Database\Model\Bill\PayerBill;
use Workbench\Database\Model\Bill\PayerBillTemp;
use Workbench\Database\Model\User\UserProfile;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Workbench\Database\Model\Lkp\LkpState;

class ImportServices
{


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/

    // ------------------- Excel ------------------- //

    public function filterState($statename)
    {
        // dd($statename);
        $state = LkpState::where('name', $statename )
                          ->first();
        // dd($state, 'cggfg');
        return $state;
    }

    public function importAccount(Request $request)
    {
        // dd($request);

        if($request->file){

            $user = Auth::user()->id;
            $acc = UserProfile::where('fk_users','=',$user)->with('userPtj')->first();
            $kodhasil = KodHasil::where('id',$request->kodhasilid)->first();

            $files = $request->file;

            $extension = $files->getClientOriginalExtension();

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/account')) {

                mkdir(public_path()."/uploads/base/account");
            }
            if (!file_exists(public_path().'/uploads/base/account/')) {

                mkdir(public_path()."/uploads/base/account/");
            }

            $path = public_path()."/uploads/base/account/";


            $filename= $files->getClientOriginalName();

            $fullpath = "/uploads/base/account/".$filename;
            $extension = $files->getClientOriginalExtension();


            $files->move($path, $files->getClientOriginalName());


            // $svdt = new FileUpload;
            // // $svdt->main_app_id = $mainapp;
            // $svdt->date = Carbon::now();
            // $svdt->dir = $path;  //full path from var
            // $svdt->full_path = $shortpath; //short path from storage/medical/
            // $svdt->file_name = $filename;
            // $svdt->type = $type;
            // $svdt->status = 0;

            // $svdt->save();

        }

        $array = Excel::toArray(new ParamImport, public_path().$fullpath);
        // dd($array[0]);

        // $get_payeraccount = PayerAccount::where('fk_ptj', $acc->fk_ptj)->first();

        // dd($array);


        for($i = 1; $i < sizeof($array[0]); $i++){

            $payeraccount = new PayerAccount();
            $payeraccount->fk_ptj = $acc->fk_ptj;
            $payeraccount->fk_agency = $acc->fk_agency;
            $payeraccount->fk_kod_hasil = $kodhasil->id;

            $filter = $this->filterState($array[0][$i][5]);
            // dd($filter);

            for($j = 0; $j < sizeof($array[0][$i]); $j++){


                // dump(($array[0][$i][5]));

                if($array[0][0][$j] == 'name'){
                    $payeraccount->name = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'account_no'){
                    $payeraccount->account_no = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'identification_no'){
                    $payeraccount->identification_no = str_replace('-', '', $array[0][$i][$j]);
                }
                if($array[0][0][$j] == 'address'){
                    $payeraccount->address = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'city'){
                    $payeraccount->city = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'state'){
                    $payeraccount->state = data_get($filter, 'id', 7);
                }
                if($array[0][0][$j] == 'status'){
                    $payeraccount->status = data_get($request,'status', 1);
                }
            }
            // dd();exit;

            $payeraccount->save();
            // dd($payeraccount);
        }

        // $api_main = ApiMain::where('id',$api_id)->first();

        // if($api_main->param_change == 1){
        //     $main_app = MainApp::where("fk_api_main",$api_id)->first();
        //     return redirect::to('/provider/api/edit2/'.$main_app->id."/2")->withSuccess(trans("Add Successful"));
        // }else{
            // return redirect::to('ptj/account/list')->withSuccess(trans("Add Successful"));
        // }

    }


    public function payerBill(Request $request)
    {

        // dd($request);

        if($request->file){

            $user = Auth::user()->id;
            $acc = UserProfile::where('fk_users','=',$user)->with('userPtj')->first();
            $kodhasil = KodHasil::where('id',$request->kodhasilid)->first();

            $files = $request->file;

            $extension = $files->getClientOriginalExtension();

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/bill')) {

                mkdir(public_path()."/uploads/base/bill");
            }
            if (!file_exists(public_path().'/uploads/base/bill/')) {

                mkdir(public_path()."/uploads/base/bill/");
            }

            $path = public_path()."/uploads/base/bill/";


            $filename= $files->getClientOriginalName();

            $fullpath = "/uploads/base/bill/".$filename;
            $extension = $files->getClientOriginalExtension();


            $files->move($path, $files->getClientOriginalName());


            // $svdt = new FileUpload;
            // // $svdt->main_app_id = $mainapp;
            // $svdt->date = Carbon::now();
            // $svdt->dir = $path;  //full path from var
            // $svdt->full_path = $shortpath; //short path from storage/medical/
            // $svdt->file_name = $filename;
            // $svdt->type = $type;
            // $svdt->status = 0;

            // $svdt->save();

        }

        $array = Excel::toArray(new ParamImport, public_path().$fullpath);
        // dd($array[0]);

        // $get_payeraccount = PayerBill::where('fk_ptj', $acc->fk_ptj)->first();

        // dd($array);

        for($i = 1; $i < sizeof($array[0]); $i++){

            $payerbilltemp = new PayerBillTemp();
            $payerbilltemp->fk_ptj = $acc->fk_ptj;
            $payerbilltemp->fk_agency = $acc->fk_agency;
            $payerbilltemp->fk_payer_account = $acc->fk_payer_account;
            $payerbilltemp->fk_kod_hasil = $kodhasil->id;

            for($j = 0; $j < sizeof($array[0][$i]); $j++)
            {
                if($array[0][0][$j] == 'name'){
                    $payerbilltemp->name = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'account_no'){
                    $payerbilltemp->account_no = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'identification_no'){
                    $payerbilltemp->identification_no = str_replace('-', '', $array[0][$i][$j]);
                }
                if($array[0][0][$j] == 'reference_no'){
                    $payerbilltemp->reference_no = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'amount'){
                    $payerbilltemp->amount = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'bill_detail'){
                    $payerbilltemp->bill_detail = $array[0][$i][$j];
                }
                if($array[0][0][$j] == 'bill_date'){
                    $payerbilltemp->bill_date = Date::excelToDateTimeObject(($array[0][$i][$j]));
                }
                if($array[0][0][$j] == 'bill_end_date'){
                    $payerbilltemp->bill_end_date = Date::excelToDateTimeObject(($array[0][$i][$j]));
                }
                if($array[0][0][$j] == 'status'){
                    $payerbilltemp->status =  data_get($request,'status', 0);
                }
            }

            $payerbilltemp->save();

        }


    }

    public function tempList(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

        if(($roleid == 2)||($roleid == 1))
        {
            $temp = PayerBillTemp::with('fkagency','fkptj')
                                 ->get();

        }
        elseif(($roleid == 4)||($roleid == 5))
        {
            $agency = UserProfile::where('fk_users','=',$user)->first();

            $temp = PayerBillTemp::where('fk_ptj', $agency->fk_ptj)
                                 ->with('fkagency','fkptj')
                                 ->groupBy(['fk_agency','fk_ptj','fk_kod_hasil','account_no','name','identification_no','reference_no','amount','bill_detail','bill_date','bill_end_date','status'])
                                 ->get();
        }

        return $temp;
    }

    public function tempAdd(Request $request)
    {
        $now = Carbon::now();

        $temp = PayerBillTemp::where('status', 0)
                              ->where('fk_kod_hasil',$request->fkkodhasil)
                              ->get();

        foreach($temp as $key => $value)
        {
            if($request->action == 1)
            {
                if($value->bill_end_date < $now)
                {
                    $varreturn = '2';
                }
                else
                {
                    $bill = new PayerBill();
                    $bill->fk_ptj = $value->fk_ptj;
                    $bill->fk_agency = $value->fk_agency;
                    $bill->fk_payer_account = $value->fk_payer_account;
                    $bill->fk_kod_hasil = $value->fk_kod_hasil;
                    $bill->name = $value->name;
                    $bill->account_no = $value->account_no;
                    $bill->identification_no = str_replace('-', '', $value->identification_no);
                    $bill->reference_no = $value->reference_no;
                    $bill->amount = $value->amount;
                    $bill->bill_detail = $value->bill_detail;
                    $bill->bill_date = $value->bill_date;
                    $bill->bill_end_date = $value->bill_end_date;
                    $bill->status = 1;
                    $bill->save();

                    $varreturn = '1';

                    $del = PayerBillTemp::where('id',$value->id)->delete();
                }
            }
            else
            {
                $varreturn = '1';

                $del = PayerBillTemp::where('id',$value->id)->delete();
            }
        }

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Maklumat Bil Pembayaran'));

        return $varreturn;
    }


}
