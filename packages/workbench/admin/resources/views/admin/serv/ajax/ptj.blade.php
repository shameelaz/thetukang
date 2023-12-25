<div class="row g-3 mt-2" id="div-ptj">
    <div class="col-auto ml-12" style="text-align: end;" >
        <label for="" class="col-form-label">PTJ: </label>
        <input type="text" readonly class="form-control-plaintext" id="" value="">
    </div>
    <div class="col-auto">

        <label for="" class="visually-hidden">Pilih</label>

         <select class="js-example-basic-single2" id="ptj" name="ptj" required>
                <option value="0"> Sila Pilih</option>
                @foreach($ptj as $pk => $pv)
                    <option value="{{$pv->id}}"> {{ $pv->name }} </option>
                @endforeach
        </select>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary mr-1 mb-2" type="submit" title="Carian" onclick="submitSearch()">
            <i class="ri-search-eye-line"></i>
        </button>
    </div>
</div>

<script>
$(document).ready(function() {

$('.js-example-basic-single2').select2();
});
</script>

