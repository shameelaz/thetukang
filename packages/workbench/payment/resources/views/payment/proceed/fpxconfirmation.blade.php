@extends('web::perakepay.frontend.layouts.base')
<link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/wizard/assets/css/bd-wizard.css') }}">
@section('content')


<?php

//Merchant will need to edit the below parameter to match their environment.
error_reporting(E_ALL);

/* Generating String to send to fpx */
/*For B2C, message.token = 01
 For B2B1, message.token = 02 */

$fpx_msgType="AR";
$fpx_msgToken="01";
$fpx_sellerExId=data_get($merchant,'exchange_id');
$fpx_sellerExOrderNo=date('YmdHis');
$fpx_sellerTxnTime=date('YmdHis');
$fpx_sellerOrderNo=data_get($data_payment,'transaction_no');
//$fpx_sellerId="SE00024700";
$fpx_sellerId=data_get($merchant,'seller_id');
$fpx_sellerBankCode="01";
$fpx_txnCurrency="MYR";
$fpx_txnAmount=data_get($data_payment,'total_amount');
//$fpx_txnAmount=$_POST['TxnAmount'];
$fpx_buyerEmail="";
$fpx_checkSum="";
$fpx_buyerName="";
$fpx_buyerBankId=data_get($data_payment,'bank');
$fpx_buyerBankBranch="";
$fpx_buyerAccNo="";
$fpx_buyerId="";
$fpx_makerName="";
$fpx_buyerIban=$flaglogin;
$fpx_productDesc=data_get($kodhasil,'name');
$fpx_version="6.0";

/* Generating signing String */
$data=$fpx_buyerAccNo."|".$fpx_buyerBankBranch."|".$fpx_buyerBankId."|".$fpx_buyerEmail."|".$fpx_buyerIban."|".$fpx_buyerId."|".$fpx_buyerName."|".$fpx_makerName."|".$fpx_msgToken."|".$fpx_msgType."|".$fpx_productDesc."|".$fpx_sellerBankCode."|".$fpx_sellerExId."|".$fpx_sellerExOrderNo."|".$fpx_sellerId."|".$fpx_sellerOrderNo."|".$fpx_sellerTxnTime."|".$fpx_txnAmount."|".$fpx_txnCurrency."|".$fpx_version;




