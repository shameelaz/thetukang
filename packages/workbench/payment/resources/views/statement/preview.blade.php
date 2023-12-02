@extends('web::perakepay.frontend.layouts.base')
@section('content')

<?php
    if (Session::has('locale')) {
        $locale = Session::get('locale', Config::get('app.locale'));
    } else {
        $locale = \Lang::locale();
    }
?>

<style>
    .select2 {
        display: initial !important;
    }
</style>

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Penyata Pemungut</h5>
    </div>
</div>
<br>
<div class="container my-5">

    <div class="card style-border">
        <div class="card-body p-md-4">

        {!! form()->open()->post()->action(url('/statement/preview/save'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="id" value="{{data_get($request,'id')}}"/>
        <input type="hidden" name="penyedia" value="{{data_get($penyedia,'ispek_role')}}"/>
        <input type="hidden" name="penyedia_name" value="{{data_get($penyedia,'user.name')}}"/>
        <input type="hidden" name="penyedia_position" value="{{data_get($penyedia,'position.description')}}"/>

        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($penyata,'agency.code') }} : {{ data_get($penyata,'agency.name') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">PTJ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($penyata,'ptj.code')  }} : {{  data_get($penyata,'ptj.name') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No Penyata Pemungut</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ data_get($penyata,'no_penyata_pemungut') }}" disabled>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Tarikh Penyata Pemungut</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ date('d-m-Y', strtotime(data_get($penyata,'tarikh_pp'))) }}" disabled/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Tarikh Bayaran</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ date('d-m-Y', strtotime(data_get($penyata,'tarikh_bayaran'))) }}" disabled/>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Jumlah Bayaran (RM)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                        value="{{ number_format(data_get($penyata,'jumlah_rm'), 2, '.', ',') }}" disabled/>
                </div>
            </div>

            <br>
            <br>

            <div id="div-list-result">
                <div class="card-body ">

                    <div class="row g-2">
                        <div id="render_ajax" class="col-md-12 col-lg-12">

                            <div class="table-responsive">
                                <table id="data-table-statement" class="table mt-2" style="width:100%;font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="text-align: center;">Bil</th>
                                            <th style="text-align: center;">Vott</th>
                                            <th style="text-align: center;">No Resit</th>
                                            <th style="text-align: center;">Perihal</th>
                                            <th style="text-align: center;">Kod Hasil</th>
                                            <th style="text-align: center;">Amaun (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $bil = 1; ?>
                                        @foreach ($penyata->penyatapemungutdetail as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $bil++ }}</td>
                                                <td class="text-center"> {{ data_get($value, 'vott') }} </td>
                                                <td class="text-center"> {{ data_get($value,'receipt_no') }} </td>
                                                <td class="text-center"> {{ data_get($value,'perihal')  }} </td>
                                                <td class="text-center"> {{ data_get($value, 'kod_hasil') }} </td>
                                                <td class="text-center"> {{ number_format(data_get($value,'amaun'), 2, '.', ',') }} </td>

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

        <br>
        <br>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Penyedia</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="" name="" value="{{ data_get($penyedia,'user.name') }}" disabled/>
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Penyemak</label>
            <div class="col-sm-10">
                <select class="js-example-basic-single1" id="penyemak" name="penyemak">
                    <option value=""> Sila Pilih</option>
                    @foreach($penyemak as $pk => $pv)
                        <option value="{{$pv->fk_users, 'name'}}" <?php if(data_get($penyata,'userprofile.user.penyemak_name') == $pk){echo "selected";}?>> {{ data_get($pv, 'user.name') }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Pelulus</label>
            <div class="col-sm-10">
                <select class="js-example-basic-single2" id="pelulus" name="pelulus">
                    <option value=""> Sila Pilih</option>
                    @foreach($pelulus as $pk => $pv)
                        <option value="{{$pv->fk_users, 'name'}}" <?php if(data_get($penyata,'userprofile.user.pelulus_name') == $pk){echo "selected";}?>> {{ data_get($pv, 'user.name') }} </option>
                    @endforeach
                </select>
            </div>
        </div>


        <br>
        <br>

            <a href="/statement/list" class="btn btn-dark" title="Kembali">Kembali</a>
            <button class="btn btn-primary" type="submit" name="action" value="1" title="Simpan">Simpan</button>
            <a href="/statement/pdf/{{ $penyata->id }}" class="btn btn-primary" title="Cetak">Cetak</a>
            @if ($penyata->status == 1)
                <a href="/statement/status/{{ $penyata->id }}" class="btn btn-success" title="Hantar">Hantar</a>
            @endif


        {{-- <div class="col s12">
            <div id="modalSubmit" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="terms" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="terms">Pengesahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label for="">Adakah anda ingin simpan atau hantar terus Penyata Pemungut ini?
                                    <br>
                                </label>
                                <br>
                                <label for="">No Penyata Pemungut :<b> {{ data_get($penyata,'no_penyata_pemungut') }} </b>
                                    <br>
                                </label>

                                <br>
                                <br>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal">Kembali</button>
                                    <button class="btn btn-primary" type="submit" name="action" value="1" title="Simpan">Simpan</button>
                                    <a href="/statement/status/{{ $penyata->id }}" class="btn btn-success" title="Hantar">Hantar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {!! form()->close()!!}




        </div>
    </div>

</div>

@endsection

@push('script')
<script type="text/javascript">

    $(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit

        // $(".modalSubmit").click(function(){
        //     $("#modalSubmit").modal('show');
        // });
    });

    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
        $( '.js-example-basic-single1' ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
        $( '.js-example-basic-single2' ).focus();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
       $('#data-table-statement').DataTable({
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
@endpush
