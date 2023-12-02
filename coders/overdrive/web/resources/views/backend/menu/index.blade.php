@extends('web::backend.layouts.base')



@section('content')
<style type="text/css">
  .modal { overflow: visible !important; }
.modal-body { overflow-y: visible !important; }

.render {
  border: 1px solid #323232;
  width: 96px;
  min-height: 96px;
  padding: 8px;
  font-size: 14px;
  display: flex;
  align-items: center;
  flex-flow: wrap;
  justify-content: center;
  text-align: center;
}
</style>
<?php 

  


?>
<div class="row blocking">
    <div class="col s12 m12 l12">
        <div id="html-validations" class="card card-tabs">
            <div id="prepdata" class="col s12" style="display: block;padding:unset;">
        <div class="intro-y box px-5 pt-5 mt-5 mb-5 pb-5" style="">

          <div class="font-medium text-base mr-auto"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg> @lang('web::page.title') </div>
          <br>
          <hr>
          <div class="row">
            <div class="col s12">



              <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <a href="#" data-toggle="modal" data-target="#modeldetail" class="btn btn-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="plus" class="lucide lucide-plus w-4 h-4 mr-5" data-lucide="plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> @lang('web::page.addbutton')</a>
        
                </div>


            </div>
            <!-- modal -->
              <div id="modeldetail" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                       {!! form()->open()->post()->action(route('menum::menu.add'))!!}
                          <div class="modal-body p-10 text-left"> 
                            <div class="font-medium text-base mr-auto"> <i data-feather="bookmark"></i> @lang('web::page.addtitle')  </div>
                              <br>
                              <hr>
                                  <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                      <div class="intro-y col-span-12 sm:col-span-6">
                                          <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_ms') <sup>*</sup></label>
                                          <input id="title_ms" name="title_ms" type="text" class="form-control" required="" required oninvalid="this.setCustomValidity('Sila masukkan nama menu')" onchange="this.setCustomValidity('')">
                                      </div>
                                      <div class="intro-y col-span-12 sm:col-span-6">
                                          <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_en') <sup>*</sup></label>
                                         <input id="title_en" name="title_en" type="text" class="form-control" required="" required oninvalid="this.setCustomValidity('Sila masukkan nama menu')" onchange="this.setCustomValidity('')">
                                      </div>
                                      <div class="intro-y col-span-12 sm:col-span-6">
                                          <label for="input-wizard-6" class="form-label"> @lang('web::page.permission')<sup>*</sup></label>
                                          <select class="tom-select w-full" multiple name="permission[]">
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
                      </div>
                  </div>
              </div>
            <!-- end modal -->

          </div>
          
        </div>
        <br>
        <hr>
        <br>





        <div class="col-span-12 xl:col-span-4 mt-6">

                  <!-- global modal -->
          <div id="giconmodal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content"  id="iconmodalcontent">
                </div>
                  
              </div>
          </div>

          <div id="modeladdsub" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                  <div class="modal-content" id="modeladdsubdata">
                   </div>
              </div>
          </div>

        <!-- end global modal -->
            
            <div class="mt-5">
               <?php $totalp = count($parent); ?>
                @foreach($parent as $key => $menu)

                <div class="intro-y">
                    <div class="box px-4 py-4 mb-3 flex items-center ">
                        <div class="w-13 h-13 flex-none image-fit rounded-md overflow-hidden">
                            <a class="cursor-pointer font-medium" data-toggle="modal" data-target="#giconmodal" onclick="openIcon({{$menu->id}})">
                              @if($menu->icon) 
                                <i data-feather="{{$menu->icon}}" style="height: 40px;width: 40px;"></i>
                              @else
                                <i data-feather="layout" style="height: 40px;width: 40px;"></i>
                              @endif
                            </a>
                        </div>
                        <!-- modal -->
                          
                        <!-- end modal -->
                        <div class="mr-auto" style="margin-left:10px !important;">
                            <div class="font-medium">
                              @if($locale ==  'en') {{$menu->name_en}} @else {{$menu->name_bm}} @endif

                            </div>
                            <div class="text-gray-600 text-xs mt-0.5"> @if($menu->status == 2) <span style="color:red;font-weight: bolder;">@lang('web::page.inactive')</span> @else <span style="color:blue;font-weight: bolder;">@lang('web::page.active') @endif </span>|| ({{$menu->route}})</div>
                        </div>

                        <!-- <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2">Change Icon</div> -->

                        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end">
                        <a class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2" data-toggle="modal" data-target="#modeladdsub" onclick="addsubjs({{$menu->id}})"> @lang('web::page.addsubbutton')</a>
                        <!-- modal -->
                        <!-- end modal -->

                        <a class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2" data-toggle="modal" data-target="#modeleditp{{$menu->id}}">@lang('web::page.edit')</a>
                        <!-- modal -->
                          <div id="modeleditp{{$menu->id}}" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                   {!! form()->open()->post()->action(route('menum::menu.edit'))!!}
                                   <input  name="mid" type="hidden" class="form-control" value="{{$menu->id}}">
                                      <div class="modal-body p-10 text-left"> 
                                        <div class="font-medium text-base mr-auto"> <i data-feather="bookmark"></i> @lang('web::page.edit') @if($locale ==  'en') for {{$menu->name_en}} @else untuk {{$menu->name_bm}} @endif </div>
                                          <br>
                                          <hr>
                                              <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                                  <div class="intro-y col-span-12 sm:col-span-6">
                                                      <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_ms') <sup>*</sup></label>
                                                      <input id="title_ms" name="title_ms" type="text" class="form-control" required="" value="{{$menu->name_bm}}">
                                                  </div>
                                                  <div class="intro-y col-span-12 sm:col-span-6">
                                                      <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_en') <sup>*</sup></label>
                                                     <input id="title_en" name="title_en" type="text" class="form-control" required="" value="{{$menu->name_en}}">
                                                  </div>
                                                  
                                                  <div class="intro-y col-span-12 sm:col-span-6">
                                                      <label for="input-wizard-6" class="form-label"> @lang('web::page.permission')<sup>*</sup></label>
                                                      <select data-header="" class="tom-select w-full" multiple name="permission[]">
                                                         @foreach($permissions as $key => $pemlist)

                                                          <option value="{{data_get($pemlist,'name')}}" @if(in_array($pemlist->name,json_decode($menu->permission))) selected="" @endif>{{$pemlist->description}}</option>
                                                         @endforeach
                                         
                                                      </select>
                                                  </div>
                                                  <div class="intro-y col-span-12 sm:col-span-6">
                                                      <label for="input-wizard-1" class="form-label">@lang('web::page.url')</label>
                                                      <input id="url" name="url" type="text" class="form-control" placeholder="@lang('web::page.url_note')" value="{{$menu->route}}">
                                                  </div>
                                                  <br>

                                                  
                                                                                    
                                              </div>

                                              <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">

                                                @if(count($menu->child) > 0)
                                                <div class="alert alert-pending show flex items-center" role="alert" style="float:left  ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="alert-triangle" data-lucide="alert-triangle" class="lucide lucide-alert-triangle w-6 h-6 mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> @lang('web::page.deleteinfo')
                                                </div>
                                                @else
                                                      <a class="btn btn-outline-secondary w-24 mr-2" href="/menu/delete/{{$menu->id}}" onclick="return confirm('Adakah anda pasti?');">@lang('web::page.deletebutton')</a>
                                                @endif
                                                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-2">@lang('web::page.cancelbutton')</button>
                                                <button type="submit" class="btn btn-success w-24">@lang('web::page.savebutton')</button>
                                        
                                              </div>
                                              {!! form()->close() !!}
                                        </div>
                                  </div>
                              </div>
                          </div>
                        <!-- end modal -->


                        <a href="/menu/action/{{$menu->id}}" class="py-1 px-2 rounded-full text-xs bg-theme-8 text-grey cursor-pointer font-medium mr-2">@lang('web::page.status')</a>
                        <select class="sm:w-auto form-select box" style="width: unset !important;padding:unset !important;padding-right: 30px !important;" onchange="location = this.value;">
                            <option value="javascript:void(0)" selected>@lang('web::page.order')</option>
                            @if($totalp == 1)

                            @elseif($menu->order == 1)
                            
                                <option value="/menu/order/{{$menu->id}}/2">@lang('web::page.orderdown')</option>
                            
                            @elseif($totalp <= $menu->order)
                            
                                <option value="/menu/order/{{$menu->id}}/1">@lang('web::page.orderup')</option>

                            @elseif(($menu->order > 1) AND ($totalp >= $menu->order))

                               <option value="/menu/order/{{$menu->id}}/2">@lang('web::page.orderdown')</option>
                               <option value="/menu/order/{{$menu->id}}/1">@lang('web::page.orderup')</option>
                            @endif


                        </select>
                      </div>
                    </div>
                </div>
                      <?php $totalc = count($menu->child); ?>
                      @foreach($menu->child as $childkey => $child)
                          <div class="intro-y">
                            <div class="box px-4 py-4 mb-3 flex items-center " style="margin-left:50px">
                                <div class="w-13 h-13 flex-none image-fit rounded-md overflow-hidden">


                                    <a class="cursor-pointer font-medium" data-toggle="modal" data-target="#giconmodal" onclick="openIcon({{$child->id}})">
                                      @if($child->icon) 
                                        <i data-feather="{{$child->icon}}" style="height: 40px;width: 40px;"></i>
                                      @else
                                        <i data-feather="layout" style="height: 40px;width: 40px;"></i>
                                      @endif
                                    </a>
                                    
                                </div>
                                <div class="mr-auto" style="margin-left:10px !important;">
                                    <div class="font-medium">
                                      @if($locale ==  'en') {{$child->name_en}} @else {{$child->name_bm}} @endif

                                    </div>
                                    <div class="text-gray-600 text-xs mt-0.5"> @if($child->status == 2) <span style="color:red;font-weight: bolder;">@lang('web::page.inactive')</span> @else <span style="color:blue;font-weight: bolder;">@lang('web::page.active') @endif </span>|| ({{$child->route}})</div>
                                </div>
                                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end">
                                <!-- <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2">Change Icon</div> -->
                                <a class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2" data-toggle="modal" data-target="#modeladdsub" onclick="addsubjs({{$child->id}})">@lang('web::page.addsubbutton')</a>
                                <!-- modal -->
                                     <!-- end modal -->
                                

                                  <a class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2" data-toggle="modal" data-target="#modeleditc{{$child->id}}">@lang('web::page.edit')</a>
                                <!-- modal -->
                                  <div id="modeleditc{{$child->id}}" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true">
                                      <div class="modal-dialog modal-xl">
                                          <div class="modal-content">
                                           {!! form()->open()->post()->action(route('menum::menu.edit'))!!}
                                           <input  name="mid" type="hidden" class="form-control" value="{{$child->id}}">
                                              <div class="modal-body p-10 text-left"> 
                                                <div class="font-medium text-base mr-auto"> <i data-feather="bookmark"></i> @lang('web::page.edit') @if($locale ==  'en') for {{$child->name_en}} @else untuk {{$child->name_bm}} @endif </div>
                                                  <br>
                                                  <hr>
                                                      <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                                          <div class="intro-y col-span-12 sm:col-span-6">
                                                              <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_ms') <sup>*</sup></label>
                                                              <input id="title_ms" name="title_ms" type="text" class="form-control" required="" value="{{$child->name_bm}}">
                                                          </div>
                                                          <div class="intro-y col-span-12 sm:col-span-6">
                                                              <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_en') <sup>*</sup></label>
                                                             <input id="title_en" name="title_en" type="text" class="form-control" required="" value="{{$child->name_en}}">
                                                          </div>
                                                          <div class="intro-y col-span-12 sm:col-span-6">
                                                              <label for="input-wizard-6" class="form-label"> @lang('web::page.permission')</label>
                                                              <select data-header="" class="tom-select w-full" multiple name="permission[]">
                                                                 @foreach($permissions as $key => $pemlist)

                                                                  <option value="{{$pemlist->name}}" @if(in_array($pemlist->name,json_decode($child->permission))) selected="" @endif>{{$pemlist->description}}</option>
                                                                 @endforeach
                                                 
                                                              </select>
                                                          </div>
                                                          <div class="intro-y col-span-12 sm:col-span-6">
                                                              <label for="input-wizard-1" class="form-label">@lang('web::page.url')</label>
                                                              <input id="url" name="url" type="text" class="form-control" placeholder="@lang('web::page.url_note')" value="{{$child->route}}">
                                                          </div>
                                                          <br>

                                                          
                                                                                            
                                                      </div>
                                                      <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">

                                                      @if(count($child->submenu) > 0)
                                                      <div class="alert alert-pending show flex items-center" role="alert" style="float:left  ">
                                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="alert-triangle" data-lucide="alert-triangle" class="lucide lucide-alert-triangle w-6 h-6 mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> @lang('web::page.deleteinfo')
                                                      </div>
                                                      @else
                                                            <a class="btn btn-outline-secondary w-24 mr-2" href="/menu/delete/{{$child->id}}" onclick="return confirm('Adakah anda pasti?');">@lang('web::page.deletebutton')</a>
                                                      @endif
                                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-2">@lang('web::page.cancelbutton')</button>
                                                        <button type="submit" class="btn btn-success w-24">@lang('web::page.savebutton')</button>
                                                
                                                      </div>
                                                      {!! form()->close() !!}
                                                </div>
                                          </div>
                                      </div>
                                  </div>
                                <!-- end modal -->



                                 <a href="/menu/action/{{$child->id}}" class="py-1 px-2 rounded-full text-xs bg-theme-8 text-grey cursor-pointer font-medium mr-2">@lang('web::page.status')</a>
                                 <select class="sm:w-auto form-select box" style="width: unset !important;padding:unset !important;padding-right: 30px !important;" onchange="location = this.value;">
                                    <option value="javascript:void(0)" selected>@lang('web::page.order')</option>
                                    @if($totalc == 1)

                                    @elseif($childkey == 0)
                                    
                                        <option value="/menu/order/{{$child->id}}/2">@lang('web::page.orderdown')</option>
                                    
                                    @elseif($totalc <= $child->order)
                                    
                                        <option value="/menu/order/{{$child->id}}/1">@lang('web::page.orderup')</option>

                                     @elseif(($childkey > 1) AND ($totalc >= $child->order))


                                       <option value="/menu/order/{{$child->id}}/2">@lang('web::page.orderdown')</option>
                                       <option value="/menu/order/{{$child->id}}/1">@lang('web::page.orderup')</option>
                                    @endif


                                </select>
                              </div>
                            </div>
                        </div>
                        <?php $totals = count($child->submenu); ?>
                        @foreach($child->submenu as $subkey => $sub)
                          <div class="intro-y">
                            <div class="box px-4 py-4 mb-3 flex items-center " style="margin-left:100px">
                                <div class="w-13 h-13 flex-none image-fit rounded-md overflow-hidden">
                                    <a class="cursor-pointer font-medium" data-toggle="modal" data-target="#giconmodal" onclick="openIcon({{$sub->id}})">
                                      
                                      @if($sub->icon) 
                                        <i data-feather="{{$sub->icon}}" style="height: 40px;width: 40px;"></i>
                                      @else
                                        <i data-feather="layout" style="height: 40px;width: 40px;"></i>
                                      @endif
                                    </a> 

                                </div>
                                <div class="mr-auto" style="margin-left:10px !important;">
                                    <div class="font-medium">
                                      @if($locale ==  'en') {{$sub->name_en}} @else {{$sub->name_bm}} @endif

                                    </div>
                                    <div class="text-gray-600 text-xs mt-0.5"> @if($sub->status == 2) <span style="color:red;font-weight: bolder;">@lang('web::page.inactive')</span> @else <span style="color:blue;font-weight: bolder;">@lang('web::page.active') @endif </span>|| ({{$sub->route}})</div>
                                </div>
                                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end">
                                <!-- <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2">Change Icon</div> -->
                                <a class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2" data-toggle="modal" data-target="#modeledits{{$sub->id}}">@lang('web::page.edit')</a>
                                <!-- modal -->
                                  <div id="modeledits{{$sub->id}}" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true">
                                      <div class="modal-dialog modal-xl">
                                          <div class="modal-content">
                                           {!! form()->open()->post()->action(route('menum::menu.edit'))!!}
                                           <input  name="mid" type="hidden" class="form-control" value="{{$sub->id}}">
                                              <div class="modal-body p-10 text-left"> 
                                                <div class="font-medium text-base mr-auto"> <i data-feather="bookmark"></i> @lang('web::page.edit') @if($locale ==  'en') for {{$sub->name_en}} @else untuk {{$sub->name_bm}} @endif </div>
                                                  <br>
                                                  <hr>
                                                      <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                                          <div class="intro-y col-span-12 sm:col-span-6">
                                                              <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_ms') <sup>*</sup></label>
                                                              <input id="title_ms" name="title_ms" type="text" class="form-control" required="" value="{{$sub->name_bm}}">
                                                          </div>
                                                          <div class="intro-y col-span-12 sm:col-span-6">
                                                              <label for="input-wizard-1" class="form-label">@lang('web::page.menutitle_en') <sup>*</sup></label>
                                                             <input id="title_en" name="title_en" type="text" class="form-control" required="" value="{{$sub->name_en}}">
                                                          </div>                                                          
                                                          <div class="intro-y col-span-12 sm:col-span-6">
                                                              <label for="input-wizard-6" class="form-label"> @lang('web::page.permission')</label>
                                                              <select data-header="" class="tom-select w-full" multiple name="permission[]">
                                                                 @foreach($permissions as $key => $pemlist)

                                                                  <option value="{{$pemlist->name}}" @if(in_array($pemlist->name,json_decode($sub->permission))) selected="" @endif>{{$pemlist->description}}</option>
                                                                 @endforeach
                                                 
                                                              </select>
                                                          </div>
                                                          <div class="intro-y col-span-12 sm:col-span-6">
                                                              <label for="input-wizard-1" class="form-label">@lang('web::page.url')</label>
                                                              <input id="url" name="url" type="text" class="form-control" placeholder="@lang('web::page.url_note')" value="{{$sub->route}}">
                                                          </div>
                                                          <br>

                                                          
                                                                                            
                                                      </div>
                                                      <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                                        <a class="btn btn-outline-secondary w-24 mr-2" href="/menu/delete/{{$sub->id}}" onclick="return confirm('Adakah anda pasti?');">@lang('web::page.deletebutton')</a>
                                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-2">@lang('web::page.cancelbutton')</button>
                                                        <button type="submit" class="btn btn-success w-24">@lang('web::page.savebutton')</button>
                                                
                                                      </div>
                                                      {!! form()->close() !!}
                                                </div>
                                          </div>
                                      </div>
                                  </div>
                                <!-- end modal -->
                                 <a href="/menu/action/{{$sub->id}}" class="py-1 px-2 rounded-full text-xs bg-theme-8 text-grey cursor-pointer font-medium mr-2">@lang('web::page.status')</a>
                                 <select class="sm:w-auto form-select box" style="width: unset !important;padding:unset !important;padding-right: 30px !important;" onchange="location = this.value;">
                                    <option value="javascript:void(0)" selected>@lang('web::page.order')</option>
                                    @if($totals == 1)

                                    @elseif($subkey == 0)
                                    
                                        <option value="/menu/order/{{$sub->id}}/2">@lang('web::page.orderdown')</option>
                                    
                                    @elseif($totals <= $sub->order)
                                    
                                        <option value="/menu/order/{{$sub->id}}/1">@lang('web::page.orderup')</option>

                                    @elseif(($subkey > 0) AND ($totals >= $sub->order))

                                       <option value="/menu/order/{{$sub->id}}/2">@lang('web::page.orderdown')</option>
                                       <option value="/menu/order/{{$sub->id}}/1">@lang('web::page.orderup')</option>
                                    @endif


                                </select>
                              </div>
                            </div>
                        </div>
                      @endforeach
                      @endforeach
                <br>
                <hr>
                <br>

                @endforeach
                
                
            </div>
        </div>
  </div>      
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script type="text/javascript">
  
  function openIcon(id) {

    $.ajax({

            type: "GET", 
            url: "{{ URL::to('menu/ajax/icon')}}"+"/"+id,
                   
            beforeSend: function () 
            {
                 $('#iconmodalcontent').html('<div class="intro-y grid grid-cols-6 sm:gap-6 gap-y-6 box px-5 py-8 mt-2" id="indeterminate-linear-alamat"><div class="col-span-6 sm:col-span-3 xl:col-span-10 flex flex-col items-center"><svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8"><rect y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect><rect x="30" y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect><rect x="60" width="15" height="140" rx="6"><animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect><rect x="90" y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect><rect x="120" y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect></svg><div class="text-center text-xs mt-2">Sila Tunggu</div></div></div>');
                  
            },
            success: function(data)
            {       
                  
                  $('#iconmodalcontent').html(data);
                
            }

        });




  };  


</script>


<script type="text/javascript">
  
  function addsubjs(id) {

    // $('#giconmodal').modal('open');

     $.ajax({

            type: "GET", 
            url: "{{ URL::to('menu/ajax/addsubs')}}"+"/"+id,
                   
            beforeSend: function () 
            {
                   $('#modeladdsubdata').html('<div class="intro-y grid grid-cols-6 sm:gap-6 gap-y-6 box px-5 py-8 mt-2" id="indeterminate-linear-alamat"><div class="col-span-6 sm:col-span-3 xl:col-span-10 flex flex-col items-center"><svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8"><rect y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect><rect x="30" y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect><rect x="60" width="15" height="140" rx="6"><animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect><rect x="90" y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect><rect x="120" y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate></rect></svg><div class="text-center text-xs mt-2">Sila Tunggu</div></div></div>');

            },
            success: function(data)
            {      

              $( ".select2-single, .select2-multiple" ).select2( {
                theme: "bootstrap",
                containerCssClass: ':all:'
              } );

               $('#modeladdsubdata').html(data);
               // unblock('blocking');
                
            }

        });

    


  };  


</script>

@endpush