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
            <h5 class="header-style">Pengurusan Kod Liabiliti</h5>
        </div>
    </div>
    <br>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Kod Liabiliti</h6>
                    </div>
                    {{-- <div style="float: right">

                        <a href="/admin/hasil/add/{{ Request::segment(4) }}"
                            class="btn btn-primary me-md-2 float-right">Tambah</a>
                    </div> --}}
                </div>

            </div>
             {{-- form()->post()->url('/admin/liabiliti/result')!!} --}}

                {{-- <div class="row g-3 mt-2">
                    <div class="col-auto ml-12" style="text-align: end;">
                        <label for="" class="col-form-label">Agensi: </label>
                        <input type="text" readonly class="form-control-plaintext" id="" value="">
                    </div>
                    <div class="col-auto">

                        <label for="" class="visually-hidden">Pilih</label>

                        <select class="js-example-basic-single" id="agency" name="agency">
                                <option value=""> Sila Pilih</option>
                                @foreach($agency as $ak => $av)
                                    <option value="{{$av->id}}"> {{ data_get($av,'code') }} : {{ $av->name }} </option>
                                @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-2" id="div-ptj-result">
                    <div class="col-auto ml-12" style="text-align: end;">
                        <label for="" class="col-form-label">PTJ: </label>
                        <input type="text" readonly class="form-control-plaintext" id="" value="">
                    </div>
                    <div class="col-auto">

                        <label for="" class="visually-hidden">Pilih</label>

                        <select class="js-example-basic-single2" id="ptj" name="ptj" style="width: 100%">
                            <option value=""> Sila Pilih</option>
                            @foreach($ptj as $pk => $pv)
                                <option value="{{$pv->id}}"> {{ $pv->code }} : {{ $pv->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}

                <div class="intro-y box p-5 col-span-12 lg:col-span-12">

                    <div class="grid grid-cols-12 gap-2">
                        <div class="row g-3 align-items-center">
                            <div class="col-4 col-lg-2">
                                <label for="" class="col-form-label" style="float: right;">Agensi :</label>
                            </div>
                            <div class="col-4 col-lg-6">
                                <select class="js-example-basic-single" id="agency" name="agency" style="width: 100%">
                                    <option value=""> Sila Pilih</option>
                                    @foreach($agency as $ak => $av)
                                        <option value="{{$av->id}}"> {{ data_get($av,'code') }} : {{ $av->name }} </option>
                                    @endforeach
                            </select>
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
                                <select class="js-example-basic-single2" id="ptj" name="ptj" style="width: 100%">
                                    <option value=""> Sila Pilih</option>
                                    @foreach($ptj as $pk => $pv)
                                        <option value="{{$pv->id}}"> {{ data_get($pv,'code') }} : {{ $pv->name }} </option>
                                    @endforeach
                            </select>
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
                                    <table id="data-table-liabiliti" class="table mt-2" style="width:100%;font-size: 12px;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th style="text-align: center;">Bil</th>
                                                <th style="text-align: left;">Agensi</th>
                                                <th style="text-align: left;">PTJ</th>
                                                <th style="text-align: left;">Perkhidmatan</th>
                                                <th style="text-align: center;">Kod Liabiliti</th>
                                                <th style="text-align: center;">Nama Lain No Rujukan</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $bil = 1; ?>
                                            @foreach ($lia as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ $bil++ }}</td>
                                                    <td>{{ data_get($value, 'agency.name') }}</td>
                                                    <td>{{ data_get($value, 'ptj.name') }}</td>
                                                    <td>{{ data_get($value, 'lkpperkhidmatan.name') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'name') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'reference_name') }}</td>
                                                    @if (data_get($value, 'status') == 1)
                                                        <td class="text-center">Aktif</td>
                                                    @else
                                                        <td class="text-center">Tidak Aktif</td>
                                                    @endif
                                                    <td class="text-center">
                                                        <a href="/admin/liabiliti/edit/{{ data_get($value,'fk_agency') }}/{{ data_get($value,'fk_ptj') }}/{{ $value->id }}"
                                                            class="btn btn-primary mr-1 mb-2" title="Kemaskini">
                                                            <i class="ri-edit-line"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
             {{-- form()->close() !!} --}}
        </div>

    </div>
    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#data-table-liabiliti').DataTable({
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

            // // onload ------------

            // // end onload ------------

            $('#clicksubmit').click(function(e)
            {
                var val_agency   = document.getElementById("agency").value;
                var val_ptj   = document.getElementById("ptj").value;

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
                    url : "{{ URL::to('/admin/liabiliti/ajax') }}"+"/"+val_agency+"/"+val_ptj,

                    beforeSend: function ()
                    {

                        $("#render_ajax").html("");
                        $('#data-table-liabiliti').DataTable().destroy();
                        document.getElementById("loader").classList.add("show");

                    },
                    success: function (result)
                    {

                        $("#render_ajax").html(result);

                        $('#data-table-liabiliti').DataTable({
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
                        url: "{{ URL::to('/admin/liabiliti/ptj')}}"+"/"+val,

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
        });

        // function submitSearch()
        // {
        //     var agency_id = document.getElementById('agency').value;
        //     var ptj_id    = document.getElementById('ptj').value;

        //     window.location.href = "/admin/liabiliti/result/"+agency_id+"/"+ptj_id;
        // }

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $( ".js-example-basic-single" ).focus();

        });

        $(document).ready(function() {
            $('.js-example-basic-single2').select2();
            $( ".js-example-basic-single2" ).focus();

        });
    </script>
@endpush
