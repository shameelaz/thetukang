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
            <h5 class="header-style">Laporan Pelarasan Kod Hasil</h5>
        </div>
    </div>
    <div class="container">

        <br>

        <div class="card style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Pelarasan Kod Hasil</h6>
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
                        <div class="col-auto">
                            <label for="" class="col-form-label">Tarikh Mula</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="start_date" class="form-control datepicker1" name="start_date" readonly>
                        </div>

                        <div class="col-auto">
                            <label for="" class="col-form-label">Tarikh Hingga</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="end_date" class="form-control datepicker1"- name="end_date" readonly>
                        </div>

                        <div class="col-auto">
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
                                <table id="data-table-pelarasan" class="table mt-2" style="width:100%;font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">Bil</th>
                                            <th style="text-align: center;">Perkhidmatan</th>
                                            <th style="text-align: center;">No Penyata Pemungut</th>
                                            <th style="text-align: center;">No Resit</th>
                                            <th style="text-align: center;">Kod Hasil Lama</th>
                                            <th style="text-align: center;">Kod Hasil Baru</th>
                                            <th style="text-align: center;">Tarikh Pelarasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($pelarasan as $key => $value)

                                            <tr>
                                                <td class="text-center">{{ $bil++}}</td>
                                                <td class="text-left"> {{ data_get($value,'lkpperkhidmatan.name') }} </td>
                                                <td class="text-center"></td>
                                                <td class="text-center"> {{ data_get($value,'receipt_no') }} </td>
                                                <td class="text-center"> {{ data_get($value,'kod_hasil_lama') }} </td>
                                                <td class="text-center"> {{ data_get($value,'kod_hasil_baru') }} </td>
                                                <td class="text-center"> {{ date('d-m-Y', strtotime(data_get($value,'tarikh_pelarasan'))) }} </td>
                                            </tr>
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
            $('#data-table-pelarasan').DataTable({
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

                if( !val_start )
                {
                    var val_start = 'start';
                }
                if( !val_end )
                {
                    var val_end   = 'end';
                }

                $.ajax(
                {
                    type: "get",
                    url : "{{ URL::to('/report/pelarasan/ajax') }}"+"/"+val_start+"/"+val_end,

                    beforeSend: function ()
                    {
                        $("#render_ajax").html("");
                        document.getElementById("loader").classList.add("show");

                    },
                    success: function (result)
                    {

                        $("#render_ajax").html(result);

                        $('#data-table-pelarasan').DataTable({
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


        });

        function pdfclick()
        {
            var val_start = document.getElementById("start_date").value;
            var val_end   = document.getElementById("end_date").value;

            if( !val_start )
            {
                var val_start = 'start';
            }
            if( !val_end )
            {
                var val_end   = 'end';
            }

            // window.location.href = "/report/transfer/1/"+val_start+"/"+val_end+"/"+val_type+"/"+val_status;
            window.open(
                "/report/pelarasan/1/"+val_start+"/"+val_end,
                "-_blank"
            );
        };

        function excelclick()
        {
            var val_start = document.getElementById("start_date").value;
            var val_end   = document.getElementById("end_date").value;

            if( !val_start )
            {
                var val_start = 'start';
            }
            if( !val_end )
            {
                var val_end   = 'end';
            }

            // window.location.href = "/report/transfer/1/"+val_start+"/"+val_end+"/"+val_type+"/"+val_status;
            window.open(
                "/report/pelarasan/2/"+val_start+"/"+val_end,
                "-_blank"
            );
        };
    </script>
@endpush
