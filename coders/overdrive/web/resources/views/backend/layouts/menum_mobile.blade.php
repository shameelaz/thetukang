<?php

use App\Model\Users;

$users = auth()->user();

use Overdrive\Web\Model\Menus;
$menu = Menus::main()->with('activechild','activechild.activesub')->get();

if (Session::has('locale')) {
    $locale = Session::get('locale', Config::get('app.locale'));
} else {
    
    $locale = \Lang::locale();
}

?>

<style type="text/css">

    #backcolor
   {
       /*background-color: #616161;*/


   }
    .lines
   {
       background-color: rgba(255,127,0,var(--tw-bg-opacity)) !important;


   }

</style>

 <!-- BEGIN: Mobile Menu -->
       <div class="mobile-menu md:hidden" style="font-size: small;">
           <div class="mobile-menu-bar">
               <a href="" class="flex mr-auto">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" style="width: 4.5rem;" src="{{ asset('overide/web/themes/apim/assets/images/logo/materialize-logo-big.png') }}">
                    

               </a>
               <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>


           </div>
           <ul class="border-t border-theme-30 py-5 hidden">

               <!-- @if (auth()->user()->status == 1) -->

                  @foreach($menu as $key => $mainmenu )

                    @if($mainmenu->status == 1)

                        @if(count($mainmenu->activechild) > 0)

                            <!-- parent 1 -->
                            @if(auth()->user()->hasPermission(json_decode($mainmenu->permission)) || auth()->user()->hasPermission('*'))

                            <!-- firstlayer -->
                            <li>
                                <a href="javascript:;.html" class="menu menu{{ request()->is($mainmenu->route) ? '--active' : '' }}">
                                  <div class="menu__icon"> <i data-feather="layout"></i> </div>
                                  <div class="menu__title">
                                       @if($locale ==  'en') {{$mainmenu->name_en}} @else {{$mainmenu->name_bm}} @endif  
                                      <div class="menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                                  </div>
                                </a>


                                    <?php $childish = ($mainmenu->activechild->implode('route', ','));?>
                                    @foreach($mainmenu->activechild as $childkey => $child)
                                      <?php $childsub = ($child->activesub->implode('route', ',')); ?>
                                    @endforeach
                                    <?php 

                                      $childish =  explode(',', $childish);
                                      $childsub =  explode(',', $childsub);

                                      $combined = array_merge($childish, $childsub);
                                    ?>


                              @if( request()->is(($combined)))
                                <ul class="menu__sub-open backcolor">
                              @else
                                <ul class="backcolor">
                              @endif



                                @foreach($mainmenu->activechild as $childkey => $child)

                                    @if(count($child->activesub) > 0)

                                          <!-- parent 2 -->
                                          <!-- secondlayer -->
                                          @if(auth()->user()->hasPermission(json_decode($child->permission)) || auth()->user()->hasPermission('*'))
                                          <li>
                                            <a href="javascript:;.html" class="menu menu{{ request()->is($child->route) ? '--active' : '' }}">
                                              <div class="menu__icon"> <i data-feather="layout"></i> </div>
                                              <div class="menu__title">
                                                   @if($locale ==  'en') {{$child->name_en}} @else {{$child->name_bm}} @endif
                                                  <div class="menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                                              </div>
                                            </a>
                                            <?php 
                                                $subroute = ($child->activesub->implode('route', ','));

                                                $subroute =  explode(',', $subroute);
                                            ?>
                                            @if( request()->is(($subroute)))
                                            <ul class="menu__sub-open backcolor">
                                            @else
                                            <ul class="backcolor">
                                            @endif

                                              @foreach($child->activesub as $subkey => $sub)
                                                    <!-- sub -->
                                                  @if(auth()->user()->hasPermission(json_decode($sub->permission)) || auth()->user()->hasPermission('*'))

                                                      <li style="margin-left: 33px;">
                                                          <a href="/{{$sub->route}}" class="menu menu{{ request()->is($sub->route)? '--active' : '' }}">
                                                              <div class="menu__icon"> <i data-feather="list"></i> </div>
                                                              <div class="menu__title">  @if($locale ==  'en') {{$sub->name_en}} @else {{$sub->name_bm}} @endif   </div>
                                                          </a>
                                                      </li>

                                                  @endif
                                              @endforeach 

                                            </ul>
                                          </li>
                                          @endif

                                    @else


                                        <!-- child  -->

                                        @if(auth()->user()->hasPermission(json_decode($child->permission)) || auth()->user()->hasPermission('*'))
                                        <li>
                                            <a href="/{{$child->route}}" class="menu menu{{ request()->is($child->route)? '--active' : '' }}">
                                                <div class="menu__icon"> <i data-feather="list"></i> </div>
                                                <div class="menu__title">  @if($locale ==  'en') {{$child->name_en}} @else {{$child->name_bm}} @endif </div>
                                            </a>
                                        </li>
                                        @endif

                                    @endif

                                @endforeach 
                                </ul>
                            </li>
                            <div class="menu__devider my-6 lines"></div>
                            @endif

                        @else 

                            <!-- main -->
                            @if(auth()->user()->hasPermission(json_decode($mainmenu->permission)) || auth()->user()->hasPermission('*'))

                              <li>
                                  <a href="/{{$mainmenu->route}}" class="menu menu{{ request()->is($mainmenu->route) ? '--active' : '' }}">
                                      <div class="menu__icon"> <i data-feather="home"></i> </div>
                                      <div class="menu__title">
                                          @if($locale ==  'en') {{$mainmenu->name_en}} @else {{$mainmenu->name_bm}} @endif                                         
                                      </div>
                                  </a>
                                
                              </li>
                              <div class="menu__devider my-6 lines"></div>


                            @endif


                        @endif

                    @endif

                  @endforeach 
                   
               <!-- @elseif(auth()->user()->status == 2)
                   <li>
                       <a href="" class="menu menu {{ request()->is('home') ? '--active' : '' }}">
                           <div class="menu__icon"> <i data-feather="home"></i> </div>
                           <div class="menu__title">
                               You are not allowed to use the system
                           </div>
                       </a>
                   </li>
               @else
                   <li>
                       <a href="" class="menu menu {{ request()->is('home') ? '--active' : '' }}">
                           <div class="menu__icon"> <i data-feather="home"></i> </div>
                           <div class="menu__title">
                               Your Access is still inactive
                           </div>
                       </a>
                   </li>
               @endif -->
           </ul>
       </div>
       <!-- END: Mobile Menu -->
