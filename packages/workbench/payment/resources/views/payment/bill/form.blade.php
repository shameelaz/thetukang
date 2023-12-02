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
                <div class="tab-pane fade show active" id="pills-search" role="tabpanel" aria-labelledby="pills-home-tab">
                    <section>
                        {!! form()->open()->post()->action(url('/bayaran/bill/save'))->attribute('id', 'formsubmit')->horizontal() !!}

                        <?php

                            $temp = array();
                            
                            foreach(data_get($lkpperkhidmatan, 'codehasil') as $key => $value)
                            {
                                array_push($temp,data_get($value,'reference_name'));

                                $single = data_get($value,'reference_name');
                            }

                            $refname = implode(",", $temp);

                        ?>

                        <div class="content-wrapper">
                            <h4 class="section-heading">Carian {{ data_get($lkpperkhidmatan,'name') }}</h4>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="firstName" class="sr-only">{{ $single }}</label>
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


                        {!! form()->close() !!}
                    </section>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    Tab 2
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    Tab 3
                </div>
                <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="pills-contact-tab">
                    Tab 4
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
                        </ul>
                    </p>
                </div>

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
        $( document ).ready(function() 
        {
            $('.datepicker1').datepicker(
            {
                format: 'dd-mm-yyyy',
            });

            $('#desclaimer-modal-preview').modal('show');

            $('#btn-cari').click(function()
            {
                var refno = $("#refno").val();
                var refid = $("#idno").val();
                var serviceid = {{ $lkpperkhidmatan->id }};

                if(refno)
                {
                
                }
                else
                {
                    refno = 0;
                }

                if(refid)
                {

                }
                else
                {
                    refid = 0;
                }

                $.ajax(
                {
                    url: "{{ URL::to('bayaran/bill/search/') }}" + "/" + serviceid + "/" + refno + "/" + refid,
                    type: "get",

                    beforeSend: function() 
                    {
                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result) 
                    {
                        document.getElementById("loader").classList.remove("show");

                        $("#div-result").html(result);
                    }
                });            
            });
        });

        $(document).ready(function()
        {
            $("#formsubmit").on("submit", function()
            {
                document.getElementById("loader").classList.add("show");
            }); // submit
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function() 
        {
            initTab();

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
            }

        });
    </script>
@endpush
