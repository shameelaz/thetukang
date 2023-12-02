@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Pengurusan Soalan Lazim</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/faq/save'))->attribute('id', 'myform')->horizontal() !!}



        <div id="div" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->



            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single1" id="" name="" style="width: 100%" disabled>
                        <option value=""> Sila Pilih</option>
                        @foreach($agencyList as $agk => $agv)
                            <option value="{{$agv->id}}" <?php if($agv->id == data_get($request,'fkagency')){ echo "selected";}?> > {{ $agv->name }} </option>
                        @endforeach
                </select>
                    <input type="hidden" class="form-control" id="" name="fk_agency"
                        value="{{ Request::segment(4) }}" />
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single2" id="fk_perkhidmatan" name="fk_perkhidmatan" style="width: 100%" required>
                            <option value=""> Sila Pilih</option>
                            @foreach($lkpperkhidmatan as $ak => $av)
                                <option value="{{$av->id}}"> {{ $av->name }} </option>
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Soalan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="soalan_ms" name="soalan_ms"
                        value="" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Jawapan</label>
                <div class="col-sm-10">
                    <textarea placeholder="" class="form-control " name="jawapan_ms" rows="5" required=""></textarea>

                </div>
            </div>

            {{-- <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="1"> Aktif </option>
                            <option value="0"> Tidak Aktif </option>
                    </select>

                </div>
            </div>
 --}}


            <a href="/admin/faq/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
        {!! form()->close()!!}




        </div>
    </div>

</div>

@endsection

@push('script')
<script type="text/javascript">
  $( document ).ready(function() {

        $('select[name="ptj"]').change(function(){
          var val = $(this).val();
          console.log(val);

          if(val){
            $.ajax({

              type: "GET",
              url: "{{ URL::to('/admin/user/getptj')}}",
              data: "id="+val,
              beforeSend: function ()
              {

                  // $(".c-hide").hide();

                  // document.getElementById('loading-1').style.display = "block";

              },
              success: function(result)
              {

                // $("input[name=zone]").val(result['zone']['lz_description']);
                // $("input[name=fk_lkp_zone").val(result['zone']['id']);

                // var html = '<select class="js-example-programmatic w-full" name="fk_lkp_road" required>';
                //     html += '<option value="">Sila Pilih</option>';

                //   for(var i = 0; i < result['road'].length; i++){
                //     html += '<option value="'+result['road'][i]['id']+'">'+result['road'][i]['lr_description']+'</option>';
                //   }

                //     html += '</select>';

                // $("#select-road").html(html);



                // $(".c-hide").css('display', 'flex');
                // document.getElementById('loading-1').style.display = "none";
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
        $('.js-example-basic-single1').select2();
        $( '.js-example-basic-single1' ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
        $( '.js-example-basic-single2' ).focus();
    });

</script>
@endpush
