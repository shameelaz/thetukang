@extends('web::perakepay.frontend.layouts.base')
<link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/wizard/assets/css/bd-wizard.css') }}">
@section('content')

<?php
/// Summary description for Controller
///  ErrorCode  : Description
///  00         : Your signature has been verified successfully.
///  06         : No Certificate found
///  07         : One Certificate Found and Expired
///  08         : Both Certificates Expired
///  09         : Your Data cannot be verified against the Signature.
function hextobin($hexstr)
{
    $n = strlen($hexstr);
    $sbin="";
    $i=0;
    while($i<$n)
    {
        $a =substr($hexstr,$i,2);
        $c = pack("H*",$a);
        if ($i==0){$sbin=$c;}
        else {$sbin.=$c;}
        $i+=2;
    }
    return $sbin;
}


function validateCertificate($path,$sign, $toSign)
{
    global  $ErrorCode;

    $d_ate=date("Y");
    //validating Last Three Certificates
    $fpxcert=array($path."fpxuat_current.cer",$path."EX00017272.cer");
    $certs=checkCertExpiry($fpxcert);
    // echo count($certs) ;
            $signdata = hextobin($sign);


    if(count($certs)==1)
    {

       $pkeyid =openssl_pkey_get_public($certs[0]);
       $ret = openssl_verify($toSign, $signdata, $pkeyid);
          if($ret!=1)
          {
           $ErrorCode=" Your Data cannot be verified against the Signature. "." ErrorCode :[09]";
           return "09";
          }
    }
     elseif(count($certs)==2)
    {

     $pkeyid =openssl_pkey_get_public($certs[0]);
     $ret = openssl_verify($toSign, $signdata, $pkeyid);
       if($ret!=1)
       {

        $pkeyid =openssl_pkey_get_public($certs[1]);
        $ret = openssl_verify($toSign, $signdata, $pkeyid);
         if($ret!=1)
         {
          $ErrorCode=" Your Data cannot be verified against the Signature. "." ErrorCode :[09]";
          return "09";
          }
        }

    }
     if($ret==1)
     {

        $ErrorCode=" Your signature has been verified successfully. "." ErrorCode :[00]";
        return "00";
     }


    return $ErrorCode;



}
function verifySign_fpx($sign,$toSign)
{
   error_reporting(0);

return validateCertificate('/opt/fpx/',$sign, $toSign);
}

function checkCertExpiry($path)
{
        global  $ErrorCode;

      $stack = array();
    $t_ime= time();
    $curr_date=date("Ymd",$t_ime);
     for($x=0;$x<2;$x++)
     {
           error_reporting(0);
          $key_id = file_get_contents($path[$x]);
           if($key_id==null)
           {
               $cert_exists++;
             continue;
           }
           $certinfo = openssl_x509_parse($key_id);
           $s= $certinfo['validTo_time_t'];
           $crtexpirydate=date("Ymd",$s-86400);
          if($crtexpirydate > $curr_date)
           {
                if ($x > 0)
                {
                 if(certRollOver($path[$x], $path[$x-1])=="true")
                     {  array_push($stack,$key_id);
                        return $stack;
                      }
                }
                array_push($stack,$key_id);
              return $stack;
           }
           elseif($crtexpirydate == $curr_date)
           {
                 if ($x > 0 && (file_exists($path[$x-1])!=1))
                 {
                       if(certRollOver($path[$x], $path[$x-1])=="true")
                       {  array_push($stack,$key_id);
                          return $stack;
                     }
                 }
                 else if(file_exists($path[$x+1])!=1)
                 {
                         array_push($stack,file_get_contents($path[$x]),$key_id);
                         return $stack;
                 }


                array_push($stack,file_get_contents($path[$x+1]),$key_id);

                return $stack;
            }

     }
          if ($cert_exists == 2)
                $ErrorCode="Invalid Certificates.  " . " ErrorCode : [06]";  //No Certificate (or) All Certificate are Expired
            else if ($stack.Count == 0 && $cert_exists == 1)
                $ErrorCode="One Certificate Found and Expired " . "ErrorCode : [07]";
            else if ($stack.Count == 0 && $cert_exists == 0)
               $ErrorCode="Both Certificates Expired " . "ErrorCode : [08]";
            return $stack;


}
function certRollOver($old_crt,$new_crt)
{

        if (file_exists($new_crt)==1)
        {

                rename($new_crt,$new_crt."_".date("YmdHis", time()));//FPXOLD.cer to FPX_CURRENT.cer_<CURRENT TIMESTAMP>

        }
        if ((file_exists($new_crt)!=1) && (file_exists($old_crt)==1))
        {
            rename($old_crt,$new_crt);                                 //FPX.cer to FPX_CURRENT.cer
        }


        return "true";
}

//Merchant will need to edit the below parameter to match their environment.
error_reporting(E_ALL);

/* Generating String to send to fpx */
/*For B2C, message.token = 01
 For B2B1, message.token = 02 */