/* Reading key */
//$priv_key = file_get_contents('C:\\pki-keys\\DevExchange\\EX00017272.key');
$priv_key = file_get_contents('/opt/fpx/EX00017272.key');
$pkeyid = openssl_get_privatekey($priv_key);
openssl_sign($data, $binary_signature, $pkeyid, OPENSSL_ALGO_SHA1);
$fpx_checkSum = strtoupper(bin2hex( $binary_signature ) );

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
            <center><h4 class="section-heading">Ringkasan Pembayaran</h4></center>
            </div>
          </div>
        </div>
 <div class="container my-3">

    <div class="card style-border">
        <div class="card-body p-md-4">

      <form name="form1" method="post" action="https://uat.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp" >



        <div id="div-individu" style="">
                          <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">Agensi</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="agency" value="{{ data_get($kodhasil,'agency.name') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">PTJ</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="ptj" value="{{ data_get($kodhasil,'ptj.name') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="service" class="col-sm-2 col-form-label">Perkhidmatan</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="service" value="{{ data_get($kodhasil,'lkpperkhidmatan.name') }}">
                                </div>
                            </div>
              @if($flagtroli==1)<!--troli-->
               <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><b>Kaedah Pembayaran</b></label>
                <div class="col-sm-10">
                     <label for="" class="col-sm-2 col-form-label">{{ data_get($list, '0.fkservice.fkpaymentgateway.name') }}</label>
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
                     <label for="" class="col-sm-2 col-form-label">{{data_get($srvmain,'fkpaymentgateway.name')}}</label>
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

                       <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label">Bank</label>
                             <div class="col-sm-10">
                                 <label for="" class="col-sm-10 col-form-label">{{data_get($banklist,'display_name')}}</label>
                            </div>
                        </div>
                         <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label">Amaun (MYR)</label>
                             <div class="col-sm-10">
                                 <input type="text" readonly class="form-control-plaintext" id="TxnAmount" name="TxnAmount" value="{{data_get($data_payment,'total_amount')}}">
                            </div>
                        </div>


            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
               <div class="d-grid gap-2 d-md-flex justify-content-md-center">

             @if($flaglogin==0)<!---x login-->

            @if($flagpay==1)<!--ticket-->
            <a href="/bayaran/tiket/{{data_get($kodhasil,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @elseif($flagpay==2)<!--bill-->
            <a href="/bayaran/bill/{{data_get($kodhasil,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @else<!--others-->
            <a href="/bayaran/hasil/{{data_get($kodhasil,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @endif

            @else <!--login-->

            @if($request->flagtroli==1)<!--troli-->
            <a href="/login/cart/next/{{$tab}}/{{$troliflag}}" class="btn btn-dark">Kembali</a>

            @else<!--bukan troli.terus-->

            @if($flagpay==1)<!--ticket-->
            <a href="/login/bayaran/tiket/{{data_get($kodhasil,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @elseif($flagpay==2)<!--bill-->
            <a href="/login/bayaran/bill/{{data_get($kodhasil,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @else<!--others-->
            <a href="/login/bayaran/hasil/{{data_get($kodhasil,'id')}}/{{$tab}}/edit/{{$id}}" class="btn btn-dark">Kembali</a>
            @endif

            @endif<!--end troli/bukan troli.terus-->
            @endif<!--end login/x login-->
            <button type="submit" class="btn btn-primary">Buat Bayaran</button>
        </div>
        </div>

        </div>
        </div>

      <input type=hidden value="<?php print $fpx_msgType; ?>" name="fpx_msgType">
      <input type=hidden value="<?php print $fpx_msgToken; ?>" name="fpx_msgToken">
      <input type=hidden value="<?php print $fpx_sellerExId; ?>" name="fpx_sellerExId">
      <input type=hidden value="<?php print $fpx_sellerExOrderNo; ?>" name="fpx_sellerExOrderNo">
      <input type=hidden value="<?php print $fpx_sellerTxnTime; ?>" name="fpx_sellerTxnTime">
      <input type=hidden value="<?php print $fpx_sellerOrderNo; ?>" name="fpx_sellerOrderNo">
      <input type=hidden value="<?php print $fpx_sellerId; ?>" name="fpx_sellerId">
      <input type=hidden value="<?php print $fpx_sellerBankCode; ?>" name="fpx_sellerBankCode">
      <input type=hidden value="<?php print $fpx_txnCurrency; ?>" name="fpx_txnCurrency">
      <input type=hidden value="<?php print $fpx_txnAmount; ?>" name="fpx_txnAmount">
      <input type=hidden value="<?php print $fpx_buyerEmail; ?>" name="fpx_buyerEmail">
      <input type=hidden value="<?php print $fpx_checkSum; ?>" name="fpx_checkSum">
      <input type=hidden value="<?php print $fpx_buyerName; ?>" name="fpx_buyerName">
      <input type=hidden value="<?php print $fpx_buyerBankId; ?>" name="fpx_buyerBankId">
      <input type=hidden value="<?php print $fpx_buyerBankBranch; ?>" name="fpx_buyerBankBranch">
      <input type=hidden value="<?php print $fpx_buyerAccNo; ?>" name="fpx_buyerAccNo">
      <input type=hidden value="<?php print $fpx_buyerId; ?>" name="fpx_buyerId">
      <input type=hidden value="<?php print $fpx_makerName; ?>" name="fpx_makerName">
      <input type=hidden value="<?php print $fpx_buyerIban; ?>" name="fpx_buyerIban">
      <input type=hidden value="<?php print $fpx_version; ?>" name="fpx_version">
      <input type=hidden value="<?php print $fpx_productDesc; ?>" name="fpx_productDesc">
       </form>

        </div>
    </div>

</div>

@endsection
@push('script')
    <script type="text/javascript">


</script>


@endpush
