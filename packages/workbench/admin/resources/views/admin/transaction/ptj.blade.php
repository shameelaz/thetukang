<div class="row g-3 align-items-center" id="div-ptj">
    <div class="col-4 col-lg-2">
        <label for="" class="col-form-label" style="float: right;">PTJ :</label>
    </div>
    <div class="col-4 col-lg-6">
        <select class="js-example-basic-single2" id="ptj" name="ptj" style="width: 100%">
            <option value=""> Sila Pilih</option>
            @foreach($ptj as $pk => $pv)
                <option value="{{$pv->id}}"> {{ $pv->code }} : {{ $pv->name }} </option>
            @endforeach
        </select>
    </div>
</div>


<script>

    $(document).ready(function() {

        $('select[name="ptj"]').change(function()
        {
            var val2 = $(this).val();

            if(val2)
            {
                $.ajax(
                {
                    type: "GET",
                    url: "{{ URL::to('/admin/transaction/kodhasil')}}"+"/"+val2,

                    beforeSend: function ()
                    {
                        $("#div-hasil").hide();

                        document.getElementById("loader").classList.add("show");
                    },
                    success: function(result)
                    {
                        $("#div-hasil-result").html(result);
                        document.getElementById("loader").classList.remove("show");
                    }
                });

            }
        });

        $('.js-example-basic-single2').select2();
        $( ".js-example-basic-single2" ).focus();

    });

</script>
