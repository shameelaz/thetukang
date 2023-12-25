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
            <h5 class="header-style">Pengurusan Maklumat Pembayaran (Bil) </h5>
        </div>
    </div>

    <br>
    <div class="container">
        {!! form()->open()->post()->action(route('agency::bill.importAdd'))->attribute('id', 'import')->multipart()->horizontal() !!}
        @csrf
        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai Excel </h6>
                    </div>
                    {{-- <div style="float: right">

                        <a href="/ptj/bill/add"
                            class="btn btn-primary me-md-2 float-right">Tambah</a>

                        <a class="btn btn-primary me-md-2 float-right" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalImport">Import/Muat Naik</a>
                    </div> --}}
                </div>


            </div>
                <div id="div-list-result">
                    <div class="card-body ">

                        <div class="row g-2">
                            <div class="col-md-12 col-lg-12">

                                <div class="table-responsive">
                                    <table id="data-table-temporary" class="table mt-2" style="width:100%;font-size: 12px;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th style="text-align: center;">Bil</th>
                                                <th style="text-align: left;">No Akaun</th>
                                                <th style="text-align: left;">Nama Pemilik Akaun</th>
                                                <th style="text-align: left;">No IC</th>
                                                <th style="text-align: center;">No Rujukan</th>
                                                <th style="text-align: center;">Amaun (RM)</th>
                                                <th style="text-align: left;">Keterangan Pembayaran</th>
                                                <th style="text-align: center;">Tarikh Bil</th>
                                                <th style="text-align: center;">Tarikh Tamat</th>
                                                <th style="text-align: center;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $bil = 1; ?>
                                            @foreach ($temp as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ $bil++ }}</td>
                                                    <td>{{ data_get($value, 'account_no') }}</td>
                                                    <td>{{ data_get($value, 'name') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'identification_no') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'reference_no') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'amount') }}</td>
                                                    <td class="text-center">{{ data_get($value, 'bill_detail') }}</td>
                                                    <td class="text-center">{{  date('d-m-Y',strtotime(data_get($value, 'bill_date'))) }}</td>
                                                    <td class="text-center">{{  date('d-m-Y',strtotime(data_get($value, 'bill_end_date'))) }}</td>
                                                    @if (data_get($value, 'status') == 0)
                                                        <td class="text-center">Draf</td>
                                                    @else
                                                        <td class="text-center">Aktif</td>
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
                <br>
                <hr>

                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left"> </h6>
                    </div>
                    <div style="float: right">

                        <a class="btn btn-primary me-md-2 float-right" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalSubmit">Sahkan</a>

                        <a class="btn btn-secondary me-md-2 float-right" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalReject">Tidak Sah</a>

                    </div>
                </div>

                <br>

        </div>

        <div class="col s12">
            <div id="modalSubmit" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="terms" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="terms">Pengesahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <input type="hidden" name="fkkodhasil" value="{{data_get($temp,'0.fk_kod_hasil')}}"/>
                        <div class="modal-body">
                            <div>
                                <label for="">Anda pasti ingin mengesahkan senarai muat naik fail ini ?
                                    <br>
                                </label>

                                <br>
                                <br>
                                <div class="modal-footer">
                                    <button  class="btn btn-success" type="submit" name="action" value="1" title="Sahkan">Sahkan</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12">
            <div id="modalReject" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="terms" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="terms">Pengesahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label for="">Anda pasti ingin tidak mengesahkan senarai muat naik fail ini ?
                                    <br>
                                </label>

                                <br>
                                <br>
                                <div class="modal-footer">
                                    <button  class="btn btn-success" type="submit" name="action" value="2" title="Tidak Sah">Tidak Sah</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! form()->close() !!}

    </div>
    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#import").on("submit", function(){
                document.getElementById("loader").classList.add("show");
            });//submit

            $(".modalSubmit").click(function(){
                $("#modalSubmit").modal('show');
            });

            $('#data-table-temporary').DataTable({
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

