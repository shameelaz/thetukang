@extends('web::perakepay.frontend.layouts.base')
@section('content')
    <div class="bg-light py-4">
        <div class="container">
            <h5>@lang('web::auth.list-agency-services') {{-- SENARAI AGENSI PERKHIDMATAN --}}</h5>
        </div>
    </div>

    <div class="container my-5">

        <div class="card style-border">
            <div class="row">

                <div class="col-md-12 pe-md-12">
                    <div class="row row-cols-1 row-cols-md-3 gy-4 mt-2 p-4">
                        @forelse($agency->where('status', 1) as $x => $y)
                            <div class="col">
                                <div class="bg-white text-center p-3 rounded box-image-text">
                                    <div>
                                        @if(data_get($y,'logo_agensi'))
                                        <img src="{{data_get($y,'logo_agensi')}}" class="logo figure-img img-fluid rounded" alt="..." style="">
                                        @else
                                        <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" class="logo figure-img img-fluid rounded" />
                                        @endif
                                    </div>
                                    <a href="/agensi/{{ $y->id }}" class="stretched-link">{{ strtoupper(data_get($y,'agensi.name'))  }}</a>
                                </div>
                            </div>
                        @empty
                        @endforelse

                    </div>
                    <br>
                    <div class="p-4">
                        @if ($user != null)
                            <a href="/home" class="btn btn-dark">@lang('web::auth.back') {{-- Kembali --}}</a>
                        @else
                            <a href="/" class="btn btn-dark">@lang('web::auth.back') {{-- Kembali --}}</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
<script type="text/javascript">
  $( document ).ready(function() {

        $('select[name="agency"]').change(function(){
          var val = $(this).val();
          console.log(val);

          if(val){
            $.ajax({

              type: "GET",
              url: "{{ URL::to('/feedback/getagency')}}"+"/"+val,
            //   data: "id="+val,
              beforeSend: function ()
              {

                document.getElementById("loader").classList.add("show");
                  // $(".c-hide").hide();

                //   document.getElementByClass('loading-1').style.display = "block";

              },
              success: function(result)
              {

                document.getElementById("loader").classList.remove("show");

                console.log(result);

                var data = result;
                // alert(data.add);
                $("#address").html('<p>'+data.add+'</p>');
                $("#email").html('<p>'+data.email+'</p>');
                $("#telephone").html('<p>'+data.phone_no+'</p>');

              }
            });
          }

        });



    });

    $(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit
    });
</script>
@endpush
