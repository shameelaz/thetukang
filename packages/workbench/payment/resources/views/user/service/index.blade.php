@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Find Services</h5>
    </div>
</div>

<div class="container my-5">

    <div class="card style-border">
        <div class="card-body p-md-4">

        <div id="div-individu" style="">
            <div class="row mb-3">
                <div class="col-sm-3">
                    {{-- <input type="text" class="form-control border-b" id="desc" name="desc" value=""> --}}
                </div>
                <div class="col-sm-6">
                    <select class="js-example-basic-single1" id="servicetype" name="servicetype"  required="required" style="width: 100%">
                        <option value=""> Find Services</option>
                        @foreach($lkpservicetype as $key => $value)
                            <option value="{{$value->id}}"> {{ $value->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    {{-- <input type="text" class="form-control border-b" id="desc" name="desc" value=""> --}}
                </div>
            </div>

            <div class="text-center">
                {{-- <a href="/handyman/promotion/list" class="btn btn-primary">Find Services</a> --}}
                <button class="btn btn-primary" onclick="search()" id="searchbutton">
                    <i class="ri-search-line"></i> Search
                </button>
            </div>
            <br>
            <br>
            <div id="loader"></div>
        </div>

        </div>
    </div>

</div>

@endsection

@push('script')
<script type="text/javascript">

    $(document).ready(function() {
        $('.js-example-basic-single1').select2();
        $( ".js-example-basic-single1" ).focus();

    });

    function search() {

        var servicetype = $('#servicetype').val();

        $.ajax({
            url: "{{ URL::to('user/service/search/') }}?servicetype=" + servicetype,
            type: "get",

            beforeSend: function() {
                document.getElementById('loader').innerHTML =
                    '<tr><td colspan="4"><div class="align-items-center text-center"><strong>Loading...</strong><div class="spinner-border s-auto" role="status" aria-hidden="true"></div></div></td></tr>';
            },
            success: function(datas) {
                    document.getElementById('loader').innerHTML = datas;
            }
        });
    }
</script>
@endpush
