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
            <h5 class="header-style">Laporan Senarai Pengguna</h5>
        </div>
    </div>
    <div class="container">

        <br>

        <div class="card style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Pengguna</h6>
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
                            <label for="inputPassword6" class="col-form-label">Tarikh Mula</label>
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
                            <label for="" class="col-form-label">Peranan</label>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" id="role" name="role">
                                <option value=""> Sila Pilih</option>
                                @foreach($role as $rk => $rv)
                                    <option value="{{$rk}}"> {{ $rv }} </option>
                                @endforeach
                            </select>
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
                                <table id="data-table-user" class="table mt-2" style="width:100%;font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">Bil</th>
                                            <th style="text-align: left;">Nama Pengguna</th>
                                            <th style="text-align: left;">Emel</th>
                                            <th style="text-align: left;">Agensi</th>
                                            <th style="text-align: left;">PTJ</th>
                                            <th style="text-align: left;">Peranan</th>
                                            <th style="text-align: center;">Tarikh Daftar</th>
                                            <th style="text-align: center;">Tarikh Tamat</th>
                                            <th style="text-align: center;">Tarikh Terakhir Masuk Sistem</th>
                                            <th style="text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($user as $key => $value)
                                            {{-- {{ dd( data_get($value, 'profile') ) }} --}}
                                            <tr>
                                                <td class="text-center">{{ $bil++ }}</td>
                                                <td>{{ data_get($value, 'name') }}</td>
                                                <td>{{ data_get($value, 'email') }}</td>
                                                <td>
                                                    @if (data_get($value, 'profile.userAgency.name') != null)
                                                        {{ data_get($value, 'profile.userAgency.name') }}
                                                    @else
                                                        -
                                                    @endif

                                                </td>
                                                <td>
                                                    @if (data_get($value, 'profile.userPtj.name') != null)
                                                        {{ data_get($value, 'profile.userPtj.name') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ data_get($value, 'role.0.name.name') }}</td>
                                                <td class="text-center" style="white-space: nowrap;">
                                                    @if (data_get($value, 'email_verified_at') != null)
                                                        {{ date('d-m-Y', strtotime(data_get($value, 'email_verified_at'))) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-center" style="white-space: nowrap;">
                                                    @if (data_get($value, 'expired_date') != null)
                                                        {{ date('d-m-Y', strtotime(data_get($value, 'expired_date'))) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                        <td class="text-center" style="white-space: nowrap;">
                                            @if (data_get($value, 'last_login') != null)
                                                {{ date('d-m-Y', strtotime(data_get($value, 'last_login'))) }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                            @if (data_get($value, 'status') == 1)
                                                <td class="text-center">Aktif</td>
                                            @else
                                                <td class="text-center">Tidak Aktif</td>
                                            @endif
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
            $('#data-table-user').DataTable({
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
                var val_role   = document.getElementById("role").value;

                if( !val_start )
                {
                    var val_start = 'start';
                }
                if( !val_end )
                {
                    var val_end   = 'end';
                }
                if( !val_role )
                {
                    var val_role   = 'rol';
                }

                $.ajax(
                {
                    type: "get",
                    url : "{{ URL::to('/report/users/ajax') }}"+"/"+val_start+"/"+val_end+"/"+val_role,

                    beforeSend: function ()
                    {
                        $("#render_ajax").html("");
                        document.getElementById("loader").classList.add("show");

                    },
                    success: function (result)
                    {

                        $("#render_ajax").html(result);

                        $('#data-table-user').DataTable({
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
            var val_role   = document.getElementById("role").value;

            if( !val_start )
            {
                var val_start = 'start';
            }
            if( !val_end )
            {
                var val_end   = 'end';
            }
            if( !val_role )
            {
                var val_role   = 'rol';
            }


            // window.location.href = "/report/transfer/1/"+val_start+"/"+val_end+"/"+val_type+"/"+val_status;
            window.open(
                "/report/users/1/"+val_start+"/"+val_end+"/"+val_role,
                "-_blank"
            );
        };

        function excelclick()
        {
            var val_start = document.getElementById("start_date").value;
            var val_end   = document.getElementById("end_date").value;
            var val_role   = document.getElementById("role").value;

            if( !val_start )
            {
                var val_start = 'start';
            }
            if( !val_end )
            {
                var val_end   = 'end';
            }
            if( !val_role )
            {
                var val_role   = 'rol';
            }


            // window.location.href = "/report/transfer/1/"+val_start+"/"+val_end+"/"+val_type+"/"+val_status;
            window.open(
                "/report/users/2/"+val_start+"/"+val_end+"/"+val_role,
                "-_blank"
            );
        };
    </script>
@endpush
