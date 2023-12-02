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
            <h5 class="header-style">Pengurusan Manual</h5>
        </div>
    </div>
    <div class="container my-5">

        <div class="card rounded style-border">
            <div class="card-header">
                <div class="gap-2">
                    <div style="float: left">
                        <h6 class=" mt-2 float-left">Senarai Manual Video</h6>
                    </div>

                </div>

                <div style="float: right">
                    <a href="/admin/manual/video/add" class="btn btn-primary me-md-2">Tambah</a>
                </div>


            </div>


            <div class="card-body">

                <div class="row g-2">
                    <div class="col-md-12 col-lg-12">

                        <div class="table-responsive" id="div-form">
                            <table id="data-table-video" class="table mt-2" style="width:100%;font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center;">Bil</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">Url</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $bil=1; @endphp
                                    @foreach ($video as $key => $value)
                                        <tr>
                                            <td style="text-align: center;">{{ $bil++ }}</td>
                                            <td style="text-align: center;">{{ data_get($value,'nama') }}</td>
                                            <td style="text-align: center;">{{ data_get($value,'url') }}</td>
                                            @if(data_get($value, 'status') == 1)
                                            <td style="text-align: center;">Aktif</td>
                                            @else
                                            <td style="text-align: center;">Tidak Aktif</td>
                                            @endif

                                            <td style="text-align: center;">
                                                <a href="/admin/manual/video/show/{{ $value->id }}" class="btn btn-primary mr-1 mb-2" title="Kemaskini">
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
            $('#data-table-video').DataTable({
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
