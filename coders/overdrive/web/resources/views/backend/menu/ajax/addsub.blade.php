{!! form()->open()->post()->action(route('menum::menu.addsub'))!!}
<input  name="parent" type="hidden" class="form-control" value="{{$menu->id}}">
<div class="modal-body p-10 text-left"> 
      <div class="font-medium text-base mr-auto"> <i data-feather="bookmark"></i> @lang('web::page.addsubtitle') @if($locale ==  'en') for {{$menu->name_en}} @else untuk {{$menu->name_bm}} @endif 
      </div>
  <br>
  <hr>
      <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
          <div class="intro-y col-span-12 sm:col-span-6">
              <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_ms') <sup>*</sup></label>
              <input id="title_ms" name="title_ms" type="text" class="form-control" required="">
          </div>
          <div class="intro-y col-span-12 sm:col-span-6">
              <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_en') <sup>*</sup></label>
             <input id="title_en" name="title_en" type="text" class="form-control" required="">
          </div>
          <div class="intro-y col-span-12 sm:col-span-6">
              <label for="input-wizard-6" class="form-label"> @lang('web::page.permission')</label>
              <select class="select2 w-full" multiple name="permission[]">
                 @foreach($permissions as $key => $pemlist)
                  <option value="{{$pemlist->name}}">{{$pemlist->description}}</option>
                 @endforeach
 
              </select>
          </div>
          <div class="intro-y col-span-12 sm:col-span-6">
              <label for="input-wizard-1" class="form-label">@lang('web::page.url')</label>
              <input id="url" name="url" type="text" class="form-control" placeholder="@lang('web::page.url_note')">
          </div>
          <br>

          
                                            
      </div>
      <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-2">@lang('web::page.cancelbutton')</button>
        <button type="submit" class="btn btn-success w-24">@lang('web::page.savebutton')</button>

      </div>
      {!! form()->close() !!}
</div>
