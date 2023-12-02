@extends('web::perakepay.frontend.layouts.base')
<link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/wizard/assets/css/bd-wizard.css') }}">

<style>
    .wizard .steps>ul li.current a {
        background-color: #E6C208 !important;
    }

    .wizard .steps>ul li .bd-wizard-step-subtitle {
        line-height: 1;
        font-size: 14px;
        color: #111111;
    }

    .content {
        border: 1px 1px #000000a6;
    }

    .wizard {
        padding: 30px 35px 20px 35px;
        background-color: #fff;
        /* min-height: 420px; */
        border-right: 3px solid #E6C208;
        border-bottom: 3px solid #E6C208;
        box-shadow: 6px 6px #000000a6;
    }

    .wizard .content .form-control {
        /* padding: 8px 9px; */
        padding: 0.375rem 2.25rem 0.375rem 0.75rem;
        min-height: 25px;
        max-width: 100% !important;
        border-radius: 4px;
        border: solid 1px #ececec;
    }

    .separator 
    {
        display: flex;
        align-items: center;
        text-align: center;
        width: 50%;
        margin: 5px;
    }

    .separator::before, .separator::after 
    {
        content: '';
        flex: 1;
        border-bottom: 1px solid #000;
    }

    .separator:not(:empty)::before 
    {
        margin-right: .25em;
    }

    .separator:not(:empty)::after 
    {
        margin-left: .25em;
    }
</style>


