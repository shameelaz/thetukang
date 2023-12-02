@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Kemaskini Pengurusan Perkhidmatan dan Kod Hasil</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/ptj/kodhasil/update'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="id" value="{{ data_get($kdh,'id') }}"/>

        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single1" id="fk_lkp_perkhidmatan" name="fk_lkp_perkhidmatan"  required="required" style="width: 100%">
                        <option value=""> Sila Pilih</option>
                        @foreach($khidmat as $hk => $hv)
                            <option value="{{$hv->id}}" <?php if($hv->id == $kdh->fk_lkp_perkhidmatan){echo "selected";}?> > {{ $hv->name }} </option>
                        @endforeach
                </select>

                </div>
            </div>

            {{-- <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kod Hasil</label>
                <div class="col-sm-10">
                    <select class="form-select" id="fk_kod_hasil" name="fk_kod_hasil"  required="required">
                            <option value=""> Sila Pilih</option>
                            @foreach($hasil as $ck => $cv)
                                <option value="{{$cv->id}}"> {{ $cv->name }} </option>
                            @endforeach
                    </select>
                </div>
            </div> --}}

            <a href="/ptj/kodhasil/list" class="btn btn-dark">Kembali</a>
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
    });

    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
        $( ".js-example-basic-single1" ).focus();

    });
</script>
@endpush
