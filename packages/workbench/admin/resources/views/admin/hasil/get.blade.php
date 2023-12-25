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

                     <select class="form-select" id="agency" name="agency">
                            <option value=""> Sila Pilih</option>
                            @foreach($agency as $ak => $av)
                                <option value="{{$av->id}}" <?php if($av->id == $fkagency){echo "selected";}?> > {{ $av->name }} </option>
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-auto ml-12" style="text-align: end;">
                    <label for="" class="col-form-label">PTJ: </label>
                    <input type="text" readonly class="form-control-plaintext" id="" value="">
                </div>
                <div class="col-auto">

                    <label for="" class="visually-hidden">Pilih</label>

                     <select class="form-select" id="ptj" name="ptj">
                            <option value=""> Sila Pilih</option>
                            @foreach($selptj as $pk => $pv)
                                <option value="{{$pk}}" <?php if($pk == $fkptj){echo "selected";}?> > {{ $pv }} </option>
                            @endforeach
                    </select>
                </div>
            </div>



            <div id="div-ptj-result">


            </div>


            <div class="card-body ">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            <table id="data-table-hasil" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">Bil</th>
                                        <th style="text-align: left;">Perkhidmatan</th>
                                        <th style="text-align: center;">Kod Hasil</th>
                                        <th style="text-align: center;">Nama Lain No Rujukan</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bil = 1; ?>
                                    @foreach ($hasil as $key => $value)
                                        <tr>
                                            <td class="text-center">{{ $bil++ }}</td>
                                            <td>{{ data_get($value, 'lkpperkhidmatan.name') }}</td>
                                            <td class="text-center">{{ data_get($value, 'name') }}</td>
                                            <td class="text-center">{{ data_get($value, 'reference_name') }}</td>
                                            @if (data_get($value, 'status') == 1)
                                                <td class="text-center">Aktif</td>
                                            @else
                                                <td class="text-center">Tidak Aktif</td>
                                            @endif
                                            <td class="text-center">
                                                <a href="/admin/hasil/edit/{{ data_get($value,'fk_agency') }}/{{ $value->id }}"
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
    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            $('select[name="agency"]').change(function(){
                var val = $(this).val();
                console.log(val);

                if(val){
                    $.ajax({

                    type: "GET",
                    url: "{{ URL::to('/admin/hasil/getptj')}}"+"/"+val,
                    // data: "id="+val,
                    beforeSend: function ()
                    {

                        $("#div-ptj").hide();

                        // document.getElementById('loading-1').style.display = "block";
                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {

                        // $("input[name=zone]").val(result['zone']['lz_description']);
                        // $("input[name=fk_lkp_zone").val(result['zone']['id']);

                        // var html = '<select class="js-example-programmatic w-full" name="fk_lkp_road" required>';
                        //     html += '<option value="">Sila Pilih</option>';

                        //   for(var i = 0; i < result['road'].length; i++){
                        //     html += '<option value="'+result['road'][i]['id']+'">'+result['road'][i]['lr_description']+'</option>';
                        //   }

                        //     html += '</select>';
                        document.getElementById("loader").classList.remove("show");
                        $("#div-ptj-result").html(result);



                        // $(".c-hide").css('display', 'flex');
                        // document.getElementById('loading-1').style.display = "none";
                    }
                    });
                }

            });


            $('#data-table-hasil').DataTable({
                "responsive": true,
                "scrollY": 200,
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
@endpush
