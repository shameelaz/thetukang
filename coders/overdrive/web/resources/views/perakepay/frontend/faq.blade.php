@extends('web::perakepay.frontend.layouts.base')
@section('content')
    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Senarai Soalan Lazim</h5>
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
                <select class="form-select" aria-label="" name="sel-agency">
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
                            @forelse($faq->where('status',1) as $key => $value)
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne{{ $value->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{ $value->id }}" aria-expanded="false" aria-controls="flush-collapseOne{{ $value->id }}">
                                        {{ data_get($value,'soalan_ms') }}
                                    </button>
                                </h2>
                                <div id="flush-collapseOne{{ $value->id }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne{{ $value->id }}" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        {{ data_get($value,'jawapan_ms') }}
                                    </div>
                                </div>
                                </div>

                            </div>
                            @empty
                            <div class="alert alert-danger" role="alert">
                                Tiada Soalan Lazim untuk carian ini
                            </div>
                            @endforelse
                        </div>

                        <br>

                        <div id="div-result">

                        </div>


                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
@push('script')
    <script type="text/javascript">

        $(document).ready(function() {

            $('select[name="sel-agency"]').change(function() {
                var val = $(this).val();
                console.log(val);

                if (val) {
                    $.ajax({

                        type: "GET",
                        url: "{{ URL::to('/faq/getagency') }}" + "/" + val,
                        //   data: "id="+val,
                        beforeSend: function() {

                            document.getElementById("loader").classList.add("show");

                            $("#div-form").hide();
                            // $(".c-hide").hide();

                            //   document.getElementByClass('loading-1').style.display = "block";

                        },
                        success: function(result) {

                            document.getElementById("loader").classList.remove("show");

                            console.log(result);

                            var data = result;

                            $("#div-result").show();

                            console.log(result);

                            $("#div-result").html(result);

                            // alert(data.add);
                            // $("#address").html('<p>' + data.add + '</p>');
                            // $("#email").html('<p>' + data.email + '</p>');
                            // $("#telephone").html('<p>' + data.phone_no + '</p>');

                        }
                    });
                }

            });



        });

        $(document).ready(function() {
            $("#myform").on("submit", function() {
                document.getElementById("loader").classList.add("show");
            }); //submit
        });
    </script>
@endpush
