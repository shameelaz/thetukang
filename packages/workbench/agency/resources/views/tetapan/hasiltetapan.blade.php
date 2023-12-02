<div class="row mb-3" id="div-hasil-tetapan">
    <label for="" class="col-sm-2 col-form-label">Perkhidmatan</label>
    <div class="col-sm-10">
        <select class="js-example-basic-single3" id="fk_kod_hasil" name="fk_kod_hasil" required="required" style="width: 100%">
            <option value=""> Sila Pilih</option>
            @foreach($hasil as $ak => $av)
                <option value="{{$av->id}}"> {{ $av->lkpperkhidmatan->name }} - {{ $av->name }} </option>
            @endforeach
        </select>
    </div>
</div>

<script>

    $(document).ready(function() {

        $('.js-example-basic-single3').select2();
        $( ".js-example-basic-single3" ).focus();

    });

</script>
