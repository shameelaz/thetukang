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
            <h5 class="header-style">Pengurusan Soalan Lazim</h5>
        </div>
    </div>
    <div class="container my-5">

        <div class="card rounded style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class=" mt-2 float-left">Senarai Soalan Lazim</h6>
                    </div>

                </div>


            </div>

            <div class="card-body">
                <select class="js-example-basic-single" aria-label="" name="sel-agency" style="width: 100%">
                    <option value="">Sila Pilih</option>
                    @foreach($agencyList as $x => $y)
                    <option value="{{ $y->id }}" <?php if($y->id == $request->fkagency){echo "selected";}?> >{{ $y->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="card-body">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive" id="div-form">
                            <table id="data-table-faq" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: left;">Bil</th>
                                        <th style="text-align: left;">Perkhidmatan</th>
                                        <th style="text-align: left;">Soalan</th>
                                        <th style="text-align: left;">Jawapan</th>
                                        <th style="text-align: left;"></th>
                                        <th style="text-align: left;">Status</th>
                                        <th style="text-align: left;">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $bil=1; @endphp
                                    @foreach ($faq as $key => $value)
                                        <tr>
                                            <td>{{ $bil++ }}</td>
                                            <td>{{ data_get($value,'fkkhidmat.name') }}</td>
                                            <td>{{ data_get($value,'soalan_ms') }}</td>
                                            <td>{{ data_get($value,'jawapan_ms') }}</td>
                                            <td>
                                                @if (data_get($value, 'status') == 1)
                                                    <td class="text-center">Aktif</td>
                                                @else
                                                    <td class="text-center">Tidak Aktif</td>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/admin/faq/edit/{{$value->fk_agency}}/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Kemaskini">
                                                    <i class="ri-edit-line"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div id="div-result">

                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Modal -->
    {{-- <div class="modal fade" id="password-modal-preview" tabindex="-1" aria-labelledby="password-modal-preview"
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
    </div> --}}

    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        function funcPass(id) {
            $("#id").val(id);
        }


        $(document).ready(function() {
            $('#data-table-faq').DataTable({
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






        $( document ).ready(function() {

            $('select[name="sel-agency"]').change(function(){
            var val = $(this).val();
            console.log(val);

            if(val){
                $.ajax({

                type: "GET",
                url: "{{ URL::to('/admin/faq/getagency')}}"+"/"+val,
                //   data: "id="+val,
                beforeSend: function ()
                {

                    document.getElementById("loader").classList.add("show");
                    $("#div-form").hide();
                    // $(".c-hide").hide();

                    //   document.getElementByClass('loading-1').style.display = "block";

                },
                success: function(result)
                {

                    document.getElementById("loader").classList.remove("show");

                    $("#div-result").show();

                    console.log(result);

                    $("#div-result").html(result);

                    // alert(data.add);
                    // $("#address").html('<p>'+data.add+'</p>');
                    // $("#email").html('<p>'+data.email+'</p>');
                    // $("#telephone").html('<p>'+data.phone_no+'</p>');

                }
                });
            }

            });
        });



    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#myform").on("submit", function() {
                document.getElementById("loader").classList.add("show");
            }); //submit
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $( ".js-example-basic-single" ).focus();

        });

    </script>
@endpush
