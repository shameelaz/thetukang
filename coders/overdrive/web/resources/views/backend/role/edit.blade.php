@extends('web::backend.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">

          <h5 class="m-0 sidebar-title" style="font-size: 30;"><i data-feather="user" class="w-14 h-14 mr-2"></i> @lang('web::user-management.role-edit-header') 
           </h5>
           <br> 
           
             <a href="/user/roles" data-toggle="modal" data-target="#modeladd" class="btn btn-sm btn-warning w-32 mr-2 mb-2"><i data-feather="plus" class="w-4 h-4 mr-2"></i>@lang('web::user-management.role-edit-button-label-back')</a>
          
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
                                        @lang('web::user-management.role-edit-name') : {{$role->name}}
                                    </h2>
                                   
                                </div>
                                <div class="col s12">
                                   <div class="container">
                                      <div class="card-content p-5">
                                           <div class="grid grid-cols-12 gap-4 gap-y-5 form-inline mt-5">
                                                  <div class="intro-y col-span-12 sm:col-span-12">
                                                     {!! form()->open()->put()->action(route('backend::role.update',$role['id']))->horizontal() !!}
                                                    
                                                    <input type="hidden" name="id" value="{{data_get($role,'id')}}"/>
                                                      @if(($role->id == '1') OR ($role->id == '2') OR ($role->id == '3') OR ($role->id == '4'))
                                                      <input type="text" name="name" class="form-control" value="{{data_get($role,'name')}}" readonly="" />
                                                      @else
                                                          <input type="text" name="name"class="form-control"  value="{{ old('name', $role['name']) }}" />
                                                      @endif
                                                  
                                                  </div>

                                              <br>

                                            </div>
                                      </div>
                                  </div>
                            </div>
                            <hr>
                            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        @lang('web::user-management.role-edit-label-name')
                                    </h2>
                                   
                                </div>


                                <div class="intro-y grid grid-cols-6 sm:gap-6 gap-y-6 box px-5 py-8 mt-5">
                                  <div class="col-span-12 lg:col-span-4 xxl:col-span-3">

                                      <div class="tab-content">

                                          <div id="manager" class="tab-pane active" role="tabpanel" aria-labelledby="manager-tab">
                                              <div class="grid grid-cols-12 gap-6 mt-5">
                                                <div class="intro-y col-span-12">
                                                      <div class="preview">
                                                          <div class="form-check mt-2">
                                                                  
                                                              <input id="select-all-1" class="form-check-input" type="checkbox">
                                                              &nbsp;<span style="padding-left:10px">@lang('web::user-management.role-edit-button-label-all')</span>
                                                         </div>
                                                      </div>
                                                  </div>
                                                  <hr>
                                                  @foreach($permissions as $key => $permission)
                                                      <div class="intro-y col-span-12">
                                                          <div class="preview">
                                                              <div class="form-check mt-2">
                                                                      
                                                                  <input id="checkbox-switch-1" name="permissions[]" class="form-check-input" type="checkbox" value="{{ $permission->id }}" {{ (in_array($permission->id, $assignedPermissions))?'checked=checked':'' }} data-type="1">
                                                                  &nbsp;<span style="padding-left:10px">{{ $permission->description ?? "No description" }}</span>
                                                             </div>
                                                          </div>
                                                      </div>
                                                  @endforeach
                                              </div>
                                          </div>
             
                                      </div>
                                  </div>
                                </div>
                              <div class="col s12">
                                   <div class="container">
                                      <div class="card-content p-5">
                                           <div class="grid grid-cols-12 gap-4 gap-y-5 form-inline mt-5">
                                                  
                                                   <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                            
                                                    <button class="btn btn-primary w-24 ml-2" type="submit" name="action">@lang('web::user-management.role-edit-button-label-save')</button>
                                                </div>
                                            </div>
                                      </div>
                                  </div>  
                            </div>
                              
                      {!! form()->close() !!}
                      <hr>
                               
                            @if($role->name !== 'admin')
                                <div class="col s12" style="display: none">
                                   <div class="container">
                                      <div class="card-content p-5" style="background-color: #ef1c1c;">
                                           <div class="grid grid-cols-12 gap-4 gap-y-5 form-inline mt-5">
                                                  <div class="intro-y col-span-12 sm:col-span-12">
                                                    
                                                       <div class="intro-y box p-5 bg-theme-1 text-white mt-5" style="background-color: #d21616;">
                                                                <span class="card-title">@lang('laravolt::label.delete_role')</span>
                                                                <p>
                                                                  @lang('laravolt::message.delete_role_intro', ['count' => ''])
                                                                </p>
                                                                <br>
                                                                <br>
                                                               
                                                                    <button class="btn waves-effect waves-light red accent-2" type="submit" name="submit" value="1"
                                                                        onclick="return confirm('@lang('laravolt::message.role_deletion_confirmation')')">@lang('laravolt::action.delete')
                                                                    </button>
                                                                 {!! form()->close() !!}
                                                            </div>
                                                    </div>
                                                  <br>

                                                </div>
                                          </div>
                                      </div>
                                </div>
                        @endif
                  </div>
           </div>
      </div>
</div>
   

@endsection
   
@push('script')
<script type="text/javascript">

document.getElementById('select-all-1').onclick = function() {
    var checkboxes = document.querySelectorAll("[data-type='1']")
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
};

document.getElementById('select-all-2').onclick = function() {
    var checkboxes = document.querySelectorAll("[data-type='2']")
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
};

document.getElementById('select-all-3').onclick = function() {
    var checkboxes = document.querySelectorAll("[data-type='3']")
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
};

</script>
@endpush