@extends('laravolt::elip.layouts.base')
@section('content')
<style type="text/css">
  
    .pos-dropdown__dropdown-menu.dropdown-menu.show{
      width: 50% !important;
      /*transform: translate(651px, 1020px) !important*/
    }
</style>
<div class="section">

<link rel="stylesheet" href="{{asset('theme/assets/css/pages/page-knowledge.css')}}">
<link rel="stylesheet" href="{{asset('theme/assets/css/pages/app-email.css')}}">






 <br>
 <br>
  <div class="intro-y grid box" id="prepdata" style="">

    <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
        <div class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l  border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
            <div class="font-medium text-center lg:text-left lg:mt-3">@lang('dashboard.welcome')</div>
              <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                  <div class="truncate sm:whitespace-normal flex items-center"> 
                    <i data-feather="user" class="w-4 h-4 mr-2"></i> 
                    {{ auth()->user()->name }} 
                  </div>
                  <div class="truncate sm:whitespace-normal flex items-center mt-3"> 
                    <i data-feather="play" class="w-4 h-4 mr-2"></i> 
                    {{ auth()->user()->roles->implode('name', ', ') }}
                  </div>
                  <div class="truncate sm:whitespace-normal flex items-center mt-3"> 
                    <i data-feather="mail" class="w-4 h-4 mr-2"></i> 
                    {{ auth()->user()->email }} 
                  </div>
                  

              </div>
        </div>
        <div class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5  border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
          
        </div>
        <div class="mt-6 lg:mt-0 flex-1 px-5  lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
          
        </div>
    </div>




 </div>

 

<br>






</div>
@endsection
@push('script')
<script type="text/javascript">
    

</script>
@endpush
