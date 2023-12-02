<?php

use \Carbon\Carbon;
$id = auth()->user()->id;
$notisall = \Overdrive\Web\Model\NotificationTable::where('status','=',0)->where('fk_users','=',$id)
            ->where('created_at','>',Carbon::now()->subDays(5))->orderBy('created_at','DESC')->get();

?>

<style type="text/css">

     .backcolor
    {
        background-color: #EFF3F6 !important;


    }
    .lines
    {
        background-color: rgba(255,127,0,var(--tw-bg-opacity)) !important;


    }
      .borderlines
    {
        border-color: rgba(255,127,0,var(--tw-bg-opacity)) !important;


    }

    .color-red
    {

      color:red !important;
    }
    .color-white
    {

      background-color: #ffffff !important;
    }



</style>

                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                      <div class="p-4">
                          <div class="font-medium">Welcome, {{auth()->user()->name}}</div>
                          <div class="text-xs text-theme-28 mt-0.5" style="color:black">{{auth()->user()->roles->implode('name', ', ')}}</div>
                      </div>
                       
                    </div>
                    @if(env('APP_ENV_TITLE')!=null)
                    <div class="-intro-x breadcrumb mr-auto sm:flex" style="color:#F1F5F8">
                     <div class="font-medium" style="font-size: 16px">{{env('APP_ENV_TITLE')}}</div>
                       
                    </div>
                    @endif
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                     
                       
                    </div>
                    <!-- END: Breadcrumb -->
           
                    <!-- BEGIN: Notifications -->
                    <div class="intro-x dropdown mr-auto sm:mr-6">
                        <div onclick="updatenot()" class="dropdown-toggle notification cursor-pointer @if(count($notisall) > 0) animated infinite swing @endif" role="button" aria-expanded="false"> <i class="material-icons">notifications_none</i> <span id="notis">0</span></div>
                        <div class="notification-content pt-2 dropdown-menu redonot">
                            <div class="notification-content__box dropdown-menu__content box dark:bg-dark-6" >
                                <div class="notification-content__title">Notifications</div>
                                

                                @forelse($notisall as $key => $notis)

                                   <div class="box p-1 cursor-pointer relative flex items-center zoom-in" onclick="updatenotis({{$notis->id}})" style="background-color: aliceblue;margin-bottom: 5px ">
                                      <div class="w-12 h-12 flex-none image-fit mr-1">
                                          <img alt="lhdn" class="rounded-full" src="/theme/assets/images/lhdn-irb-logo.png">
                                          <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                      </div>
                                      <div class="ml-2 overflow-hidden" style="width: 100%;">
                                          <div class="flex items-center">
                                            
                                              <a href="javascript:;" class="font-medium truncate mr-5" style="font-size: 12px">Admin - Laravolt Portal</a> 
                  
                                              <div class="text-xs text-gray-500 ml-auto whitespace-nowrap" style="color: black">{{date('d-m-Y h:m:s',strtotime($notis->created_at))}}</div>
                                          </div>
                                          <div class="w-full truncate text-gray-600 mt-0.5" style="font-size: 11px">{{$notis->content}}</div>
                                      </div>
                                  </div>
                                  <hr>
                                  @empty
                                  <div class="py-1 px-2 rounded-full text-xs bg-theme-10 text-white cursor-pointer font-medium gradient-45deg-amber-amber">No New Notification</div>
                                  @endforelse
                            </div>
                        </div>
                    </div>
                   
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false">
                            <img alt="Rubick Tailwind HTML Admin Template" src="{{asset('overide/web/themes/apim/assets/images/profile-1.jpg')}}">
                        </div>
                        <div class="dropdown-menu w-56">
                            <div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white" style="background-color: #616161">
                                <div class="p-4 border-b border-theme-27 dark:border-dark-3 borderlines">
                                    <div class="font-medium">{{auth()->user()->name}}</div>
                                    
                                </div>
                                <div class="p-2">
                                    <a href="/site/profile" class="flex items-center block p-2 transition duration-300 ease-in-out"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>

                                    <div class="p-2 border-t border-theme-27 dark:border-dark-3 borderlines">
                                       @if(Auth::check())
                                          <a href="/auth/logout" class="flex items-center block p-2 transition duration-300 ease-in-out"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                       @else
                                         <a href="/auth/login" class="flex items-center block p-2 transition duration-300 ease-in-out"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Login </a>
                                       @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>


@push('script')

<script type="text/javascript">

      function updatenotis(id)
      {
            //update notis
            var ids = id;

            $.ajax({
                    url: "{{ URL::to('backend/notisread/')}}"+"/"+ids,
                    type: "get",
                    beforeSend: function () 
                    {
                       
                   
                    },
                    success: function(url)
                    {       
                       window.location.replace(url);
                    }


                });

                
          // alert('clicked');
      }
</script>

@endpush