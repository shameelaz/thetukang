<?php

namespace Workbench\Payment\Service;

use Illuminate\Routing\Controller;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\Agency\Ptj;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\APermission;
use Workbench\Database\Model\User\UserProfile;
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
use Workbench\Database\Model\Agency\KodHasil;
use Workbench\Database\Model\Payment\PenyataPemungutMain;
use Workbench\Database\Model\Payment\PenyataPemungutDetail;
use Workbench\Database\Model\Payment\PenyataPemungutLog;
use Storage;


/*
--helper--

// padBoth()
$padded = Str::padBoth('Alien', 10, '_'); // '__Alien___'
$padded = Str::padBoth('Alien', 10); // '  Alien   '

// padLeft()
$padded = Str::padLeft('Alien', 10, '-='); // '-=-=-Alien'
$padded = Str::padLeft('Alien', 10); // ' Alien'

// padRight()
$padded = Str::padRight('Alien', 10, '-'); // 'Alien-----'
$padded = Str::padRight('Alien', 10); // 'Alien '

*/


class IspeksServices
{

    public function createHeader($id)
	{
        //create line for header
        /*
          - 1 Record Type AN (1) Value '0' Mandatory: YES
          - 2 Agency Code AN (8) Left justified with trailing ‘ ‘ (Space) for blanks Mandatory: YES
          - 3 Total Collector Statement Count N (3) Right justified with leading zeroes Mandatory: YES
          - 4 Total Amount N (15) Right justified with leading zeroes (Last 2 digit for decimal) Mandatory: YES
        */

      	//2
        // ------------------------------

        $main = PenyataPemungutMain::where('id','=',$id)->first();
        $detail = PenyataPemungutDetail::where('fk_penyata_pemungut','=',$id)->get();

        $agencycode = $main->agency_code;

        if(Str::length($agencycode) < 8)
        {
        	$space = 8;
        	$agencycode = Str::padRight($agencycode, $space);
        }
        // -------------------------------



        // 3
        // --------------------------------

        $totalstatement = $detail->count();
        if(Str::length($totalstatement) < 3)
        {
        	$space = 3;
        	$totalstatement = Str::padLeft($totalstatement, $space,'0');
        }

		// 4
        // ------------------------------
        $totalamount = $main->jumlah_rm;
        $convert =  (string)(floatval($totalamount) * 100);
        if(Str::length($convert) < 15)
        {
        	$space = 15;
        	$totalamount = Str::padLeft($convert, $space,'0');
        }



      	$header = '0|'.$agencycode.'|'.$totalstatement.'|'.$totalamount.'|';
      	return $header;

    }

