@extends('web::perakepay.frontend.layouts.base')
@section('content')
    <style>
        .select2 {
            display: initial !important;
        }
    </style>

    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style m-0">Tambah Pengurusan PTJ</h5>
        </div>
    </div>

    <div class="container my-5">

        <!-- <div class="rounded border shadow-sm border-primary"> -->
        <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
        <div class="card style-border">
            <div class="card-body p-md-4">

                {!! form()->open()->post()->action(url('/admin/agency/ptj/save'))->attribute('id', 'myform')->horizontal() !!}

                <div id="div-individu" style="">

                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Agensi</label>
                        <div class="col-sm-10">

                            <select class="js-example-basic-single1" id="agency" name="agency" required>
                                <option value=""> Sila Pilih</option>
                                @foreach ($agency as $ak => $av)
                                    <option value="{{ $av->id }}"> {{ $av->code }} : {{ $av->name }} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div id="div-ptj-result">

                    </div>

                    <div id="div-kod-ptj-result">

                    </div>

                    <div id="div-kod-swift-result">

                    </div>

                    <a href="/admin/agency/ptj/list/{{ data_get($agency, 'id') }}" class="btn btn-dark">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                {!! form()->close() !!}




            </div>
        </div>

    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $('select[name="agency"]').change(function() {
                var val = $(this).val();
                console.log(val);

                if (val) {
                    $.ajax({

                        type: "GET",
                        url: "{{ URL::to('/admin/agency/getptj/') }}" + "/" + val,

                        beforeSend: function() {

                            // $("#div-ptj").hide();

                            document.getElementById("loader").classList.add("show");
                        },
                        success: function(result) {

                            document.getElementById("loader").classList.remove("show");
                            $("#div-ptj-result").html(result);

                        }
                    });
                }

            });



            $(document).ready(function() {
                $("#myform").on("submit", function() {
                    document.getElementById("loader").classList.add("show");
                }); //submit
            });


            $(document).ready(function() {
                $('.js-example-basic-single1').select2();
                $(".js-example-basic-single1").focus();

            });

            $(document).ready(function() {
                $('.js-example-basic-single2').select2();
                $(".js-example-basic-single2").focus();

            });

        });
    </script>
@endpush
