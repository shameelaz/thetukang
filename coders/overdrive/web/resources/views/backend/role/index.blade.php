@extends('web::backend.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">

          <h5 class="m-0 sidebar-title" style="font-size: 30;"><i data-feather="user" class="w-14 h-14 mr-2"></i> @lang('web::user-management.role-label') &nbsp;
           <a href="/user/addrole" data-toggle="modal" data-target="#modeladd" class="btn btn-sm btn-warning w-32 mr-2 mb-2"><i data-feather="plus" class="w-4 h-4 mr-2"></i>@lang('web::user-management.role-add-button-label')</a>


           </h5> 
           <div class="mt-10 pt-2" >
            <p class="m-0 subtitle font-weight-700" style="color:#000480"><b style="font-size: 20px">@lang('web::user-management.role-index')</b></p>
            <p class="m-0 text-muted " style="color:purple"><b style="font-size: 20px">{{$role->count()}} @lang('web::user-management.role-label')</b></p>

          </div>
        </div>
      </div>
     
      
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->

<!-- Content Area Starts -->

     <div class="intro-y grid grid-cols-6 sm:gap-6 gap-y-6 box px-5 py-8 mt-5">
      <div class="grid grid-cols-12 gap-6 mt-5">
          @foreach($role as $key => $roles)
             

             <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                 <a href="/user/editrole/{{$roles->id}}" style="color:white !important" onclick="">
                    <div class="report-box zoom-in">
                        <div class="box p-5 zoom-in" style="background: linear-gradient(45deg, #00CCB0, #00B89A) !important;height: 120px;font-size: 14px">
                            <div class="text-base"><b><i data-feather="user" class="w-14 h-14 mr-2"></i>{{$roles->name}}</b></div>
                             <div>&nbsp;</div>
                            <span>{{$roles->permission->count()}} <br> @lang('web::user-management.permission-label')</span>
                        </div>
                    </div>
                    </a>
            </div>
              
          @endforeach
        </div>
     
    </div>

  
</div>
   

@endsection