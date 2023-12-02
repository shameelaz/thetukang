<div class="row mb-3" id="div-ptj">
    <label for="" class="col-sm-2 col-form-label">PTJ</label>
    <div class="col-sm-10">

        <select class="form-select" id="ptj" name="ptj" required>
                <option value=""> Sila Pilih</option>
            @foreach($ptj as $pk => $pv)
                <option value="{{$pv->id}}"> {{ $pv->ptj_code }} : {{ $pv->ptj_name }} </option>
            @endforeach
        </select>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        //kod ptj dan kod prefix
        $('select[name="ptj"]').change(function() {

            // alert('WOIIII');
            var val = $(this).val();
            console.log(val);

            if (val) {
                $.ajax({

                    type: "GET",
                    url: "{{ URL::to('/admin/agency/getkod/') }}" + "/" + val,

                    beforeSend: function() {

                        // $("#div-ptj").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result) {


                        document.getElementById("loader").classList.remove("show");
                        $("#div-kod-ptj-result").html(result);

                    }
                });
            }

        });

    });
</script>
