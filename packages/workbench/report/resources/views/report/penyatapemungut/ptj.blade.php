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

        $('.js-example-basic-single2').select2();
        $( ".js-example-basic-single2" ).focus();

    });

</script>
