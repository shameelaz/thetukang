<div class="row mb-3" id="div-kodptj">
    <label for="" class="col-sm-2 col-form-label">Kod PTJ</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="ptj_code" name="ptj_code"
            value="{{ data_get($kod, 'ptj_code') }}" required="required" readonly>

    </div>
</div>

<div class="row mb-3" id="div-prefixptj">
    <label for="" class="col-sm-2 col-form-label">Kod Prefix</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="ptj_prefix" name="ptj_prefix"
            value="{{ data_get($kod, 'ptj_prefix') }}" required="required" readonly>

    </div>
</div>

<div class="row mb-3" id="div-kodswift">
    <label for="" class="col-sm-2 col-form-label">Nama Bank</label>
    <div class="col-sm-10">
        <select class="js-example-basic-single4" id="lkp_bank" name="lkp_bank" style="width: 100%;" required="required">
            <option value=""> Sila Pilih</option>
            @foreach ($lkpbank as $bk => $bv)
                <option value="{{ $bv->id }}"> {{ $bv->bank_name }} </option>
            @endforeach
        </select>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        //swiftbank
        $('select[name="lkp_bank"]').change(function() {

            // alert('WOIIII');
            var val = $(this).val();
            console.log(val);

            if (val) {
                $.ajax({

                    type: "GET",
                    url: "{{ URL::to('/admin/agency/getswift/') }}" + "/" + val,

                    beforeSend: function() {

                        // $("#div-ptj").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result) {


                        document.getElementById("loader").classList.remove("show");
                        $("#div-kod-swift-result").html(result);

                    }
                });
            }

        });

        $(document).ready(function() {
            $("#myform").on("submit", function() {
                document.getElementById("loader").classList.add("show");
            }); //submit
        });

        $(document).ready(function() {
            $('.js-example-basic-single4').select2();
            $(".js-example-basic-single4").focus();

        });

    });
</script>
