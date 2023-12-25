@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Kemaskini Pengurusan Perkhidmatan dan Kadar Bayaran</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/ptj/account/update'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="id" value="{{data_get($acc,'id')}}"/>
        <input type="hidden" name="fk_kod_hasil" value="{{ data_get($kodhasil,'id') }}"/>


        <div id="div-individu" style="">

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Kod Hasil</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name=""
                            value="{{ data_get($kodhasil, 'name')}}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Pemilik Akaun</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ data_get($acc, 'name') }}" style="text-transform: uppercase">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No Akaun</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="account_no" name="account_no"
                        value="{{ data_get($acc, 'account_no') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No Pengenalan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="identification_no" name="identification_no"
                        value="{{ data_get($acc, 'identification_no') }}" style="text-transform: uppercase">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ data_get($acc, 'address') }}" style="text-transform: uppercase">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Bandar</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ data_get($acc, 'city') }}" style="text-transform: uppercase">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Negeri</label>
                <div class="col-sm-10">
                    <select class="form-select" id="state" name="state"  required="required">
                        <option value=""> Sila Pilih</option>
                        @foreach($state as $sk => $sv)
                            <option value="{{$sv->id}}" <?php if($sv->id == $acc->state){echo "selected";}?> > {{ $sv->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="1" <?php if(data_get($acc,'status')==1){echo "selected" ;}?>> Aktif </option>
                            <option value="0" <?php if(data_get($acc,'status')==0){echo "selected" ;}?>> Tidak Aktif </option>
                    </select>

                </div>
            </div>



            <a href="/ptj/account/list/{{ data_get($acc, 'fk_kod_hasil') }}" class="btn btn-primary">Kembali</a>
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


</script>
@endpush
