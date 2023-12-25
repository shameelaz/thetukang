@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Edit Rating</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">

        {!! form()->open()->post()->action(url('/admin/rating/update'))->attribute('id', 'myform')->horizontal() !!}

        <input type="hidden" name="id" value="{{ data_get($$viewrate,'id') }}"/>

        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Rate</label>
                <div class="col-sm-10">
                    <select class="form-select" id="rate" name="rate">
                        <option value=""> Please Select</option>
                        <option value="*" <?php if(data_get($$viewrate,'rate')==1){echo "selected" ;}?>> * </option>
                        <option value="**" <?php if(data_get($$viewrate,'rate')==2){echo "selected" ;}?>> *&nbsp;* </option>
                        <option value="***" <?php if(data_get($$viewrate,'rate')==3){echo "selected" ;}?>> *&nbsp;*&nbsp;* </option>
                        <option value="****" <?php if(data_get($$viewrate,'rate')==4){echo "selected" ;}?>> *&nbsp;*&nbsp;*&nbsp;* </option>
                        <option value="*****" <?php if(data_get($$viewrate,'rate')==5){echo "selected" ;}?>> *&nbsp;*&nbsp;*&nbsp;*&nbsp;* </option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc" name="desc" value="{{ data_get($$viewrate, 'desc') }}">
                </div>
            </div>

            <div class="row mb-3" id="div-status">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-select" id="status" name="status">
                        <option value=""> Please Select</option>
                        <option value="1" <?php if(data_get($$viewrate,'status')==1){echo "selected" ;}?>> Active </option>
                        <option value="0" <?php if(data_get($$viewrate,'status')==0){echo "selected" ;}?>> Not Active </option>
                    </select>
                </div>
            </div>

            <a href="/admin/rating/list" class="btn btn-dark">Back</a>
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
