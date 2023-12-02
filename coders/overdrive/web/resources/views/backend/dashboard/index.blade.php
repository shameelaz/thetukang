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

<div class="row">
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <!-- BEGIN: Notification -->
        <div class="intro-y col-span-11 alert alert-primary alert-dismissible show flex items-center mb-6" role="alert">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="info" data-lucide="info" class="lucide lucide-info w-4 h-4 mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></span>
            <span>Before anything, please create your menu using menu managmenet here <a href="/menu/index" class="underline ml-1" target="blank">Create</a></span>
            <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <!-- BEGIN: Notification -->
        <div class="intro-y col-span-11 2xl:col-span-9">
            <div class="intro-y box col-span-12 2xl:col-span-6">
                    <div class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Announcement</h2>
                        <button data-carousel="announcement" data-target="prev" class="tiny-slider-navigator btn btn-outline-secondary px-2 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left" data-lucide="chevron-left" class="lucide lucide-chevron-left w-4 h-4"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </button>
                        <button data-carousel="announcement" data-target="next" class="tiny-slider-navigator btn btn-outline-secondary px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-right" data-lucide="chevron-right" class="lucide lucide-chevron-right w-4 h-4"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                    </div>
                    <div class="tns-outer" id="announcement-ow"><button type="button" data-action="stop"><span class="tns-visually-hidden">stop animation</span>stop</button><div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">2</span>  of 3</div><div id="announcement-mw" class="tns-ovh"><div class="tns-inner" id="announcement-iw"><div class="tiny-slider py-5  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="announcement" style="transform: translate3d(-20%, 0px, 0px); transition-duration: 0s;"><div class="px-5 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                            <div class="font-medium text-lg">Midone Admin Template</div>
                            <div class="text-slate-600 dark:text-slate-500 mt-2">Check here how to use this template </div>
                            <div class="flex items-center mt-5">
                                <div class="px-3 py-2 text-primary bg-primary/10 dark:bg-darkmode-400 dark:text-slate-300 rounded font-medium">02 June 2021</div>
                                <a class="btn btn-secondary ml-auto" href="http://rubick-laravel.left4code.com/?layout=side-menu">View Details</a>
                            </div>
                        </div>
                        
                        
                        </div></div></div></div></div>
                </div>
        </div>
       
    </div>
</div>
@endsection