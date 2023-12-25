@extends('web::perakepay.frontend.layouts.base')
@section('content')
    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Maklum Balas</h5>
        </div>
    </div>

    <div class="container my-5">
        <div class="bg-info border-info border-start border-4 p-4 h6 fw-normal" style="--bs-bg-opacity: .2;">
            <p>Salurkan sebarang pertanyaan, isu atau cadangan dan kami sedia membantu anda</p>
            <footer class="blockquote-footer mb-0">PERAK <cite title="Source Title">ePAY</cite></footer>
        </div>
        <div class="card style-border p-3 p-md-4 mt-4">
            <div class="row">

                <div class="col-md-6 ">
                    <h3>Keterangan</h3>
                    {{-- <h4>Alamat</h4> --}}
                        <div class="card  mb-3" style="max-width: 50rem;">
                            <div class="card-header">Alamat</div>
                            <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text" id="address"></p>
                            </div>
                        </div>
                    {{-- <p id="address" ></p> --}}


                    {{-- <h4>E-mel</h4> --}}
                    <div class="card  mb-3" style="max-width: 50rem;">
                        <div class="card-header">Emel</div>
                        <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text" id="email"></p>
                        </div>
                    </div>

                    {{-- <p id="email"></p> --}}

                    {{-- <h4>Telefon</h4> --}}
                    <div class="card  mb-3" style="max-width: 50rem;">
                        <div class="card-header">Telefon</div>
                        <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text" id="telephone"></p>
                        </div>
                    </div>
                    {{-- <p id="telephone"></p> --}}

                </div>

                <div class="col-md-6">
                    <h3>Borang</h3>
                    {!! form()->open()->post()->action(url('/feedback/store'))->attribute('id', 'myform')->horizontal() !!}

                        <div class="form-group">
                            <select id="agency" class="form-control mb-3 " name="agency" required>
                                <option value="" selected="">-Sila Pilih Agensi-</option>
                                @foreach ($agency as $key =>$value )
                                <option value="{{ $value->id }}">{{ $value->name}}</option>
                                @endforeach


                            </select>
                        </div>
                        <div class="form-group">
                            <input placeholder="Nama Anda" type="text" name="name" class="form-control "
                                id="name" required="" value="">
                        </div>
                        <div class="form-group mt-3">
                            <input placeholder="Alamat e-mel anda" type="email" class="form-control " name="email"
                                id="email" required="" value="">
                        </div>
                        <div class="form-group mt-3">
                            <input placeholder="Subjek" type="text" class="form-control " name="subject" id="subject"
                                required="" value="">
                        </div>
                        <div class="form-group mt-3">
                            <textarea placeholder="Mesej" class="form-control " name="message" rows="5" required=""></textarea>
                        </div>
                        <br>
                        <div class="field action">
                            {!! Captcha::display( ['data-theme' => 'dark',]) !!}
                        </div>
                        @if ($errors->has('g-recaptcha-response'))
                        <div class="field action">
                            <span class="help-block">
                                <strong><font color="red">Captcha Wajib diisi</font></strong>
                            </span>
                        </div>
                        @endif
                        <br>
                        <button type="submit" class="btn btn-primary">Hantar</button>
                    {!! form()->close() !!}
                </div>
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
              url: "{{ URL::to('/feedback/getagency')}}"+"/"+val,
            //   data: "id="+val,
              beforeSend: function ()
              {

                document.getElementById("loader").classList.add("show");
                  // $(".c-hide").hide();

                //   document.getElementByClass('loading-1').style.display = "block";

              },
              success: function(result)
              {

                document.getElementById("loader").classList.remove("show");

                console.log(result);

                var data = result;
                // alert(data.add);
                $("#address").html('<p>'+data.add+'</p>');
                $("#email").html('<p>'+data.email+'</p>');
                $("#telephone").html('<p>'+data.phone_no+'</p>');

              }
            });
          }

        });



    });

    $(document).ready(function(){
        $("#myform").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit
    });
</script>
@endpush
