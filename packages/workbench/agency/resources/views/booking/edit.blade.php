@extends('web::perakepay.frontend.layouts.base')
@section('content')

<div class="bg-light py-4">
    <div class="container">
        <h5 class="header-style m-0">Booking Information</h5>
    </div>
</div>

<div class="container my-5">

    <!-- <div class="rounded border shadow-sm border-primary"> -->
    <!-- <div class="bg-white rounded shadow-sm border-top border-2 border-primary py-4 px-5 mt-5"> -->
    <div class="card style-border">
        <div class="card-body p-md-4">

        <input type="hidden" name="id" value="{{ data_get($booking,'id') }}"/>

        <div id="div-individu" style="">
            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Type of Service</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="" name="" value="{{ data_get($booking, 'mainservice.lkpservicetype.name')}}" disabled>
                </div>
            
                <label for="" class="col-sm-2 col-form-label"><strong>Price (RM)</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="" name="" value="{{ number_format(data_get($booking,'mainservice.price'), 2, '.', '') }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Service Description</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="" name="" value="{{ data_get($booking, 'mainservice.lkpservicetype.desc')}} " disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Title</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="title" name="title" value="{{ data_get($booking, 'title')}}" disabled>
                </div>
           
                <label for="" class="col-sm-2 col-form-label"><strong>Booking Date</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="date_booking" name="date_booking" value="{{ date('d-m-Y', strtotime(data_get($booking, 'date_booking')))}}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Description</strong></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc" name="desc" value="{{ data_get($booking, 'desc')}}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-2 col-form-label"><strong>Image</strong></label>
                
                {{-- @foreach ($booking->attachmentbooking as $attachment)
                    @foreach ($attachment as $file)
                        <a href="{{URL::to($file->full_path)}}" style="width: 100%;" class="btn btn-primary btn-sm active"><i class="fi fi-rr-download" target="__blank"></i> &nbsp {{ $file->file_name }}</a>
                    @endforeach
                @endforeach --}}

                @foreach ($booking->attachmentbooking as $attachment)
                    @foreach ($attachment as $file)
                        @if (is_object($file) && property_exists($file, 'full_path'))
                            <a href="{{ URL::to($file->full_path) }}" style="width: 100%;" class="btn btn-primary btn-sm active">
                                <i class="fi fi-rr-download" target="__blank"></i> &nbsp {{ $file->file_name }}
                            </a>
                        @endif
                    @endforeach
                @endforeach

            </div>

            <br>
            <a href="/home" class="btn btn-dark">Back</a>
            {{-- <button type="submit" class="btn btn-primary">Click here for update the booking!</button> --}}
            <a onclick="modalBooking({{ data_get($booking, 'id')}})" class="btn btn-primary">
                Click here for update the booking!
            </a>
        </div>

        </div>
    </div>

    {!! form()->open()->post()->action(url('/handyman/booking/update'))->attribute('id', 'myform')->horizontal()->multipart() !!}
    <div class="modal fade " id="bookingupdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id" value="{{ data_get($booking,'id') }}"/>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label"><strong>Description &nbsp;<span style="color: red;">*</span></strong></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="desc_handyman" name="desc_handyman" value="" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label"><strong>Date &nbsp;<span style="color: red;">*</span></strong></label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="date_handyman" name="date_handyman" value="" required>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    {!! form()->close()!!}

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

    // VIEW MODAL (PELAJAR)
    function modalBooking(id)
    {

        $('#bookingupdate').modal('show');

        $.ajax(
        {
            url: "{{ URL::to('handyman/booking/modal') }}" + "/" + id,
            type: "get",

            beforeSend: function() 
            {
                document.getElementById("loader").classList.add("show");
            },
            success: function(result) 
            {
                document.getElementById("loader").classList.remove("show");

                $("#div-result").html(result);
            }
        });
    }

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
