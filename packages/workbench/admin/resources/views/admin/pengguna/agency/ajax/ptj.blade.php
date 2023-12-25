<div class="row mb-3" id="div-ptj">
    <label for="" class="col-sm-2 col-form-label">PTJ</label>
    <div class="col-sm-10">

        <select class="form-select" id="ptj" name="ptj" required>
                <option value=""> Sila Pilih</option>
            @foreach($ptj as $pk => $pv)
                <option value="{{$pk}}"> {{ $pv }} </option>
            @endforeach
        </select>

    </div>
</div>
