<?php $lastlogin = Auth::user()->last_login;?>
<div class="header-base">MENU</div>
<div class="border rounded shadow-sm p-4 mt-4">
    <ul class="list-base">
        <li>
            <a href="/home" class="icon-list active"><i class="ri-search-line"></i>Find Service</a>
        </li>
        <li>
            <a href="/user/booking/add" class="icon-list"><i class="ri-bank-card-line"></i>Booking</a>
        </li>
        {{-- <li>
            <a href="/user/berdaftar/list" class="icon-list"><i class="ri-folder-user-line"></i>@lang('web::auth.registered-account') </a>
        </li>
        <li>
            <a href="/user/transaction/list" class="icon-list"><i class="ri-file-copy-2-line"></i>@lang('web::auth.transaction-history')</a>
        </li>
        <li>
            <a href="/inbox" class="icon-list"><i class="ri-inbox-line"></i>@lang('web::auth.inbox') </a>
        </li>
        <li>
            <a href="/login/cart/list" class="icon-list"><i class="ri-shopping-cart-fill"></i>@lang('web::auth.trolley') </a>
        </li> --}}
    </ul>
</div>

@if(date('d-m-Y',strtotime($lastlogin)) != '01-01-1970')
    <div class="small text-muted mt-3">
        LAST LOGIN {{-- Login Terakhir --}}  : {{ date('d-m-Y H:s:i',strtotime($lastlogin))}}
    </div>
@endif
