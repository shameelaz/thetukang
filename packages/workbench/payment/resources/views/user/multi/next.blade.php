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
                    
                </div>

                <!-- tab 2 -->
                <div class="tab-pane fade" id="pills-profile-2" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <section>
                        {!! form()->open()->post()->action(url('/login/bayaran/multi/next'))->attribute('id', 'formpayer')->horizontal() !!}

                        <input type="hidden" name="troliflag" value="{{ data_get($request, 'troli_flag') }}"/>
                        <input type="hidden" name="tab" value="2"/>
                        <input type="hidden" name="nexttab" value="3"/>

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

                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input class="btn btn-primary" type="submit" name="next" value="Seterusnya">
                        </div>

                        {!! form()->close() !!}
                    </section>
                </div>

                <!-- tab 3 -->
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <section>
                        {!! form()->open()->post()->action(url('/login/bayaran/multi/next'))->attribute('id', 'formpayment')->horizontal() !!}

                        <!-- <input type="hidden"  name="m" value=" data_get($kodhasil,'id') }}" /> -->
                        <!-- <input type="hidden"  name="srvratemgt" value=" data_get($srvratemgt,'id') }}" /> -->
                        <!-- <input type="hidden"  name="id" value=" data_get($srvmain,'id') }}" /> -->
                        <input type="hidden"  name="troliflag" value="{{ data_get($request, 'troli_flag') }}"/>
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

                <!-- tab 4 -->
                <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <section>
                        {!! form()->open()->post()->action(url('/login/bayaran/multi/bayar'))->attribute('id', 'formsummary')->horizontal() !!}

                        <input type="hidden"  name="kodhasil" value="{{ data_get($list, '0.fkservice.fk_kod_hasil') }}" />
                        <input type="hidden"  name="srvratemgt" value="{{ data_get($list, '0.fkservice.serviceratemgt.id') }}" />
                        <input type="hidden"  name="troliflag" value="{{ data_get($request, 'troli_flag') }}"/>
                        <input type="hidden"  name="id" value="0"/>
                        <input type="hidden"  name="tab" value="4"/>
                        <input type="hidden"  name="nexttab" value="5"/>
                        <input type="hidden"  name="flaglogin" value="1"/><!--login -->
                        <input type="hidden"  name="flagpay" value="{{ data_get($list[0], 'type') }}"/><!--ticket-->
                        <input type="hidden"  name="flagtroli" value="1"/><!-- 1 = yes ;0=no -->
                        <input type="hidden"  name="flagmulti" value="1"/><!-- 1 = yes ;0=no -->

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


                                </div>
                            </div>

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
@endsection
@push('script')

    <script type="text/javascript">

        $(document).ready(function()
        {
            var active_tab = {{ $tab }};

            if (active_tab == 1) {
                // tab1();
                initTab();
                $('#desclaimer-modal-preview').modal('hide')
            } else if (active_tab == 2) {
                tab2();
                // var myModal = document.getElementById('delete-modal-preview');
                // myModal.show();
                $('#desclaimer-modal-preview').modal('show')
            } else if (active_tab == 3) {
                tab3();
                $('#desclaimer-modal-preview').modal('hide')

            }else if(active_tab == 4){
                tab4();
                $('#desclaimer-modal-preview').modal('hide')
            }else{
                initTab();
                $('#desclaimer-modal-preview').modal('hide')
            }

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

        $( document ).ready(function() 
        {
            $('#divtypeakaun').hide();
            $('#divtypekad').hide();

            $('#paytype').on('change', function()
            {
                var typeakaun =this.value

                if(typeakaun==1)
                {
                    //fpx
                    $('#divtypeakaun').show();
                    $('#divtypekad').hide();
                    $("#akauntype1").attr('required',true);
                    $("#akauntype2").attr('required',true);
                    $("#kadtype1").attr('required',false);
                    $("#kadtype2").attr('required',false);
                }
                else if(typeakaun=='')
                {
                    $('#divtypeakaun').hide();
                    $('#divtypekad').hide();
                    $("#akauntype1").attr('required',false);
                    $("#akauntype2").attr('required',false);
                    $("#kadtype1").attr('required',false);
                    $("#kadtype2").attr('required',false);
                }
                else
                {
                    //card
                    $('#divtypeakaun').hide();
                    $('#divtypekad').show();
                    $("#akauntype1").attr('required',false);
                    $("#akauntype2").attr('required',false);
                    $("#kadtype1").attr('required',true);
                    $("#kadtype2").attr('required',true);
                }
            });
        });
    </script>

    <script type="text/javascript">
        function initTab() 
        {
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

        function tab2() 
        {
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

        function tab3() 
        {
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

        function tab4() 
        {
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
@endpush
