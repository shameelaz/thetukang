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
            <h5 class="header-style">Pengurusan Kod Hasil</h5>
        </div>
    </div>
    <br>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Kod Hasil</h6>
                    </div>
                    <div style="float: right">

                        <a href="/admin/hasil/add/{{$request->agency}}/{{$request->ptj}}"
                            class="btn btn-primary me-md-2 float-right">Tambah</a>
                    </div>
                </div>

            </div>




            <div class="row g-3 mt-2">
                <div class="col-auto ml-12" style="text-align: end;">
                    <label for="" class="col-form-label">Agensi: </label>
                    <input type="text" readonly class="form-control-plaintext" id="" value="">
                </div>
                <div class="col-auto">

                    <label for="" class="visually-hidden">Pilih</label>

                     <select class="js-example-basic-single3" id="agency" name="agency">
                            <option value=""> Sila Pilih</option>
                            @foreach($agency as $ak => $av)
                                <option value="{{$av->id}}" <?php if($av->id == $request->agency){echo "selected";}?> > {{ data_get($av,'code') }} :  {{ $av->name }} </option>
                            @endforeach
                    </select>
                </div>
            </div>

            <div id="div-ptj-result">
                <div class="row g-3 mt-2" id="div-ptj">
                    <div class="col-auto ml-12" style="text-align: end;" >
                        <label for="" class="col-form-label">PTJ: </label>
                        <input type="text" readonly class="form-control-plaintext" id="" value="">
                    </div>
                    <div class="col-auto">

                        <label for="" class="visually-hidden">Pilih</label>

                         <select class="js-example-basic-single4" id="ptj" name="ptj">
                                <option value=""> Sila Pilih</option>
                                @foreach($ptj as $pk => $pv)
                                    <option value="{{$pv->id}}" <?php if($pv->id == $request->ptj){echo "selected";}?> > {{ data_get($pv,'code') }} :  {{ $pv->name }} </option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary mr-1 mb-2" type="submit" title="Carian" onclick="submitSearch()">
                            <i class="ri-search-eye-line"></i>
                        </button>
                        {{-- <a href="/admin/hasil/add/"
                            class="btn btn-primary mr-1 mb-2" title="Carian">
                            <i class="ri-search-eye-line"></i>
                        </a> --}}
                    </div>
                </div>
            </div>

            <div id="div-list-result">

                <div class="card-body ">

                    <div class="row g-2">
                        <div class="col-md-12 col-lg-12">

                            <div class="table-responsive">
                                <table id="data-table-hasil" class="table mt-2" style="width:100%;font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">Bil</th>
                                            <th style="text-align: left;">Agensi</th>
                                            <th style="text-align: left;">Perkhidmatan</th>
                                            <th style="text-align: center;">Kod Hasil</th>
                                            <th style="text-align: center;">Nama Lain No Rujukan</th>
                                            {{-- <th style="text-align: center;">Jenis</th> --}}
                                            {{-- <th style="text-align: center;">Jenis Kadar Bayaran</th> --}}
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($hasil as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $bil++ }}</td>
                                                <td>{{ data_get($value, 'agency.name') }}</td>
                                                <td>{{ data_get($value, 'lkpperkhidmatan.name') }}</td>
                                                <td class="text-center">{{ data_get($value, 'lkpkodhasil.kod_hasil') }}</td>
                                                <td class="text-center">{{ data_get($value, 'reference_name') }}</td>
                                                {{-- <td class="text-center">
                                                    @if(data_get($value,'type')== 1)
                                                    Bil
                                                    @elseif(data_get($value,'type')== 2)
                                                    Kadar Bayaran
                                                    @else
                                                    @endif
                                                </td> --}}
                                                {{-- <td class="text-center">
                                                    @if(data_get($value,'type_rate')== 0)
                                                    Tiada
                                                    @elseif(data_get($value,'type_rate')== 1)
                                                    Kadar Bayaran : Tiket
                                                    @elseif(data_get($value,'type_rate')== 2)
                                                    Kadar Bayaran : Timbangan
                                                    @else

                                                    @endif
                                                </td> --}}
                                                @if (data_get($value, 'status') == 1)
                                                    <td class="text-center">Aktif</td>
                                                @else
                                                    <td class="text-center">Tidak Aktif</td>
                                                @endif
                                                <td class="text-center">
                                                    <a href="/admin/hasil/edit/{{ data_get($value,'fk_agency') }}/{{ data_get($value,'fk_ptj') }}/{{ $value->id }}"
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
        </div>

    </div>
    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#data-table-hasil').DataTable({
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

            $('select[name="agency"]').change(function()
            {
                var val = $(this).val();

                if(val)
                {
                    $.ajax({
                    type: "GET",
                    url: "{{ URL::to('/admin/hasil/ajax/ptj')}}"+"/"+val,

                    beforeSend: function ()
                    {
                        $("#div-ptj").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {
                        $("#div-ptj-result").html(result);
                        document.getElementById("loader").classList.remove("show");
                    }
                    });

                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('/admin/hasil/ajax/agency')}}"+"/"+val,

                        beforeSend: function ()
                        {
                            $("#div-list-result").hide();

                            document.getElementById("loader").classList.add("show");

                            $("#data-table-hasil").DataTable().destroy();
                        },
                        success: function(result)
                        {
                            $("#div-list-result").html(result);
                            $("#div-list-result").show();
                            document.getElementById("loader").classList.remove("show");
                        }
                    });
                }

            });
        });
    </script>

<script type="text/javascript">
    function submitSearch()
    {
        var agency_id = document.getElementById('agency').value;
        var ptj_id    = document.getElementById('ptj').value;

        if( !agency_id )
        {
            var agency_id   = 'agency';
        }

        if( !ptj_id )
        {
            var ptj_id   = 'ptj';
        }

        window.location.href = "/admin/hasil/result/"+agency_id+"/"+ptj_id;
    }

    $(document).ready(function() {
        $('.js-example-basic-single3').select2();
        $( ".js-example-basic-single3" ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single4').select2();
        $( ".js-example-basic-single4" ).focus();
    });
</script>

@endpush
