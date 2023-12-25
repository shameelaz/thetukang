<div class="row mb-3" id="div-khidmat">
    <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
    <div class="col-sm-10">

        <select class="js-example-basic-single2" id="fk_perkhidmatan" name="fk_perkhidmatan" style="width: 100%" required>
                <option value=""> Sila Pilih</option>
            @foreach($khidmat as $kk => $kv)
                <option value="{{$kv->id}}"> {{ $kv->name }} </option>
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