/*$fpx_msgToken="01";*/
$fpx_msgToken=$fpxtype;
$fpx_msgType="BE";
//$fpx_sellerExId="EX00017272";
$fpx_sellerExId=data_get($merchant,'exchange_id');
$fpx_version="6.0";
/* Generating signing String */
$data=$fpx_msgToken."|".$fpx_msgType."|".$fpx_sellerExId."|".$fpx_version;
/* Reading key */
$priv_key = file_get_contents('/opt/fpx/EX00017272.key');
$pkeyid = openssl_get_privatekey($priv_key);
openssl_sign($data, $binary_signature, $pkeyid, OPENSSL_ALGO_SHA1);
$fpx_checkSum = strtoupper(bin2hex( $binary_signature ) );


//extract data from the post

extract($_POST);
$fields_string="";

//set POST variables
$url ='https://uat.mepsfpx.com.my/FPXMain/RetrieveBankList';

$fields = array(
                        'fpx_msgToken' => urlencode($fpx_msgToken),
                        'fpx_msgType' => urlencode($fpx_msgType),
                        'fpx_sellerExId' => urlencode($fpx_sellerExId),
                        'fpx_checkSum' => urlencode($fpx_checkSum),
                        'fpx_version' => urlencode($fpx_version)

                );
$response_value=array();
$bank_list=array();

try{
//url-ify the data for the POST
// try{
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');
rtrim($fields_string, '&');
substr($fields_string, 0, -1);

//open connection
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);

curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
//execute post
$result = curl_exec($ch);




//close connection
curl_close($ch);





$token = strtok($result, "&");

// $debug = [

//   'url' => 'https://uat.mepsfpx.com.my/FPXMain/RetrieveBankList',
//   'arrayfield' => $fields_string,
//   'curl_call' => $ch,
//   'result' => $result,

// ];





while ($token !== false)
{
    list($key1,$value1)=explode("=", $token);
    $value1=urldecode($value1);
    $response_value[$key1]=$value1;
    $token = strtok("&");
}



//Response Checksum Calculation String
$data=$response_value['fpx_bankList']."|".$response_value['fpx_msgToken']."|".$response_value['fpx_msgType']."|".$response_value['fpx_sellerExId'];
$val=verifySign_fpx($response_value['fpx_checkSum'], $data);

// val == 00 verification success

$token = strtok($response_value['fpx_bankList'], ",");


while ($token !== false)
{
    list($key1,$value1)=explode("~", $token);
    $value1=urldecode($value1);
    $bank_list[$key1]=$value1;
    $token = strtok(",");
}



//dd($bank_list);

}
catch(Exception $e){
    echo 'Error :', ($e->getMessage());
}

