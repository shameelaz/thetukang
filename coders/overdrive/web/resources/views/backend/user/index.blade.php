@extends('web::backend.layouts.base')

@section('content')

     <div class="tab-content mt-5">
            <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
                <div class="grid grid-cols-12 gap-6">
                            <!-- BEGIN: Latest Uploads -->
                        <div class="intro-y box col-span-12 lg:col-span-12">
                                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        @lang('web::user-management.title')
                                    </h2>
                                   <a href="/user/create" data-toggle="modal" data-target="#modeladd" class="btn btn-success btnadd"><i data-feather="plus" class="w-4 h-4 mr-2"></i>@lang('web::user-management.button-add')</a>
                                    
                                </div>
                               <div class="col s12">
                                     <div class="container">
                                          <div class="card-content p-5">
                                                 <table id="page-length-option" class="display" style="width:100%;font-size: 12px;background-color:#87b0fb">
                                                    <thead>
                                                        <tr>
                                                        <th style="text-align: left;">@lang('web::user-management.table-name')</th>
                                                        <th style="text-align: left;">@lang('web::user-management.table-email')</th>
                                                        <th style="text-align: left;">@lang('web::user-management.table-role')</th>
                                                        <th style="text-align: left;">@lang('web::user-management.table-status')</th>
                                                        <th style="text-align: left;">@lang('web::user-management.table-action')</th>
                                                      </tr>
                                                    </thead>
                                                      <tbody>
                                                      @foreach($useractive as $key =>$data)
                                                          <tr>
                                                            <td><b>{{$data->name}}</b></td>
                                                            <td>{{$data->email}}</td>
                                                            <td><b>{{$data->roles->implode('name', ', ')}}</b></td>
                                                            <td>@if($data->status == 0) PENDING / INACTIVE @else ACTIVE @endif</td>
                                                            <td><a href="/user/edit/{{$data->id}}" class="invoice-action-edit">
                                                            <i data-feather="edit-2" class="w-4 h-4 mr-2"></i>
                                                          </a></td>
                                                          </tr>
                                                          
                                                        @endforeach
                                                      
                                                    
                                                      </tbody>
                                                  </table>
                                              </div>      
                                          </div>
                                </div>
                         </div>
                    </div>
             </div>

           
       </div>


               
         
                            <!-- END: Latest Uploads -->
@endsection


@push('script')


@endpush