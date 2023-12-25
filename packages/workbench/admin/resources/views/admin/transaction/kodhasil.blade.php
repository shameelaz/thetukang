<div class="row g-3 align-items-center" id="div-hasil">
    <div class="col-4 col-lg-2">
        <label for="" class="col-form-label" style="float: right;">Kod Hasil :</label>
    </div>
    <div class="col-4 col-lg-6">
        <select class="js-example-basic-single3" id="kodhasil" name="kodhasil" style="width: 100%">
            <option value=""> Sila Pilih</option>
            @foreach($kodhasil as $hk => $hv)
                <option value="{{$hv->id}}"> {{ $hv->name }} </option>
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
