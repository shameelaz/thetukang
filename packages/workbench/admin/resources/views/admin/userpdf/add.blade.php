@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Tambah Panduan Pengguna PDF</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">

            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Perhatian!</h4>
                <p>Sila pastikan anda memenuhi kriteria ini sebelum memuat naik PDF</p>
                <hr>
                <p class="mb-0">
                    <ul>
                        <li>Sila pastikan hanya format pdf</li>
                        <li>Saiz tidak kurang dari 5MB</li>
                        {{-- <li>Beresolusi 60px x 60px untuk logo negeri</li>
                        <li>Beresolusi 144px x 40px untuk logo sistem</li> --}}
                    </ul>
                </p>
            </div>
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif


        {!! form()->open()->post()->action(url('/admin/userpdf/save'))->attribute('id', 'myform')->multipart()->horizontal() !!}


        <div id="" style="">

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single1" id="fk_agensi" name="fk_agensi" style="width: 100%" required>
                        <option value=""> Sila Pilih</option>
                        @foreach($agency as $ak => $av)
                            <option value="{{$av->id}}"> {{ $av->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div id="div-khidmat-result">

            </div>


            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Fail</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" id="fail" name="fail" type="file" required="required">
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
            </div> --}}


            <a href="/admin/userpdf/list" class="btn btn-dark">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
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
