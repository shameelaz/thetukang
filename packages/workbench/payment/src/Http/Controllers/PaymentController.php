<?php

namespace Workbench\Payment\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
use File;
use Redirect;
use Mail;
use Curl;
use Auth;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;

use Barryvdh\DomPDF\Facade\Pdf;

use Workbench\Payment\Service\KodHasilServices;
use Workbench\Payment\Service\PaymentServices;
use Workbench\Admin\Service\TransactionServices;
use Workbench\Admin\Service\RinggitServices;
use Workbench\Payment\Service\IspeksServices;
use Workbench\Database\Model\Payment\Payment;
use Workbench\Database\Model\Payment\PaymentDetail;
use Workbench\Payment\Service\UserServices;
use Workbench\Database\Model\Bill\Troli;
use Workbench\Database\Model\Payment\Bank;
use Workbench\Database\Model\Payment\Bankb2b;
use Workbench\Database\Model\Payment\MerchantSetup;



class PaymentController extends Controller
{
    public function __construct()
    {

    }

    public function genpp(Request $request)
    {
        $id = $request->id;
        $debug = 0;
        if(isset($request->debug))
        {
            $debug = 1;
        }
        $payment = (new IspeksServices())->generateFile($id,$debug);

        return redirect('/statement/history')->withSuccess('Berjaya');
    }

    public function index()
    {
        // dd('sini');
        return view('payment::payment.index');
    }

    public function testFpx(Request $request)
    {
        return view('payment::payment.fpx.main');
    }

    public function testConfirm(Request $request)
    {
        return view('payment::payment.fpx.submit',compact('request'));
    }

    public function tiketFpx(Request $request)//form FPX
    {
    
        $payment = (new PaymentServices())->paymentDetail($request);
        $flaglogin=$request->flaglogin;
        $fpxtrans=$request->fpxtrans;

        // dump($payment);
        // return view('payment::payment.fpx.tiket.form',compact('payment')); -->asal

        return view('payment::payment.fpx.tiket.form',compact('payment','flaglogin','fpxtrans'));
    }

    public function updateFpx(Request $request)
    {
        // dd($request);exit;
        $payment = (new PaymentServices())->updatePayment($request);
        $flaglogin=$request->flaglogin;



        if($flaglogin==0)
        {
            return redirect('/bayaran/fpxsucess/success/'.$request->paymentid)->withSuccess('Pembayaran berjaya');
        }
        else
        {
            return redirect('/login/bayaran/fpxsucess/success/'.$request->paymentid)->withSuccess('Pembayaran berjaya');
        }
    }

    public function successFpx(Request $request)
    {
        
       
        $payment = (new PaymentServices())->paymentDetail($request);

        // dump($payment);
        // dd(data_get($payment,'paymentdetail.0.fktroli.fkservice.servicemaindetail'));
        
        return view('payment::payment.fpx.tiket.success',compact('payment'));
    }
    
