@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Kemaskini Pengurusan Agensi/Jabatan</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/khidmat/update'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="id" value="{{ data_get($khidmat,'id')  }}">

        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{data_get($khidmat,'name')}}" required="required">

                </div>
            </div>

            <div class="row mb-3" id="div-jenis">
                <label for="" class="col-sm-2 col-form-label">Jenis</label>
                <div class="col-sm-10">

                    <select class="form-select" id="type" name="type" required="required">
                        <option value=""> Sila Pilih</option>
                        <option value="1" <?php if(data_get($khidmat,'type')==1){echo "selected" ;}?>> Bil </option>
                        <option value="2" <?php if(data_get($khidmat,'type')==2){echo "selected" ;}?>> Kadar Bayaran </option>
                        <option value="3" <?php if(data_get($khidmat,'type')==3){echo "selected" ;}?>> Pelbagai Kod Hasil </option>
                    </select>

                </div>
            </div>

            <div class="row mb-3" id="div-type-rate">
                <label for="" class="col-sm-2 col-form-label">Jenis Kadar Bayaran</label>
                <div class="col-sm-10">

                    <select class="form-select" id="type_rate" name="type_rate" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="0" <?php if(data_get($khidmat,'type_rate')==0){echo "selected" ;}?> > Tiada</option>
                            <option value="1" <?php if(data_get($khidmat,'type_rate')==1){echo "selected" ;}?> > Kadar Bayaran : Tiket </option>
                            <option value="2" <?php if(data_get($khidmat,'type_rate')==2){echo "selected" ;}?> > Kadar Bayaran : Hasil </option>
                            <option value="3" <?php if(data_get($khidmat,'type_rate')==3){echo "selected" ;}?> > Kadar Bayaran : Sebut Harga / Tender </option>
                    </select>

                </div>
            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                        <option value=""> Sila Pilih</option>
                        <option value="1" <?php if(data_get($khidmat,'status')==1){echo "selected" ;}?>> Aktif </option>
                        <option value="0" <?php if(data_get($khidmat,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                    </select>

                </div>
            </div>


            <a href="/admin/khidmat/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Kemaskini</button>
        </div>
        {!! form()->close()!!}




        </div>
    </div>

</div>

@endsection

@push('script')
<script type="text/javascript">
  $( document ).ready(function() {

        $('select[name="khidmat"]').change(function(){
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
@endpush