?>


    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Bayaran</h5>
        </div>
    </div>
    <br>

        <div class="container">
          <div class="row">

            <div class="col-sm-12">
            <center> <img src="{{ URL::asset('FPX_Logo_FA_Full_FC.png') }}" alt="perakpay" style="width:350px;height: 150px"></center>
            </div>
          </div>
        </div>
 <div class="container my-3">

    <div class="card style-border">
        <div class="card-body p-md-4">

         @if($flaglogin==1)
        {!! form()->open()->post()->action(url('/login/bayaran/fpx/updateBank'))->attribute('id', 'myform')->horizontal() !!}

        @else
        {!! form()->open()->post()->action(url('/bayaran/fpx/updateBank'))->attribute('id', 'myform')->horizontal() !!}
        @endif

        <input type="hidden" name="paymentid" value="{{$paymentid}}" />
        <input type="hidden" name="id" value="{{$id}}" />
        <input type="hidden" name="tab" value="{{$tab}}" />
        <input type="hidden" name="flaglogin" value="{{$flaglogin}}" />
        <input type="hidden" name="flagpay" value="{{$flagpay}}" />
         @if($request->flagtroli==1)<!--troli-->
        <input type="hidden" name="flagtroli" value="1" />
        @else
        <input type="hidden" name="flagtroli" value="0" />
        @endif
        <input type="hidden" name="troliflag" value="{{$troliflag}}" />
        <input type="hidden" name="kodhasilval" value="{{data_get($kodhasilval,'id')}}" />



              <div id="div-individu" style="">

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><b>Amaun (MYR)</b></label>
                <div class="col-sm-10">
                    <label for="" class="col-sm-2 col-form-label">{{$total_bayar}}</label>

                </div>
            </div>
              <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><b>Order No</b></label>
                <div class="col-sm-10">
                   <label for="" class="col-sm-2 col-form-label">{{$payment_no}}</label>

                </div>
            </div>

           <div class="mb-3 row">
                  <label for="agency" class="col-sm-2 col-form-label"><b>Agensi</b></label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="agency" value="{{ data_get($kodhasilval,'agency.name') }}">
                  </div>
              </div>
              <div class="mb-3 row">
                  <label for="agency" class="col-sm-2 col-form-label"><b>PTJ</b></label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="ptj" value="{{ data_get($kodhasilval,'ptj.name') }}">
                  </div>
              </div>

              @if($request->flagtroli==1)<!--troli-->
               <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><b>Cara Pembayaran</b></label>
                <div class="col-sm-10">
                     <label for="" class="col-sm-2 col-form-label">{{$paymentgateway_name}}</label>
                </div>
              </div>


               @if($paymentgateway ==1)<!--fpx--->
                <div class="row mb-3">
                  <label for="" class="col-sm-2 col-form-label"><b>Jenis Akaun</b></label>
                 @if($fpxtype=='01')
                   <label for="" class="col-sm-10 col-form-label">Akaun Individu</label>
                  @else
                   <label for="" class="col-sm-10 col-form-label">Akaun Korporat</label>
                  @endif
                </div>
               @else <!--card payment-->
               <div class="mb-3 row">
                    <label for="paymenttype" class="col-sm-3 col-form-label">Jenis Kad</label>
                    <div class="col-sm-9">
                        @if(data_get($list, '0.fkservice.card_type')==1)
                         <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Debit">
                        @else
                         <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Kredit">
                        @endif
                    </div>
                </div>
              @endif<!--end fpx/card -->

              @else<!--bukan troli.terus-->

               <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><b>Cara Pembayaran</b></label>
                <div class="col-sm-10">
                     <label for="" class="col-sm-2 col-form-label">{{$paymentgateway_name}}</label>
                </div>
                </div>

              @if($paymentgateway ==1)<!--fpx--->
                 <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label"><b>Jenis Akaun</b></label>
                    @if(data_get($srvmain,'fpx_type')=='01')
                     <label for="" class="col-sm-10 col-form-label">Akaun Individu</label>
                    @else
                     <label for="" class="col-sm-10 col-form-label">Akaun Korporat</label>
                    @endif
                </div>
              @else <!--card payment-->

               <div class="mb-3 row">
                    <label for="paymenttype" class="col-sm-3 col-form-label">Jenis Kad</label>
                    <div class="col-sm-9">
                       @if(data_get($srvmain,'card_type')=='1')
                         <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Debit">
                        @else
                         <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Kredit">
                        @endif
                    </div>
                </div>
              @endif<!--end fpx/card -->

              @endif<!--end-troli-bukan troli.terus-->
           <div class="row mb-3"><!--///-->
                <label for="" class="col-sm-2 col-form-label">Bank</label>
                <div class="col-sm-10" id="bank">
                    <select  id="typebank" name="typebank" class="form-select" required="required">
                        <option value=""> Sila Pilih</option>
                         @foreach($bank_list as $key => $value)
                         <?php $ind=0?>

                          @foreach($banklist as $bank1)

                             @if($key==data_get($bank1,'bank_id'))

                            <option value="{{ $bank1->bank_id }}">

                            @if($value=='B')
                           
                            {{ $bank1->bank_name }} (Offline)

                            @else
                            
                            {{ $bank1->bank_name }}

                            @endif
                           
                         
                            </option>
                             <?php $ind=1?>     
                            @endif
                                       
                          @endforeach
                           @if($ind == 0)
                           <option value="{{ $bank1->bank_id }}">
                           
                            {{ $bank1->bank_id }}
                           
                         
                            </option>
                            @endif

                         @endforeach

                      </select>
                </div>
            </div>
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="checkterm" id="checkterm" value="accept" required>
                 <span class="form-check-label">Dengan memilih mod pembayaran ini, anda bersetuju dengan <a href="https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp" target="_blank">terma dan syarat</a> FPX.</span>
            </label>
            <br>
            <br>



            <div class="d-grid gap-2 d-md-flex justify-content-md-center">

             @if($flaglogin==0)<!---x login-->

            @if($flagpay==1)<!--ticket-->
            <a href="/bayaran/tiket/{{data_get($kodhasilval,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @elseif($flagpay==2)<!--bill-->
            <a href="/bayaran/bill/{{data_get($kodhasilval,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @else<!--others-->
            <a href="/bayaran/hasil/{{data_get($kodhasilval,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @endif

            @else <!--login-->

            @if($request->flagtroli==1)<!--troli-->
            <a href="/login/cart/next/{{$tab}}/{{$troliflag}}" class="btn btn-dark">Kembali</a>

            @else<!--bukan troli.terus-->

            @if($flagpay==1)<!--ticket-->
            <a href="/login/bayaran/tiket/{{data_get($kodhasilval,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @elseif($flagpay==2)<!--bill-->
            <a href="/login/bayaran/bill/{{data_get($kodhasilval,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @else<!--others-->
            <a href="/login/bayaran/hasil/{{data_get($kodhasilval,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @endif

            @endif<!--end troli/bukan troli.terus-->
            @endif<!--end login/x login-->
            <button type="submit" class="btn btn-primary">Seterusnya</button>
        </div>
        </div>
        {!! form()->close()!!}




        </div>
    </div>

</div>

 <div class="modal fade " id="pilihbank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Sila Pilih Bank
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ya</button>
            </div>
        </div>
        </div>
    </div>

@endsection
@push('script')
<script type="text/javascript">


</script>


@endpush
