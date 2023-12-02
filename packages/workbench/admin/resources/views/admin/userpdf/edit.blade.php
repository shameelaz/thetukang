@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Kemaskini Panduan Pengguna PDF</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/userpdf/update'))->attribute('id', 'myform')->multipart()->horizontal()  !!}

        <input type="hidden" name="id" value="{{data_get($usrpdf,'id')}}"/>

        <div id="div" style="">

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single1" id="fk_agensi" name="fk_agensi" style="width: 100%">
                        <option value=""> Sila Pilih</option>
                        @foreach($agency as $ak => $av)
                            <option value="{{$av->id}}" <?php if($av->id == $usrpdf->fk_agensi){echo "selected";}?>> {{ $av->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3" id="div-khidmat-result">
                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single2" id="fk_perkhidmatan" name="fk_perkhidmatan" style="width: 100%">
                            <option value=""> Sila Pilih</option>
                            @foreach($khidmat as $pk => $pv)
                            <option value="{{$pv->id}}" <?php if($pv->id == $usrpdf->fk_perkhidmatan){echo "selected";}?> > {{ $pv->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Fail</label>
                <div class="col-sm-10">
                    <a href="{{ data_get($usrpdf,'fail') }}" class="btn btn-primary mr-1 mb-2" title="Muat Turun Fail">
                        <i class="ri-folder-download-fill"></i>
                    </a>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" id="fail" name="fail" type="file" title="Muat Naik Fail Baru"
                        value="" >
                </div>
            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="1" <?php if(data_get($usrpdf,'status')==1){echo "selected" ;}?>> Aktif </option>
                            <option value="0" <?php if(data_get($usrpdf,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                    </select>

                </div>
            </div>



            <a href="/admin/userpdf/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Kemaskini</button>
        </div>
        {!! form()->close()!!}




        </div>
    </div>

</div>

@endsection

@push('script')
<script type="text/javascript">

    $(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit

        $('select[name="fk_agensi"]').change(function(){
          var val = $(this).val();
          console.log(val);

          if(val){
            $.ajax({

              type: "GET",
              url: "{{ URL::to('/admin/userpdf/khidmat')}}"+"/"+val,

              beforeSend: function ()
              {
                $("#div-khidmat").hide();
                document.getElementById("loader").classList.add("show");
              },
              success: function(result)
              {
                document.getElementById("loader").classList.remove("show");
                $("#div-khidmat-result").html(result);
              }
            });
          }

        });

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
