<!-- extends('laravolt::elip.layouts.base') -->
@extends('web::perakepay.frontend.layouts.base')
@section('content')


<div class="bg-light py-4">
  <div class="container">
      <h5 class="header-style">Pengurusan Sistem</h5>
  </div>
</div>
<div class="container">

    <div class="card style-border">
        <div class="card-header">Maklumat Aplikasi</div>
        <div class="card-body">
            <main>
                <div class="row g-5">
                    <div class="col-md-12 col-lg-12">


                        {!! form()->open()->post()->action(url('base/update'))->horizontal()->multipart() !!}


                            <div id="div-individu" style="">



                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Abbr</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="abbr"  name="abbr" oninvalid="this.setCustomValidity('Sila masukkan nama penuh')" oninput="setCustomValidity('')" value="{{ data_get($base,'abbr')}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name"  name="name" oninvalid="this.setCustomValidity('Sila masukkan nama penuh')" oninput="setCustomValidity('')" value="{{ data_get($base,'name')}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ringkasan</label>
                                    <div class="col-sm-10">

                                        <textarea class="ckeditor form-control" name="desc">{{data_get($base, 'desc')}}</textarea>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hubungi</label>
                                    <div class="col-sm-10">

                                        <textarea class="ckeditor form-control" name="contact">{{data_get($base, 'contact')}}</textarea>

                                    </div>
                                </div>





                                <div class="row mb-3">
                                    <label for="refid" class="col-sm-2 col-form-label" id="refidlabel">Footer</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="footer" name="footer" value="{{ data_get($base,'footer') }}">

                                    </div>

                                </div>









                                <button type="submit" class="btn btn-primary">Kemaskini</button>
                            </div>

                        {!! form()->close() !!}



                    </div>
                </div>
            </main>
        </div>
    </div>

</div>
<br/>
@endsection

<script src="{{ asset('overide/web/themes/perakepay/assets/ckeditor/ckeditor.js') }}"></script>
{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
<script type="text/javascript">
    $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });

    </script>
@push('script')
{{-- <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script> --}}

@endpush
