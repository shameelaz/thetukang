@extends('web::perakepay.frontend.layouts.base')
<link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/wizard/assets/css/bd-wizard.css') }}">




@section('content')
    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Bayaran</h5>
        </div>
    </div>
    <br>

        <div class="container">
          <div class="row">

            <div class="col-sm-12">
            <center><h5>Card Payment</h5></center>
            </div>
          </div>
        </div>
 <div class="container my-3">

    <div class="card style-border">
        <div class="card-body p-md-4">

       

        {!! form()->open()->post()->action(url('/bayaran/card'))->attribute('id', 'myform1')->horizontal() !!}



        <input type="hidden" name="apiOperation" value="PAY" id="apiOperation"/>
        <input type="hidden" name="merchant" value="TEST10710800001" id="merchant"/>
        <input type="hidden" name="order.amount" value="{{$total_bayar}}" id="order.amount"/>
        <input type="hidden" name="order.currency" value="MYR" id="order.currency"/>
        <input type="hidden" name="order.id" value="{{$payment_no}}" id="order.id"/>
        <input type="hidden" name="transaction.id" value="{{$payment_no}}" id="transaction.id"/>
        <input type="hidden" name="sourceOfFunds.type" value="CARD" id="sourceOfFunds.type"/>
        <input type="hidden" name="apiPassword" value="79ee1a82e6f639bb5d3e9596ef15e294" id="apiPassword"/>
        <input type="hidden" name="apiUsername" value="merchant.TEST10710800001" id="apiUsername"/>
       <!--  <input type="hidden" name="sourceOfFunds.provided.card.expiry.month" value="05" id="sourceOfFunds.provided.card.expiry.month"/>
        <input type="hidden" name="sourceOfFunds.provided.card.expiry.year" value="13" id="sourceOfFunds.provided.card.expiry.year"/>
        <input type="hidden" name="sourceOfFunds.provided.card.number" value="5123456789012346" id="sourceOfFunds.provided.card.number"/>
        <input type="hidden" name="sourceOfFunds.provided.card.securityCode" value="112" id="sourceOfFunds.provided.card.securityCode"/>
  -->

      
        
        <!-- <input type="hidden" name="interaction.operation" value="AUTHORIZE" id="interaction.operation"/>
        <input type="hidden" name="interaction.merchant.name" value="PEJ KEWANGAN NEG PERAK" id="interaction.merchant.name"/>
        
        
        
        <input type="hidden" name="order.description" value="{{data_get($kodhasilval,'ptj.name')}}" id="order.description"/>
        <input type="hidden" name="sourceOfFunds.provided.boletoBancario.dueDate" value="2023-10-12" id="sourceOfFunds.provided.boletoBancario.dueDate"/> -->
        
      <!--   <input type="hidden" name="sourceOfFunds.provided.card.expiry.month" value="05" id="sourceOfFunds.provided.card.expiry.month"/>
        <input type="hidden" name="sourceOfFunds.provided.card.expiry.year" value="13" id="sourceOfFunds.provided.card.expiry.year"/>
        <input type="hidden" name="sourceOfFunds.provided.card.number" value="5123456789012346" id="sourceOfFunds.provided.card.number"/>
        <input type="hidden" name="sourceOfFunds.type" value="CARD" id="sourceOfFunds.type"/>
 -->

        






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
                     <label for="" class="col-sm-2 col-form-label">{{ data_get($list, '0.fkservice.fkpaymentgateway.name') }}</label>
                </div>
              </div>


               @if($paymentgateway ==1)<!--fpx--->
                <div class="row mb-3">
                  <label for="" class="col-sm-2 col-form-label"><b>Jenis Akaun</b></label>
                 @if(data_get($list, '0.fkservice.fpx_type')=='01')
                   <label for="" class="col-sm-10 col-form-label">Akaun Individu</label>
                  @else
                   <label for="" class="col-sm-10 col-form-label">Akaun Korporat</label>
                  @endif
                </div>
               @else <!--card payment-->
               <div class="mb-3 row">
                    <label for="paymenttype" class="col-sm-2 col-form-label"><b>Jenis Kad</b></label>
                    <div class="col-sm-9">
                        @if(data_get($list, '0.fkservice.card_type')==1)
                        <label for="" class="col-sm-10 col-form-label">Debit</label>
                        @else
                         <label for="" class="col-sm-10 col-form-label">Kredit</label>
                        @endif
                    </div>
                </div>
                 <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"><b>No Kad</b></label>
                    <div class="col-sm-5">
                       <input type="number" name="sourceOfFunds.provided.card.number" id="sourceOfFunds.provided.card.number" class="form-control" placeholder="No Kad" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"><b>Tarikah Luput</b></label>
                    <div class="col-sm-1">
                       <input name="sourceOfFunds.provided.card.expiry.month" id="sourceOfFunds.provided.card.expiry.month" class="form-control" placeholder="Month" type="text" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');"required>
                    </div>/
                    <div class="col-sm-1">
                      <input name="sourceOfFunds.provided.card.expiry.year" id="sourceOfFunds.provided.card.expiry.year" class="form-control" placeholder="Year" type="text" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"><b>CVV</b></label>
                    <div class="col-sm-1">
                       <input name="sourceOfFunds.provided.card.securityCode" id="sourceOfFunds.provided.card.securityCode" class="form-control" placeholder="CVV" type="text" maxlength="3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
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
                    <label for="paymenttype" class="col-sm-2 col-form-label"><b>Jenis Kad</b></label>
                    <div class="col-sm-9">
                       @if(data_get($srvmain,'card_type')=='1')
                        <label for="" class="col-sm-10 col-form-label">Debit</label>
                        @else
                         <label for="" class="col-sm-10 col-form-label">Kredit</label>
                        @endif
                    </div>
                </div>
                 <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"><b>No Kad</b></label>
                    <div class="col-sm-9">
                       <input type="text" name="nokad" id="nokad" class="form-control" placeholder="No Kad">
                    </div>
                </div>
              @endif<!--end fpx/card -->

              @endif<!--end-troli-bukan troli.terus-->

            <br>


            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <a href="/bayaran/tiket/2/4/edit/16" class="btn btn-dark">Kembali</a>
            <button  type="submit" id="ajaxBtn" class="btn btn-primary">Buat Bayaran</button>

        </div>
        </div>
        {!! form()->close()!!}




        </div>
    </div>

</div>
@endsection
@push('script')
<script type="text/javascript">
        $(document).ready(function () {

        //  $('#ajaxBtn').click(function(){

        //     alert('sini');


        //      var form = $('#myform1').find('input[name!=_token]').serialize();

        //         //console log
        //      console.log(form);


        //      $.ajax({
        //         url :"https://test-bimb.mtf.gateway.mastercard.com/api/nvp/version/75",
        //         type: "POST",
        //         contentType: "application/x-www-form-urlencoded",
        //         data:form,
        //         success: function(response){
        //             console.log(response)
        //         },
        //         error:function(response){
        //             alert("something went wrong");
        //         }
        //     });


        // });
    });
    </script>






@endpush
