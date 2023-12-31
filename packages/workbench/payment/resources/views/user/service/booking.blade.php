@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Booking</h5>
    </div>
</div>

<div class="container my-5">

    <div class="card style-border">
        <div class="card-body p-md-4">

        {!! form()->open()->post()->action(url('/user/service/booking/save'))->attribute('id', 'myform')->horizontal()->multipart() !!}

        @php
            $discountPercentage = data_get($booking, 'promotion.0.percent', 0) / 100; // Assuming the percentage is stored as an integer
            $discountprice = data_get($booking, 'price') * (1 - $discountPercentage);

            $promotionPresent = data_get($booking, 'promotion.0.percent') !== null;
            $promotionStartDate = date('d-m-Y', strtotime(data_get($booking, 'promotion.0.start_date')));
            $promotionEndDate = date('d-m-Y', strtotime(data_get($booking, 'promotion.0.end_date')));
            $now = \Carbon\Carbon::now(); // Store the current date without the timestamp
            $formattedNow = $now->format('d-m-Y');
        @endphp
        
        <input type="hidden" name="id" value="{{ data_get($booking, 'id') }}">
        <input type="hidden" name="pid" value="{{ data_get($booking, 'promotion.0.id') }}">
        <input type="hidden" name="start_date" value="{{ date('d-m-Y', strtotime(data_get($booking, 'promotion.0.start_date'))) }}">
        <input type="hidden" name="end_date" value="{{ date('d-m-Y', strtotime(data_get($booking, 'promotion.0.end_date'))) }}">
        <input type="hidden" name="discountprice" value="{{ $discountprice }}">
        <input type="hidden" name="percent" value="{{ data_get($booking, 'promotion.0.percent', 0) }}">

        <div id="div-individu" style="">
            
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Company Name</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="" name="" value="{{ data_get($booking, 'user.name')}}" disabled>
                </div>

                <label for="" class="col-sm-2 col-form-label"><strong>Phone Number</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="" name="" value="{{ data_get($booking, 'user.profile.mobile_no')}}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Type of Service</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="" name="" value="{{ data_get($booking, 'lkpservicetype.name')}}" disabled>
                </div>
            
                <label for="" class="col-sm-2 col-form-label"><strong>Price (RM)</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="" name="" value="{{ number_format(data_get($booking,'price'), 2, '.', ',') }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Description</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name="" value="{{ data_get($booking, 'lkpservicetype.desc')}}" disabled>
                </div>
            </div>

            {{-- Promotion --}}
            @if ($promotionPresent && $promotionStartDate <= $formattedNow && $formattedNow <= $promotionEndDate)

                <!-- Display promotion details -->
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label"><strong>Promotion Details</strong></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="" name="" value="{{ data_get($booking, 'promotion.0.title')}} - {{ data_get($booking, 'promotion.0.desc')}}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label"><strong>Start Date Promotion</strong></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="" name="start_date" value="{{ date('d-m-Y', strtotime(data_get($booking, 'promotion.0.start_date'))) }}" disabled>
                    </div>
                
                    <label for="" class="col-sm-2 col-form-label"><strong>End Date Promotion</strong></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="" name="end_date" value="{{ date('d-m-Y', strtotime(data_get($booking, 'promotion.0.end_date'))) }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label"><strong>Discount (%)</strong></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="" name="" value="{{ data_get($booking, 'promotion.0.percent') }}" disabled>
                    </div>
                
                    <label for="" class="col-sm-2 col-form-label"><strong>After Discount Price (RM)</strong></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="discountprice" name="discountprice" value="{{ number_format(($discountprice), 2, '.', '') }}" disabled>
                    </div>
                </div>
            @endif

            <hr>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Title &nbsp;<span style="color: red;">*</span></strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Description &nbsp;<span style="color: red;">*</span></strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc" name="desc" value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Start Date &nbsp;<span style="color: red;">*</span></strong></label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="date_booking" name="date_booking" value="" required="required">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Image &nbsp;<span style="color: red;">*</span></strong></label>
                <div class="col-sm-10">
                    <button type="button" class="btn btn-secondary btn-small btn-sm active" id="add-file-btn" style="float:left">Add Image</button>
                    <br><br>
                    <div id="file-container"></div>
                </div>
            </div>

            <br>
            <a href="/handyman/promotion/list" class="btn btn-dark">Back</a>
            <button type="submit" class="btn btn-primary">Booking Now!</button>
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

        $('.js-example-basic-single1').select2();
        $( ".js-example-basic-single1" ).focus();

        let counter = 0;

        // Add event listener to the "Add File" button
        const addFileBtn = document.getElementById('add-file-btn');
        addFileBtn.addEventListener('click', function() {
            createFileField(counter++);
        });
    });

    // Function to create file upload field and file name input
    function createFileField(counter) {

        // Create a new file upload field
        const fileField = document.createElement('input');
        fileField.setAttribute('type', 'file');
        fileField.setAttribute('name', 'files[]');
        fileField.setAttribute('class', 'form-control col');
        fileField.setAttribute('required', '');

        // Create a new file name input
        const fileNameInput = document.createElement('input');
        fileNameInput.setAttribute('type', 'text');
        fileNameInput.setAttribute('name', 'file_names[]');
        fileNameInput.setAttribute('placeholder', 'File Name');
        fileNameInput.setAttribute('class', 'form-control col');
        fileNameInput.setAttribute('required', '');

        // Create a delete button
        const deleteBtn = document.createElement('button');
        deleteBtn.setAttribute('type', 'button');
        deleteBtn.setAttribute('class', 'form-control col btn btn-danger btn-small btn-sm active');
        deleteBtn.textContent = 'Delete';

        // Create a container to hold the file upload field and file name input
        const container = document.createElement('div');
        container.setAttribute('class', 'row');
        container.setAttribute('style', 'padding-bottom:15px');


        container.setAttribute('id', 'file-' + counter);
        container.appendChild(fileNameInput);
        container.appendChild(fileField);
        container.appendChild(deleteBtn);


        // Append the container to the file container
        const fileContainer = document.getElementById('file-container');
        fileContainer.appendChild(container);

        // Add event listener to the delete button
        deleteBtn.addEventListener('click', function() {
            container.remove();
        });
    }
</script>
@endpush
