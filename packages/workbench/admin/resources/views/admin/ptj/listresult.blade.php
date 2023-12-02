@extends('web::perakepay.frontend.layouts.base')
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
            <h5 class="header-style">Pengurusan PTJ</h5>
        </div>
    </div>
    <div class="container">

        <div class="card style-border">
            <div class="card-header">
                <!-- Senarai Pengguna Agensi / PTJ -->
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class="mt-2 float-left">Senarai PTJ</h6>
                    </div>
                    {{-- <div style="float: right">

                        <a href="/admin/agency/ptj/add/{{ Request::segment(5) }}"
                            class="btn btn-primary me-md-2 float-right">Tambah</a>
                    </div> --}}
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
                                <option value="{{$av->id}}" <?php if(data_get($request,'agency') == $av->id){echo "selected";} ?> > {{ $av->name }} </option>
                            @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <a href="/admin/agency/ptj/listresult"
                        class="btn btn-primary mr-1 mb-2" title="Carian">
                        <i class="ri-search-eye-line"></i>
                    </a>
                    {{-- <button type="submit" class="btn btn-primary mb-3">Cari</button> --}}
                </div>
            </div>


            <div class="card-body ">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive">
                            <table id="data-table-ptj" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">Bil</th>
                                        <th style="text-align: left;">PTJ</th>
                                        <th style="text-align: center;">Kod PTJ</th>
                                        <th style="text-align: center;">Kod Prefix</th>
                                        <th style="text-align: center;">Seller ID</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bil = 1; ?>
                                    @foreach ($ptj as $key => $value)
                                        <tr>
                                            <td class="text-center">{{ $bil++ }}</td>
                                            <td>{{ data_get($value, 'name') }}</td>
                                            <td class="text-center">{{ data_get($value, 'code') }}</td>
                                            <td class="text-center">{{ data_get($value, 'prefix') }}</td>
                                            <td class="text-center">{{ data_get($value, 'seller_id') }}</td>
                                            @if (data_get($value, 'status') == 1)
                                                <td class="text-center">Aktif</td>
                                            @else
                                                <td class="text-center">Tidak Aktif</td>
                                            @endif
                                            <td class="text-center">
                                                <a href="/admin/agency/ptj/edit/{{ $value->agency->id }}/{{ $value->id }}"
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
            $('#data-table-ptj').DataTable({
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
