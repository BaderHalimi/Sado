@extends('layouts.front-end.app')

@section('title', $web_config['name']->value . ' ' . translate('online_Shopping') . ' | ' . $web_config['name']->value .
    ' ' . translate('ecommerce'))

    @push('css_or_js')
        <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
        <meta property="og:title" content="Welcome To {{ $web_config['name']->value }} Home" />
        <meta property="og:url" content="{{ env('APP_URL') }}">
        <meta property="og:description"
            content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

        <meta property="twitter:card" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
        <meta property="twitter:title" content="Welcome To {{ $web_config['name']->value }} Home" />
        <meta property="twitter:url" content="{{ env('APP_URL') }}">
        <meta property="twitter:description"
            content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

        <link rel="stylesheet" href="{{ asset('public/assets/front-end') }}/css/home.css" />
        <style>
            .cz-countdown-days {
                border: .5px solid{{ $web_config['primary_color'] }};
            }

            .btn-scroll-top {
                background: {{ $web_config['primary_color'] }};
            }

            .__best-selling:hover .ptr,
            .flash_deal_product:hover .flash-product-title {
                color: {{ $web_config['primary_color'] }};
            }

            .cz-countdown-hours {
                border: .5px solid{{ $web_config['primary_color'] }};
            }

            .cz-countdown-minutes {
                border: .5px solid{{ $web_config['primary_color'] }};
            }

            .cz-countdown-seconds {
                border: .5px solid{{ $web_config['primary_color'] }};
            }

            .flash_deal_product_details .flash-product-price {
                color: {{ $web_config['primary_color'] }};
            }

            .featured_deal_left {
                background: {{ $web_config['primary_color'] }} 0% 0% no-repeat padding-box;
            }

            .category_div:hover {
                color: {{ $web_config['secondary_color'] }};
            }

            .deal_of_the_day {
                background: {{ $web_config['secondary_color'] }};
            }

            .best-selleing-image {
                background: {{ $web_config['primary_color'] }}10;
            }

            .top-rated-image {
                background: {{ $web_config['primary_color'] }}10;
            }

            @media (max-width: 800px) {
                .categories-view-all {
                    {{ session('direction') === 'rtl' ? 'margin-left: 10px;' : 'margin-right: 6px;' }}
                }

                .categories-title {
                    {{ Session::get('direction') === 'rtl' ? 'margin-right: 0px;' : 'margin-left: 6px;' }}
                }

                .seller-list-title {
                    {{ Session::get('direction') === 'rtl' ? 'margin-right: 0px;' : 'margin-left: 10px;' }}
                }

                .seller-list-view-all {
                    {{ Session::get('direction') === 'rtl' ? 'margin-left: 20px;' : 'margin-right: 10px;' }}
                }

                .category-product-view-title {
                    {{ Session::get('direction') === 'rtl' ? 'margin-right: 16px;' : 'margin-left: -8px;' }}
                }

                .category-product-view-all {
                    {{ Session::get('direction') === 'rtl' ? 'margin-left: -7px;' : 'margin-right: 5px;' }}
                }
            }

            @media (min-width: 801px) {
                .categories-view-all {
                    {{ session('direction') === 'rtl' ? 'margin-left: 30px;' : 'margin-right: 27px;' }}
                }

                .categories-title {
                    {{ Session::get('direction') === 'rtl' ? 'margin-right: 25px;' : 'margin-left: 25px;' }}
                }

                .seller-list-title {
                    {{ Session::get('direction') === 'rtl' ? 'margin-right: 6px;' : 'margin-left: 10px;' }}
                }

                .seller-list-view-all {
                    {{ Session::get('direction') === 'rtl' ? 'margin-left: 12px;' : 'margin-right: 10px;' }}
                }

                .seller-card {
                    {{ Session::get('direction') === 'rtl' ? 'padding-left:0px !important;' : 'padding-right:0px !important;' }}
                }

                .category-product-view-title {
                    {{ Session::get('direction') === 'rtl' ? 'margin-right: 10px;' : 'margin-left: -12px;' }}
                }

                .category-product-view-all {
                    {{ Session::get('direction') === 'rtl' ? 'margin-left: -20px;' : 'margin-right: 0px;' }}
                }
            }

            .countdown-card {
                background: {{ $web_config['primary_color'] }}10;

            }

            .flash-deal-text {
                color: {{ $web_config['primary_color'] }};
            }

            .countdown-background {
                background: {{ $web_config['primary_color'] }};
            }

            .czi-arrow-left {
                color: {{ $web_config['primary_color'] }};
                background: {{ $web_config['primary_color'] }}10;
            }

            .czi-arrow-right {
                color: {{ $web_config['primary_color'] }};
                background: {{ $web_config['primary_color'] }}10;
            }

            .flash-deals-background-image {
                background: {{ $web_config['primary_color'] }}10;
            }

            .view-all-text {
                color: {{ $web_config['secondary_color'] }} !important;
            }

            .feature-product .czi-arrow-left {
                color: {{ $web_config['primary_color'] }};
                background: {{ $web_config['primary_color'] }}10
            }

            .feature-product .czi-arrow-right {
                color: {{ $web_config['primary_color'] }};
                background: {{ $web_config['primary_color'] }}10;
                font-size: 12px;
            }

            #featured_products_list .owl-nav {
                display: none !important;
            }

            /*  */
        </style>

        <link rel="stylesheet" href="{{ asset('public/assets/front-end') }}/css/owl.carousel.min.css" />
        <link rel="stylesheet" href="{{ asset('public/assets/front-end') }}/css/owl.theme.default.min.css" />
    @endpush

