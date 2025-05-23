<div class="row no-gutters position-relative rtl">
        <div class="col-12 col-xl-12 __top-slider-images">
        <div class="{{Session::get('direction') === "rtl" ? 'pr-xl-2' : 'pl-xl-2'}}">
            <div class="owl-theme owl-carousel hero-slider">
                @foreach($main_banner as $key=>$banner)
                <a href="{{$banner['url']}}" class="d-block">
                    <img class="w-100 __slide-img"
                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                        src="{{asset('storage/app/public/banner')}}/{{$banner['photo']}}"
                        alt="">
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

