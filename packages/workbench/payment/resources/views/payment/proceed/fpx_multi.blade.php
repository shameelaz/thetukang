@extends('web::perakepay.frontend.layouts.base')
    <link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/wizard/assets/css/bd-wizard.css') }}">
@section('content')

<style>
    img 
    {
        width: 10vw;
        height: 7vw;
        padding: 1vw;
    }
    input[type=radio] 
    {
        display: none;
    }
    img:hover 
    {
        opacity:0.6;
        cursor: pointer;
    }
    img:active 
    {
        opacity:0.4;
        cursor: pointer;
    }
    input[type=radio]:checked + label > img 
    {
        border: 10px solid rgb(228, 207, 94);
    }
</style>

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style">Bayaran</h5>
    </div>
</div>
<br>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <center> <img src="{{ URL::asset('fpx.png') }}" alt="perakpay" style="width:200px;height: 100px"></center>
        </div>
    </div>
</div>

<div class="container my-3">
    <div class="card style-border">
        <div class="card-body p-md-4">

            {!! form()->open()->post()->action(url('/bayaran/fpx/updateBank'))->attribute('id', 'myform')->horizontal() !!} 

                <div class="content-wrapper">
                    <h4 class="section-heading">Ringkasan Troli</h4>

                    <!-- foreach($list[0]->fk_service as $key => $list) -->
                    <div class="mb-3 row">
                        <label for="agency" class="col-sm-3 col-form-label">Agensi</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control-plaintext" id="agency" value="{{ data_get($list, '0.fkpayer.fkagency.name') }}{{ data_get($list, '0.fkservice.fkkodhasil.agency.name') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="paymenttype" class="col-sm-3 col-form-label">Kaedah Pembayaran</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="{{ data_get($list,'0.fkservice.fkpaymentgateway.name') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="paymenttype" class="col-sm-3 col-form-label">Nama Pembayar</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="{{  data_get($list, '0.fkpayer.name') }}">
                        </div>
                    </div>
                    
                    @if(data_get($list, '0.fkservice.fk_payment_gateway')=='1')
                    <div class="mb-3 row">
                        <label for="paymenttype" class="col-sm-3 col-form-label">Jenis Akaun</label>
                        <div class="col-sm-9">
                            @if(data_get($list, '0.fkservice.fpx_type')=='01')
                             <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Akaun Individu">
                            @else
                             <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Akaun Korporat">
                            @endif
                         
                        </div>
                    </div>
                    @endif

                    @if(data_get($list, '0.fkservice.fk_payment_gateway')=='2')
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
                    @endif

                    <!-- endforeach -->

                    <div class="row g-2">
                        <div class="col-md-12 col-lg-12">

                            <div class="table-responsive">
                                <table id="data-table-agency" class="table mt-2" style="width:100%;font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;" valign="top">Bil</th>
                                            <th style="text-align: left;" valign="top">Perkhidmatan</th>
                                            <th style="text-align: left;" valign="top">No Akaun</th>
                                            <!-- <th style="text-align: left;" valign="top">Nama Pemegang Akaun</th> -->
                                            <!-- <th style="text-align: left;" valign="top">Agensi</th> -->
                                            <th style="text-align: left;" valign="top">Kod Hasil</th>
                                            <th style="text-align: center;" valign="top">Amaun (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $bil=1;
                                            $total = 0;
                                        ?>

                                            @foreach($list as $key => $value)
                                            
                                                <tr>
                                                    <td class="text-center" valign="top">{{ $bil++ }}</td>
                                                    <td class="text-left" valign="top">
                                                        {{ data_get($value, 'fkservice.serviceratemgt.lkpperkhidmatan.name') }}
                                                        {{ data_get($value, 'fkservice.fkkodhasil.lkpperkhidmatan.name') }}
                                                    </td>
                                                    <td class="text-center" valign="top">
                                                        {{ data_get($value, 'fkpayer.account_no') }}
                                                        {{ data_get($value, 'fkpayerbill.account_no') }}
                                                    </td> <!-- hold utk bil -->
                                                    <!-- <td class="text-left" valign="top"> data_get($value, 'fkpayer.name') }}</td> -->
                                                    <!-- <td class="text-left" valign="top">
                                                         data_get($value, 'fkpayer.fkagency.name') }}
                                                         data_get($value, 'fkservice.fkkodhasil.agency.name') }}
                                                    </td> -->
                                                    <td class="text-left" valign="top">
                                                        {{ data_get($value, 'fkservice.serviceratemgt.name') }}
                                                        {{ data_get($value, 'fkservice.fkkodhasil.name') }}
                                                    </td>
                                                    <td class="text-center" valign="top">{{ data_get($value, 'amount') }}</td>
                                                </tr>
                                                <?php

                                                    $total += data_get($value, 'amount');

                                                ?>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" style="text-align: right">
                                                    <b>JUMLAH KESELURUHAN</b>
                                                </td>
                                                <td colspan="1" style="text-align: center">
                                                    <b>RM {{ number_format($total, 2, '.', '') }}</b>
                                                </td>
                                            </tr>

                                    </tbody>
                                </table>
                            </div>

                           <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label"><b>Bank</b></label>
                                <div class="col-sm-10" id="bank">
                                    <input type="radio" name="bank" id="choose-1" value="MAYBANK" required="required" />
                                    <label for="choose-1">
                                      <img src="/maybank.jpg" />
                                    </label>
                                    <input type="radio" name="bank" id="choose-2" value="CIMB" readonly="required" />
                                    <label for="choose-2">
                                      <img src="/cimb.png" />
                                    </label>
                                    <input type="radio" name="bank" id="choose-3" value="RHB" required="required" />
                                    <label for="choose-3">
                                      <img src="/rhb.png" />
                                    </label>
                                </div>
                            </div>
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="checkterm" id="checkterm" value="accept" required>
                                 <span class="form-check-label">Dengan memilih mod pembayaran ini, anda bersetuju dengan <a href="https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp" target="_blank">terma dan syarat</a> FPX.</span>
                            </label>
                            <br>
                            <br>

                        </div>
                    </div>

                </div>
            {!! form()->close() !!}
            
        </div>
    </div>
</div>

@endsection

@push('script')
<script type="text/javascript">

</script>
@endpush