@section('content')
    {{-- <section class="bg-transparent py-3">
        <div class="container position-relative">
            @include('web-views.partials._home-top-slider')
        </div>
    </section> --}}
    <div id="MainCarousel" class="carousel slide w-100" data-bs-ride="carousel">
        <div class="carousel-inner">

            @foreach ($main_banner as $key => $banner)
                <div class="carousel-item active position-relative">
                    <a href="{{ $banner['url'] }}" class="d-block w-100">
                        <img class="w-100 __lide-img"
                            onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                            src="{{ asset('storage/app/public/banner') }}/{{ $banner['photo'] }}" alt="">
                    </a>
                    {{-- <img src="{{ asset('public/assets/carousel/item1.svg') }}" alt=""> --}}
                </div>

            @endforeach
            {{-- <div class="carousel-item active position-relative">
                <img src="{{ asset('public/assets/carousel/item1.svg') }}" alt="">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('public/assets/carousel/item2.svg') }}" alt="">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('public/assets/carousel/item3.svg') }}" alt="">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('public/assets/carousel/item4.svg') }}" alt="">
            </div> --}}
        </div>

        <!-- أزرار التنقل -->
        <button class="d-none d-md-block carousel-control-prev border-0" style="background: none;" type="button"
            data-bs-target="#MainCarousel" data-bs-slide="prev">
            <span class="pb-2 pt-3 px-3 bg-white rounded-circle">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </span>
            {{-- <span class="visually-hidden">السابق</span> --}}
        </button>
        <button class="d-none d-md-block carousel-control-next border-0" style="background: none;" type="button"
            data-bs-target="#MainCarousel" data-bs-slide="next">

            <span class="pb-2 pt-3 px-3 bg-white rounded-circle">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </span>
            {{-- <span class="visually-hidden">التالي</span> --}}
        </button>


    </div>
    <div class="__inline-61">
        @php($decimal_point_settings = !empty(\App\CPU\Helpers::get_business_settings('decimal_point_settings')) ? \App\CPU\Helpers::get_business_settings('decimal_point_settings') : 0)
        <!-- Hero (Banners + Slider)-->
        {{-- <section class="bg-transparent py-3">
            <div class="container position-relative">
                @include('web-views.partials._home-top-slider',['main_banner'=>$main_banner])
            </div>
        </section> --}}

        <!--flash deal-->
        @if ($web_config['flash_deals'] && count($web_config['flash_deals']->products) > 0)
            @include('web-views.partials._flash-deal')
        @endif

        <!-- Products grid (featured products)-->
        @if ($featured_products->count() > 0)
            <div class="container py-4 rtl px-0 px-md-3">
                <div class="__inlin-62 pt-3">
                    <div class="d-flex justify-content-between">
                        <div class="text-right fs-4 fw-bold px-3 text-dark mt-0"
                            style="color: {{ $web_config['primary_color'] }}">
                            {{ translate('featured_products') }}
                        </div>
                        <div class="text-end px-3">
                            <a class="text-capitalize view-all-text d-md-none text-dark" style="color: #66717C !important;"
                                href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">
                                {{ translate('view_all') }}
                            </a>

                            <a class="text-capitalize view-all-text d-none d-md-inline text--primary"
                                href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}"
                                style="color: {{ $web_config['primary_color'] }} !important">
                                {{ translate('view_all') }}
                            </a>

                        </div>
                    </div>
                    <div class="feature-product">
                        <div class="carousel-wrap p-1">
                            <div class="owl-carousel owl-theme " id="featured_products_list">
                                @foreach ($featured_products as $product)
                                    <div>
                                        @include('web-views.partials._feature-product', [
                                            'product' => $product,
                                            'decimal_point_settings' => $decimal_point_settings,
                                        ])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="text-center pt-2 d-md-none">
                            <a class="text-capitalize view-all-text"
                                href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}"
                                style="color: {{ $web_config['primary_color'] }}!important">
                                {{ translate('view_all') }}
                                <i
                                    class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1' }}"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        @endif

        <!-- category -->
        @include('web-views.partials._category-section-home')



        <!--featured deal-->
        @if ($web_config['featured_deals'] && count($web_config['featured_deals']) > 0)
            <section class="featured_deal rtl">
                <div class="container">
                    <div class="__featured-deal-wrap bg--light">
                        <div class="d-flex flex-wrap justify-content-between gap-8 mb-3">
                            <div class="w-0 flex-grow-1">
                                <span
                                    class="featured_deal_title font-bold text-dark">{{ translate('featured_deal') }}</span>
                                <br>
                                <span
                                    class="text-left text-nowrap">{{ translate('see_the_latest_deals_and_exciting_new_offers') }}!</span>
                            </div>
                            <div>
                                <a class="text-capitalize view-all-text"
                                    href="{{ route('products', ['data_from' => 'featured_deal']) }}"
                                    style="color: {{ $web_config['primary_color'] }}!important">
                                    {{ translate('view_all') }}
                                    <i
                                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1' }}"></i>
                                </a>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme new-arrivals-product">
                            @foreach ($web_config['featured_deals'] as $key => $product)
                                @include('web-views.partials._product-card-1', [
                                    'product' => $product,
                                    'decimal_point_settings' => $decimal_point_settings,
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- @if (isset($main_section_banner))
            <div class="container rtl pt-4 px-0 px-md-3">
                <a href="{{$main_section_banner->url}}"
                    class="cursor-pointer d-block">
                    <img class="d-block footer_banner_img __inline-63"
                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                        src="{{asset('storage/app/public/banner')}}/{{$main_section_banner['photo']}}">
                </a>
            </div>
        @endif --}}
        <section style="background-color: #EAF2F9;" class=" position-relative" style="overflow: hidden;">
            <div class="container">
                <div class="row justify-content-center align-items-top g-2 text-start">
                    <div class="col-6">
                        <img class="w-100" src="{{ asset('assets/images/image.png') }}"
                            alt="{{ translate('Design_your_perfect_home_with_the_perfect_furniture') }}">
                    </div>
                    <div class="col-6 py-5 px-md-5" dir="rtl">
                        <h2 class="fs-sm-1 fs-6 d-none d-sm-block" style="color: #307EC4;">
                            {{ translate('Design_your_perfect_home_with_the_perfect_furniture') . '.' }}</h2>
                        <h6 class="d-sm-none" style="color: #307EC4;">
                            {{ translate('Design_your_perfect_home_with_the_perfect_furniture') . '.' }}</h6>
                        <p class="" style="color: #6D8FAE;">
                            {{ translate('We_make_it_easy_for_you_to_find_the_perfect_fit_for_you') . '.' }}</p>
                        <a href="{{ route('products') }}"
                            class="btn btn-outline-primary">{{ translate('explore_now') }}</a>
                    </div>

                </div>
            </div>
            <svg class="position-absolute d-none d-sm-inline" style="bottom: -0%; right: -0%;" width="603"
                height="396" viewBox="0 0 603 396" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M501.936 129.028C509.975 147.653 522.545 163.564 538.752 175.629C539.394 176.442 541.128 175.679 541.283 174.715C542.535 164.498 540.739 154.674 536.109 146.416C533.038 141.7 530.774 136.451 529.386 130.832C528.747 117.775 541.315 114.256 552.601 108.059C567.472 100.17 596.267 89.4227 593.009 72.9447C592.607 70.9587 588.819 72.3928 589.135 74.377C590.453 81.8521 579.958 90.212 567.65 97.4394C555.343 104.667 540.748 111.004 534.304 114.99C524.393 121.133 524.091 125.502 527.053 133.685C529.391 140.34 533.054 146.561 535.732 153.224C537.108 156.352 538.111 159.673 538.722 163.132C539.439 167.523 541.564 171.692 535.715 169.884C527.679 167.526 522.197 156.68 518.091 151.166C513.169 143.936 509.127 136.096 506.029 127.769C505.033 126.191 501.161 127.202 501.936 129.028Z"
                    fill="#BFD7ED" />
                <path
                    d="M549.873 242.308C548.23 224.254 527.265 209.396 514.182 197.792C509.962 193.993 505.603 190.238 501.662 186.352C497.725 182.574 494.341 178.292 491.57 173.578C489.683 170.8 488.595 167.489 488.387 163.888C488.178 160.288 488.855 156.49 490.367 152.774C494.23 145.074 499.766 137.931 506.53 131.919C508.228 130.213 505.596 128.424 503.792 130.216C485.553 147.673 479.502 162.048 490.56 178.359C497.664 187.379 505.714 195.615 514.625 202.981C520.534 208.367 527.889 214.371 534.046 221.064C540.271 226.799 544.323 234.439 545.786 243.194C545.985 245.43 550.026 244.375 549.873 242.308Z"
                    fill="#BFD7ED" />
                <path
                    d="M375.901 204.696C386.007 205.24 390.998 213.062 395.98 217.863L412.514 233.314C423.469 243.528 434.818 253.919 447.047 264.025C457.054 272.395 467.819 280.65 479.362 288.278C486.631 293.074 497.871 304.186 509.67 301.61C510.255 301.492 510.552 300.901 510.486 300.602C498.43 275.78 469.454 259.407 447.709 241.874C435.753 232.112 423.797 222.35 413.27 212.355C409.858 209.11 402.092 204.222 400.904 200.247C400.194 197.323 400.609 194.057 402.08 190.993C403.256 187.771 405.374 184.792 408.15 182.455C413.691 178.813 419.523 175.71 425.54 173.205C429.209 171.103 433.14 169.655 437.109 168.945C441.078 168.235 445.005 168.276 448.666 169.067C459.433 170.771 458.074 170.876 462.097 177.151C464.134 180.374 466.171 183.597 468.104 186.903C471.85 193.471 475.337 200.248 479.513 206.823C486.51 218.703 495.483 229.192 506.15 237.961C513.293 243.35 542.504 262.491 550.768 244.376C551.782 242.222 547.783 241.35 546.906 243.463C543.169 252.591 532.773 249.745 522.707 244.309C514.729 239.817 507.289 234.604 500.465 228.725C495.512 223.861 491.07 218.526 487.184 212.773C483.258 207.266 479.676 201.551 476.335 195.925C472.994 190.299 470.809 182.055 466.139 174.961C464.336 171.135 461.32 168.104 457.445 166.225C453.571 164.347 448.999 163.7 444.268 164.36C429.459 167.1 403.913 179.24 396.649 188.524C392.546 194.073 395.644 200.035 401.396 205.274C407.147 210.513 414.358 215.988 418.045 219.365C434.619 234.221 452.969 248.424 471.849 262.976C481.844 270.022 491.141 277.876 499.666 286.477C503.07 290.785 512.968 299.876 499.331 298.084C494.178 297.363 486.823 290.525 482.94 288.08C462.263 273.93 442.932 258.185 425.089 240.959L398.694 216.035C392.842 210.454 388.483 203.111 377.26 202.548C375.143 202.77 374.114 204.582 375.901 204.696Z"
                    fill="#BFD7ED" />
                <path
                    d="M344.305 227.026C350.344 226.172 357.581 231.579 363.833 238.058C370.085 244.537 375.018 252.215 377.923 254.79C386.95 264.229 395.938 273.84 406.346 283.151C415.24 291.477 424.938 298.994 435.36 305.639C440.35 308.644 455.641 320.273 463.649 318.821C471.657 317.368 467.621 308.618 459.698 300.465C451.776 292.313 441.144 284.374 439.042 282.486C433.506 277.465 409.951 259.57 391.299 243.135C372.648 226.7 359.7 211.084 378.83 204.063C380.696 203.336 379.462 201.663 377.542 202.433C364.603 207.356 364.185 214.774 367.727 222.238C372.057 229.453 377.635 235.77 384.283 240.987C396.697 251.071 410.143 261.028 422.489 271.798C429.158 277.591 435.983 283.47 442.473 289.477C447.427 293.983 460.623 301.967 462 308.014C465.071 309.474 464.372 311.017 460.368 312.129C457.787 315.043 455.238 315.128 452.734 312.51C449.944 311.432 447.313 310.096 444.872 308.518C437.304 304.284 430.137 299.525 423.412 294.268C412.297 285.355 401.817 275.773 392.014 265.562L376.227 249C370.963 243.551 366.048 238.102 360.517 232.868C356.284 228.834 352.924 224.03 343.894 225.182C342.018 225.566 342.429 227.41 344.305 227.026Z"
                    fill="#BFD7ED" />
                <path
                    d="M445.061 360.677C445.393 350.184 426.347 344.192 416.806 339.319C399.272 330.22 380.86 321.757 364.602 311.983C347.683 301.481 332.406 289.238 329.279 273.821C328.006 266.433 328.944 258.422 331.995 250.629C333.376 246.373 335.022 242.151 336.923 237.986C338.706 233.462 341.746 229.267 345.668 225.919C346.829 224.987 345.203 223.911 344.009 224.801C333.154 232.889 329.214 248.31 327.079 257.939C325.502 264.406 325.586 270.815 327.323 276.583C329.224 283.152 332.565 289.013 337.154 293.829C349.569 305.959 364.059 316.001 380.218 323.673L410.213 338.941C419.016 343.426 442.173 352.001 441.792 361.341C441.806 362.451 445.086 362.127 445.061 360.677Z"
                    fill="#BFD7ED" />
                <path
                    d="M431.027 435.741C439.783 432.013 431.668 422.921 420.522 414.716C411.372 408.296 401.791 402.402 391.819 397.059C375.96 387.718 357.044 378.371 341.298 367.885C325.552 357.398 313.079 345.689 310.249 330.945C309.644 327.352 309.537 323.61 309.931 319.81C310.169 316.127 310.665 312.416 311.416 308.703C313.747 297.057 323.022 305.147 330.486 309.98L352.382 324.387C359.674 329.217 367.105 334.007 374.828 338.632C388.313 347.031 402.821 354.042 418.171 359.579C425.124 361.94 436.636 367.389 443.657 361.679C445.058 360.554 442.838 359.033 441.438 360.158C435.835 364.658 422.597 360.243 409.834 354.392C397.071 348.541 384.491 341.418 381.209 339.625C373.347 335.04 365.813 330.333 358.521 325.503L336.607 311.181C332.491 308.44 320.464 296.865 313.13 298.959C305.796 301.052 307.642 314.336 307.218 317.77C306.265 328.397 308.936 338.374 314.826 346.184C322.109 355.691 331.248 363.632 341.866 369.678C355.858 378.48 371.075 386.579 385.737 395.264C394.196 400.282 402.343 405.551 410.251 410.731C413.514 412.822 439.098 429.75 429.807 433.767C428.562 434.767 429.648 436.356 431.027 435.741Z"
                    fill="#BFD7ED" />
                <path
                    d="M316.273 387.162C321.455 383.695 335.643 389.646 349.704 397.087C363.765 404.528 376.985 414.102 381.394 416.597C395.818 424.718 412.974 435.086 432.6 434.588C433.955 434.541 434.016 432.965 432.714 432.97C416.702 432.089 401.921 427.68 389.438 420.059C376.22 412.912 363.958 404.442 352.533 398.354C345.682 394.42 324.513 380.405 315.423 386.527C314.924 386.997 315.761 387.505 316.273 387.162Z"
                    fill="#BFD7ED" />
                <path
                    d="M483.141 446.281C470.663 458.471 461.041 474.591 442.855 481.017C418.825 489.549 393.706 477.699 376.843 465.021C362.873 454.147 350.566 441.478 340.175 427.275C330.721 414.851 323.229 400.979 317.892 386.016C317.419 385.417 315.868 385.543 316.224 386.306C320.1 394.032 324.145 402.181 328.848 410.43C333.561 418.936 338.765 427.126 344.439 434.968C356.675 452.483 372.925 466.765 392.205 476.947C406.039 484.016 423.254 488.16 439.575 483.861C449.035 481.129 457.875 475.715 464.87 468.369C471.714 461.473 477.916 453.555 484.524 446.988C485.214 446.295 483.83 445.588 483.141 446.281Z"
                    fill="#BFD7ED" />
                <path
                    d="M600.564 209.056C599.186 202.22 603.782 192.657 610.138 183.201C616.494 173.744 623.716 164.006 627.942 157.158C634.705 146.201 644.336 133.147 644.387 121.226C644.438 109.305 634.27 104.072 625.925 97.8579C614.855 90.1035 606.789 80.2122 595.081 73.4537C593.5 72.5132 590.986 74.7401 592.416 75.5949C601.576 81.568 608.275 89.5177 617.038 96.155C621.803 100.064 627.61 103.066 632.339 107.142C644.712 117.925 637.336 133.727 629.219 147.637C622.211 159.344 615.273 170.926 608.082 182.296C602.203 191.508 595.352 199.912 597.207 209.473C597.248 211.858 600.915 210.985 600.564 209.056Z"
                    fill="#BFD7ED" />
                <path
                    d="M714.764 450.908C713.902 440.523 708.041 439.833 698.355 438.148C680.077 435.092 661.64 432.584 643.417 429.064C634.432 427.607 625.862 425.078 617.885 421.528L609.797 416.737C610.179 404.723 614.171 399.203 623.276 400.793C627.714 400.572 632.056 400.9 636.199 401.77C652.616 404.499 667.187 411.514 683.812 413.865C707.766 417.269 725.026 408.033 740.169 386.826C759.252 360.351 771.418 330.248 764.979 301.909C764.82 301.47 764.48 301.137 764.027 300.98C763.574 300.823 763.042 300.854 762.539 301.065C747.296 308.26 732.107 315.203 716.77 321.211C701.433 327.22 679.874 337.316 664.587 336.765C660.326 339.276 658.273 339.453 658.734 337.26C663.38 333.528 667.909 329.54 672.591 325.639C678.94 320.539 685.699 315.742 692.507 311.114C703.476 303.636 715.224 297.144 726.092 289.537C735.269 283.308 743.663 275.927 750.99 267.646C758.239 259.183 763.507 249.484 766.323 239.416C769.6 225.801 769.837 212.211 767.017 199.599C764.201 187.05 760.277 174.939 755.283 163.384C755.138 163.097 754.91 162.865 754.622 162.711C754.333 162.557 753.994 162.487 753.636 162.506C753.278 162.526 752.915 162.635 752.58 162.823C752.245 163.01 751.95 163.271 751.724 163.579C735.082 183.957 724.409 206.55 713.005 228.539C707.447 239.52 701.366 250.324 694.784 260.911C688.106 271.425 680.215 281.32 671.3 290.36C664.496 297.6 656.26 303.446 647.294 307.399C645.562 308.906 643.444 309.872 641.307 310.13C639.169 310.388 637.145 309.922 635.584 308.812C631.588 308.026 632.03 306.129 636.842 303.034C642.433 291.953 654.512 280.219 662.086 269.298C670.285 257.244 677.802 244.756 684.979 232.051C692.032 219.277 698.433 206.272 704.157 193.092C708.863 182.743 712.393 172.121 714.675 161.438C717.258 150.698 717.432 139.98 715.186 130.04C713.823 123.535 711.04 117.615 707.005 112.635C705.009 110.046 702.13 108.25 698.737 107.477C695.345 106.704 691.594 106.99 687.966 108.297C670.747 114.486 659.319 137.406 652.365 150.072C645.696 163.09 638.135 175.794 629.74 188.085C625.087 194.989 619.424 201.313 612.973 206.81C607.81 210.957 602.601 212.267 598.965 208.947C597.746 207.403 594.58 209.806 596.126 211.228C601.951 216.785 609.445 214.201 617.882 206.723C627.76 196.753 636.386 185.743 643.512 174.008C660.611 147.585 675.897 116.519 685.842 113.298C692.597 111.167 705.219 118.065 708.23 122.517C710.437 126.685 711.797 131.332 712.248 136.256C713.436 144.957 712.91 154.098 710.694 163.234C708.792 171.827 706.017 180.374 702.411 188.745C699.012 197.154 695.084 205.427 690.917 213.611C674.617 248.018 653.275 280.746 627.651 310.627C627.474 310.828 627.35 311.064 627.293 311.307C627.236 311.55 627.248 311.79 627.328 312.002C627.408 312.214 627.553 312.389 627.746 312.507C627.939 312.625 628.174 312.682 628.423 312.671C634.737 313.288 641.387 312.466 647.876 310.265C654.365 308.064 660.524 304.542 665.891 299.963C676.511 291.055 685.774 280.698 693.267 269.351C712.947 240.855 725.059 208.762 744.952 179.253C751.749 169.378 752.831 166.475 756.78 178.096C760.627 188.113 763.321 198.68 764.82 209.636C767.252 231.94 761.063 254.227 742.06 272.365C728.566 283.891 714.111 294.233 698.929 303.222C682.581 314.212 666.878 326.216 651.946 339.136C650.604 340.214 651.822 341.97 653.329 341.741C674.208 338.63 695.093 333.108 715.525 325.296C726.108 321.282 736.61 316.844 747.2 311.983C755.249 308.393 760.302 302.932 763.711 313.443C764.627 320.335 764.196 327.568 762.438 334.797C759.981 345.968 755.948 357.043 750.457 367.696C745.049 378.403 737.868 388.444 729.246 397.352C705.674 420.281 679.396 409.77 656.096 403.456C642.475 399.674 626.396 395.343 611.138 399.956C601.006 403.047 599.55 407.932 604.699 414.663C612.153 424.099 628.199 428.387 640.7 430.966C651.715 433.265 662.991 434.935 674.128 436.856C685.266 438.777 710.751 438.778 711.765 451.704C711.18 454.488 714.97 453.197 714.764 450.908Z"
                    fill="#BFD7ED" />
                <path
                    d="M538.411 440.808C551.632 453.186 553.372 473.029 558.295 490.526C563.218 508.023 570.932 523.207 597.318 525.786C620.393 528 645.811 514.476 666.581 502.295C686.186 491.19 710.711 474.515 715.298 452.053C715.646 450.155 712.335 450.002 711.901 451.898C708.023 464.482 699.601 476.039 688.294 484.293C677.122 492.763 665.219 500.154 652.806 506.326C629.508 518.709 601.929 530.241 579.486 518.306C547.074 501.297 563.779 460.591 539.643 439.818C538.945 439.253 537.764 440.202 538.411 440.808Z"
                    fill="#BFD7ED" />
                <path
                    d="M472.055 459.025C482.257 446.911 494.678 439.104 508.55 429.712C521.064 421.369 531.483 410.134 538.572 397.339C556.231 366.216 563.381 331.844 566.958 299.152C570.535 266.461 570.794 231.815 573.963 198.821C576.154 165.41 584.939 131.489 599.85 98.8617C600.16 98.6126 599.376 98.2622 599.116 98.6813C580.036 128.006 573.067 159.292 570.307 190.557C567.547 221.823 568.371 253.989 565.885 283.355C563.044 319.866 557.272 358.87 537.898 394.24C534.018 401.378 529.136 408.107 523.418 414.2C517.566 420.43 510.974 425.984 503.837 430.698C497.769 434.696 491.907 439.03 486.289 443.673C480.884 448.095 476.062 453.172 471.99 458.728C471.99 458.728 471.934 459.193 472.055 459.025Z"
                    fill="#BFD7ED" />
            </svg>
        </section>
        <!--top seller-->
        @php($business_mode = \App\CPU\Helpers::get_business_settings('business_mode'))
        @if ($business_mode == 'multi' && count($top_sellers) > 0)
            @include('web-views.partials._top-sellers')
        @endif

        <!-- deal of the day and latest product -->
        {{-- @include('web-views.partials._deal-of-the-day')
        <!-- end deal of the day and latest product -->

        <!-- Banner  mobile-->
        @if ($footer_banner->count() > 0)
            @foreach ($footer_banner as $key => $banner)
            @if ($key == 0)
                <div class="container rtl d-sm-none">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <a href="{{$banner->url}}" class="d-block">
                                <img class="footer_banner_img __inline-63"
                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                    src="{{asset('storage/app/public/banner')}}/{{$banner['photo']}}">
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        @endif --}}

        <!-- new-arrival -->

        <section class="new-arrival-section">

            <div class="container rtl mt-4">
                <a class="text-capitalize view-all-text float-left"
                    style="color: {{ $web_config['primary_color'] }}!important"
                    href="{{ route('products') }}">{{ translate('view_all') }}
                    <i
                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>
                </a>
                @if ($latest_products->count() > 0)
                    <div class="section-header">
                        <div class="arrival-title d-block">
                            <div class="text-capitalize">
                                {{ translate('new_arrivals') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="container rtl mb-3 overflow-hidden">
                <div class="py-2">
                    <div class="new_arrival_product">
                        <div class="carousel-wrap">
                            <div class="owl-carousel owl-theme new-arrivals-product">
                                @foreach ($latest_products as $key => $product)
                                    @include('web-views.partials._single-product', [
                                        'product' => $product,
                                        'decimal_point_settings' => $decimal_point_settings,
                                    ])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="container rtl px-0 px-md-3">
                <div class="row g-3 mx-max-md-0">
                    <!-- best selling product -->
                    @if ($bestSellProduct->count() > 0)
                        @include('web-views.partials._best-selling')
                    @endif
                    <!-- top rated  product -->
                    @if ($topRated->count() > 0)
                        @include('web-views.partials._top-rated')
                    @endif
                </div>
            </div> --}}
        </section>
        <!-- Brands -->
        @if ($web_config['brand_setting'] && $brands->count() > 0)
            <section class="container rtl pt-4">
                <!-- Heading-->
                <div class="section-header">
                    <div class="text-black font-bold __text-22px">
                        <span> {{ translate('brands') }}</span>
                    </div>
                    <div class="__mr-2px">
                        <a class="text-capitalize view-all-text" href="{{ route('brands') }}"
                            style="color: {{ $web_config['primary_color'] }}!important">
                            {{ translate('view_all') }}
                            <i
                                class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>
                        </a>
                    </div>
                </div>
                <!-- Grid-->
                <div class="mt-sm-3 mb-3 brand-slider">
                    <div class="owl-carousel owl-theme p-2 brands-slider pb-5 pb-sm-0">
                        @foreach ($brands as $brand)
                            <div class="text-center">
                                <a href="{{ route('products', ['id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}"
                                    class="__brand-item">
                                    <img onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                        src="{{ asset("storage/app/public/brand/$brand->image") }}"
                                        alt="{{ $brand->name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- <!-- Categorized product -->
        @if ($home_categories->count() > 0)
            @foreach ($home_categories as $category)
                @include('web-views.partials._category-wise-product')
            @endforeach
        @endif --}}

        <!--delivery type -->
        @php($company_reliability = \App\CPU\Helpers::get_business_settings('company_reliability'))
        @if ($company_reliability != null)
            @include('web-views.partials._company-reliability')
        @endif
    </div>
