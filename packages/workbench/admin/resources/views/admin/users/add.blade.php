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

        {!! form()->open()->post()->action(url('/admin/users/save'))->attribute('id', 'myform')->horizontal() !!}

        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">No. Phone</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="mobile_no" name="mobile_no" value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <select class="form-select" id="role" name="role" required="required">
                        <option value=""> Please Select</option>
                        <option value="4"> Handyman </option>
                        <option value="7"> Customer </option>
                    </select>
                </div>
            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-select" id="status" name="status" required="required">
                        <option value=""> Please Select</option>
                        <option value="1"> Active </option>
                        <option value="0"> Not Active </option>
                    </select>
                </div>
            </div>

            <a href="/admin/users/list" class="btn btn-dark">Back</a>
            <button type="submit" class="btn btn-primary">Add</button>
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
