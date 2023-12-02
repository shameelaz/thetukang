<!-- translation -->
<?php
    $locale = Session::get('locale');
    $activems = '';
    $activeen = '';

    if($locale == 'ms')
    {
        $activems = 'filter: drop-shadow(0 0 0.45rem crimson);';
    }else{
        $activeen = 'filter: drop-shadow(0 0 0.45rem crimson);';
    }

?>
<!-- translation -->

<style>
    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown>.dropdown-toggle:active {
    /*Without this, clicking will make it sticky*/
        pointer-events: none;
    }

</style>

<div class="hstack gap-3">
	{{-- <a href="/home/ms" style="{{$activems}}"><img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-ms.png') }}" class="h-24" /></a>
	<a href="/home/en" style="{{$activeen}}"><img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-en.png') }}" class="h-24" /></a> --}}
	{{-- <a href="/faq"><img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-faq.png') }}" class="h-24" /></a>
	<a href="/hubungi"><img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-hubungi.png') }}" class="h-24" /></a>
	<a href="/feedback"><img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-maklumbalas.png') }}" class="h-24" /></a>
	<a href="/petalaman"><img src="{{ asset('overide/web/themes/perakepay/assets/images/icon/icon-peta.png') }}" class="h-24" /></a>

    <div class="dropdown">
        <button class="btn btn-light" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
            <i class="ri-wheelchair-line"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" id="inc"><i class="ri-add-line"></i>&nbsp;&nbsp;&nbsp;Tambah Saiz</a></i></li>
            <li><a class="dropdown-item" id="reset"><i class="ri-refresh-line"></i>&nbsp;&nbsp;&nbsp;Tetapkan Saiz</a></i></li>
            <li><a class="dropdown-item" id="dec"><i class="ri-subtract-line"></i>&nbsp;&nbsp;&nbsp;Kurangkan Saiz</a></i></li>
        </ul>
    </div> --}}

{{-- 
    {!! form()->open()->get()->action(url('/carian/form'))->attribute('id', 'myform')->horizontal() !!}
	<div class="input-group search-icon">

		<input class="form-control rounded" type="text" name="search" placeholder="Carian">
		<span class="input-group-append">
			<button class="btn border-0" type="button">
				<i class="ri-search-line"></i>
			</button>
		</span>

	</div>
    {!! form()->close() !!} --}}
</div>
