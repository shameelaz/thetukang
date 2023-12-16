{!! form()->open()->post()->action(url('/user/rating/save'))->attribute('id', 'myform')->horizontal()->multipart() !!}

    <input type="hidden" name="id" value="{{ data_get($rate ,'id') }}"/>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label"><strong>Rating &nbsp;<span style="color: red;">*</span></strong></label>
        <div class="col-sm-10">
            <select class="form-select" id="status" name="status" required="required">
                <option value=""> Please Select</option>
                <option value="1"> *</option>
                <option value="2"> *&nbsp;*</option>
                <option value="3"> *&nbsp;*&nbsp;*</option>
                <option value="4"> *&nbsp;*&nbsp;*&nbsp;*</option>
                <option value="5"> *&nbsp;*&nbsp;*&nbsp;*&nbsp;*</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-sm-2 col-form-label"><strong>Comment &nbsp;<span style="color: red;">*</span></strong></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="desc" name="desc" value="" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
    
{!! form()->close()!!}