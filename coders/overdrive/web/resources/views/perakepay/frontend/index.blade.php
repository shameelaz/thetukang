@extends('web::perakepay.frontend.layouts.base')
@section('content')
<style>

.splide__arrow {
    -ms-flex-align: center;
    align-items: center;
    background: #E6C208;
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    display: -ms-flexbox;
    display: flex;
    height: 5em;
    -ms-flex-pack: center;
    justify-content: center;
    opacity: .7;
    padding: 0;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 5em;
    z-index: 1;
}

</style>

<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 pe-md-6">
                <h4 class="header-style">HOME</h4>
                {{-- <div class="row row-cols-2 row-cols-md-3 gy-4 mt-2">
                    @forelse($agensi as $x => $y)
                        <div class="col">
                            <div class="bg-white text-center p-3 rounded box-image-text">
                                <div>
                                    @if(data_get($y,'logo_agensi'))
                                    <img src="{{data_get($y,'logo_agensi')}}" class="logo figure-img img-fluid rounded" alt="..." style="">
                                    @else
                                    <img src="{{ asset('overide/web/themes/perakepay/assets/images/logo/logo-handyman.png') }}" class="logo figure-img img-fluid rounded" />
                                    @endif
                                </div>
                                <a href="/agensi/{{ $y->id }}" class="stretched-link">{{ strtoupper(data_get($y,'agensi.name'))  }}</a>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div> --}}
                <br>
                {{-- <a href="/public/agensi/list"><button type="button" class="btn btn-primary btn-sm">@lang('web::auth.show-all')</button></a> --}}
            </div>
            {{-- <div class="col-md-4">
                <h4 class="header-style">@lang('web::auth.system-user-guide')</h4>
                <div class="mt-4">
                    <?php
                        $videolink = data_get($video,'url');
                    ?>
                    <iframe id="ytplayer" type="text/html" width="400" height="360"
                    src="https://www.youtube.com/embed/{{ $videolink }}?autoplay=1&origin=http://example.com" frameborder="0">
                    </iframe>
                </div>

            </div> --}}
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#slider-utama', {
            type: 'loop',
            autoplay: true,
        }).mount();
    });

</script>

@endsection
