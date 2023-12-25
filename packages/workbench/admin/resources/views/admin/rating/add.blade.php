@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Add Rating</h5>
    </div>
</div>

<div class="container my-5">

    <div class="card style-border">
        <div class="card-body p-md-4">

        {!! form()->open()->post()->action(url('/admin/rating/save'))->attribute('id', 'myform')->horizontal() !!}


        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Rate</label>
                <div class="col-sm-10">
                    <select class="form-select" id="rate" name="rate" required="required">
                        <option value=""> Please Select</option>
                        <option value="*"> * </option>
                        <option value="**"> *&nbsp;* </option>
                        <option value="***"> *&nbsp;*&nbsp;* </option>
                        <option value="****"> *&nbsp;*&nbsp;*&nbsp;* </option>
                        <option value="*****"> *&nbsp;*&nbsp;*&nbsp;*&nbsp;* </option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc" name="desc" value="" required="required">
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

            <a href="/admin/rating/list" class="btn btn-dark">Back</a>
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
