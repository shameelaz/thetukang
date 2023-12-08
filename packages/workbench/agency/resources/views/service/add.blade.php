@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Add Services</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">




        {!! form()->open()->post()->action(url('/handyman/service/save'))->attribute('id', 'myform')->horizontal() !!}


        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Services</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single1" id="fk_lkp_service_type" name="fk_lkp_service_type"  required="required" style="width: 100%">
                        <option value=""> Please Select</option>
                        @foreach($lkpservicetype as $key => $value)
                            <option value="{{$value->id}}"> {{ $value->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc" name="desc" value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Price (RM)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" name="price" value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label">Location</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="location" name="location" value="" required="required">
                </div>
            </div>
            

            <a href="/handyman/service/list" class="btn btn-dark">Back</a>
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
