
<div class="form-group col-md-12">
    <label for="lastName" class="sr-only">Kategori</label>
    <select class="form-select" id="srvrate" name="srvrate" required="required">
        <option value=""> Sila Pilih</option>
        @foreach($data as $key => $value)
        <option value="{{ $value->id }}"> {{ data_get($value,'fkcategory.description') }} : RM {{ data_get($value,'rate') }} </option>
        @endforeach
    </select>

</div>

<div class="form-group col-md-12">
    <label for="firstName" class="sr-only">Bilangan </label>
    <input type="number" class="form-control" id="bil" name="bil"
    value="" required >
</div>

<input type="hidden" name="lkpperkhidmatan" value="{{ $request->id }}"/>
