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




        {!! form()->open()->post()->action(url('/admin/agency/update'))->attribute('id', 'myform')->horizontal() !!}

        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{data_get($agency,'name')}}" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kod Agensi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="code" name="code"
                        value="{{data_get($agency,'code')}}" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="textarea" class="form-control" id="add" name="add"
                        value="{{data_get($agency,'add')}}" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com"
                        value="{{data_get($agency,'email')}}" required="required">

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No. Telefon</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="phone_no" name="phone_no"
                        value="{{data_get($agency,'phone_no')}}" required="required">

                </div>
            </div>


            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                        <option value=""> Sila Pilih</option>
                        <option value="1" <?php if(data_get($agency,'status')==1){echo "selected" ;}?>> Aktif </option>
                        <option value="0" <?php if(data_get($agency,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                    </select>

                </div>
            </div>

            <input type="hidden" name="id" value="{{ data_get($agency,'id')  }}">

            <a href="/admin/agency/list" class="btn btn-dark">Kembali</a>
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

        $('select[name="agency"]').change(function(){
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
