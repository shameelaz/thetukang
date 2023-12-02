<div class="row mb-3" id="div-ptj-tetapan">
    <label for="" class="col-sm-2 col-form-label">PTJ</label>
    <div class="col-sm-10">
        <select class="js-example-basic-single2" id="fk_ptj" name="fk_ptj" required="required" style="width: 100%">
            <option value=""> Sila Pilih</option>
            @foreach($ptj as $pk => $pv)
                <option value="{{$pv->id}}"> {{ $pv->code }} : {{ $pv->name }} </option>
            @endforeach
        </select>
    </div>
</div>



<script>

    $(document).ready(function(){

        $('select[name="fk_ptj"]').change(function()
            {
            var val = $(this).val();

            if(val)
            {
                $.ajax(
                {
                    type: "GET",
                    url: "{{ URL::to('/ptj/tetapan/hasiltetapan')}}"+"/"+val,

                    beforeSend: function ()
                    {
                        $("#div-hasil-tetapan").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {
                        $("#render_ajax").html("");
                        $("#div-hasil-tetapan-result").html(result);
                        document.getElementById("loader").classList.remove("show");
                    }
                });

            }

        });
    });

    $(document).ready(function() {

        $('.js-example-basic-single2').select2();
        $( ".js-example-basic-single2" ).focus();

    });

</script>
