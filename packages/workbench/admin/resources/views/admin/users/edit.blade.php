@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Add Users</h5>
    </div>
</div>

<div class="container my-5">

    <div class="card style-border">
        <div class="card-body p-md-4">

        {!! form()->open()->post()->action(url('/admin/users/update'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="id" value="{{ data_get($viewurs,'id') }}"/>

        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Name</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ data_get($viewurs, 'name')  }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Email</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="{{ data_get($viewurs, 'email')  }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>No. Phone</strong></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="mobile_no" name="mobile_no" value="{{ data_get($viewurs, 'profile.mobile_no')  }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Role</strong></label>
                <div class="col-sm-10">
                    <select class="form-select" id="role_id" name="role_id">
                        <option value=""> Please Select</option>
                        <option value="4" <?php if(data_get($viewurs,'aclroleuser.0.role_id')==4){echo "selected" ;}?>> Handyman </option>
                        <option value="7" <?php if(data_get($viewurs,'aclroleuser.0.role_id')==7){echo "selected" ;}?>> Customer </option>
                    </select>
                </div>
            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label"><strong>Status</strong></label>
                <div class="col-sm-10">
                    <select class="form-select" id="status" name="status">
                        <option value=""> Please Select</option>
                        <option value="1" <?php if(data_get($viewurs,'status')==1){echo "selected" ;}?>> Active </option>
                        <option value="0" <?php if(data_get($viewurs,'status')==0){echo "selected" ;}?>> Not Active </option>
                    </select>
                </div>
            </div>

            <a href="/admin/users/list" class="btn btn-dark">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
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
