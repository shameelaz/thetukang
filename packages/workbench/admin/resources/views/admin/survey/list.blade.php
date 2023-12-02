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
            <h5 class="header-style">Pengurusan Kajian Kepuasan Pelanggan</h5>
        </div>
    </div>
    <div class="container my-5">

        <div class="card rounded style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class=" mt-2 float-left">Kajian Kepuasan Pelanggan</h6>
                    </div>

                </div>

                <div style="float: right">
                    <a href="/admin/survey/add" class="btn btn-primary me-md-2">Tambah</a>
                </div>


            </div>


            <div class="card-body">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive" id="div-form">
                            <table id="data-table-survey" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: left;">Bil</th>
                                        <th style="text-align: left;">Gambar</th>
                                        <th style="text-align: left;">Keterangan</th>
                                        <th style="text-align: left;">Markah</th>
                                        <th style="text-align: left;">Status</th>
                                        <th style="text-align: left;">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $bil=1; @endphp
                                    @foreach ($survey as $key => $value)
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
                                            <td>{{ data_get($value,'description') }}</td>
                                            <td>{{ data_get($value,'rate') }}</td>

                                            @if(data_get($value, 'status') == 1)
                                            <td class="text-center">Aktif</td>
                                            @else
                                            <td class="text-center">Tidak Aktif</td>
                                            @endif

                                            <td>
                                                <a href="/admin/survey/show/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Kemaskini">
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



    <br />
@endsection



@push('script')
    <script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        function funcPass(id) {
            $("#id").val(id);
        }


        $(document).ready(function() {
            $('#data-table-survey').DataTable({
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
    </script>
@endpush
