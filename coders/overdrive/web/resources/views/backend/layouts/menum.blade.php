<?php

use App\Model\User;

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
    #backcolor {
        background-color: #EFF3F6 !important;
        /*#616161*/
    }

    .backcolor {
        background-color: #EFF3F6 !important;
        /*#616161*/
    }

    .lines {
        background-color: rgba(255, 127, 0, var(--tw-bg-opacity)) !important;
    }

    .color-red {
        color: red !important;
    }

    .color-white {
        background-color: #ffffff !important;
    }

    .side-menu {
        color: black !important;
    }
</style>

<!-- BEGIN: Side Menu -->
<nav class="side-nav" style="font-size: small; width: 200px; !important">
    <a href="/home" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Rubick Tailwind HTML Admin Template"  src="{{ asset('overide/web/themes/apim/assets/images/logo/materialize-logo-big.png') }}">
        
    </a>
    <div class="side-nav__devider my-6 lines"></div>

    <!-- Menu start -->
    <ul>

        @if ((auth()->user()->status == 'ACTIVE') OR (auth()->user()->status == 1))
                @foreach($menu as $key => $mainmenu )

                    @if($mainmenu->status == 1)

                        @if(count($mainmenu->activechild) > 0)

                            <!-- parent 1 -->
                            @if(auth()->user()->hasPermission(json_decode($mainmenu->permission)) || auth()->user()->hasPermission('*'))

                            <!-- firstlayer -->
                            <li>
                                <a href="javascript:;.html" class="side-menu side-menu{{ request()->is($mainmenu->route) ? '--active' : '' }}">
                                  <div class="side-menu__icon"> 

                                    @if($mainmenu->icon) 
                                      <i data-feather="{{$mainmenu->icon}}"></i>
                                    @else
                                      <i data-feather="layout"></i>
                                    @endif

                                  </div>
                                  <div class="side-menu__title">
                                       @if($locale ==  'en') {{$mainmenu->name_en}} @else {{$mainmenu->name_bm}} @endif  
                                      <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
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
                                <ul class="side-menu__sub-open backcolor">
                              @else
                                <ul class="backcolor">
                              @endif



                                @foreach($mainmenu->activechild as $childkey => $child)

                                    @if(count($child->activesub) > 0)

                                          <!-- parent 2 -->
                                          <!-- secondlayer -->
                                          @if(auth()->user()->hasPermission(json_decode($child->permission)) || auth()->user()->hasPermission('*'))
                                          <li>
                                            <a href="javascript:;.html" class="side-menu side-menu{{ request()->is($child->route) ? '--active' : '' }}">
                                              <div class="side-menu__icon"> 
                                                @if($child->icon) 
                                                  <i data-feather="{{$child->icon}}"></i>
                                                @else
                                                  <i data-feather="layout"></i>
                                                @endif
                                              </div>
                                              <div class="side-menu__title">
                                                   @if($locale ==  'en') {{$child->name_en}} @else {{$child->name_bm}} @endif
                                                  <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                                              </div>
                                            </a>
                                            <?php 
                                                $subroute = ($child->activesub->implode('route', ','));

                                                $subroute =  explode(',', $subroute);
                                            ?>
                                            @if( request()->is(($subroute)))
                                            <ul class="side-menu__sub-open backcolor">
                                            @else
                                            <ul class="backcolor">
                                            @endif

                                              @foreach($child->activesub as $subkey => $sub)
                                                    <!-- sub -->
                                                  @if(auth()->user()->hasPermission(json_decode($sub->permission)) || auth()->user()->hasPermission('*'))

                                                      <li style="margin-left: 12px; margin-bottom: 20px;">
                                                          <a href="/{{$sub->route}}" class="side-menu side-menu{{ request()->is($sub->route)? '--active' : '' }}">
                                                              <div class="side-menu__icon"> 
                                                                @if($sub->icon) 
                                                                    <i data-feather="{{$sub->icon}}"></i>
                                                                  @else
                                                                    <i data-feather="layout"></i>
                                                                  @endif
                                                              </div>
                                                              <div class="side-menu__title">  @if($locale ==  'en') {{$sub->name_en}} @else {{$sub->name_bm}} @endif</div>
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
                                            <a href="/{{$child->route}}" class="side-menu side-menu{{ request()->is($child->route)? '--active' : '' }}">
                                                <div class="side-menu__icon"> 

                                                  @if($child->icon) 
                                                    <i data-feather="{{$child->icon}}"></i>
                                                  @else
                                                    <i data-feather="layout"></i>
                                                  @endif
                                                </div>
                                                <div class="side-menu__title"> @if($locale ==  'en') {{$child->name_en}} @else {{$child->name_bm}} @endif </div>
                                            </a>
                                        </li>
                                        @endif

                                    @endif

                                @endforeach 
                                </ul>
                            </li>
                            <div class="side-nav__devider my-6 lines"></div>
                            @endif

                        @else 

                            <!-- main -->
                            @if(auth()->user()->hasPermission(json_decode($mainmenu->permission)) || auth()->user()->hasPermission('*'))

                              <li>
                                  <a href="/{{$mainmenu->route}}" class="side-menu side-menu{{ request()->is($mainmenu->route) ? '--active' : '' }}">
                                      <div class="side-menu__icon"> 
                                        @if($mainmenu->icon) 
                                          <i data-feather="{{$mainmenu->icon}}"></i>
                                        @else
                                          <i data-feather="layout"></i>
                                        @endif
                                      </div>
                                      <div class="side-menu__title">
                                          @if($locale ==  'en') {{$mainmenu->name_en}} @else {{$mainmenu->name_bm}} @endif                                         
                                      </div>
                                  </a>
                                
                              </li>
                              <div class="side-nav__devider my-6 lines"></div>


                            @endif


                        @endif

                    @endif

                @endforeach 


        @elseif(auth()->user()->status == 2)
            <li>
                <a href="" class="side-menu side-menu {{ request()->is('home') ? '--active' : '' }}">
                    <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                    <div class="side-menu__title">
                        You are not allowed to use the system
                    </div>
                </a>
            </li>
        @else
            <li>
                <a href="" class="side-menu side-menu {{ request()->is('home') ? '--active' : '' }}">
                    <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                    <div class="side-menu__title">
                        Your Access is still inactive
                    </div>
                </a>
            </li>
        @endif

    </ul>
</nav>
<!-- END: Side Menu -->
