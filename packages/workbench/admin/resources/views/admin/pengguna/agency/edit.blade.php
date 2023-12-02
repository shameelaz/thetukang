@extends('web::perakepay.frontend.layouts.base')
@section('content')

<style>
    .select2 {
        display: initial !important;
    }
</style>

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Tambah Pengguna Agensi / PTJ</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/user/agency/update'))->attribute('id', 'myform')->horizontal() !!}
        <input type="hidden" name="id" value="{{data_get($user,'id')}}">
        <div id="div-individu" style="">

            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Agensi</label>
                <div class="col-sm-10">

                    <select class="js-example-basic-single" id="agency" name="agency">
                            <option value=""> Sila Pilih</option>
                        @foreach($agency as $ak => $av)
                            <option value="{{$ak}}" <?php if(data_get($user,'profile.fk_agency') == $ak){echo "selected";}?> > {{ $av }} </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="row mb-3" id="div-ptj">
                <label for="" class="col-sm-2 col-form-label">PTJ</label>
                <div class="col-sm-10">

                    <select class="js-example-basic-single2" id="ptj" name="ptj">
                            <option value=""> Sila Pilih</option>
                        @foreach($ptj as $pk => $pv)
                            <option value="{{$pk}}" <?php if(data_get($user,'profile.fk_ptj') == $pk){echo "selected";}?>> {{ $pv }} </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div id="div-ptj-result">

            </div>


            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        oninvalid="this.setCustomValidity('Sila masukkan nama penuh')"
                        oninput="setCustomValidity('')" value="{{data_get($user,'name')}}">
                </div>
            </div>

            <div class="row mb-3" id="">
                <label for="" class="col-sm-2 col-form-label">Jawatan</label>
                <div class="col-sm-10">

                    <select class="js-example-basic-single3" id="position" name="position">
                            <option value=""> Sila Pilih</option>
                            @foreach($position as $pk => $pv)
                                <option value="{{$pk}}" <?php if(data_get($user,'profile.fk_position') == $pk){echo "selected";}?>> {{ $pv }} </option>
                            @endforeach
                    </select>

                </div>
            </div>

            <!-- <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Jenis Pengenalan</label>
                <div class="col-sm-10">
                    <select class="form-select" id="selrefid" name="selrefid" disabled>
                        <option value="1"  >No
                            Kad Pengenalan
                        </option>
                        <option value="2" >No
                            Paspot</option>
                        <option value="3" >No
                            Polis/ Tentera
                        </option>

                    </select>
                </div>
            </div> -->

            <!-- <div class="row mb-3">
                <label for="refid" class="col-sm-2 col-form-label" id="refidlabel"></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="refid" name="refid"
                        value="">

                </div>

            </div> -->


            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Emel</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" onkeyup='validateemail(this)'
                        value="{{data_get($user,'email')}}" readonly>
                    <p id='resultemail'></p>
                </div>

            </div>


            <div class="row mb-3" id="">
                <label for="" class="col-sm-2 col-form-label">Peranan</label>
                <div class="col-sm-10">

                    <select class="form-select" id="role" name="role">
                            <option value=""> Sila Pilih</option>
                        @foreach($roles as $rk => $rv)
                            <option value="{{$rk}}" <?php if(data_get($user,'role.0.name.id') == $rk){echo "selected";}?> > {{ $rv }} </option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="row mb-3" id="">
                 <div class="col-sm-10 offset-sm-2">
                  <div class="form-check">
                    @if(data_get($user,'profile.flag_ptj') == 1)
                    <input class="form-check-input" type="checkbox" value="1" name="adminptj" id="adminptj" checked>
                    @else
                    <input class="form-check-input" type="checkbox" value="1" name="adminptj" id="adminptj">
                    @endif
                    <label class="form-check-label" for="adminptj">
                      Admin PTJ
                    </label>
                  </div>
                </div>
            </div>

            <?php $end = date('d-m-Y', strtotime('+3 years')); ?>
            {{-- <div class="row mb-3">
                <label for="refid" class="col-sm-2 col-form-label" id="refidlabel">Tarikh Luput</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control datepicker" id="expired_date" name="expired_date"
                        value="{{date('d-m-Y',strtotime($user->expired_date))}}" readonly>

                </div>

            </div> --}}

            <div class="row mb-3" id="">
                <label for="" class="col-sm-2 col-form-label">Peranan iSpeks</label>
                <div class="col-sm-10">

                    <select class="form-select" id="ispek" name="ispek">
                            <option value=""> Sila Pilih</option>
                            <option value="1" <?php if(data_get($user,'profile.ispek_role') == 1){echo "selected";}?> > Penyedia </option>
                            <option value="2" <?php if(data_get($user,'profile.ispek_role') == 2){echo "selected";}?> > Penyemak </option>
                            <option value="3" <?php if(data_get($user,'profile.ispek_role') == 3){echo "selected";}?> > Pelulus </option>
                    </select>

                </div>
            </div>

            <div class="row mb-3" id="">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status">
                            <option value=""> Sila Pilih</option>
                            <option value="1" <?php if(data_get($user,'status') == 1){echo "selected";}?> > Aktif </option>
                            <option value="0" <?php if(data_get($user,'status') == 0){echo "selected";}?> > Tidak Aktif </option>

                    </select>

                </div>
            </div>

            <!-- <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">No Tel. Bimbit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone_no" name="phone_no" maxlength="11"
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                        value="">
                    <p id='resultphone'></p>
                </div>

            </div> -->
            <input type="hidden" name="seltype" value="1">
            <input type="hidden" name="userlevel" value="1">





            <a href="/admin/user/agency" class="btn btn-dark">Kembali</a>
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
              url: "{{ URL::to('/admin/user/getptj')}}"+"/"+val,
              // data: "id="+val,
              beforeSend: function ()
              {

                  $("#div-ptj").hide();

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

                $("#div-ptj-result").html(result);



                // $(".c-hide").css('display', 'flex');
                // document.getElementById('loading-1').style.display = "none";
              }
            });
          }

        });



    });


  function validateemail(inputText)
    {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(inputText.value.match(mailformat))
        {
            document.querySelector("#resultemail").innerHTML="<span style='color:green;'>Emel Sah</span>";
            return true;
        }else{

            document.querySelector("#resultemail").innerHTML="<span style='color:red;'>Emel Tidak Sah</span>";
            return false;
        }

        // var phoneNumRegex = /^\+?([0-9]{3})\)?[ -]?([0-9]{3})[ -]?([0-9]{4})$/;
        // if(phoneNum.value.match(phoneNumRegex)) {
        // document.querySelector("#result").innerHTML="<span style='color:green;'>Sah</span>";
        // $("#btn-submit").show();
        // }
        // else {
        // document.querySelector("#result").innerHTML="<span style='color:red;'>Tidak Sah</span>";
        // $("#btn-submit").hide();
        // }


    }



    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',

    });




</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit
    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $( '.js-example-basic-single' ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
        $( '.js-example-basic-single2' ).focus();
    });

    $(document).ready(function() {
        $('.js-example-basic-single3').select2();
        $( '.js-example-basic-single3' ).focus();
    });
</script>
@endpush
