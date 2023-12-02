@extends('web::perakepay.frontend.layouts.base')
<link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/wizard/assets/css/bd-wizard.css') }}">
@section('content')




    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Demo Bank</h5>
        </div>
    </div>
    <br>

        <div class="container">
          <div class="row">
            <div class="col-sm-12">
            @if(data_get($data,'bank')=='MAYBANK')
            <center> <img src="{{ URL::asset('maybank.png') }}" alt="perakpay" style="width:200px;height: 100px"></center>
            @elseif(data_get($data,'bank')=='CIMB')
            <center> <img src="{{ URL::asset('cimb.png') }}" alt="perakpay" style="width:200px;height: 100px"></center>
            @else
            <center> <img src="{{ URL::asset('rhb.png') }}" alt="perakpay" style="width:200px;height: 100px"></center>
            @endif
            </div>
          </div>
        </div>
 <div class="container my-2">

    <center><div class="card style-border" style="width: 600px">
        <div class="card-body p-md-2">

      <form name="form1" method="post" >

        <div id="div-individu" style="">
            <div class="col-sm-12">
              <center> <img src="{{ URL::asset('fpx.png') }}" alt="perakpay" style="width:150px;height: 75px"></center>
            </div>
                <div class="mb-3 row">
                      <label for="agency" class="col-sm-6 col-form-label" style="text-align: right;"><b>From Account</b></label>
                      <label for="agency" class="col-sm-6 col-form-label" style="text-align: left;">xxxxx</label>
                  </div>
                  <div class="mb-3 row">
                      <label for="agency" class="col-sm-6 col-form-label" style="text-align: right;"><b>Merchant Name</b></label>
                      <label for="agency" class="col-sm-6 col-form-label" style="text-align: left;">PEJABAT KEWANGAN NEGERI BENDAHARI NEGERI PERAK</label>

                  </div>
                  <div class="mb-3 row">
                      <label for="service" class="col-sm-6 col-form-label" style="text-align: right;"><b>Payment Referance</b></label>
                      <label for="agency" class="col-sm-6 col-form-label" style="text-align: left;">{{data_get($data,'transaction_no')}}</label>
                  </div>
                  <div class="mb-3 row">
                      <label for="paymenttype" class="col-sm-6 col-form-label" style="text-align: right;"><b>FPX Transaction ID</b></label>
                       <?php $txnId = "FPX".date('YmdHis');?>
                      <label for="agency" class="col-sm-6 col-form-label" style="text-align: left;">{{$txnId}}</label>
                  </div>

               <div class="mb-3 row">
                   <label for="" class="col-sm-6 col-form-label" style="text-align: right;"><b>Amaun (MYR)</b></label>
                   <label for="agency" class="col-sm-6 col-form-label" style="text-align: left;">{{data_get($data,'total_amount')}}</label>
              </div>


            <div class="d-grid gap-2 d-md-flex justify-content-md-center">


           @if($flaglogin==0)
             <a href="/bayaran/fpx/{{data_get($data,'id')}}/{{$flaglogin}}/{{$flagpay}}/{{$txnId}}" class="btn btn-primary">Demo Bayar</a>
           @else
             <a href="/login/bayaran/fpx/{{data_get($data,'id')}}/{{$flaglogin}}/{{$flagpay}}/{{$txnId}}" class="btn btn-primary">Demo Bayar</a>
           @endif

            @if($flaglogin==0)<!---x login-->

            @if($flagpay==1)<!--ticket-->
            <a href="/bayaran/tiket/{{$kodhasil}}/{{$tab}}/edit/{{$srvmain}}" class="btn btn-dark">Cancel</a>
            @elseif($flagpay==2)<!--bill-->
            <a href="/bayaran/bill/{{$kodhasil}}/{{$tab}}/edit/{{$srvmain}}" class="btn btn-dark">Cancel</a>
            @else<!--others-->
            <a href="/bayaran/hasil/{{$kodhasil}}/{{$tab}}/edit/{{$srvmain}}" class="btn btn-dark">Cancel</a>
            @endif

            @else <!--login-->

            @if($flagtroli==1)<!--troli-->
            <a href="/login/cart/next/{{$tab}}/{{$troliflag}}" class="btn btn-dark">Cancel</a>

            @else<!--bukan troli.terus-->

            @if($flagpay==1)<!--ticket-->
            <a href="/login/bayaran/tiket/{{$kodhasil}}/{{$tab}}/edit/{{$srvmain}}" class="btn btn-dark">Cancel</a>
            @elseif($flagpay==2)<!--bill-->
            <a href="/login/bayaran/bill/{{$kodhasil}}/{{$tab}}/edit/{{$srvmain}}" class="btn btn-dark">Cancel</a>
            @else<!--others-->
            <a href="/login/bayaran/hasil/{{$kodhasil}}/{{$tab}}/edit/{{$srvmain}}" class="btn btn-dark">Cancel</a>
            @endif

            @endif<!--end troli/bukan troli.terus-->
            @endif<!--end login/x login-->




           <!--  <button type="submit" class="btn btn-primary">Buat Bayaran</button> -->

        </div>
        </div>


       </form>

        </div>
    </div></center>

</div>

@endsection
@push('script')
    <script type="text/javascript">


</script>


@endpush