    public function updateBank(Request $request)
    {

        

        $updateBank = (new PaymentServices())->updateBank($request);




        $servicemain=$request->id;
        //$kodhasil = (new KodHasilServices())->kodhasil($request);
        $kodhasilval = $request->kodhasilval;
        $tab=$request->tab;
        $flaglogin=$request->flaglogin;
        $flagpay=$request->flagpay;
        $flagtroli=$request->flagtroli;
        $paymentid=$request->paymentid;
        $data=Payment::find($paymentid);
        $total_bayar=data_get($data,'total_amount');
        $paymentid=data_get($data,'id');
        $payment_no=data_get($data,'transaction_no');




         if($flagtroli==1)
        {
            // dd('troli');exit;
            $payment = 0;
            $srvmainid = 0;

            if ($request->flagmulti == 1) 
            {
               // $data =  (new UserServices())->cartMultiBayar($request);
                $list =  (new UserServices())->cartMultiList($request);
            }
            else
            { 
               // $data =  (new UserServices())->cartBayar($request);
                $list =  (new UserServices())->cartList($request);
            }
            
            $trolicek = Troli::where('flag', $request->troliflag)
                             ->first();

            $paymentgateway = $trolicek->fkservice->fk_payment_gateway;
            $fpxtype = $trolicek->fkservice->fpx_type;
            $total_bayar    = data_get($data,'total_amount');
            $paymentid      = data_get($data,'id');
            $payment_no     = data_get($data,'transaction_no');
            
            $troliflag      = data_get($trolicek, 'flag');


            
        }
        else
        {
            // dd('stret');exit;
            //$data    = (new KodHasilServices())->bayarTiket($request);
            $payment = (new KodHasilServices())->getPayment($request);
            $srvmain = (new KodHasilServices())->serviceMain($request);

            $srvmainid = $request->id;

            $paymentgateway = data_get($srvmain,'fk_payment_gateway');
            $fpxtype =data_get($srvmain,'fpx_type');
            $total_bayar    = data_get($srvmain,'total');
            $list       = '';
            $troliflag  = 0;

            $paymentid  = data_get($payment,'id');
            $payment_no = data_get($payment,'transaction_no');

             
        }





        if($flaglogin==0)
        {
            return redirect('/bayaran/fpxsummary/'.$request->paymentid.'/'.$kodhasilval.'/'.$tab.'/'.$flaglogin.'/'.$flagpay.'/'.$troliflag.'/'.$flagtroli.'/'.$srvmainid);
        }
        else
        {
            return redirect('/login/bayaran/fpxsummary/'.$request->paymentid.'/'.$kodhasilval.'/'.$tab.'/'.$flaglogin.'/'.$flagpay.'/'.$troliflag.'/'.$flagtroli.'/'.$srvmainid);
        }
    }

    public function demobank(Request $request){

        $paymentid=$request->paymentid;
        $data=Payment::find($paymentid);
        $flaglogin=$request->flaglogin;
        $flagpay=$request->flagpay;
        $troliflag=$request->troliflag;
        $tab=$request->tab;
        $srvmain=$request->srvmain;
        $kodhasil = $request->kodhasil;
        $flagtroli=$request->flagtroli;


          return view('payment::payment.proceed.demo_bank',compact('paymentid','data','flagpay','flaglogin','troliflag','tab','srvmain','kodhasil','flagtroli'));



     }

    public function summarytiket(Request $request)
    {

      
        $flaglogin=$request->flaglogin;
        $tab=$request->tab;
        $flagpay=$request->flagpay;
        //$troliflag=$request->troliflag;
        $flagtroli=$request->flagtroli;

        $id=$request->id;
        

        $data_payment=Payment::find($request->paymentid);

        $kodhasil = (new KodHasilServices())->kodhasil($request);

        $merchant=MerchantSetup::where('fk_ptj',data_get($kodhasil,'fk_ptj'))->first();



        if(data_get($data_payment,'fpx_type') == '01'){//akuan individu
                $banklist=Bank::where('bank_id',data_get($data_payment,'bank'))->first();

        }else{
            $banklist=Bankb2b::where('bank_id',data_get($data_payment,'bank'))->first();

        }



           if($flagtroli==1)
        {
            // dd('troli');exit;
            $payment = 0;
            $srvmain = 0;

            if ($request->flagmulti == 1) 
            {
                //$data =  (new UserServices())->cartMultiBayar($request);
                $list =  (new UserServices())->cartMultiList($request);
            }
            else
            { 
                //$data =  (new UserServices())->cartBayar($request);
                $list =  (new UserServices())->cartList($request);
            }
            
            $trolicek = Troli::where('flag', $request->troliflag)
                             ->first();

            $paymentgateway = $trolicek->fkservice->fk_payment_gateway;
            $fpxtype = $trolicek->fkservice->fpx_type;
            //$paymentid      = data_get($data,'id');
           // $payment_no     = data_get($data,'transaction_no');
            
            $troliflag      = data_get($trolicek, 'flag');


            
        }
        else
        {
            // dd('stret');exit;
            //$data    = (new KodHasilServices())->bayarTiket($request);
            $payment = (new KodHasilServices())->getPayment($request);
            $srvmain = (new KodHasilServices())->serviceMain($request);

            $paymentgateway = data_get($srvmain,'fk_payment_gateway');
            $fpxtype =data_get($srvmain,'fpx_type');
            $list       = '';
            $troliflag  = 0;

            //$paymentid  = data_get($payment,'id');
           // $payment_no = data_get($payment,'transaction_no');

             
        }


         if(data_get($data_payment,'fpx_type') =='01'){
             return view('payment::payment.proceed.fpxconfirmation',compact('kodhasil','flaglogin','tab','flagpay','troliflag','flagtroli','srvmain', 'request','paymentgateway','list','data_payment','banklist','fpxtype','id','merchant'));

         }else{
             return view('payment::payment.proceed.fpxconfirmation_b2b',compact('kodhasil','flaglogin','tab','flagpay','troliflag','flagtroli','srvmain', 'request','paymentgateway','list','data_payment','banklist','fpxtype','id','merchant'));


         }
        



       
    }

