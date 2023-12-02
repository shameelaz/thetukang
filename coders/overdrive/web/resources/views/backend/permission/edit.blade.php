@extends('web::backend.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">

          <h5 class="m-0 sidebar-title" style="font-size: 30;"><i data-feather="aperture" class="w-14 h-14 mr-2"></i>@lang('web::user-management.permission-edit-header') 
           </h5>
           <br> 
           
             <a href="/user/permissions" class="btn btn-sm btn-warning w-32 mr-2 mb-2"><i data-feather="plus" class="w-4 h-4 mr-2"></i>@lang('web::user-management.permission-edit-button-label-back') </a>
          
        </div>
      </div>
     
      
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->

<!-- Content Area Starts -->
  <div class="tab-content mt-5">
          <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
                <div class="grid grid-cols-12 gap-6">
                            <!-- BEGIN: Latest Uploads -->
                        <div class="intro-y box col-span-12 lg:col-span-12">
                                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        @lang('web::user-management.permission-edit-name') : {{$permission->name}}
                                    </h2>
                                   
                                </div>
                                    {!! form()->open()->post()->action(route('backend::permissions.update'))->attribute('id', 'saveuser')->horizontal() !!}
                                    <input type="hidden" name="id" value="{{data_get($permission,'id')}}"/>
                                <div class="col s12">
                                   <div class="container">
                                      <div class="card-content p-5">
                                           <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">


                                                  <div class="intro-y col-span-12 sm:col-span-12">
                                                 
                                                   <div><label for="vertical-form-1" class="form-label">@lang('web::user-management.permission-edit-label-name')</label> 
                                                    <input type="text" id="name" name="name" readonly="readonly" class="form-control" value="{{$permission->name}}" required="required" placeholder="@lang('web::user-management.permission-edit-label-name')"> 
                                                    </div>
                                                    <br>
                                                     <div> <label for="vertical-form-1" class="form-label">@lang('web::user-management.permission-edit-label-desc')</label> 
                                                    <input type="text" id="description" name="description" class="form-control" value="{{$permission->description}}" required="required" placeholder="@lang('web::user-management.permission-edit-label-desc')"> 
                                                    </div>
                                                    <br>


                                                  
                                                  </div>

                                              <br>

                                            </div>
                                      </div>
                                              
                                  </div>
                            </div>
                            <hr>
                              <br>
                              <br>
                              <br>

                              <br>
                              <br>
                              
                              <br>
                              <br>
                              <div class="col s12">
                                   <div class="container">
                                      <div class="card-content p-5">
                                           <div class="grid grid-cols-12 gap-4 gap-y-5 form-inline mt-5">
                                                 
                                                   <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                            
                                                    <button class="btn btn-primary w-24 ml-2" type="submit" name="action">@lang('web::user-management.permission-edit-button-label-save')</button>
                                                </div>
                                            </div>
                                      </div>
                                  </div>  
                            </div>
                              
                      {!! form()->close() !!}
                      <hr>        
                                <div class="col s12" style="display: none">
                                   <div class="container">
                                      <div class="card-content p-5" style="background-color: #ef1c1c;">
                                           <div class="grid grid-cols-12 gap-4 gap-y-5 form-inline mt-5">
                                                  <div class="intro-y col-span-12 sm:col-span-12">
                                                    
                                                       <div class="intro-y box p-5 bg-theme-1 text-white mt-5" style="background-color: #d21616;">
                                                                <span class="card-title"> @lang('web::user-management.permission-edit-title-label-delete')</span>
                                                                <p>
                                                                  @lang('web::user-management.permission-edit-info-label-delete')
                                                                </p>
                                                                <br>
                                                                <br>
                                                                    {!! form()->open()->get()->action(route('backend::permission.delete', $permission['id']))->horizontal() !!}
                                 
                                                                  <button class="btn waves-effect waves-light red accent-2" type="submit" name="submit" value="1"
                                                                      onclick="return confirm('Are you sure want to delete this permission')">@lang('web::user-management.permission-edit-button-label-delete')
                                                                  </button>
                                                            {!! form()->close() !!}
                                                            </div>
                                                    </div>
                                                  <br>

                                                </div>
                                          </div>
                                      </div>
                                </div>
                          </div>
                    </div>
            </div>
      </div>
   

@endsection
   
@push('script')
@endpush