@endsection

@push('script')
    <script>
        /*--flash deal Progressbar --*/
        function update_flash_deal_progress_bar() {
            const current_time_stamp = new Date().getTime();
            const start_date = new Date('{{ $web_config['flash_deals']['start_date'] ?? '' }}').getTime();
            const countdownElement = document.querySelector('.cz-countdown');
            const get_end_time = countdownElement.getAttribute('data-countdown');
            const end_time = new Date(get_end_time).getTime();
            let time_progress = ((current_time_stamp - start_date) / (end_time - start_date)) * 100;
            const progress_bar = document.querySelector('.flash-deal-progress-bar');
            progress_bar.style.width = time_progress + '%';
        }
        update_flash_deal_progress_bar();
        setInterval(update_flash_deal_progress_bar, 10000);
        /*-- end flash deal Progressbar --*/
    </script>

    <!-- Owl Carousel -->
    <script src="{{ asset('public/assets/front-end') }}/js/owl.carousel.min.js"></script>

    <script>
        $('.flash-deal-slider').owlCarousel({
            loop: false,
            autoplay: true,
            center: false,
            margin: 10,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1.1
                },
                360: {
                    items: 1.2
                },
                375: {
                    items: 1.4
                },
                480: {
                    items: 1.8
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 3
                },
                //Large
                992: {
                    items: 4
                },
                //Extra large
                1200: {
                    items: 4
                },
            }
        })
        $('.flash-deal-slider-mobile').owlCarousel({
            loop: false,
            autoplay: true,
            center: true,
            margin: 10,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1.1
                },
                360: {
                    items: 1.2
                },
                375: {
                    items: 1.4
                },
                480: {
                    items: 1.8
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 3
                },
                //Large
                992: {
                    items: 4
                },
                //Extra large
                1200: {
                    items: 4
                },
            }
        })

        $('#web-feature-deal-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 20,
            nav: false,
            //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 2
                }
            }
        })

        $('.new-arrivals-product').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}'></i>",
                "<i class='czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}'></i>"
            ],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1.1
                },
                360: {
                    items: 1.2
                },
                375: {
                    items: 1.4
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 4
                },
                //Extra extra large
                1400: {
                    items: 4
                }
            }
        })

        $('.category-wise-product-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}'></i>",
                "<i class='czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}'></i>"
            ],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: {
                    items: 1.2
                },
                375: {
                    items: 1.4
                },
                425: {
                    items: 2
                },
                576: {
                    items: 3
                },
                768: {
                    items: 4
                },
                992: {
                    items: 5
                },
                1200: {
                    items: 6
                },
            }
        })
    </script>
    <script>
        $('#featured_products_list').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: false,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 3
                },
                //Large
                992: {
                    items: 4
                },
                //Extra large
                1200: {
                    items: 4
                },
            }
        });
    </script>
    <script>
        $('.hero-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            // '{{ session('direction') }}': false,
            // center: true,
            items: 1
        });
    </script>
    <script>
        $('.brands-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 10,
            nav: false,
            '{{ session('direction') }}': true,
            autoplayHoverPause: true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 4,
                    dots: true,
                },
                360: {
                    items: 5,
                    dots: true,
                },
                //Small
                576: {
                    items: 6,
                    dots: false,
                },
                //Medium
                768: {
                    items: 7,
                    dots: false,
                },
                //Large
                992: {
                    items: 9,
                    dots: false,
                },
                //Extra large
                1200: {
                    items: 11,
                    dots: false,
                },
                //Extra extra large
                1400: {
                    items: 12,
                    dots: false,
                }
            }
        })
    </script>

    <script>
        $('#category-slider, #top-seller-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 20,
            nav: false,
            // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 6
                },
                //Large
                992: {
                    items: 8
                },
                //Extra large
                1200: {
                    items: 10
                },
                //Extra extra large
                1400: {
                    items: 11
                }
            }
        })
        $('.categories--slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 20,
            nav: false,
            // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 3
                },
                360: {
                    items: 3.2
                },
                375: {
                    items: 3.5
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 6
                },
                //Large
                992: {
                    items: 8
                },
                //Extra large
                1200: {
                    items: 10
                },
                //Extra extra large
                1400: {
                    items: 11
                }
            }
        })
    </script>
    <script>
        // Others Store Slider
        const othersStore = $(".others-store-slider").owlCarousel({
            responsiveClass: true,
            nav: false,
            dots: false,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 600,
            rtl: {{ session()->get('direction') == 'rtl' ? true : 'false' }},
            responsive: {
                0: {
                    items: 1.3,
                    margin: 10,
                },
                480: {
                    items: 2,
                    margin: 26,
                },
                768: {
                    items: 2,
                    margin: 26,
                },
                992: {
                    items: 3,
                    margin: 26,
                },
                1200: {
                    items: 4,
                    margin: 26,
                },
            },
        });
        $(".store-next").on("click", function() {
            othersStore.trigger("next.owl.carousel", [600]);
        });
        $(".store-prev").on("click", function() {
            othersStore.trigger("prev.owl.carousel", [600]);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
