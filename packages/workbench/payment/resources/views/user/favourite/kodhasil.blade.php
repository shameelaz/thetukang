<div class="row mb-3">
    <label for="" class="col-sm-2 col-form-label">@lang('web::auth.type-bill') {{-- Jenis Bill --}}</label>
    <div class="col-sm-10">
        <select class="js-example-basic-single2"" id="kodhasil" name="kodhasil" style="width: 100%" required>
            <option value="">@lang('web::auth.please-select')  {{-- Sila Pilih --}}</option>
            @foreach($data as $x => $y)
                <option value="{{$y->id}}" > {{ data_get($y,'lkpperkhidmatan.name') }} : {{ data_get($y,'ptj.name') }} </option>
            @endforeach
        </select>

    </div>
</div>

<div class="row mb-3">
    <label for="" class="col-sm-2 col-form-label">@lang('web::auth.search-no-account') {{-- Carian No Akaun --}}</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="search" name="search" value="" required="required">
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single2').select2();
        $( '.js-example-basic-single2' ).focus();
    });
</script>