    public function createRow($id)
    {


    	$detail = PenyataPemungutDetail::where('id','=',$id)->first();
    	$main = PenyataPemungutMain::where('id','=',$detail->fk_penyata_pemungut)->first();

    	// ------------------------------------------------------------1
    	$recordtype      = '1';
    	// ------------------------------------------------------------2
    	$departmentcode  =  $main->agency_code;
    	if(Str::length($departmentcode) < 6)
        {
        	$space = 6;
        	$departmentcode = Str::padLeft($departmentcode, $space,'0');
        }
        // -------------------------------------------------------------3
        $ptjcode         =  $main->ptj_code;
        // -------------------------------------------------------------4 data
        $statementno     =  $main->no_penyata_pemungut;
        if(Str::length($statementno) < 13)
        {
        	$space = 13;
        	$statementno = Str::padRight($statementno, $space);
        }
        // ------------------------------------------------------------5 data
        $statementdate   = date('dmY', strtotime($main->tarikh_pp));
        //-------------------------------------------------------------6
        $postingdate     = '        ';
        // ------------------------------------------------------------7
        $year            = date('Y', strtotime($detail->tarikh));
        // ------------------------------------------------------------8
        $statecode       = '0245';
        // ------------------------------------------------------------9
        $ptjgroup        = $main->ptj_code;
        // ------------------------------------------------------------10
        $panjarcode      = '          ';
        // ------------------------------------------------------------11 data
        $bankslip        = $main->no_penyata_pemungut;
        if(Str::length($bankslip) < 20)
        {
        	$space = 20;
        	$bankslip = Str::padRight($bankslip, $space);
        }
        // ------------------------------------------------------------14
        $bankindate      = date('dmY', strtotime($detail->tarikh));
        $collectstart    = date('dmY', strtotime($detail->tarikh));
        $collectend      = date('dmY', strtotime($detail->tarikh));
        // ------------------------------------------------------------15
        $bankinstatus    = 'A';
        // ------------------------------------------------------------16 data
        $bankcode        = $main->bank;
        // ------------------------------------------------------------17 data
        $accountno       = $main->no_akaun;
        if(Str::length($accountno) < 20)
        {
        	$space = 20;
        	$accountno = Str::padRight($accountno, $space);
        }
        // ------------------------------------------------------------18
        $method          = 'W';
        // ------------------------------------------------------------19

        $amount          = $main->jumlah_rm;
        $convert         =  (string)(floatval($amount) * 100);
        if(Str::length($convert) < 15)
        {
        	$space = 15;
        	$amount = Str::padLeft($convert, $space,'0');
        }
        // ------------------------------------------------------------ 20
        $pname           = $main->penyedia_name;
        if(Str::length($pname) < 50)
        {
        	$space = 50;
        	$pname = Str::padRight($pname, $space);
        }
        $pposition       = $main->penyedia_position;
        if(Str::length($pposition) < 40)
        {
        	$space = 40;
        	$pposition = Str::padRight($pposition, $space);
        }
        $pdate           = date('dmY', strtotime($main->penyedia_date));
        // ------------------------------------------------------------ 23
        $cname           = $main->penyemak_name;
        if(Str::length($cname) < 50)
        {
        	$space = 50;
        	$cname = Str::padRight($cname, $space);
        }
        $cposition       = $main->penyemak_position;
        if(Str::length($cposition) < 40)
        {
        	$space = 40;
        	$cposition = Str::padRight($cposition, $space);
        }
        $cdate           = date('dmY', strtotime($main->penyemak_date));
        // ------------------------------------------------------------ 26
        $aname           = $main->pelulus_name;
        if(Str::length($aname) < 50)
        {
        	$space = 50;
        	$aname = Str::padRight($aname, $space);
        }
        $aposition       = date('dmY', strtotime($main->pelulus_position));
        if(Str::length($aposition) < 40)
        {
        	$space = 40;
        	$aposition = Str::padRight($aposition, $space);
        }
        $adate           = date('dmY', strtotime($main->pelulus_date));
        // ------------------------------------------------------------ 29
        $linenew         = '000';
        // ------------------------------------------------------------30
        $startline       = 'K';
        // ------------------------------------------------------------31
        $kodterimaan     = '               ';
        // ------------------------------------------------------------ 32
        $vot             = $detail->vott;
        if(Str::length($vot) < 5)
        {
        	$space = 5;
        	$vot = Str::padRight($vot, $space);
        }
        // ------------------------------------------------------------ 33
        $ptjgroup2       = $main->ptj_code;
        // ------------------------------------------------------------ 34
        $activity         = '      ';
        // ------------------------------------------------------------ 35
        $project         = '          ';
        // ------------------------------------------------------------ 36
        $setia           = '   ';
        // ------------------------------------------------------------ 37
        $subsetia        = '    ';
        // ------------------------------------------------------------ 38
        $paymenttype     = ' ';
        // ------------------------------------------------------------ 39
        $kodehasil       = $detail->kod_hasil;
        // ------------------------------------------------------------ 40
        $glaccount       = '          ';
        // ------------------------------------------------------------ 41
        $amaun           = $detail->amaun;
        $convert         =  (string)(floatval($amaun) * 100);
        if(Str::length($convert) < 15)
        {
        	$space = 15;
        	$amaun = Str::padLeft($convert, $space,'0');
        }
        // ------------------------------------------------------------ 42
        $desc            = '                                                  ';
        // ------------------------------------------------------------ 43
        $bankwsft        = '          ';
        // ------------------------------------------------------------ 44
        $checque         = '                                                  ';
        // ------------------------------------------------------------ 45
        $checkdate       = '        ';
        // ------------------------------------------------------------ 46
        $checamount      = '               ';
        // ------------------------------------------------------------ 47
        $branch          = '                                                                                                    ';
        // ------------------------------------------------------------ 48
        $oldbankwsft        = '          ';
        // ------------------------------------------------------------ 49
        $oldchecque         = '                                                  ';
        // ------------------------------------------------------------ 50
        $oldcheckdate       = '        ';
        // ------------------------------------------------------------ 51
        $oldchecamount      = '               ';
        // ------------------------------------------------------------ 52
        $paccno             = '                    ';
        // ------------------------------------------------------------ end



        $row = $recordtype.'|'.$departmentcode.'|'.$ptjcode.'|'.$statementno.'|'.$statementdate.'|'.$postingdate.'|'.$year.'|'.$statecode.'|'.$ptjgroup.'|'.$panjarcode.'|'.$bankslip.'|'.$bankindate.'|'.$collectstart.'|'.$collectend.'|'.$bankinstatus.'|'.$bankcode.'|'.$accountno.'|'.$method.'|'.$amount.'|'.$pname.'|'.$pposition.'|'.$pdate.'|'.$cname.'|'.$cposition.'|'.$cdate.'|'.$aname.'|'.$aposition.'|'.$adate.'|'.$linenew.'|'.$startline.'|'.$kodterimaan.'|'.$vot.'|'.$ptjgroup2.'|'.$activity.'|'.$project.'|'.$setia.'|'.$subsetia.'|'.$paymenttype.'|'.$kodehasil.'|'.$glaccount.'|'.$amaun.'|'.$desc.'|'.$bankwsft.'|'.$checque.'|'.$checkdate.'|'.$checamount.'|'.$branch.'|'.$oldbankwsft.'|'.$oldchecque.'|'.$oldcheckdate.'|'.$oldchecamount.'|'.$paccno.'|';

        return $row;

        // -------------------------------------------------------------

    }


