@extends('web::perakepay.frontend.layouts.base')
<!-- extends('web::backend.layouts.base') -->
@section('content')
    <?php
    if (Session::has('locale')) {
        $locale = Session::get('locale', Config::get('app.locale'));
    } else {
        $locale = \Lang::locale();
    }
    ?>

    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Laporan Terimaan Harian/ Bulanan Mengikut Jenis</h5>
        </div>
    </div>
    <div class="container">

        <br>

        <div class="card style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Terimaan Harian/ Bulanan Mengikut Jenis</h6>
                    </div>
                    <div style="float: right">

                        <a href="javascript:;" id="clickpdf"  onclick="pdfclick()" class="btn btn-primary me-md-2 float-right">PDF</a>

                        <a href="javascript:;" onclick="excelclick()" class="btn btn-primary me-md-2 float-right">Excel</a>
                    </div>
                </div>

            </div>

            <div class="intro-y box p-5 col-span-12 lg:col-span-12">
                <!-- --------------------- -->

                <div class="grid grid-cols-12 gap-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-4 col-lg-2 align-items-right">
                            <label for="" class="col-form-label" style="float: right;">Tarikh Transaksi :</label>
                        </div>
                        <div class="col-4 col-lg-2">
                            <input type="text" id="start_date" class="form-control datepicker1" name="start_date" readonly>
                        </div>

                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label"  style="float: right;"">Tarikh Hingga :</label>
                        </div>
                        <div class="col-4 col-lg-2">
                            <input type="text" id="end_date" class="form-control datepicker1"- name="end_date" readonly>
                        </div>
                    </div>
                </div>

                <br>

                <div class="grid grid-cols-12 gap-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;">Agensi :</label>
                        </div>
                        <div class="col-4 col-lg-6">
                            @if($roleid==4 || $roleid==5)
                            <label for="" class="col-form-label">{{data_get($agency,'code')}} : {{data_get($agency,'name')}}</label>
                            <input type="hidden" id="agency" name="agency" value="{{data_get($agency,'id')}}">
                            @else
                             <select class="js-example-basic-single1" id="agency" name="agency" style="width: 100%">
                                <option value=""> Sila Pilih</option>
                                @foreach($agency as $ak => $av)
                                    <option value="{{$av->id}}"> {{ $av->code }} : {{ $av->name }} </option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                </div>

                <br>

                <div class="grid grid-cols-12 gap-2" id="div-ptj-result">
                    <div class="row g-3 align-items-center" id="div-ptj">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;">PTJ :</label>
                        </div>
                        <div class="col-4 col-lg-6">
                            @if($roleid==4 || $roleid==5)
                            <label for="" class="col-form-label">{{data_get($ptj,'code')}} : {{data_get($ptj,'name')}}</label>
                            <input type="hidden" id="ptj" name="ptj" value="{{data_get($ptj,'id')}}">
                            @else
                            <select class="js-example-basic-single2" id="ptj" name="ptj" style="width: 100%">
                                <option value=""> Sila Pilih</option>
                                @foreach($ptj as $pk => $pv)
                                    <option value="{{$pv->id}}"> {{ $pv->code }} : {{ $pv->name }} </option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                </div>

                <br>

                <div class="grid grid-cols-12 gap-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;"> &nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="col-4 col-lg-2">
                        </div>

                        <div class="col-4 col-lg-2">
                            <label for="" class="col-form-label" style="float: right;"> </label>
                        </div>
                        <div class="col-4 col-lg-2" style="text-align: right;">
                            <a href="javascript:;" class="btn btn-primary" type="button" id="clicksubmit" title="Cari">
                                <i class="ri-search-line"></i>
                                 Cari
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="div-list-result">
                <div class="card-body ">

                    <div class="row g-2">
                        <div id="render_ajax" class="col-md-12 col-lg-12">

                            <div class="table-responsive">
                                <table id="data-table-receipt-type" class="table mt-2" style="width:100%;font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">Bil</th>
                                            <th style="text-align: left;">Jabatan</th>
                                            <th style="text-align: left;">PTJ</th>
                                            <th style="text-align: center;">Kod Akaun</th>
                                            {{-- <th style="text-align: left;">Bil Urusniaga</th>
                                            <th style="text-align: left;">Amaun (RM)</th>
                                            <th style="text-align: left;">Jumlah Terimaan</th>
                                            <th style="text-align: left;">Bilangan Urusniaga Batal</th>
                                            <th style="text-align: left;">Bilangan Urusniaga Diterima</th> --}}
                                            <th style="text-align: center;" title="Terimaan FPX Online Individu">(FPXI)</th> {{--  Terimaan FPX Online Individu --}}
                                            <th style="text-align: center;" title="Terimaan FPX Online Syarikat">(FPXS)</th> {{--  Terimaan FPX Online  Syarikat --}}
                                            <th style="text-align: center;" title="Terimaan Online Kad Debit">(KDO)</th> {{--  Terimaan Online Kad Debit  --}}
                                            <th style="text-align: center;" title="Terimaan Online Kad Kredit">(KKO)</th> {{--  Terimaan Online Kad Kredit --}}
                                            {{-- <th style="text-align: center;">Jumlah Semua</th>
                                            <th style="text-align: center;">Bilangan Urusniaga Batal</th>
                                            <th style="text-align: center;">Bilangan Urusniaga Diterima</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($receipttype as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $bil++ }}</td>
                                                <td>
                                                    {{ data_get($value, 'fkkodhasil.agency.name') }}
                                                </td>
                                                <td>
                                                    {{ data_get($value, 'fkkodhasil.ptj.name') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ data_get($value, 'fkkodhasil.name') }}
                                                </td>
                                                {{-- <td>
                                                 {{ data_get($value, 'details') }}
                                                </td>
                                                <td>
                                                    {{ data_get($value, 'fkpayer.name') }}
                                                </td>
                                                <td>
                                                    {{ data_get($value, 'fkpayment.fkpaymentgateway.name') }}
                                                </td>
                                                <td>
                                                    {{ date('H:i:s', strtotime(data_get($value, 'fkpayment.transaction_date'))) }}
                                                </td>
                                                <td>
                                                    {{ data_get($value, 'fkkodhasil.name') }}
                                                </td> --}}
                                                <td class="text-center">
                                                    @if (data_get($value, 'fkpayment.fpx_type') == 1)
                                                        {{ data_get($value, 'fkpayment.fpx_type') }}
                                                    @else
                                                        -
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    @if (data_get($value, 'fkpayment.fpx_type') == 2)
                                                        {{ data_get($value, 'fkpayment.fpx_type') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (data_get($value, 'fkpayment.card_type') == 1)
                                                        {{ data_get($value, 'fkpayment.card_type') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (data_get($value, 'fkpayment.card_type') == 2)
                                                        {{ data_get($value, 'fkpayment.card_type') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                {{-- <td class="text-center">
                                                    {{ data_get($value, 'amount') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ data_get($value, 'amount') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ data_get($value, 'amount') }}
                                                </td> --}}

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-table-receipt-type').DataTable({
                "responsive": true,
                "scrollY": true,
                "scrollX": true,
                "ordering": false,
                "info": true,
                'iDisplayLength': 100,
                "lengthMenu": [
                    [25, 50, 100, 250, -1],
                    [25, 50, 100, 250, "All"]
                ],
                @if ($locale == 'ms')
                    "language": {
                        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                    },
                @endif
            });

        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {

            $('.datepicker1').datepicker({
                format: 'dd-mm-yyyy',

            });

            $('#clicksubmit').click(function(e)
            {
                var val_start = document.getElementById("start_date").value;
                var val_end   = document.getElementById("end_date").value;
                var val_agency   = document.getElementById("agency").value;
                var val_ptj   = document.getElementById("ptj").value;

                if( !val_start )
                {
                    var val_start = 'start';
                }
                if( !val_end )
                {
                    var val_end   = 'end';
                }
                if( !val_agency )
                {
                    var val_agency   = 'agen';
                }
                if( !val_ptj )
                {
                    var val_ptj   = 'pt';
                }

                $.ajax(
                {
                    type: "get",
                    url : "{{ URL::to('/report/receipttype/ajax') }}"+"/"+val_start+"/"+val_end+"/"+val_agency+"/"+val_ptj,

                    beforeSend: function ()
                    {
                        $("#render_ajax").html("");
                        document.getElementById("loader").classList.add("show");

                    },
                    success: function (result)
                    {

                        $("#render_ajax").html(result);

                        $('#data-table-receipt-type').DataTable({
                            "responsive": true,
                            "scrollY": true,
                            "scrollX": true,
                            "ordering": false,
                            "info": true,
                            'iDisplayLength': 100,
                            "lengthMenu": [
                                [25, 50, 100, 250, -1],
                                [25, 50, 100, 250, "All"]
                            ],
                            @if ($locale == 'ms')
                                "language": {
                                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                                },
                            @endif
                        });

                        document.getElementById("loader").classList.remove("show");
                    }

                });

            });

            $('select[name="agency"]').change(function()
            {
                var val = $(this).val();

                if(val)
                {
                    $.ajax(
                    {
                        type: "GET",
                        url: "{{ URL::to('/report/receipttype/ptj')}}"+"/"+val,

                        beforeSend: function ()
                        {
                            $("#div-ptj").hide();

                            document.getElementById("loader").classList.add("show");
                        },
                        success: function(result)
                        {
                            $("#render_ajax").html("");
                            $("#div-ptj-result").html(result);
                            document.getElementById("loader").classList.remove("show");
                        }
                    });

                }

            });

            $(document).ready(function() {
                $('.js-example-basic-single1').select2();
                $( ".js-example-basic-single1" ).focus();
            });

            $(document).ready(function() {

                $('.js-example-basic-single2').select2();
                $( ".js-example-basic-single2" ).focus();
            });


        });

        function pdfclick()
        {
            var val_start = document.getElementById("start_date").value;
            var val_end   = document.getElementById("end_date").value;
            var val_agency   = document.getElementById("agency").value;
            var val_ptj   = document.getElementById("ptj").value;

            if( !val_start )
            {
                var val_start = 'start';
            }
            if( !val_end )
            {
                var val_end   = 'end';
            }
            if( !val_agency )
            {
                var val_agency   = 'agen';
            }
            if( !val_ptj )
            {
                var val_ptj   = 'pt';
            }

            // window.location.href = "/report/transfer/1/"+val_start+"/"+val_end+"/"+val_type+"/"+val_status;
            window.open(
                "/report/receipttype/1/"+val_start+"/"+val_end+"/"+val_agency+"/"+val_ptj,
                "-_blank"
            );
        };

        function excelclick()
        {
            var val_start = document.getElementById("start_date").value;
            var val_end   = document.getElementById("end_date").value;
            var val_agency   = document.getElementById("agency").value;
            var val_ptj   = document.getElementById("ptj").value;

            if( !val_start )
            {
                var val_start = 'start';
            }
            if( !val_end )
            {
                var val_end   = 'end';
            }
            if( !val_agency )
            {
                var val_agency   = 'agen';
            }
            if( !val_ptj )
            {
                var val_ptj   = 'pt';
            }

            // window.location.href = "/report/transfer/1/"+val_start+"/"+val_end+"/"+val_type+"/"+val_status;
            window.open(
                "/report/receipttype/2/"+val_start+"/"+val_end+"/"+val_agency+"/"+val_ptj,
                "-_blank"
            );
        };
    </script>
@endpush
