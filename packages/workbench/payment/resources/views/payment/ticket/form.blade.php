@extends('web::perakepay.frontend.layouts.base')
<link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/wizard/assets/css/bd-wizard.css') }}">

<style>
    .wizard .steps>ul li.current a 
    {
        background-color: #E6C208 !important;
    }

    .wizard .steps>ul li .bd-wizard-step-subtitle 
    {
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
                        {!! form()->open()->post()->action(url('/bayaran/tiket/'.data_get($kodhasil,"id").'/save'))->attribute('id', 'formsubmit')->horizontal() !!}

                        <input type="hidden"  name="kodhasil" value="{{ data_get($kodhasil,'id') }}" />
                        <input type="hidden"  name="srvratemgt" value="{{ data_get($srvratemgt,'id') }}" />
                        <div class="content-wrapper">
                          <h4 class="section-heading">Maklumat Tiket : {{ data_get($kodhasil,'lkpperkhidmatan.name') }}</h4>
                          <div class="row">
                              <div class="form-group col-md-12">
                                  <label for="firstName" class="sr-only">Tarikh </label>
                                  <input type="text" class="form-control datepicker1" id="date_start" name="date_start"
                                  value="" required readonly>
                              </div>
                              <div class="form-group col-md-12">
                                  <label for="lastName" class="sr-only">Kategori</label>
                                  <select class="form-select" id="category" name="category" required="required">
                                      <option value=""> Sila Pilih</option>
                                      @foreach(data_get($srvratemgt,'servicerate') as $key => $value)
                                      <option value="{{ $value->id }}"> {{ data_get($value,'fkcategory.description') }} : RM {{ data_get($value,'rate') }} </option>
                                      @endforeach
                                  </select>

                              </div>
                              <div class="form-group col-md-12">
                                  <label for="firstName" class="sr-only">Bilangan </label>
                                  <input type="number" class="form-control" id="bil" name="bil"
                                  value="" required >
                              </div>
                              {{-- <div class="form-group col-md-12">
                                  <label for="firstName" class="sr-only">Jumlah </label>
                                  <input type="number" class="form-control" id="total" name="total"
                                  value="" required >
                              </div> --}}
                          </div>
                          <br>

                          <button type="submit" class="btn btn-primary">Tambah</button>
                          {{-- <h4 class="section-heading">Senarai Tiket</h4>
                          <div class="row">

                          </div> --}}


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
@endsection
@push('script')

    <script type="text/javascript">
        $( document ).ready(function() {

            $('.datepicker1').datepicker({
                format: 'dd-mm-yyyy',

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

            initTab();


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

            }






        });
    </script>
@endpush
