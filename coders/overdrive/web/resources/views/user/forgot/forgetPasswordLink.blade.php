@extends('web::perakepay.frontend.layouts.base')
@section('content')


<div class="bg-light py-4">
  <div class="container">
      <h5 class="header-style">SAHKAN KATA LALUAN</h5>
  </div>
</div>

<div class="container">
    <h1></h1>



   <div class="card style-border">
      <div class="card-header">
        Pengesahan kata laluan
      </div>
      <div class="card-body">
        <main>
            <div class="row g-5">
              <div class="col-md-12 col-lg-12">


                    <form class="ui form" method="POST" action="{{ url('reset-password') }}" id="myform">

                        <input type="hidden" name="token" value="{{data_get($token,'token')}}"/>
                        <input type="hidden" name="user_id" value="{{data_get($token,'user_id')}}"/>

                    <hr class="my-4">
                    <div id="div-individu" style="">


                        <div class="row mb-3">
                            <label for="refid" class="col-sm-2 col-form-label" id="refidlabel">Emel</label>
                            <div class="col-sm-10">
                              <input type="email" name="email" placeholder="Emel" value="{{data_get($token,'email')}}" class="form-control" readonly>

                            </div>

                        </div>


                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Katalaluan</label>
                            <div class="col-sm-10">
                              <input type="password" id="password" name="password" placeholder="Katalaluan baru" class="form-control" required onkeyup='check();'>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style="margin: -40px 350px"></span>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Sekali lagi</label>
                            <div class="col-sm-10">
                              <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Pengesahan Kata Laluan" required onkeyup='check();'>
                                <span toggle="#repassword-field" class="fa fa-fw fa-eye field-icon toggle-repassword" style="margin: -40px 350px"></span>
                                <br/>
                                <span id='message'></span>
                            </div>

                        </div>







                        <button type="submit" class="btn btn-primary">Kemaskini</button>
                    </div>

                    </form>




              </div>
            </div>
         </main>
      </div>
    </div>



</div>
<br>
@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".toggle-password").click(function() {

          $(this).toggleClass("fa-eye fa-eye-slash");
          // alert('hi');
          var type = $("#password").attr('type');

          switch (type) {
                case 'password':
                {
                    $("#password").attr('type', 'text');
                    return;
                }
                case 'text':
                {
                    $("#password").attr('type', 'password');
                    return;
                }
            }

        });

        $(".toggle-repassword").click(function() {

          $(this).toggleClass("fa-eye fa-eye-slash");

          var type1 = $("#password_confirmation").attr('type');
          switch (type1) {
                case 'password':
                {
                    $("#password_confirmation").attr('type', 'text');
                    return;
                }
                case 'text':
                {
                    $("#password_confirmation").attr('type', 'password');
                    return;
                }
            }

        });
    });

</script>
<script>

    // document.getElementById("btn-reset").style.display = "none";

    var check = function() {
    if (document.getElementById('password').value == document.getElementById('password_confirmation').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Kata Laluan sama dengan Pengesahan Kata Laluan';

        document.getElementById("btn-reset").style.display = "block";
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Pengesahan Kata Laluan Tidak Sama';
        document.getElementById("btn-reset").style.display = "none";
    }
    }
</script>
@if ($message = Session::get('success'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'success'
    })
</script>
@endif

@if ($message = Session::get('error'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'error'
    })
</script>
@endif

@if ($message = Session::get('warning'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'warning'
    })
</script>
@endif

@if ($message = Session::get('info'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'info'
    })
</script>
@endif
