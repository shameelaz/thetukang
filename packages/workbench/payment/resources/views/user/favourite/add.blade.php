@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">@lang('web::auth.add') @lang('web::auth.registered-account') {{-- Tambah Akaun Berdaftar --}}</h5>
    </div>
</div>

<div class="container my-5">
    <div class="card style-border">
        <div class="card-body p-md-4">

        {!! form()->open()->post()->action(url('/user/favourite/payeracc/save'))->attribute('id', 'formsubmit')->horizontal() !!}

        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">@lang('web::auth.agency') {{-- Agensi --}}</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single1" id="agency" name="agency" style="width: 100%" required>
                        <option value=""> @lang('web::auth.please-select') {{-- Sila Pilih --}}</option>
                        @foreach($listAgency as $agk => $agv)
                            <option value="{{$agv->id}}" > {{ data_get($agv,'name') }} </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <br>

            <div id="div-result">

            </div>



            <a href="/user/berdaftar/list" class="btn btn-dark">@lang('web::auth.back') {{--Kembali --}}</a>
            <button type="button" class="btn btn-primary" id="btn-cari">@lang('web::auth.search') {{-- Cari --}}</button>

            <div id="div-result2">

            </div>

        </div>
        {!! form()->close()!!}
        </div>
    </div>

</div>

@endsection

@push('script')
<script type="text/javascript">
$(document).ready(function(){

    $("#formsubmit").on("submit", function(){
        document.getElementById("loader").classList.add("show");
    });//submit
});

$( document ).ready(function() {

    $('select[name="agency"]').change(function(){

        var val = $(this).val();
        console.log(val);

        if(val){
            $.ajax({

              type: "GET",
              url: "{{ URL::to('/user/favourite/getcodehasil')}}" + "/" + val,
            //   data: "id="+val,
              beforeSend: function ()
              {
                document.getElementById("loader").classList.add("show");


              },
              success: function(result)
              {
                document.getElementById("loader").classList.remove("show");

                $("#div-result").html(result);

              }
            });
          }

    });

    $('#btn-cari').click(function(){

        var search = $("#search").val();
        var codehasil = $("#kodhasil").val();

        if( !search )
        {
            var search = 'search';
        }


        // if(refno){

        // }else{
        //     refno = 0;
        // }

        // if(refid){

        // }else{
        //     refid = 0;
        // }

        // alert(q);
        // console.log(search);
        // console.log(codehasil);




            $.ajax({

                url: "{{ URL::to('/user/favourite/getpayeracc') }}" + "/" + codehasil + "/" + search,
                    type: "get",
                    beforeSend: function() {
                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result) {
                        document.getElementById("loader").classList.remove("show");

                        $("#div-result2").html(result);

                    }


            });



        });


    // $('#btn-cari).click(function(){

    //     var id = $(this).val();
    //     console.log(is);

    //     if(id){
    //         $.ajax({

    //         type: "GET",
    //         url: "{{ URL::to('/user/favourite/getpayeracc')}}" + "/" + id,
    //         //   data: "id="+val,
    //         beforeSend: function ()
    //         {
    //             document.getElementById("loader").classList.add("show");


    //         },
    //         success: function(result)
    //         {
    //             document.getElementById("loader").classList.remove("show");

    //             $("#div-result2").html(result);

    //         }
    //         });
    //     }

    // });

    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
        $( '.js-example-basic-single1' ).focus();
    });

});
</script>
@endpush
