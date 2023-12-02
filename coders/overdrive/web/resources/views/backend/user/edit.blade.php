@extends('web::backend.layouts.base')

@section('content')
  <div class="tab-content mt-5">
          <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
                <div class="grid grid-cols-12 gap-6">
                            <!-- BEGIN: Latest Uploads -->
                        <div class="intro-y box col-span-12 lg:col-span-12">
                                    <div class="flex items-center px-5 py-5">
                                        <h2 class="font-medium text-base mr-auto">
                                           @lang('web::user-management.edit-name') : {{$user->name}}
                                            
                                        </h2>
                                    </div>
                            {!! form()->open()->post()->action(route('backend::user.update'))->horizontal() !!}
                            <input type="hidden" name="id" value="{{data_get($user,'id')}}"/>
                                 <div class="p-5" style="width: 100%">
                                    <div class="preview">
                                       <div class="text-gray-600 text-center mt-2 sm:py-3 border-b border-gray-200 dark:border-dark-5"><b>@lang('web::user-management.edit-title')</b></div>
                                        <div>
                                               <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                                    <div class="intro-y col-span-12 sm:col-span-12">
                                                        <label for="input-wizard-1" class="form-label"><i data-feather="user" class="w-4 h-4 mr-2"></i>@lang('web::user-management.edit-label-name')</label>
                                                        <input  type="text" class="form-control" placeholder="@lang('web::user-management.edit-label-name')" id="name" name="name" required="required" value="{{$user->name}}">

                                                    </div>
                                                     <div class="intro-y col-span-12 sm:col-span-12">
                                                        <label for="input-wizard-1" class="form-label"><i data-feather="mail" class="w-4 h-4 mr-2"></i>@lang('web::user-management.edit-label-email')</label>
                                                        <input  type="text" class="form-control" placeholder="@lang('web::user-management.edit-label-email')" id="email" name="email" required="required" value="{{$user->email}}">

                                                    </div>
                                                    <!-- <div class="intro-y col-span-12 sm:col-span-12">
                                                        <label for="input-wizard-1" class="form-label"><i data-feather="phone" class="w-4 h-4 mr-2"></i>Phone No.</label>
                                                        <input  type="text" class="form-control" placeholder="Phone No." id="phone" name="phone" required="required" value="{{data_get($user,'profile.phone_no')}}">

                                                    </div>   -->   
                                             </div>
                                        </div>
                                        <br>
   
                                         <br>

                                      <div class="mt-3"> <label>@lang('web::user-management.edit-label-status')</label>
                                         <div class="mt-2"> 
                                             <select name="status" class="form-select" id="status"  required="required">
                                             <option value="" disabled selected>@lang('web::user-management.edit-label-option')</option>
                                              <option value="1" @if($user->status == '1') selected @endif>@lang('web::user-management.edit-label-option-active')</option>
                                              <option value="0" @if($user->status == '0') selected @endif>@lang('web::user-management.edit-label-option-inactive')</option>
                                          </select>
                                           </div>
                                            <div class="input-field">
                                            </div>
                                     </div> <!-- END: Nested Select -->

                                       <div class="text-gray-600 text-center mt-2 sm:py-3 border-b border-gray-200 dark:border-dark-5"><b>@lang('web::user-management.edit-label-role')</b></div>

                                          <div class="col s12">
                                               <div class="container">
                                                  <div class="card-content p-5">
                                                       <div class="grid grid-cols-12 gap-4 gap-y-5 form-inline mt-5">
                                                              <div class="intro-y col-span-12 sm:col-span-6">
                                                                <div class="preview">
                                                        
                                                                   @foreach($acl_role as $key => $role)

                                                                     <div class="form-check mt-2">
                                                                             <input name="roles[]" type="checkbox" value="{{$role->id}}" {{ ($user->hasRole($role))?'checked=checked':'' }} />
                                                                            <label class="form-check-label" for="checkbox-switch-1">{{$role->name}}</label>
                                                                       </div>

              
                                                                @endforeach

                                                               
                                              
                                                                  </div>
                                                                </div>
                                                              
                                                        </div>
                                                  </div>
                                              </div>  
                                        </div>
                                         <div class="intro-y col-span-12 flex items-center justiqwfy-center sm:justify-end mt-5">
                                                  <a class="btn btn-primary w-24 ml-2" href="/user/index"><span>@lang('web::user-management.edit-button-label-back')</span></a>
                                                    <button class="btn btn-primary w-24 ml-2" type="submit" name="action">@lang('web::user-management.edit-button-label-save')</button>
                                          </div>
                                    </div>
                                </div>

                                  
                            <!-- {!! form()->close() !!} -->

                        </div>

                    </div>
                </div>
            </div>
  

@endsection
@push('script')

@endpush