    public function exportTransaction(Request $request)
    {
        $paydet = PaymentDetail::where('fk_payment', $request->id)
                               ->first();

        $request->id = $paydet->id;

        $now = Carbon::now();

        $total = 0;

        // $data = (new TransactionServices())->getexportTransaction($request);
        // dd($data);
        $data = (new TransactionServices())->getexportTransactionmulti($request);
        
        foreach($data['payment'][0]->paymentdetail as $key =>$value)
        {
            $total += data_get($value, 'amount');
        }

        $ringgitmalaysia = (new RinggitServices())->convertEjaan($total);

        $paydet->flag_original = 2;
        $paydet->save();


        // return view('payment::payment.receipt.pdf', compact('data', 'request'));

        $pdf = Pdf::loadView('payment::payment.receipt.pdf_new_two', compact('data', 'request', 'now', 'ringgitmalaysia'))->setPaper('a4', 'potrait');

        return $pdf->stream("Resit_Pembayaran_".$now->format('d-M-y_His').".pdf");

    }

    public function getSendEmail($id)
    {
        $email_env  = env('EMAIL_ENV');

        if($email_env == "production")
        {
            // $content    = $this->meetingrepo->contentEmail($request);
            // $user       = $this->meetingrepo->sendMailT3($request);

            // Mail::send('meeting::meeting.emailt3', ['content' => $content], function($message) use($user)
            //     {
            //         $message->to($user['email']);
            //         $message->subject('Elesen : Panggilan Mesyuarat Dalaman');
            //     });

            // return redirect::to('/meeting/edit/'.$request->id.'/'.$request->tab)->withSuccess('Email Panggilan Mesyuarat Dalaman Berjaya Dihantar');
        }
        else
        {
            // $content    = $this->meetingrepo->contentEmail($request);
            // $user       = $this->meetingrepo->sendMailT3($request);

            $content = (new PaymentServices())->dataEmail($id);

            if( data_get($content, 'status') == 1 )
            {
                $status = 'Telah Berjaya';
            }
            elseif( data_get($content, 'status') == 2 )
            {
                $status = 'Tidak Berjaya';
            }
            elseif( data_get($content, 'status') == 3 )
            {
                $status = 'Masih Menunggu Bayaran';
            }
            else
            {
                $status = 'Bayaran Tidak Berjaya - Mohon Rujuk Pentadbir Sistem';
            }
            // return view('payment::payment.email.email', compact('content', 'status'));
            // dd($content, 'sini');exit;

            Mail::send('payment::payment.email.email', [ 'content' => $content, 'status' => $status ], function($message) use($content, $status)
                {
                    $message->to('shikin@3fresources.com');
                    $message->subject('Bayaran '.$content->paymentdetail->first()->fkperkhidmatan->name.' '.$status);
                });

            // return redirect::to('/meeting/edit/'.$request->id.'/'.$request->tab)->withSuccess('Email Panggilan Mesyuarat Dalaman Berjaya Dihantar');
        }
    }

