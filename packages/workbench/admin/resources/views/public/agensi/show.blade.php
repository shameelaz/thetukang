@extends('web::perakepay.frontend.layouts.base')
@section('content')
    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">{{ data_get($agensi,'agensi.name') }}</h5>
        </div>
    </div>

    <div class="container my-5">

        <div class="card style-border">
            <div class="row">

                <div class="row align-items-md-stretch">
                    <div class="col-md-8">
                      <div class="h-100 p-5  rounded-3">
                        <h2>{{ data_get($agensi,'agensi.name') }}</h2>
                        <p>{!! data_get($agensi,'keterangan_ms') !!}</p>

                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="h-100 p-5 rounded-3 text-center">

                        <figure class="figure">
                            @if( data_get($agensi,'logo_agensi'))
                            <img src="{{data_get($agensi,'logo_agensi')}}" class="img-thumbnail figure-img img-fluid rounded " alt="..." style="width:200px; height:200px;">
                            @else
                            <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" class="logo figure-img img-fluid rounded" style="width:200px; height:200px;"/>
                            @endif


                        </figure>

                      </div>
                    </div>
                </div>

                <div class="align-items-md-stretch">


                    <div class=" px-4 py-5" id="">
                        <h2 class="pb-2 border-bottom">Perkhidmatan</h2>
                        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 ">
                            @forelse(data_get($agensi,'lamanagensiperkhidmatan') as $x => $y)
                            @if(data_get($y,'url'))
                            <a href="{{ data_get($y,'url') }}" style="color:black;">
                            @else
                            <a href="#" style="color:black;">
                            @endif

                            <div class="bg-white text-center p-3 rounded box-image-text" style="width: 18rem;">
                                <div>
                                    <h6><i class="ri-check-double-line"></i></i> {{ data_get($y,'nama') }}</h6>
                                </div>

                            </div>
                            </a>
                            @empty
                            @endforelse


                            @forelse ( $dalaman as $x => $y )
                                <?php
                                if(data_get($y,'lkpperkhidmatan.type')== 1)
                                {
                                    // bil
                                    if(Auth::check())
                                    {
                                        $link = "/login/bayaran/bil/".data_get($y,'lkpperkhidmatan.id')."/form";
                                    }
                                    else
                                    {
                                        $link = "/bayaran/bil/".data_get($y,'lkpperkhidmatan.id')."/form";
                                    }
                                }
                                elseif(data_get($y,'lkpperkhidmatan.type')== 3)
                                {
                                    // multi bil
                                    if(Auth::check())
                                    {
                                        $link = "/login/bayaran/multi/".data_get($y,'lkpperkhidmatan.id')."/form";
                                    }
                                    else
                                    {
                                        $link = "/bayaran/multi/".data_get($y,'lkpperkhidmatan.id')."/form";
                                    }
                                }
                                else
                                {
                                    //kadar bayaran
                                    if(data_get($y,'lkpperkhidmatan.type_rate')== 1)
                                    {
                                        //tiket
                                        if(Auth::check())
                                        {
                                            $link = "/login/bayaran/tiket/".data_get($y,'lkpperkhidmatan.id')."/form";
                                        }
                                        else
                                        {
                                            $link = "/bayaran/tiket/".data_get($y,'lkpperkhidmatan.id')."/form";
                                        }

                                    }
                                    elseif(data_get($y,'lkpperkhidmatan.type_rate')== 2)
                                    {
                                        //timbangan
                                        if(Auth::check())
                                        {
                                            $link = "/login/bayaran/hasil/".data_get($y,'lkpperkhidmatan.id')."/form";
                                        }
                                        else
                                        {
                                            $link = "/bayaran/hasil/".data_get($y,'lkpperkhidmatan.id')."/form";
                                        }

                                    }
                                    else
                                    {
                                        //0
                                        $link="#";
                                    }

                                }
                                ?>
                                <a href="{{ $link }}" style="color:black;">
                                    <div class="bg-white text-center p-3 rounded box-image-text" style="width: 18rem;">

                                        <div>
                                            <h6><i class="ri-check-double-line"></i></i> {{ data_get($y,'lkpperkhidmatan.name') }}</h6>
                                        </div>

                                    </div>
                                </a>
                            @empty

                            @endforelse

                            {{-- @forelse(data_get($agensi,'perkhidmatandalaman') as $a => $b) --}}
                            <?php
                            // if(data_get($b,'codehasil.type')== 1){

                            //     $link = "/bayaran/bil/".data_get($b,'codehasil.id')."/form";

                            // }else{

                            //     if(data_get($b,'codehasil.type_rate')== 1){

                            //         $link = "/bayaran/tiket/".data_get($b,'codehasil.id')."/form";
                            //     }elseif(data_get($b,'codehasil.type_rate')== 2){

                            //         $link = "/bayaran/timbang".data_get($b,'codehasil.id')."/form";
                            //     }else{

                            //     }

                            // }
                            ?>
                            {{-- <a href="{{ $link }}" style="color:black;">
                                <div class="bg-white text-center p-3 rounded box-image-text" style="width: 18rem;">

                                    <div>
                                        <h6><i class="ri-check-double-line"></i></i> {{ data_get($b,'codehasil.lkpperkhidmatan.name') }}</h6>
                                    </div>

                                </div>
                            </a> --}}
                            {{-- @empty
                            @endforelse --}}


                        </div>


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
