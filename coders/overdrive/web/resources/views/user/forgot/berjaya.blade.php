@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="container">
    {{-- <h1>Forgot</h1> --}}


    <br>
   <div class="card style-border">
      <div class="card-header">
        {{-- Pengesahan --}}
      </div>
      <div class="card-body">
        <main>
            <div class="row g-5">
              <div class="col-md-12 col-lg-12">


                Pengesahan berjaya. Sila log masuk menggunakan kata laluan yang telah ditetapkan
              	{{-- Berjaya Sila Login semula --}}



              </div>
            </div>
         </main>
      </div>
    </div>



</div>

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
