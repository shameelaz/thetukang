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
            <h5 class="header-style">Pengurusan Pengumuman</h5>
        </div>
    </div>
    <div class="container my-5">

        <div class="card rounded style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class=" mt-2 float-left">Senarai Pengumuman</h6>
                    </div>
                    <div style="float: right">
                        <a href="/admin/banner/add" class="btn btn-primary me-md-2">Tambah</a>
                    </div>
                </div>


            </div>


            <div class="card-body">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="">
                            <table id="data-table-user" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: left;">Bil</th>
                                        <th style="text-align: left;">Banner</th>
                                        <th style="text-align: left;">Tajuk</th>
                                        {{-- <th style="text-align: left;">Penerangan</th> --}}
                                        <th style="text-align: left;">Tarikh Mula</th>
                                        <th style="text-align: left;">Tarikh Tamat</th>
                                        <th style="text-align: left;">Tarikh Kemaskini</th>
                                        <th style="text-align: left;">Status</th>
                                        <th style="text-align: left;">Susunan</th>
                                        <th style="text-align: left;">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bil = 1; $totalp = $banner->count();?>
                                    @foreach ($banner as $key => $value)
                                        <tr>
                                            <td>{{ $bil++ }}</td>
                                            <td>
                                                <figure class="figure">
                                                    @if( data_get($value,'image'))
                                                    <img src="{{data_get($value,'image')}}" class="img-thumbnail figure-img img-fluid rounded logo" alt="..." style="height:60px">
                                                    @else
                                                    @endif

                                                    {{-- <figcaption class="figure-caption"></figcaption> --}}
                                                </figure>

                                            </td>
                                            <td>{{ data_get($value, 'tajuk') }}</td>
                                            {{-- <td>{{ data_get($value, 'penerangan') }}</td> --}}
                                            <td>
                                                {{ date('d-m-Y',strtotime(data_get($value,'tarikh_mula')))  }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y',strtotime(data_get($value,'tarikh_tamat')))  }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y',strtotime(data_get($value,'updated_at')))  }}
                                            </td>
                                            @if (data_get($value, 'status') == 1)
                                                <td>Aktif</td>
                                            @else
                                                <td>Tidak Aktif</td>
                                            @endif
                                            <td>
                                                {{-- {{ data_get($value,'order') }} --}}
                                                <select name="select-order" class="sm:w-auto form-select box" id="select-order" style="width: unset !important;padding-right: 30px !important;" onchange="location = this.value;">
                                                    <option value="javascript:void(0)" selected>Pilih Susunan</option>
                                                    @if(data_get($value,'order') == 1)
                                                    <option value="/admin/banner/order/{{$value->id}}/2">Bawah</option>
                                                    @elseif($totalp <= $value->order)
                                                    <option value="/admin/banner/order/{{$value->id}}/1">Atas</option>
                                                    @elseif(($value->order > 1) AND ($totalp >= $value->order))
                                                    <option value="/admin/banner/order/{{$value->id}}/2">Bawah</option>
                                                    <option value="/admin/banner/order/{{$value->id}}/1">Atas</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <a href="/admin/banner/edit/{{ $value->id }}"
                                                    class="btn btn-primary mr-1 mb-2" alt="Kemaskini" title="Kemaskini">
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

    <!-- Modal -->
    <div class="modal fade" id="password-modal-preview" tabindex="-1" aria-labelledby="password-modal-preview"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! form()->open()->post()->action(url('/admin/user/awam/password'))->horizontal()->attribute('id', 'myform') !!}
                    <div class="p-2 text-center"> <i data-feather="alert-circle"
                            class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Perlu Tukar Katalaluan?</div>
                        <div class="text-gray-600 mt-2">Pengesahan Emel tukar katalaluan akan dihantar ke email pengguna
                            <br></div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <input type="hidden" name="id" id="id" />
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-primary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Batal</button>

                        <input type="submit" class="btn btn-primary w-30" value="Ya!">

                    </div>
                    {!! form()->close() !!}
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        function funcPass(id) {
            $("#id").val(id);
        }


        $(document).ready(function() {
            $('#data-table-user').DataTable({
                "responsive": true,
                "scrollY": false,
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
            $("#myform").on("submit", function() {
                document.getElementById("loader").classList.add("show");
            }); //submit
        });


        $( document ).ready(function() {

            $('select[name="select-order"]').change(function(){
            var val = $(this).val();
            console.log(val);

            document.getElementById("loader").classList.add("show");

            });

        });
    </script>
@endpush
