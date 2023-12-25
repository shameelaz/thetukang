<?php $lastlogin = Auth::user()->last_login;?>
<div class="header-base">MENU</div>
<div class="border rounded shadow-sm p-4 mt-4">
    <ul class="list-base">
        <li>
            <a href="/user/service/index" class="icon-list active"><i class="ri-search-line"></i>Find Service</a>
        </li>
        <li>
            <a href="/user/booking/list" class="icon-list"><i class="ri-bank-card-line"></i>Booking</a>
        </li>
        
    </ul>
</div>

@if(date('d-m-Y',strtotime($lastlogin)) != '01-01-1970')
    <div class="small text-muted mt-3">
        LAST LOGIN : {{ date('d-m-Y H:s:i',strtotime($lastlogin))}}
    </div>
@endif
