@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Tambah Pengurusan Laman Utama Agensi/Jabatan</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/admin/agensiptj/save'))->attribute('id', 'myform')->horizontal() !!}

        <div id="div-individu" style="">
            <!-- <h5 class="mb-3">Maklumat Individu</h5> -->

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Nama Agensi</label>
                <div class="col-sm-10">
                    <select class="form-select" id="fk_agency" name="fk_agency">
                            <option value=""> Sila Pilih</option>
                            @foreach($agptj as $ak => $av)
                                <option value="{{$av->id}}"> {{ $av->name }} </option>
                            @endforeach
                    </select>

                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <textarea placeholder="Keterangan" class="form-control " name="keterangan_ms" rows="5" required="required"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Logo Agensi</label>
                <div class="col-sm-10">
                    <input class="form-control form-control-sm" id="logo_agensi" name="logo_agensi" type="file" required="required">
                </div>
            </div>
            {{-- <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">

                    <figure class="figure">
                        @if( data_get($value,'logo_agensi'))
                        <img src="{{data_get($value,'logo_agensi')}}" class="img-thumbnail figure-img img-fluid rounded logo" alt="..." style="height:60px">
                        @else
                        <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-perak-epay.svg') }}" class="logo figure-img img-fluid rounded" />
                        @endif

                        <figcaption class="figure-caption">Logo Sistem</figcaption>
                    </figure>


                </div>

            </div> --}}

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">

                    <select class="form-select" id="status" name="status" required="required">
                            <option value=""> Sila Pilih</option>
                            <option value="1"> Aktif </option>
                            <option value="0"> Tidak Aktif </option>
                    </select>

                </div>
            </div>

            <a href="/admin/agensiptj/list" class="btn btn-dark">Kembali</a>
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





    });
</script>
@endpush
