@extends('web::backend.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title" style="font-size: 30;"><i data-feather="aperture" class="w-14 h-14 mr-2"></i> @lang('web::user-management.permission-label') &nbsp;
<!--            <a href="/admin/permissionadd" data-toggle="modal" data-target="#modeladd" class="btn btn-sm btn-warning w-32 mr-2 mb-2"><i data-feather="plus" class="w-4 h-4 mr-2"></i>ADD</a> -->

           </h5> 
           <div class="mt-10 pt-2" >
            <p class="m-0 subtitle font-weight-700" style="color:#000480"><b style="font-size: 20px">@lang('web::user-management.permission-index')</b></p>
            <p class="m-0 text-muted " style="color:purple"><b style="font-size: 20px">{{$permission->count()}} @lang('web::user-management.permission-label')</b></p>

          </div>
        </div>
      </div>
     
      
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->

<!-- Content Area Starts -->

  <div class="intro-y grid grid-cols-6 sm:gap-6 gap-y-6 box px-5 py-8 mt-5">
      <div class="col-span-12 lg:col-span-4 xxl:col-span-3">
          <div class="intro-y pr-1">
              <div class="box p-2">
                  <div class="chat__tabs nav nav-tabs justify-center" role="tablist"> 

                    <a id="all-tab" data-toggle="tab" data-target="#all" href="javascript:;" class="flex-1 py-2 rounded-md text-center active" role="tab" aria-controls="all" aria-selected="true">@lang('web::user-management.permission-list')</a> 

                  <!--   <a id="manager-tab" data-toggle="tab" data-target="#manager" href="javascript:;" class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="manager" aria-selected="false">Manager</a> 

                    <a id="provider-tab" data-toggle="tab" data-target="#provider" href="javascript:;" class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="provider" aria-selected="false">Provider</a> 

                    <a id="consumer-tab" data-toggle="tab" data-target="#consumer" href="javascript:;" class="flex-1 py-2 rounded-md text-center" role="tab" aria-controls="consumer" aria-selected="false">Consumer</a> -->

                  </div>
              </div>
          </div>
          <div class="tab-content">
              <div id="all" class="tab-pane active" role="tabpanel" aria-labelledby="all-tab">
                 <div class="grid grid-cols-12 gap-6 mt-5">
                      @foreach($permission->sortBy('type') as $key => $perm)

                         <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                             <a href="/user/editpermission/{{$perm->id}}" style="color:white !important" onclick="">
                                <div class="report-box zoom-in">
                                    <div class="box p-5 zoom-in" style="background: linear-gradient(45deg, #00CCB0, #00B89A) !important;height: 120px;font-size: 14px">
                                        <div class="text-base"><b><i data-feather="aperture" class="w-14 h-14 mr-2"></i>@lang('web::user-management.permission-title') :  {{$perm->name}}</b></div>
                                         <div>&nbsp;</div>
                                        <span>@if($perm->description) {{$perm->description}} @else @lang('web::user-management.permission-desc') @endif</span>
                                    </div>
                                </div>
                                </a>
                        </div>
                      @endforeach
                  </div>
              </div>
              <div id="manager" class="tab-pane" role="tabpanel" aria-labelledby="manager-tab">
                  <div class="grid grid-cols-12 gap-6 mt-5">
                      @foreach($permission->where('type','=',1) as $key => $perm)

                         <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                             <a href="/admin/permissionedit/{{$perm->id}}" style="color:white !important" onclick="">
                                <div class="report-box zoom-in">
                                    <div class="box p-5 zoom-in" style="background: linear-gradient(45deg, #309a9f, #75d62c) !important;height: 120px;font-size: 14px">
                                        <div class="text-base"><b><i data-feather="aperture" class="w-14 h-14 mr-2"></i>Type :  @if($perm->type == 1) Manager @elseif($perm->type == 2) Provider @elseif($perm->type == 3) Consumer @else Other(System Default) @endif</b></div>
                                         <div>&nbsp;</div>
                                        <span>{{ $perm->description ?? "No description" }}</span>
                                    </div>
                                </div>
                                </a>
                        </div>
                      @endforeach
                  </div>
              </div>
              <div id="provider" class="tab-pane" role="tabpanel" aria-labelledby="provider-tab">
                   <div class="grid grid-cols-12 gap-6 mt-5">
                      @foreach($permission->where('type','=',2) as $key => $perm)

                         <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                             <a href="/admin/permissionedit/{{$perm->id}}" style="color:white !important" onclick="">
                                <div class="report-box zoom-in">
                                    <div class="box p-5 zoom-in" style="background: linear-gradient(45deg, #309a9f, #75d62c) !important;height: 120px;font-size: 14px">
                                        <div class="text-base"><b><i data-feather="aperture" class="w-14 h-14 mr-2"></i>Type :  @if($perm->type == 1) Manager @elseif($perm->type == 2) Provider @elseif($perm->type == 3) Consumer @else Other(System Default) @endif</b></div>
                                         <div>&nbsp;</div>
                                        <span>{{ $perm->description ?? "No description" }}</span>
                                    </div>
                                </div>
                                </a>
                        </div>
                      @endforeach
                  </div>
              </div>
              <div id="consumer" class="tab-pane" role="tabpanel" aria-labelledby="consumer-tab">
                  <div class="grid grid-cols-12 gap-6 mt-5">
                      @foreach($permission->where('type','=',3) as $key => $perm)

                         <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                             <a href="/admin/permissionedit/{{$perm->id}}" style="color:white !important" onclick="">
                                <div class="report-box zoom-in">
                                    <div class="box p-5 zoom-in" style="background: linear-gradient(45deg, #309a9f, #75d62c) !important;height: 120px;font-size: 14px">
                                        <div class="text-base"><b><i data-feather="aperture" class="w-14 h-14 mr-2"></i>Type :  @if($perm->type == 1) Manager @elseif($perm->type == 2) Provider @elseif($perm->type == 3) Consumer @else Other(System Default) @endif</b></div>
                                         <div>&nbsp;</div>
                                        <span>{{ $perm->description ?? "No description" }}</span>
                                    </div>
                                </div>
                                </a>
                        </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
    </div>

  
</div>
   

@endsection