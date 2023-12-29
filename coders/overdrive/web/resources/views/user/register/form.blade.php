@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">New Registration</h5>
    </div>
</div>

<div class="container my-5">
    <!-- <h1>Pendaftaran Pengguna Baru</h1> -->

    <div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card rounded style-border">
				<div class="p-md-4">
				  <main>
					  <div class="row g-5">
						<div class="col-md-12 col-lg-12">
						  <!-- <h4 class="mb-3">Billing address</h4> -->




								 <div class="row mb-3">
								  <label for="" class="col-sm-4 col-form-label">Registration For:</label>
								  <div class="col-sm-8">
									<select class="form-select" id="seltype" name="seltype" >
										<option selected>Please Select</option>
										<option value="1">Individual</option>
										<option value="2">Company</option>
									  </select>
								  </div>
							  </div>


							  {{-- <form class="ui form" method="POST" action="{{ url('user/register') }}" id="myform"> --}}
                            {!! form()->open()->post()->action(url('/user/register'))->attribute('id', 'myform')->horizontal() !!}

							  <hr class="my-4">
							  <div id="div-individu" style="display:none;">

								  <h5 class="mb-3">Individual Information</h5>

								  <div class="row mb-3">
									  <label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
									  <div class="col-sm-8">
										<input type="text" class="form-control" id="name"  name="name" oninput="this.value = this.value.toUpperCase()" required>
									  </div>
									</div>

									{{-- <div class="row mb-3">
									  <label for="" class="col-sm-4 col-form-label">ID Type</label>
									  <div class="col-sm-8">
										<select class="form-select" id="selrefid" name="selrefid" required>
											<option value="1" selected >IC No.</option>
											<option value="2">@lang('web::auth.no-passport')</option>
											<option value="3">@lang('web::auth.no-police')</option>
										  </select>
									  </div>
								  </div> --}}

								  <div class="row mb-3">
									  <label for="refid" class="col-sm-4 col-form-label" id="refidlabel"></label>
									  <div class="col-sm-8">
										<input type="text" class="form-control" id="refid" name="refid" oninput="this.value = this.value.toUpperCase()" required>

									  </div>

									</div>


									<div class="row mb-3">
									  <label for="email" class="col-sm-4 col-form-label">Email</label>
									  <div class="col-sm-8">
										<input type="email" class="form-control" id="email" name="email" onkeyup='validateemail(this)' required>
										<p id='resultemail'></p>
									  </div>

									</div>

									<div class="row mb-3">
									  <label for="email" class="col-sm-4 col-form-label">Phone Number </label>
									  <div class="col-sm-8">
										<input type="text" class="form-control" id="phone_no" name="phone_no" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
										<p id='resultemail'></p>
									  </div>

									</div>
									<input type="hidden" name="seltype" value="1">


									<button type="submit" class="btn btn-primary" id="btn-submit">Register Now</button>
							  </div>
                            {!! form()->close() !!}

                              {!! form()->open()->post()->action(url('/user/register/company'))->attribute('id', 'myform2')->horizontal() !!}

                                <div id="div-comp" style="display:none;">
                                    <h5 class="mb-3">Registration Company Information</h5>


                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Company Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name" oninput="this.value = this.value.toUpperCase()" required>
                                        </div>
                                        </div>

                                        <div class="row mb-3">
                                        <label for="" class="col-sm-4 col-form-label">Type of Identification</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="selrefid" name="selrefid" >
                                                <option value="4" selected >Company Registration Number</option>
                                                <!-- <option value="2">No Paspot</option>
                                                <option value="3">No Polis/ Tentera</option>	 -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="refid" class="col-sm-4 col-form-label" id="">Company Registration Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="refid" name="refid" oninput="this.value = this.value.toUpperCase()" required>

                                        </div>

                                        </div>


                                        <div class="row mb-3">
                                        <label for="email" class="col-sm-4 col-form-label">Company Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="email" name="email" onkeyup='validateemail2(this)' required>
                                            <p id='resultemail2'></p>
                                        </div>

                                        </div>

                                        <div class="row mb-3">
                                        <label for="email" class="col-sm-4 col-form-label">Company Represent Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="refname" name="refname"  oninput="this.value = this.value.toUpperCase()" required>

                                        </div>

                                        </div>

                                        <div class="row mb-3">
                                        <label for="email" class="col-sm-4 col-form-label">Company Represent Phone Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="phone_no" name="phone_no" maxlength="11" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                            <p id='resultemail'></p>
                                        </div>

                                        </div>
                                        <input type="hidden" name="seltype" value="2">
                                    <button type="submit" class="btn btn-primary" id="btn-submit">Register Now</button>
                                </div>
                            {!! form()->close() !!}



						</div>
					  </div>
				   </main>
				</div>
			  </div>
		</div>
	</div>







</div>

<!-- Modal -->
<div class="modal fade" id="terms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="terms" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="terms">[@lang('web::auth.note-notification')]</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>@lang('web::auth.note-1')</p>
            <p>@lang('web::auth.note-2')</p>
            <ul>
                <li>@lang('web::auth.note-3')</li>
                <li>@lang('web::auth.note-4')</li>
                <li>@lang('web::auth.note-5')</li>
                <li>@lang('web::auth.note-6')</li>
                <li>@lang('web::auth.note-7')</li>
                <li>@lang('web::auth.note-8')</li>
                <li>@lang('web::auth.note-9')</li>
            </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">@lang('web::auth.understand')</button>
        </div>
      </div>
    </div>
  </div>

@endsection


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

@push('script')
{{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
<script>

    $("#myform").on("submit", function(){

            document.getElementById("loader").classList.add("show");
        });//submit

    $("#myform2").on("submit", function(){
            document.getElementById("loader").classList.add("show");
        });//submit
</script>
<script type="text/javascript">

    $(document).ready(function(){

        $("#terms").modal('hide');

    });




    $(document).ready(function(){


    });



	$("select[name=seltype]").change(function () {

		var val = $(this).val();
      	console.log(val);

      	if(val ==1){
      		document.getElementById("div-individu").style.display="block";
      		document.getElementById("div-comp").style.display="none";
      	}else if(val ==2){
      		document.getElementById("div-individu").style.display="none";
      		document.getElementById("div-comp").style.display="block";
      	}else{

      	}

	});

	$("#refidlabel").html("Identification Number");

	$("select[name=selrefid]").change(function () {

		var val = $(this).val();
      	console.log(val);

      	if(val ==1){
      		// document.getElementById("div-individu").style.display="block";

      		$("#refidlabel").html("Identification Number");
      	}else if(val ==2){
      		// document.getElementById("div-individu").style.display="none";
      		$("#refidlabel").html("@lang('web::auth.no-passport')");
      	}else{
      		$("#refidlabel").html("@lang('web::auth.no-police')");
      	}

	});




	function validateemail(inputText)
    {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(inputText.value.match(mailformat))
        {
            document.querySelector("#resultemail").innerHTML="<span style='color:green;'>Email Verified</span>";
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

    function validateemail2(inputText)
    {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(inputText.value.match(mailformat))
        {
            document.querySelector("#resultemail2").innerHTML="<span style='color:green;'>Email Verified</span>";
            return true;
        }else{

            document.querySelector("#resultemail2").innerHTML="<span style='color:red;'>Emel Tidak Sah</span>";
            return false;
        }




    }




</script>




@endpush