    public function indirect(Request $request){


       $updatepayment = (new PaymentServices())->updatepaymentfpx($request);

       $paymentid=$updatepayment;
       $flaglogin=$request->fpx_sellerExOrderNo;



       if($request->fpx_buyerIban){  
        

             return redirect::to('login/bayaran/fpxsucess/success/'.$paymentid)->withSuccess('Pembayaraan berjaya dikemaskini');

             

        }else{
  

             return redirect::to('bayaran/fpxsucess/success/'.$paymentid)->withSuccess('Pembayaraan berjaya dikemaskini');

        }

       // return view('payment::payment.fpx.indirect',compact('paymentid','flaglogin'));


    }

    public function direct(Request $request){

          echo strip_tags('OK' );

         exit();
   
       
    


          //return view('payment::payment.fpx.tiket.direct');
          


    }

    public function bayarancard(Request $request)
    {

          $configArray = array();

  // possible values:
  // FALSE = disable verification
  // TRUE = enable verification
  $configArray["certificateVerifyPeer"] = TRUE;

  // possible values:
  // 0 = do not check/verify hostname
  // 1 = check for existence of hostname in certificate
  // 2 = verify request hostname matches certificate hostname
  $configArray["certificateVerifyHost"] = 2;


  // Base URL of the Payment Gateway. Do not include the version.
  $configArray["gatewayUrl"] = "https://test-bimb.mtf.gateway.mastercard.com/api/nvp";

  // Merchant ID supplied by your payments provider
  $configArray["merchantId"] = $request->merchant;

  // API username in the format below where Merchant ID is the same as above
  $configArray["apiUsername"] = $request->apiUsername;

  // API password which can be configured in Merchant Administration
  $configArray["password"] =  $request->apiPassword;

  // The debug setting controls displaying the raw content of the request and 
  // response for a transaction.
  // In production you should ensure this is set to FALSE as to not display/use
  // this debugging information
  $configArray["debug"] = TRUE;

  // Version number of the API being used for your integration
  // this is the default value if it isn't being specified in process.php
  $configArray["version"] = "75";

  /*    
  This class holds all the merchant related variables and proxy 
  configuration settings    
  */

  $proxyServer = "";
  $proxyAuth = "";
  $proxyCurlOption = 0;
  $proxyCurlValue = 0;  

  $certificatePath = "";
  $certificateVerifyPeer = FALSE;   
  $certificateVerifyHost = 0;

  $gatewayUrl = "";
  $debug = TRUE;
  $version = "";
  $merchantId = "";
  $password = "";
  $apiUsername = "";

  // if (array_key_exists("proxyServer", $configArray));
  //   $proxyServer = $configArray["proxyServer"];

  if (array_key_exists("proxyAuth", $configArray))
    $proxyAuth = $configArray["proxyAuth"];
    
  if (array_key_exists("proxyCurlOption", $configArray))
    $proxyCurlOption = $configArray["proxyCurlOption"];

  if (array_key_exists("proxyCurlValue", $configArray))
    $proxyCurlValue = $configArray["proxyCurlValue"];
    
  if (array_key_exists("certificatePath", $configArray))
    $certificatePath = $configArray["certificatePath"];
    
  if (array_key_exists("certificateVerifyPeer", $configArray))
    $certificateVerifyPeer = $configArray["certificateVerifyPeer"];
    
  if (array_key_exists("certificateVerifyHost", $configArray))
    $certificateVerifyHost = $configArray["certificateVerifyHost"];

  if (array_key_exists("gatewayUrl", $configArray))
    $gatewayUrl = $configArray["gatewayUrl"];

  if (array_key_exists("debug", $configArray))  
    $debug = $configArray["debug"];
    
  if (array_key_exists("version", $configArray))
    $version = $configArray["version"];
    
  if (array_key_exists("merchantId", $configArray)) 
    $merchantId = $configArray["merchantId"];

  if (array_key_exists("password", $configArray))
    $password = $configArray["password"];
    
  if (array_key_exists("apiUsername", $configArray))
    $apiUsername = $configArray["apiUsername"]; 





$request='order.id='.$request->order_id.'&transaction.id='.$request->transaction_id.'&apiOperation='.$request->apiOperation.'&sourceOfFunds.type='.$request->sourceOfFunds_type.'&sourceOfFunds.provided.card.number='.$request->sourceOfFunds_provided_card_number.'&sourceOfFunds.provided.card.expiry.month='.$request->sourceOfFunds_provided_card_expiry_month.'&sourceOfFunds.provided.card.expiry.year='.$request->sourceOfFunds_provided_card_expiry_year.'&sourceOfFunds.provided.card.securityCode='.$request->sourceOfFunds_provided_card_securityCode.'&order.amount='.$request->order_amount.'&order.currency='.$request->order_currency.'&merchant='.$request->merchant.'&apiPassword='.$request->apiPassword.'&apiUsername='.$request->apiUsername;

// 

echo $request;


// order.id=20231027160401&transaction.id=20231027160401&apiOperation=PAY&sourceOfFunds.type=CARD&sourceOfFunds.provided.card.number=1928287282&sourceOfFunds.provided.card.expiry.month=01&sourceOfFunds.provided.card.expiry.year=24&sourceOfFunds.provided.card.securityCode=233&order.amount=5.00&order.currency=MYR&merchant=%5BINSERT-MERCHANT-ID%5D&apiPassword=&apiUsername=merchant.%5BINSERT-MERCHANT-ID%5D





    // foreach ($request as $fieldName => $fieldValue) {
    //   if (strlen($fieldValue) > 0 && $fieldName != "merchant" && $fieldName != "apiPassword" && $fieldName != "apiUsername") {
    //     // replace underscores in the fieldnames with decimals
    //     for ($i = 0; $i < strlen($fieldName); $i++) {
    //       if ($fieldName[$i] == '_')
    //         $fieldName[$i] = '.';
    //     }
    //     $request .= $fieldName . "=" . urlencode($fieldValue) . "&";
    //   }
    // }



    // [Snippet] howToSetCredentials - start
    // For NVP, authentication details are passed in the body as Name-Value-Pairs, just like any other data field
    // $request .= "merchant=" . urlencode($merchantId) . "&";
    // $request .= "apiPassword=" . urlencode($password) . "&";
    // $request .= "apiUsername=" . urlencode($apiUsername);
    // [Snippet] howToSetCredentials - end
    
    $curlObj = curl_init();
    // [Snippet] howToPost - start
    curl_setopt($curlObj, CURLOPT_POSTFIELDS, $request);
    // [Snippet] howToPost - end

    // [Snippet] howToSetURL - start
       $gatewayUrl = $gatewayUrl;
        $gatewayUrl .= "/version/" . $version;

        echo $gatewayUrl;
    curl_setopt($curlObj, CURLOPT_URL, $gatewayUrl);
        // [Snippet] howToSetURL - end

    // [Snippet] howToSetHeaders - start
    // set the content length HTTP header
    curl_setopt($curlObj, CURLOPT_HTTPHEADER, array("Content-Length: " . strlen($request)));

    // set the charset to UTF-8 (requirement of payment server)
    curl_setopt($curlObj, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded;charset=UTF-8"));
    // [Snippet] howToSetHeaders - end

    // tells cURL to return the result if successful, of FALSE if the operation failed
    curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, TRUE);

    // this is used for debugging only. This would not be used in your integration, as DEBUG should be set to FALSE
    if ($debug) {
      curl_setopt($curlObj, CURLOPT_HEADER, TRUE);
      curl_setopt($curlObj, CURLINFO_HEADER_OUT, TRUE);
    }

    // [Snippet] executeSendTransaction - start
    // send the transaction
    $response = curl_exec($curlObj);

    dd($response);
    // [Snippet] executeSendTransaction - end

    // this is used for debugging only. This would not be used in your integration, as DEBUG should be set to FALSE
    if ($debug) {
      $requestHeaders = curl_getinfo($curlObj);
      $response = $requestHeaders["request_header"] . $response;
    }

    // assigns the cURL error to response if something went wrong so the caller can echo the error
    if (curl_error($curlObj))
      $response = "cURL Error: " . curl_errno($curlObj) . " - " . curl_error($curlObj);

 
      



    }
   


}
