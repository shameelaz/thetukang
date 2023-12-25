@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Teruskan</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">

        <?php

            //Merchant will need to edit the below parameter to match their environment.
            error_reporting(E_ALL);

            /* Generating String to send to fpx */
            /*For B2C, message.token = 01
            For B2B1, message.token = 02 */

            $fpx_msgType="AR";
            $fpx_msgToken="01";
            $fpx_sellerExId="EX00003846";
            $fpx_sellerExOrderNo=date('YmdHis');
            $fpx_sellerTxnTime=date('YmdHis');
            $fpx_sellerOrderNo=date('YmdHis');
            $fpx_sellerId="SE00004293";
            $fpx_sellerBankCode="01";
            $fpx_txnCurrency="MYR";
            $fpx_txnAmount=$_POST['TxnAmount'];
            $fpx_buyerEmail="wan.rizuan@3fresources.com";
            $fpx_checkSum="";
            $fpx_buyerName="";
            $fpx_buyerBankId="TEST0021";
            $fpx_buyerBankBranch="";
            $fpx_buyerAccNo="";
            $fpx_buyerId="";
            $fpx_makerName="";
            $fpx_buyerIban="";
            $fpx_productDesc="SampleProduct";
            $fpx_version="6.0";

            /* Generating signing String */
            $data=$fpx_buyerAccNo."|".$fpx_buyerBankBranch."|".$fpx_buyerBankId."|".$fpx_buyerEmail."|".$fpx_buyerIban."|".$fpx_buyerId."|".$fpx_buyerName."|".$fpx_makerName."|".$fpx_msgToken."|".$fpx_msgType."|".$fpx_productDesc."|".$fpx_sellerBankCode."|".$fpx_sellerExId."|".$fpx_sellerExOrderNo."|".$fpx_sellerId."|".$fpx_sellerOrderNo."|".$fpx_sellerTxnTime."|".$fpx_txnAmount."|".$fpx_txnCurrency."|".$fpx_version;

            /* Reading key */
            $priv_key = file_get_contents('C:\\pki-keys\\DevExchange\\EX00003846.key');
            $pkeyid = openssl_get_privatekey($priv_key);
            // openssl_sign($data, $binary_signature, $pkeyid, OPENSSL_ALGO_SHA1);
            // $fpx_checkSum = strtoupper(bin2hex( $binary_signature ) );


        ?>


        <form name="form1" method="post" action="https://uat.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp" >


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


        <div id="div-individu" style="">

            <table border="0" cellpadding="2" cellspacing="1" width="100%">
                <tbody>
                  <tr class="infoBoxContents">
                    <td valign="top" width="30%"><table border="0" cellpadding="2" cellspacing="0" width="100%">
                        <tbody>
                          <tr>
                            <td height="164" align="center" class="main"><b>Payment Method via FPX</b>
                            <p>&nbsp;</p>
                            <input type="submit" style="cursor:hand" value="Click to Pay"/>
                              <p>&nbsp;</p>
                              <p> <img src="image/FPXButton.PNG" border="2"/></p>
                              <p>&nbsp;</p>
                              <p class="main">&nbsp;</p>
                              <p class="main"><strong>* You must have Internet Banking Account in order to make transaction using FPX.</strong></p>
                              <p>&nbsp;</p>
                              <p class="main"><strong>* Please ensure that your browser's pop up blocker has been disabled to avoid any interruption during making transaction.</strong></p>
                              <p>&nbsp;</p>
                              <p class="main"><strong>* Do not close browser / refresh page until you receive response.</strong></p>
                            <p>&nbsp;</p></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table>

            {{-- <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Total (RM)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="TxnAmount" name="TxnAmount"
                        value="{{ data_get($request,'TxnAmount') }}" required="required">

                </div>
            </div> --}}

            {{-- <button type="submit" class="btn btn-primary">Bayar</button> --}}
        </div>

        </form>




        </div>
    </div>

</div>

@endsection

@push('script')
<script type="text/javascript">
  $( document ).ready(function() {



    });
</script>
@endpush
