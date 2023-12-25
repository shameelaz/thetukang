@extends('web::perakepay.frontend.layouts.base')
<link rel="stylesheet" href="{{ asset('overide/web/themes/perakepay/wizard/assets/css/bd-wizard.css') }}">
<style>

    .wizard .steps > ul li.current a 
    {
        background-color:#E6C208 !important;
    }
    .wizard .steps > ul li .bd-wizard-step-subtitle 
    {
        line-height: 1;
        font-size: 14px;
        color: #111111;
    }
    .content 
    {
        border: 1px 1px #000000a6;
    }
    .wizard 
    {
        padding: 30px 35px 20px 35px;
        background-color: #fff;
        /* min-height: 420px; */
        border-right: 3px solid #E6C208;
        border-bottom: 3px solid #E6C208;
        box-shadow: 6px 6px #000000a6;
    }

    .wizard .content .form-control 
    {
        /* padding: 8px 9px; */
        padding: 0.375rem 2.25rem 0.375rem 0.75rem;
        min-height: 25px;
        max-width: 100% !important;
        border-radius: 4px;
        border: solid 1px #ececec;
    }
</style>

@section('content')

    <div class="bg-light py-4">
        <div class="container">
            <h5 class="header-style">Bayaran Secara Terus</h5>
        </div>
    </div>

    <br>

    <div class="container">
        <div id="wizard" class="card wizard">

            <h3>
                <div class="media">
                    <div class="bd-wizard-step-icon"><i class="ri-search-2-line"></i></div>
                    <div class="media-body">
                        <div class="bd-wizard-step-title">Carian</div>
                        <div class="bd-wizard-step-subtitle">1</div>
                    </div>
                </div>
            </h3>
            
            <section>
                <div class="content-wrapper">
                    <h4 class="section-heading">Maklumat Tiket</h4>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="firstName" class="sr-only">Tarikh </label>
                            <input type="text" class="form-control datepicker1" id="date_start" name="date_start" value="" required readonly>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="lastName" class="sr-only">Kategori</label>
                            <select class="form-select" id="category" name="category" required="required">
                                <option value=""> Sila Pilih</option>
                                @foreach(data_get($srvratemgt,'servicerate') as $key => $value)
                                    <option value="{{ $value->id }}"> {{ data_get($value,'fkcategory.description') }} : RM {{ data_get($value,'rate') }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="firstName" class="sr-only">Bilangan </label>
                            <input type="number" class="form-control" id="bil" name="bil" value="" required >
                        </div>

                        <div class="form-group col-md-12">
                            <label for="firstName" class="sr-only">Jumlah </label>
                            <input type="number" class="form-control" id="bil" name="bil" value="" required >
                        </div>
                    </div>

                    <h4 class="section-heading">Senarai Tiket</h4>
                    <div class="row">
                      
                    </div>
                </div>
            </section>

            <h3>
                <div class="media">
                    <div class="bd-wizard-step-icon"><i class="ri-file-user-fill"></i></div>
                    <div class="media-body">
                        <div class="bd-wizard-step-title">Maklumat Pembayar</div>
                        <div class="bd-wizard-step-subtitle">2</div>
                    </div>
                </div>
            </h3>

            <section>
                <div class="content-wrapper">
                    <h4 class="section-heading">Enter your Employment details </h4>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="designation" class="sr-only">Designation</label>
                            <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="department" class="sr-only">Department</label>
                            <input type="text" name="department" id="department" class="form-control" placeholder="Department">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="employeeNumber" class="sr-only">Employee Number</label>
                            <input type="text" name="employeeNumber" id="employeeNumber" class="form-control" placeholder="Employee Number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="workEmailAddress" class="sr-only">Work Email Address</label>
                            <input type="email" name="workEmailAddress" id="workEmailAddress" class="form-control" placeholder="Work Email Address">
                        </div>
                    </div>
                </div>
            </section>

            <h3>
                <div class="media">
                    <div class="bd-wizard-step-icon"><i class="ri-secure-payment-line"></i></div>
                    <div class="media-body">
                        <div class="bd-wizard-step-title">Pilihan Pembayaran </div>
                        <div class="bd-wizard-step-subtitle">3</div>
                    </div>
                </div>
            </h3>

            <section>
                <div class="content-wrapper">
                    <h4 class="section-heading mb-5">Pilihan Pembayaran</h4>
                    <h6 class="font-weight-bold">Personal Details</h6>
                    <p class="mb-4"><span id="enteredFirstName">Cha</span> <span id="enteredLastName">Ji-Hun C</span> <br>
                        Phone: <span id="enteredPhoneNumber">+230-582-6609</span> <br>
                        Email: <span id="enteredEmailAddress">willms_abby@gmail.com</span>
                    </p>
                    <h6 class="font-weight-bold">Employment Details</h6>
                    <p class="mb-0"><span id="enteredDesignation">Junior Developer</span> - <span id="enteredDepartment">UI Development</span> <br>
                        Phone: <span id="enteredEmployeeNumber">JDUI36849</span> <br>
                        Email: <span id="enteredWorkEmailAddress">willms_abby@company.com</span>
                    </p>
                </div>
            </section>

            <h3>
                <div class="media">
                    <div class="bd-wizard-step-icon"><i class="ri-book-read-line"></i></div>
                    <div class="media-body">
                        <div class="bd-wizard-step-title">Ringkasan</div>
                        <div class="bd-wizard-step-subtitle">4</div>
                    </div>
                </div>
            </h3>

            <section>
                <div class="content-wrapper">
                    <h4 class="section-heading mb-5">Accept agreement and Submit</h4>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                            I hereby declare that I had read all the <a href="#!">terms and conditions</a>  and all the details provided my me in this form are true.
                        </label>
                    </div>
                </div>
            </section>

        </div>
    </div>

@endsection

@push('script')

<script src="{{ asset('overide/web/themes/perakepay/wizard/assets/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('overide/web/themes/perakepay/wizard/assets/js/bd-wizard.js') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() 
    {
        $('.datepicker1').datepicker(
        {
            format: 'dd-mm-yyyy',
        });
    });

    $(document).ready(function()
    {
        $("#myform").on("submit", function()
        {
            document.getElementById("loader").classList.add("show");
        });//submit
    });
</script>
@endpush