@section('content')
    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Bayaran Secara Terus</h5>
        </div>
    </div>
    <br>
    <div class="container">

        <div id="wizard" class="card wizard style-border">
            <div id="div-tab">

            </div>

            <div class="content clearfix tab-content">
                <div class="tab-pane fade active" id="pills-search" role="tabpanel" aria-labelledby="pills-home-tab">
                    <section>
                        {!! form()->open()->post()->action(url('/login/bayaran/bill/update'))->attribute('id', 'formsubmit')->horizontal() !!}

                        <input type="hidden"  name="kodhasil" value="{{ data_get($kodhasil,'id') }}" />
                        <input type="hidden"  name="tab" value="1"/>
                        <input type="hidden"  name="id" value="{{ data_get($srvmain,'id') }}" />

                        <?php
                            $temp = array();
                            // $kodhasillist = data_get()
                            foreach($kodhasillist as $key => $value)
                            {
                                array_push($temp,data_get($value,'reference_name'));
                            }
                            $refname = implode(",", $temp);

                        ?>
                        
                        <div class="content-wrapper">
                            <h4 class="section-heading">Carian </h4>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="firstName" class="sr-only">{{ $refname }}</label>
                                    <input type="text" class="form-control" id="refno" name="refno" value="" >
                                    <label for="hidden" class="sr-only">&nbsp;</label>
                                </div>
                            </div>

                            <!-- <br> -->
                            <center>
                                <div class="separator">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;atau&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </center>
                            <!-- <br> -->

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="firstName" class="sr-only">No Pengenalan </label>
                                    <input type="text" class="form-control" id="idno" name="idno" value="" >
                                </div>
                            </div>

                            <br>

                            <button type="button" class="btn btn-primary" id="btn-cari">Cari</button>
                        </div>

                        <br>

                        <div id="div-result">

                        </div>

                        <div id="div-list">
                            <div class="row">
                                <div class="content-wrapper border border-2 rounded">
                                    <h4 class="section-heading">Pilihan {{ data_get($kodhasil, 'lkpperkhidmatan.name') }}</h4>

                                    <div class="mb-3 row">
                                        <label for="agency" class="col-sm-2 col-form-label">Agensi</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="agency" value="{{ strtoupper(data_get($kodhasil,'agency.name')) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="agency" class="col-sm-2 col-form-label">PTJ</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="ptj" value="{{ strtoupper(data_get($kodhasil,'ptj.name')) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="service" class="col-sm-2 col-form-label">Perkhidmatan</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="service" value="{{ strtoupper(data_get($kodhasil,'lkpperkhidmatan.name')) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="codehasil" class="col-sm-2 col-form-label">Kod Hasil</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="codehasil" value="{{ strtoupper(data_get($kodhasil,'name')) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="codehasil" class="col-sm-2 col-form-label">No Akaun</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="account_no" value="{{ data_get($srvmain,'fkpayerbill.account_no') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="codehasil" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="name" value="{{ strtoupper(data_get($srvmain,'fkpayerbill.name')) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="codehasil" class="col-sm-2 col-form-label">No Pengenalan</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="name" value="{{ data_get($srvmain,'fkpayerbill.identification_no') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="codehasil" class="col-sm-2 col-form-label">No Rujukan</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="reference_no" value="{{ data_get($srvmain,'fkpayerbill.reference_no') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="codehasil" class="col-sm-2 col-form-label">Amaun</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="amount" value="{{ data_get($srvmain,'fkpayerbill.amount') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="codehasil" class="col-sm-2 col-form-label">Keterangan Bil</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="bill_detail" value="{{ strtoupper(data_get($srvmain,'fkpayerbill.bill_detail')) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="codehasil" class="col-sm-2 col-form-label">Tarikh Bil</label>
                                        <div class="col-sm-10">
                                          <input type="text" readonly class="form-control-plaintext" id="bill_date" value="{{ date('d-m-Y',strtotime(data_get($srvmain,'fkpayerbill.bill_date'))) }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {!! form()->close() !!}


                        {!! form()->open()->post()->action(url('/login/bayaran/bill/next'))->attribute('id', 'formnext')->horizontal() !!}

                        <input type="hidden"  name="kodhasil" value="{{ data_get($kodhasil,'id') }}" />
                        <input type="hidden"  name="id" value="{{ data_get($srvmain,'id') }}" />
                        <input type="hidden"  name="tab" value="1"/>
                        <input type="hidden"  name="nexttab" value="2"/>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input class="btn btn-primary" type="submit" name="next" value="Seterusnya">
                        </div>
                        {!! form()->close() !!}

                    </section>
                </div>

                <div class="tab-pane fade" id="pills-profile-2" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <section>
                        {!! form()->open()->post()->action(url('/login/bayaran/bill/next'))->attribute('id', 'formpayer')->horizontal() !!}

                        <input type="hidden"  name="kodhasil" value="{{ data_get($kodhasil,'id') }}" />
                        <!-- <input type="hidden"  name="srvratemgt" value=" data_get($srvratemgt,'id') }}" /> -->
                        <input type="hidden"  name="id" value="{{ data_get($srvmain,'id') }}" />
                        <input type="hidden"  name="tab" value="2"/>
                        <input type="hidden"  name="nexttab" value="3"/>

                        <div class="content-wrapper">
                            <h4 class="section-heading">Maklumat Pembayar</h4>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="sr-only">Nama </label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ data_get($curuser, 'fkpayerbill.name') }}" required style="text-transform: uppercase;">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="identification_no" class="sr-only">No Pengenalan </label>
                                    <input type="text" class="form-control" id="identification_no" name="identification_no" value="{{ data_get($curuser, 'fkpayerbill.identification_no') }}" required style="text-transform: uppercase;">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email" class="sr-only">Emel </label>
                                    <input type="email" class="form-control" id="email" name="email" value="" required style="text-transform: unset !important;" >
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="no_tel" class="sr-only">No Tel </label>
                                    <input type="text" class="form-control" id="no_tel" name="no_tel" value="" required onkeypress="onlynumber(event)">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address" class="sr-only">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" style="text-transform: uppercase;"></textarea>

                                </div>
                                <div class="form-group col-md-12">
                                    <label for="city" class="sr-only">Bandar </label>
                                    <input type="text" class="form-control" id="city" name="city" value="" required style="text-transform: uppercase;">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="city" class="sr-only">Negeri </label>
                                    <input type="text" class="form-control" id="" name="" value="PERAK" required readonly style="text-transform: uppercase;">
                                    <input type="hidden" name="state" value="7" />
                                </div>

                            </div>

                            <br>

                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <!-- <input class="btn btn-primary" type="submit" name="next" value="Seterusnya"> -->
                            <input type="hidden" name="buttonclicked" id="buttonclicked" value="">
                            <input class="btn btn-primary" type="submit" name="addtocart" value="TAMBAH KE TROLI" onClick="addtocart2()">
                            <input class="btn btn-primary" type="submit" name="next" value="SETERUSNYA" onClick="gonexttab2()">
                        </div>

                        {!! form()->close() !!}
                    </section>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <section>
                        {!! form()->open()->post()->action(url('/login/bayaran/bill/next'))->attribute('id', 'formpayment')->horizontal() !!}

                        <input type="hidden"  name="kodhasil" value="{{ data_get($kodhasil,'id') }}" />
                        {{-- <input type="hidden"  name="srvratemgt" value="{{ data_get($srvratemgt,'id') }}" /> --}}
                        <input type="hidden"  name="id" value="{{ data_get($srvmain,'id') }}" />
                        <input type="hidden"  name="tab" value="3"/>
                        <input type="hidden"  name="nexttab" value="4"/>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="paytype" class="sr-only">Cara Pembayaran</label>
                                <select class="form-select" id="paytype" name="paytype" required="required">
                                    <option value=""> Sila Pilih</option>
                                    @foreach($paymentGtwy as $key => $value)
                                    <option value="{{ $value->id }}"> {{ data_get($value,'name') }} </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                    <div class="row" id="divtypeakaun">
                            <div class="form-group col-md-12">
                                <label for="paytype" class="sr-only">Jenis Akaun</label>
                                 <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="akauntype" id="akauntype1" value="01">
                                      <label class="form-check-label" for="inlineRadio1">Akaun Individu</label>
                                    </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="akauntype" id="akauntype2" value="02">
                                          <label class="form-check-label" for="inlineRadio2">Akaun Korporat</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="row" id="divtypekad">
                             <div class="form-group col-md-12">
                                <label for="kadtype" class="sr-only">Jenis Kad</label>
                                 <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="kadtype" id="kadtype1" value="1">
                                      <label class="form-check-label" for="inlineRadiokad1">Debit</label>
                                    </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="kadtype" id="kadtype2" value="2">
                                          <label class="form-check-label" for="inlineRadiokad2">Kredit</label>
                                    </div>
                               </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input class="btn btn-primary" type="submit" name="next" value="Seterusnya">
                        </div>

                        {!! form()->close() !!}
                    </section>
                </div>
                <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <section>
                        {!! form()->open()->post()->action(url('/login/bayaran/bill/bayar'))->attribute('id', 'formsummary')->horizontal() !!}

                        <input type="hidden" name="kodhasil" value="{{ data_get($kodhasil,'id') }}" />

                        <input type="hidden" name="id" value="{{ data_get($srvmain,'id') }}" />
                        <input type="hidden" name="tab" value="4"/>
                        <input type="hidden" name="nexttab" value="5"/>
                        <input type="hidden" name="flaglogin" value="0"/><!--tak login-->
                        <input type="hidden" name="flagpay" value="2"/><!--bill-->


                        <div class="content-wrapper">
                            <h4 class="section-heading">Ringkasan Bayaran</h4>

                            <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">Agensi</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="agency" value="{{ strtoupper(data_get($kodhasil,'agency.name')) }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">PTJ</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="ptj" value="{{ strtoupper(data_get($kodhasil,'ptj.name')) }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="service" class="col-sm-2 col-form-label">Perkhidmatan</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="service" value="{{ strtoupper(data_get($kodhasil,'lkpperkhidmatan.name')) }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="codehasil" class="col-sm-2 col-form-label">Kod Hasil</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="codehasil" value="{{ strtoupper(data_get($kodhasil,'name')) }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="codehasil" class="col-sm-2 col-form-label">No Akaun</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="account_no" value="{{ data_get($srvmain,'fkpayerbill.account_no') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="codehasil" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="name" value="{{ strtoupper(data_get($srvmain,'fkpayerbill.name')) }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="codehasil" class="col-sm-2 col-form-label">No Pengenalan</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="name" value="{{ data_get($srvmain,'fkpayerbill.identification_no') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="codehasil" class="col-sm-2 col-form-label">No Rujukan</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="reference_no" value="{{ data_get($srvmain,'fkpayerbill.reference_no') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="codehasil" class="col-sm-2 col-form-label">Amaun</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="amount" value="{{ data_get($srvmain,'fkpayerbill.amount') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="codehasil" class="col-sm-2 col-form-label">Keterangan Bil</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="bill_detail" value="{{ strtoupper(data_get($srvmain,'fkpayerbill.bill_detail')) }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="codehasil" class="col-sm-2 col-form-label">Tarikh Bil</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="bill_date" value="{{ date('d-m-Y',strtotime(data_get($srvmain,'fkpayerbill.bill_date'))) }}">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="paymenttype" class="col-sm-2 col-form-label">Kaedah Pembayaran</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="{{ data_get($srvmain,'fkpaymentgateway.name') }}">
                                </div>
                            </div>
                              @if(data_get($srvmain,'fk_payment_gateway')=='1')
                            <div class="mb-3 row">
                                <label for="paymenttype" class="col-sm-2 col-form-label">Jenis Akaun</label>
                                <div class="col-sm-10">
                                    @if(data_get($srvmain,'fpx_type')=='01')
                                     <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Akaun Individu">
                                    @else
                                     <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Akaun Korporat">
                                    @endif
                                 
                                </div>
                            </div>
                            @endif
                             @if(data_get($srvmain,'fk_payment_gateway')=='2')
                             <div class="mb-3 row">
                                <label for="paymenttype" class="col-sm-2 col-form-label">Jenis Kad</label>
                                <div class="col-sm-10">
                                    @if(data_get($srvmain,'card_type')==1)
                                     <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Debit">
                                    @else
                                     <input type="text" readonly class="form-control-plaintext" id="paymenttype" value="Kredit">
                                    @endif
                                </div>
                            </div>
                             @endif

                            <h4 class="section-heading">Maklumat Pembayar</h4>
                            <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="name" value="{{ data_get($srvmain,'fkpayer.name') }}">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">No Pengenalan</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="identification_no" value="{{ data_get($srvmain,'fkpayer.identification_no') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control-plaintext" id="address"  rows="3" readonly>{{ data_get($srvmain,'fkpayer.address') }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">Bandar</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="city" value="{{ data_get($srvmain,'fkpayer.city') }}">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="agency" class="col-sm-2 col-form-label">Negeri</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="state" value="PERAK">
                                </div>
                            </div>

                            <br>






                            <table id="data-table-user" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <!-- <th style="text-align: left;">Bil</th>
                                        <th style="text-align: left;">Perkhidmatan</th>
                                        {{-- <th style="text-align: left;">Bilangan</th>
                                        <th style="text-align: left;">Fi Per Pax (RM)</th> --}}
                                        <th style="text-align: left;">Jumlah Fi (RM)</th> -->

                                        <th valign="top" style="text-align: center;" valign="top">Bil</th>
                                        <th valign="top" style="text-align: left;">Perkhidmatan</th>
                                        <th valign="top" style="text-align: center;">No Akaun</th>
                                        <th valign="top" style="text-align: left;">Nama Pemegang Akaun</th>
                                        <th valign="top" style="text-align: left;">Agensi</th>
                                        <th valign="top" style="text-align: center;">Amaun Perlu Dibayar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bil = 1; $sumtotal = 0;?>
                                    @foreach (data_get($srvmain,'srvmaindetail') as $key => $value)

                                        <tr>
                                            <td class="text-center">{{ $bil++ }}</td>
                                            <td class="text-left">{{ strtoupper(data_get($kodhasil, 'lkpperkhidmatan.name')) }}</td>
                                            <td class="text-center">{{ data_get($srvmain, 'fkpayerbill.account_no') }}</td>  <!-- hold utk bil -->
                                            <td class="text-left">{{ data_get($srvmain, 'fkpayerbill.name') }}</td>
                                            <td class="text-left">{{ data_get($srvmain, 'codehasil.agency.name') }}</td>
                                            <td class="text-center">{{ data_get($value, 'total') }}</td>
                                        </tr>
                                        <?php
                                            $sumtotal += data_get($value,'total');
                                        ?>

                                        <!-- <tr>
                                            <td> $bil++ }}</td>
                                            <td> strtoupper(data_get($kodhasil,'lkpperkhidmatan.name')) }}</td>
                                            {{-- <td> data_get($value,'number') }}</td>
                                            <td> data_get($value,'perpax') }}</td> --}}
                                            <td>
                                                 data_get($value,'total') }}
                                            </td>


                                        </tr> -->
                                    @endforeach
                                        <tr class="table-light">
                                            <td colspan="4"></td>
                                            <td colspan="" style="text-align: left">
                                                <b>JUMLAH KESELURUHAN</b>
                                            </td>
                                            <td colspan="1" style="text-align: center">
                                                <b>{{ number_format($sumtotal,2) }}</b>
                                            </td>

                                        </tr>
                                </tbody>
                            </table>


                            <h4 class="section-heading">Setuju dan Hantar</h4>
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="checkterm" id="checkterm" value="accept" required>
                                Saya dengan ini mengaku bahawa saya telah membaca semua terma dan syarat dan semua butiran yang diberikan kepada saya dalam borang ini adalah benar.
                            </label>

                        </div>

                        <br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input class="btn btn-primary" type="submit" name="bayar" value="Bayar">
                        </div>

                        {!! form()->close() !!}
                    </section>
                </div>
            </div>

        </div>




    </div>


    {{-- modal tab2 --}}
    <div class="modal fade " id="desclaimer-modal-preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading"></h4>
                    <p>Sila pastikan anda</p>
                    <hr>
                    <p class="mb-0">
                        <ul>
                            <li>Sila pastikan no rujukan yang betul seperti no kad pengenalan/no akaun dan sebagainya betul</li>
                            {{-- <li>Saiz tidak kurang dari 2MB</li> --}}

                        </ul>
                    </p>
                </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ya</button>
            {{-- <button type="button" class="btn btn-primary">Ya</button> --}}
            </div>
        </div>
        </div>
    </div>


@endsection
@push('script')

    <script type="text/javascript">






        $(document).ready(function(){

            $("#formsubmit").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit

            $("#formnext").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit

            $("#formpayer").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit

            $("#formpayment").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit

            $("#formsummary").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit

        });

             $( document ).ready(function() {

            $('#divtypeakaun').hide();
            $('#divtypekad').hide();

            

            $('#paytype').on('change', function()
            {
 

                var typeakaun =this.value

                if(typeakaun==1){//fpx

                     $('#divtypeakaun').show();
                     $('#divtypekad').hide();

                     $("#akauntype1").attr('required',true);
                     $("#akauntype2").attr('required',true);
                     $("#kadtype1").attr('required',false);
                     $("#kadtype2").attr('required',false);


                }else if(typeakaun==''){

                     $('#divtypeakaun').hide();
                     $('#divtypekad').hide();
                     $("#akauntype1").attr('required',false);
                     $("#akauntype2").attr('required',false);
                     $("#kadtype1").attr('required',false);
                     $("#kadtype2").attr('required',false);



                }else{//card

            
                        $('#divtypeakaun').hide();
                        $('#divtypekad').show();
                        $("#akauntype1").attr('required',false);
                        $("#akauntype2").attr('required',false);
                        $("#kadtype1").attr('required',true);
                        $("#kadtype2").attr('required',true);

            
                      

                }
            });



          });

        $( document ).ready(function() {

            $('.datepicker1').datepicker({
                format: 'dd-mm-yyyy',

            });

            // $('#desclaimer-modal-preview').modal('show')



            $('#btn-cari').click(function(){

                var refno = $("#refno").val();
                var refid = $("#idno").val();
                var serviceid = {{ $kodhasil->lkpperkhidmatan->id }};

                if(refno){

                }else{
                    refno = 0;
                }

                if(refid){

                }else{
                    refid = 0;
                }

                // alert(q);
                console.log(refno);
                console.log(refid);



                // if(q){
                    $.ajax({

                        url: "{{ URL::to('login/bayaran/bill/search/') }}" + "/" + serviceid + "/" + refno + "/" + refid,
                            type: "get",
                            beforeSend: function() {
                                document.getElementById("loader").classList.add("show");
                                $("#div-list").html('');
                            },
                            success: function(result) {
                                document.getElementById("loader").classList.remove("show");

                                $("#div-result").html(result);

                            }


                    });

                // }else{}

            });

        });

        $(document).ready(function(){

            $("#formsubmit").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit
        });
    </script>

    <script type="text/javascript">

        function Feet1Converter(valNum) {
            //panjang

            var pax = $("input[name=widthmeter]").val();
            var data = (valNum * 3.2808).toFixed(2);
            $("input[name=lengthkaki]").val(data);

            var width = $("input[name=widthmeter]").val();

            if (width > 0) {
                var temp = (valNum * width).toFixed(2);
                var sum = Math.round(temp * 20) / 20;
            } else {
                var sum = 0;
            }

            var total = Math.ceil(sum).toFixed(2);

            $("input[name=ukuran]").val(total);

            kiraTotal(total, 1);

        }


        $(document).ready(function() {
        });

            // tab2();


            var active_tab = {{ $tab }};
            // alert(active_tab);

            if (active_tab == 1) {

                initTab();
                // $('#desclaimer-modal-preview').modal('hide');
            } else if (active_tab == 2) {

                tab2();

                // $('#desclaimer-modal-preview').modal('show')
            } else if (active_tab == 3) {
                tab3();
                // $('#desclaimer-modal-preview').modal('hide')

            }else if(active_tab == 4){
                tab4();
                // $('#desclaimer-modal-preview').modal('hide')
            }else{
                initTab();
                // $('#desclaimer-modal-preview').modal('hide')
            }


            function initTab() {

                var html = '<div class="steps clearfix">';
                html += '<ul role="tablist">';
                html += '<li role="presentation" class="first current" aria-disabled="false" aria-selected="true">';
                html += '<a id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-search" href="#" aria-controls="pills-home" role="tab" aria-selected="true" class="active">';
                html += '<span class="current-info audible">current step: </span>';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-search-2-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Carian</div>';
                html += '<div class="bd-wizard-step-subtitle">1</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';

                html += '<li role="presentation" class="disabled" aria-disabled="true" aria-selected="false">';
                html += '<a id="pills-profile-tab" href="#"  data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" class="disabled">';

                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-file-user-fill"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Maklumat Pembayar</div>';
                html += '<div class="bd-wizard-step-subtitle">2</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';

                html += '<li role="presentation" class="disabled" aria-disabled="true">';
                html += '<a id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" class="disabled">';

                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-secure-payment-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Pilihan Pembayaran</div>';
                html += '<div class="bd-wizard-step-subtitle">3</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';


                html += '<li role="presentation" class="disabled last" aria-disabled="true">';
                html += '<a id="pills-summary-tab" data-bs-toggle="pill" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="false" class="disabled">';

                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-book-read-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Ringkasan</div>';
                html += '<div class="bd-wizard-step-subtitle">4</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';


                html += '</ul>';
                html += '</div>';



                $("#div-tab").html(html);
                $("#pills-search").addClass('show active');
                $("#pills-profile").removeClass('show ');
                $("#pills-profile-2").removeClass('show active');

            }

            function tab2() {


                var html = '<div class="steps clearfix">';
                html += '<ul role="tablist">';
                html += '<li role="presentation" class="first done" aria-disabled="true" aria-selected="true">';
                html += '<a id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-search" href="#" aria-controls="pills-home" role="tab" aria-selected="true" class="active">';
                html += '<span class="current-info audible">current step: </span>';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-search-2-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Carian</div>';
                html += '<div class="bd-wizard-step-subtitle">1</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';

                html += '<li role="presentation" class="current " aria-disabled="false" aria-selected="true">';
                html += '<a id="pills-profile-tab" href="#"  data-bs-toggle="pills-profile-2" data-bs-target="#pills-profile-2" role="tab" aria-controls="pills-profile" aria-selected="false" class="active">';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-file-user-fill"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Maklumat Pembayar</div>';
                html += '<div class="bd-wizard-step-subtitle">2</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';

                html += '<li role="presentation" class="disabled" aria-disabled="true">';
                html += '<a id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" class="disabled">';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-secure-payment-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Pilihan Pembayaran</div>';
                html += '<div class="bd-wizard-step-subtitle">3</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';


                html += '<li role="presentation" class="disabled last" aria-disabled="true">';
                html += '<a id="pills-summary-tab" data-bs-toggle="pill" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="false" class="disabled">';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-book-read-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Ringkasan</div>';
                html += '<div class="bd-wizard-step-subtitle">4</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';


                html += '</ul>';
                html += '</div>';



                $("#div-tab").html(html);
                $("#pills-search").removeClass('show active');
                $("#pills-profile").addClass('show ');
                $("#pills-profile-2").addClass('show active');



            }

            function tab3() {

                var html = '<div class="steps clearfix">';
                html += '<ul role="tablist">';
                html += '<li role="presentation" class="first done" aria-disabled="true" aria-selected="true">';
                html += '<a id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-search" href="#" aria-controls="pills-home" role="tab" aria-selected="true" class="active">';
                html += '<span class="current-info audible">current step: </span>';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-search-2-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Carian</div>';
                html += '<div class="bd-wizard-step-subtitle">1</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';

                html += '<li role="presentation" class="done " aria-disabled="false" aria-selected="true">';
                html += '<a id="pills-profile-tab" href="#"  data-bs-toggle="pills-profile-2" data-bs-target="#pills-profile-2" role="tab" aria-controls="pills-profile" aria-selected="false" class="active">';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-file-user-fill"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Maklumat Pembayar</div>';
                html += '<div class="bd-wizard-step-subtitle">2</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';

                html += '<li role="presentation" class="current" aria-disabled="true">';
                html += '<a id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" class="actives">';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-secure-payment-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Pilihan Pembayaran</div>';
                html += '<div class="bd-wizard-step-subtitle">3</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';


                html += '<li role="presentation" class="disabled last" aria-disabled="true">';
                html += '<a id="pills-summary-tab" data-bs-toggle="pill" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="false" class="disabled">';
                html += '<div class="media">';
                html += '<div class="bd-wizard-step-icon"><i class="ri-book-read-line"></i></div>';
                html += '<div class="media-body">';
                html += '<div class="bd-wizard-step-title">Ringkasan</div>';
                html += '<div class="bd-wizard-step-subtitle">4</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</li>';


                html += '</ul>';
                html += '</div>';



                $("#div-tab").html(html);
                $("#pills-search").removeClass('show active');
                $("#pills-profile").removeClass('show active');
                $("#pills-contact").addClass('show ');
                $("#pills-contact").addClass('show active');



            }

            function tab4() {

                    var html = '<div class="steps clearfix">';
                    html += '<ul role="tablist">';
                    html += '<li role="presentation" class="first done" aria-disabled="true" aria-selected="true">';
                    html += '<a id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-search" href="#" aria-controls="pills-home" role="tab" aria-selected="true" class="active">';
                    html += '<span class="current-info audible">current step: </span>';
                    html += '<div class="media">';
                    html += '<div class="bd-wizard-step-icon"><i class="ri-search-2-line"></i></div>';
                    html += '<div class="media-body">';
                    html += '<div class="bd-wizard-step-title">Carian</div>';
                    html += '<div class="bd-wizard-step-subtitle">1</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';
                    html += '</li>';

                    html += '<li role="presentation" class="done " aria-disabled="false" aria-selected="true">';
                    html += '<a id="pills-profile-tab" href="#"  data-bs-toggle="pills-profile-2" data-bs-target="#pills-profile-2" role="tab" aria-controls="pills-profile" aria-selected="false" class="disabled">';
                    html += '<div class="media">';
                    html += '<div class="bd-wizard-step-icon"><i class="ri-file-user-fill"></i></div>';
                    html += '<div class="media-body">';
                    html += '<div class="bd-wizard-step-title">Maklumat Pembayar</div>';
                    html += '<div class="bd-wizard-step-subtitle">2</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';
                    html += '</li>';

                    html += '<li role="presentation" class="done" aria-disabled="true">';
                    html += '<a id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" class="disabled">';
                    html += '<div class="media">';
                    html += '<div class="bd-wizard-step-icon"><i class="ri-secure-payment-line"></i></div>';
                    html += '<div class="media-body">';
                    html += '<div class="bd-wizard-step-title">Pilihan Pembayaran</div>';
                    html += '<div class="bd-wizard-step-subtitle">3</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';
                    html += '</li>';


                    html += '<li role="presentation" class="current last" aria-disabled="true">';
                    html += '<a id="pills-summary-tab" data-bs-toggle="pill" data-bs-target="#summary" type="button" role="tab" aria-controls="summary" aria-selected="false" class="active">';
                    html += '<div class="media">';
                    html += '<div class="bd-wizard-step-icon"><i class="ri-book-read-line"></i></div>';
                    html += '<div class="media-body">';
                    html += '<div class="bd-wizard-step-title">Ringkasan</div>';
                    html += '<div class="bd-wizard-step-subtitle">4</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';
                    html += '</li>';


                    html += '</ul>';
                    html += '</div>';



                    $("#div-tab").html(html);
                    $("#pills-search").removeClass('show active');
                    $("#pills-profile").removeClass('show active');
                    $("#pills-contact").removeClass('show active');
                    $("#summary").addClass('show ');
                    $("#summary").addClass('show active');



            }







    </script>

    <script type="text/javascript">
        function onlynumber(evt) 
        {
            var theEvent = evt || window.event;

            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);

            var regex = /[0-9]/;

            if( !regex.test(key) ) 
            {
                theEvent.returnValue = false;

                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>

    <script>
        // function addtocartori(servicemainid,kodhasilid)
        // {
        //     // alert(id);
        //     document.getElementById("loader").classList.add("show");
        //     // window.location.reload();
        //     window.location.href = "/login/cart/add/"+servicemainid+"/"+kodhasilid;
        // } 
        
        function gonexttab2()
        {
            // alert('cuba');
            $('#buttonclicked').val('1'); 
        }

        function addtocart2()
        {
            // alert('add to  cart');
            $('#buttonclicked').val('2');
        }

</script>
@endpush