    public function generateFile($id,$debug)
    {
   		// File Naming : KodNegeri_KodAgensi_KodJenisTransaksi_TimeStamp(YYYYMMDDHHMMss).gpg
		// KodJenisTransaksi = “PPL”

		// Contoh:
		// Nama fail Penyata Pemungut bagi Sistem Hasil Tanah Johor (SHTJ) -
		// 01_00028_PPL_20180112101317.gpg
		// $data = '01_00028_PPL_20180112101317.gpg n/ lalala';

		$kodnegeri = '08';
		$kodagensi = '00036';
		$kodJenisTran = 'PPL';
		$timestamp = date('Ymdhis');

		$filename = $kodnegeri.'_'.$kodagensi.'_'.$kodJenisTran.'_'.$timestamp;

        // 1 - create file with header
        $path = "/pp/".$filename;
		$header = $this->createHeader($id);
        Storage::put($path,$header);

        // 2 - create line item to files
        $bodys = [];
        $bodyl = '';
        $detail = PenyataPemungutDetail::where('fk_penyata_pemungut','=',$id)->get();
        foreach($detail as $key=>$value)
        {
        	$rowid = $value->id;
        	$body = $this->createRow($rowid);
        	$bodys[] = $body;
        	if($key == 0)
        	{
        		$bodyl = $body. PHP_EOL;
        	}else
        	{
        		$bodyl = $bodyl.$body. PHP_EOL;
        	}

        	Storage::append($path,$body);

        }

        $data = [];

        if($debug == 1)
        {

        	$data = [

        		'id table' => 1,
        		'filename' => $filename,
        		'header'   => $header,
        		'body'     => $bodys

        	];
        }

        $update = new PenyataPemungutLog;
        $update->fk_penyata_pemungut = $id;
        $update->file_name = $filename;
        $update->header = $header;
        $update->body = $bodyl;
        $update->save();

        $penyata = PenyataPemungutMain::where('id', $id)->first();
        $penyata->status = 2;
        $penyata->save();


        //3 - //next is to generate pgp and send notification

        return 0;


    }

    public function Notification($request)
    {
        $new = new FavouriteAccount;
        $new->fk_payer_account = $request->payeraccid;
        $new->fk_user = Auth::user()->id;
        $new->tarikh = date('Y-m-d');
        $new->status = 1;
        $new->save();


    }




}
