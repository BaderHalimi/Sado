<!-- Footer -->
<style>
    .social-media :hover {
        color: {{$web_config['secondary_color']}} !important;
    }
    footer{
        background-color: {{$web_config['primary_color']}} !important;
    }
    .start_address_under_line{
        {{Session::get('direction') === "rtl" ? 'width: 344px;' : 'width: 331px;'}}
    }

    .floating-text {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        white-space: nowrap;
        z-index: 1000; /* يجعل العنصر فوق باقي العناصر */
    }
    .icons-top-footer svg{
        width: 35px;
        height: 35px;
    }
</style>
<div class="__inline-9 rtl">
    <div style="background: {{$web_config['primary_color']}}10;padding:20px;" class=" d-flex justify-content-center text-center {{Session::get('direction') === "rtl" ? 'text-md-right' : 'text-md-left'}} mt-3">
        <div class="container d-flex justify-content-between text-center icons-top-footer {{Session::get('direction') === "rtl" ? 'text-md-right' : 'text-md-left'}} mt-3">
        <div class="col-md-4 col-1 d-flex justify-content-">
            <div >
                <a href="{{route('about-us')}}">
                    <div class="text-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M30 60C13.4579 60 0 46.5421 0 30C0 13.4579 13.4579 0 30 0C46.5421 0 60 13.4579 60 30C60 46.5421 46.5421 60 30 60ZM35.5152 45.9485C39.7791 44.4698 43.2723 41.3275 45.2126 37.3008H38.3414C37.9561 39.6172 37.3857 41.7533 36.6489 43.5956C36.3015 44.4639 35.9221 45.2488 35.5152 45.9485ZM14.7875 37.3009C16.7278 41.3273 20.2209 44.4698 24.4848 45.9486C24.078 45.2488 23.6985 44.4639 23.3511 43.5957C22.6141 41.7534 22.0439 39.6173 21.6586 37.3009H14.7875ZM24.4848 14.0515C20.2209 15.5302 16.7278 18.6727 14.7875 22.6992H21.6586C22.0439 20.3828 22.6141 18.2467 23.3511 16.4044C23.6985 15.5361 24.0779 14.7512 24.4848 14.0515ZM30 13.125C28.7698 13.125 27.3261 14.8234 26.2327 17.557C25.6294 19.0654 25.1511 20.8062 24.8077 22.6992H35.1925C34.849 20.8063 34.3709 19.0654 33.7675 17.557C32.6739 14.8234 31.2302 13.125 30 13.125ZM13.125 30C13.125 31.4486 13.3086 32.8549 13.6535 34.1974H21.2657C21.1424 32.8322 21.077 31.4276 21.077 30C21.077 28.5724 21.1424 27.1678 21.2657 25.8026H13.6535C13.3017 27.174 13.1241 28.5842 13.125 30ZM24.3799 34.1974H35.6202C35.7512 32.8409 35.8196 31.4345 35.8196 30C35.8196 28.5655 35.7513 27.1591 35.6202 25.8026H24.3799C24.2489 27.1591 24.1805 28.5655 24.1805 30C24.1805 31.4345 24.2488 32.8409 24.3799 34.1974ZM30 46.875C31.2302 46.875 32.6739 45.1766 33.7673 42.443C34.3707 40.9346 34.8489 39.1938 35.1923 37.3008H24.8075C25.151 39.1937 25.6293 40.9346 26.2325 42.443C27.3261 45.1766 28.7698 46.875 30 46.875ZM46.875 30C46.875 28.5514 46.6914 27.1451 46.3465 25.8026H38.7342C38.8575 27.1678 38.9229 28.5724 38.9229 30C38.9229 31.4276 38.8575 32.8322 38.7342 34.1974H46.3465C46.6983 32.826 46.8759 31.4158 46.875 30ZM45.2125 22.6991C43.2723 18.6725 39.7791 15.53 35.5151 14.0514C35.9218 14.7512 36.3014 15.5361 36.6488 16.4044C37.3857 18.2467 37.956 20.3827 38.3413 22.6992L45.2125 22.6991ZM49.9785 30C49.9785 41.0161 41.0161 49.9785 30 49.9785C18.9838 49.9785 10.0215 41.0161 10.0215 30C10.0215 18.9839 18.9838 10.0215 30 10.0215C41.0162 10.0215 49.9785 18.9839 49.9785 30Z" fill="url(#paint0_linear_140_2454)"/>
                            <defs>
                            <linearGradient id="paint0_linear_140_2454" x1="30" y1="0" x2="30" y2="60" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#2E7EC4"/>
                            <stop offset="1" stop-color="#4FADFE"/>
                            </linearGradient>
                            </defs>
                            </svg>
{{--
                        <img class="size-60" src="{{asset("public/assets/front-end/png/about company.png")}}"
                                alt=""> --}}
                    </div>
                    <div class="text-center">
                        <p class="m-0 mt-2 mt-sm-0 floating-text">
                            {{ translate('about_Company')}}
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-1 d-flex justify-content-center">
            <div >
                <a href="{{route('contacts')}}">
                    <div class="text-center">
                        <svg width="58" height="60" viewBox="0 0 58 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M55.8156 0H13.3153C12.1154 0 11.1309 1.075 11.1309 2.38533V12.0376L10.7994 11.3404C10.2028 10.0807 8.92996 8.82837 7.18985 9.92517C5.00545 11.3042 2.17806 12.8933 1.16714 14.9492C-0.311182 17.9535 -0.307897 22.7206 0.7429 26.5864C2.9239 34.6184 6.75564 41.4921 11.8834 47.0229C16.9482 52.6224 23.2427 56.8067 30.5979 59.1884C34.138 60.3359 38.5034 60.3395 41.2578 58.7251C43.1406 57.6211 44.5924 54.5336 45.8552 52.1481C46.8596 50.2479 45.716 48.8579 44.5625 48.2064L34.592 42.5598C33.9456 42.1905 32.991 42.0132 32.5568 42.7733L30.2266 46.8527C29.4742 48.1702 28.4135 48.0182 27.671 47.6381C24.5851 46.0419 20.7268 42.3751 18.3834 39.9246C17.7718 39.2267 17.1727 38.516 16.5863 37.7927H55.8156C57.0155 37.7927 58 36.7177 58 35.4074V2.38533C58 1.07512 57.0156 0 55.8156 0Z" fill="#FFC146"/>
                            <path d="M7.18985 9.92604C5.00545 11.3051 2.17806 12.8941 1.16714 14.9501C-0.311182 17.9544 -0.307897 22.7214 0.7429 26.5873C2.9239 34.6192 6.75564 41.4929 11.8834 47.0237C16.9482 52.6233 23.2427 56.8076 30.5979 59.1893C34.138 60.3368 38.5034 60.3404 41.2578 58.7259C43.1406 57.622 44.5924 54.5345 45.8552 52.149C46.8596 50.2487 45.716 48.8587 44.5625 48.2072L34.592 42.5606C33.9456 42.1914 32.991 42.014 32.5568 42.7742L30.2266 46.8536C29.4742 48.1711 28.4135 48.0191 27.671 47.639C24.5851 46.0428 20.7268 42.376 18.3834 39.9255C16.1427 37.37 12.7816 33.1531 11.3233 29.7833C10.9719 28.9761 10.8326 27.8179 12.0392 26.9962L15.7748 24.448C16.4709 23.9738 16.3084 22.9313 15.9737 22.2255L10.7996 11.3413C10.2029 10.0817 8.93008 8.82936 7.18985 9.92604Z" fill="#2B71B0"/>
                            <path d="M55.8159 0H13.3156C12.7349 0 12.206 0.253297 11.8135 0.661546L34.5479 22.1087L57.3011 0.6447C56.9102 0.246609 56.3884 0 55.8159 0Z" fill="#FFE187"/>
                            <path d="M38.3806 18.5063H38.3653L34.5475 22.1079L30.74 18.516L13.9746 34.3336C14.8138 35.5409 15.7208 36.7239 16.5863 37.7917H55.8156C56.5842 37.7917 57.2629 37.3494 57.6525 36.688L38.3806 18.5063Z" fill="#FFC146"/>
                            <path d="M44.5627 48.2063L34.5923 42.5597C33.9459 42.1905 32.9913 42.0131 32.5571 42.7733L30.7659 45.9091L44.9216 53.928C45.2456 53.3191 45.5559 52.7139 45.8554 52.1481C46.8597 50.2478 45.7161 48.8578 44.5627 48.2063ZM12.9045 26.4052L15.775 24.4471C16.4711 23.9729 16.3087 22.9304 15.9739 22.2246L10.7998 11.3404C10.2032 10.0807 8.93032 8.82834 7.19021 9.92513C6.67218 10.2521 6.118 10.5911 5.56055 10.9453L12.9045 26.4052ZM11.5121 27.4684L10.7164 28.0123C9.48223 28.8545 9.62463 30.0418 9.98407 30.8692C11.476 34.3234 14.9142 38.6457 17.2063 41.2651C19.6036 43.7769 23.5503 47.5354 26.7071 49.1716C27.4667 49.5611 28.5517 49.717 29.3213 48.3665L29.9626 47.2415C29.2402 48.1323 28.3303 47.9756 27.6712 47.6382C24.5853 46.042 20.7271 42.3752 18.3836 39.9247C16.1429 37.3692 12.7819 33.1523 11.3235 29.7825C11.0354 29.1207 10.8905 28.2231 11.5121 27.4684Z" fill="#307EC4"/>
                            </svg>

                        {{-- <img class="size-60" src="{{asset("public/assets/front-end/png/contact us.png")}}"
                                alt=""> --}}
                    </div>
                    <div class="text-center">
                        <p class="m-0 mt-2 mt-sm-0 floating-text">
                            {{ translate('contact_Us')}}
                    </p>
                    </div>
                </a>
            </div>
        </div>
        <div dir="ltr" class="col-md-4 col-1 d-flex">
            <div >
                <a href="{{route('helpTopic')}}">
                    <div class="text-center">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_140_2421)">
                            <mask id="mask0_140_2421" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="60" height="60">
                            <path d="M0 0.000175476H59.9998V60H0V0.000175476Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0_140_2421)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M45.3364 1.17192H6.82909C4.42523 1.17192 2.46094 3.13516 2.46094 5.53011V8.6494C2.46094 9.46643 3.13008 10.1343 3.94922 10.1343H39.48C40.2991 10.1343 40.9684 9.46643 40.9684 8.6494V5.53011C40.9684 3.13188 42.9326 1.17192 45.3364 1.17192Z" fill="#E6DFE1"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7901 16.6683C19.3894 16.6683 19.8789 17.1566 19.8789 17.7512V22.3054C19.8789 22.9 19.3894 23.3884 18.7901 23.3884H14.2255C13.6296 23.3884 13.1401 22.9 13.1401 22.3054V17.7512C13.1401 17.1566 13.6296 16.6683 14.2255 16.6683H18.7901ZM39.4787 10.1343H6.26172V55.3242C6.26172 56.1415 6.93086 56.8091 7.75 56.8091H39.1124C37.9107 55.9853 36.7521 54.8958 35.6799 53.5206L27.5463 43.08C24.9428 39.7382 29.0478 35.3202 31.921 38.3963L34.7744 41.4557C37.0783 43.9238 36.6521 42.419 36.6521 38.9277V21.9931C36.6521 18.3192 41.8726 18.3192 41.8726 21.9931V32.2476C41.8726 28.5737 47.093 28.5737 47.093 32.2476V34.4665C47.093 32.6296 48.3981 31.7095 49.7031 31.7095V5.53021C49.7031 3.13186 47.7389 1.17202 45.3351 1.17202C42.9312 1.17202 40.967 3.13186 40.967 5.53021V8.64938C40.967 9.46652 40.2978 10.1343 39.4787 10.1343Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7906 16.6681H14.226C13.6301 16.6681 13.1406 17.1564 13.1406 17.751V22.3053C13.1406 22.8999 13.6301 23.3882 14.226 23.3882H18.7906C19.3899 23.3882 19.8794 22.8999 19.8794 22.3053V17.751C19.8794 17.1564 19.3899 16.6681 18.7906 16.6681Z" fill="#307EC4"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M36.6535 21.9932V38.9278C36.6535 42.419 37.0798 43.9238 34.7759 41.4556L31.9225 38.3964C29.0493 35.3203 24.9442 39.7383 27.5477 43.08L35.6814 53.5205C36.7535 54.8958 37.912 55.9852 39.1139 56.8092C47.3008 62.4197 57.6085 55.7728 57.5386 43.8341V36.6823C57.5386 33.0083 52.3149 33.0083 52.3149 36.6823V34.4665C52.3149 32.6297 51.0098 31.7094 49.7046 31.7094C48.3994 31.7094 47.0944 32.6297 47.0944 34.4665V32.2477C47.0944 28.5736 41.874 28.5736 41.874 32.2477V21.9932C41.874 18.3192 36.6535 18.3192 36.6535 21.9932Z" fill="#FFDCD5"/>
                            </g>
                            </g>
                            <defs>
                            <clipPath id="clip0_140_2421">
                            <rect width="60" height="60" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>

                        {{-- <img class="size-60" src="{{asset("public/assets/front-end/png/faq.png")}}"
                                alt=""> --}}
                    </div>
                    <div class="text-center">
                        <p class="m-0">
                        {{ translate('FAQ')}}
                    </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
        {{-- <div class="col-md-1">

        </div> --}}
    </div>

    <footer class="page-footer font-small mdb-color rtl">
        <!-- Footer Links -->
        <div class="pt-4" style="background:{{$web_config['primary_color']}}20;">
            <div class="container text-center __pb-13px">

                <!-- Footer links -->
                <div
                    class="row text-center {{Session::get('direction') === "rtl" ? 'text-md-right' : 'text-md-left'}} mt-3 pb-3 ">
                    <!-- Grid column -->
                    <div class="col-md-3 footer-web-logo pb-0" >
                        <a class="d-block" href="{{route('home')}}">
                            <img class="{{Session::get('direction') === "rtl" ? 'rightalign' : ''}}" src="{{asset("storage/app/public/company/")}}/{{ $web_config['footer_logo']->value }}"
                                onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                alt="{{ $web_config['name']->value }}"/>
                        </a>
                        <div class="mt-3 store-contents d-block d-sm-none justify-content- pr-lg-4 pb-0" >
                            @if ($web_config['ios']['status'] || $web_config['android']['status'])
                                <h4 class="text-white">{{ translate('download_our_app')}}</h4>
                            @endif
                           <div class="d-flex">
                                @if($web_config['ios']['status'])
                                    <div class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2">
                                        <a class="" href="{{ $web_config['ios']['link'] }}" role="button">
                                            <img width="100" src="{{asset("public/assets/front-end/png/apple_app.png")}}"
                                                alt="">
                                        </a>
                                    </div>
                                @endif

                                @if($web_config['android']['status'])
                                    <div class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2">
                                        <a href="{{ $web_config['android']['link'] }}" role="button">
                                            <img width="100" src="{{asset("public/assets/front-end/png/google_app.png")}}" alt="">
                                        </a>
                                    </div>
                                @endif
                           </div>
                       </div>

                        {{-- @if($web_config['ios']['status'] || $web_config['android']['status']) --}}
                            <div class="mt-4 pt-lg-4 d-none d-sm-block">
                                <div class="pl-2">
                                    <span class="__text-14px d-flex align- flex-column flex-sm-row ">
                                        <i class="fa fa-map-marker m-2"></i>
                                        <span>{{ \App\CPU\Helpers::get_business_settings('shop_address')}}</span>
                                    </span>
                                </div>
                                <a class="widget-list-link" href="tel: {{$web_config['phone']->value}}">
                                    <span class="">
                                        <i class="fa fa-phone m-2"></i>{{\App\CPU\Helpers::get_business_settings('company_phone')}}
                                    </span>
                                </a>
                                <a class="widget-list-link" href="mailto: {{\App\CPU\Helpers::get_business_settings('company_email')}}">
                                    <span ><i class="fa fa-envelope m-2"></i> {{\App\CPU\Helpers::get_business_settings('company_email')}} </span>
                                </a>
                                @if(auth('customer')->check())
                                    <a class="widget-list-link" href="{{route('account-tickets')}}">
                                        <span ><i class="fa fa-user-o m-2"></i> {{ translate('support_ticket')}} </span>
                                    </a><br>
                                @else
                                    <a class="widget-list-link" href="{{route('customer.auth.login')}}">
                                        <span ><i class="fa fa-user-o m-2"></i> {{ translate('support_ticket')}} </span>
                                    </a><br>
                                @endif
                                {{-- <h6 class="text-uppercase font-weight-bold footer-heder align-items-center">
                                    {{translate('download_our_app')}}
                                </h6> --}}
                            </div>
                        {{-- @endif --}}


                        {{-- <div class="store-contents d-flex justify-content-center pr-lg-4" >
                             @if($web_config['ios']['status'])
                                <div class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2">
                                    <a class="" href="{{ $web_config['ios']['link'] }}" role="button">
                                        <img width="100" src="{{asset("public/assets/front-end/png/apple_app.png")}}"
                                            alt="">
                                    </a>
                                </div>
                             @endif

                             @if($web_config['android']['status'])
                                <div class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2">
                                    <a href="{{ $web_config['android']['link'] }}" role="button">
                                        <img width="100" src="{{asset("public/assets/front-end/png/google_app.png")}}" alt="">
                                    </a>
                                </div>
                             @endif
                        </div> --}}
                    </div>
                    <div class="col-md-9" >
                        <div class="row">

                            <div class="col-md-3 footer-padding-bottom" >
                                <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">{{translate('special')}}</h6>
                                <ul class="widget-list __pb-10px">
                                    @php($flash_deals=\App\Model\FlashDeal::where(['status'=>1,'deal_type'=>'flash_deal'])->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->first())
                                    @if(isset($flash_deals))
                                        <li class="widget-list-item">
                                            <a class="widget-list-link"
                                            href="{{route('flash-deals',[$flash_deals['id']])}}">
                                                {{translate('flash_deal')}}
                                            </a>
                                        </li>
                                    @endif
                                    <li class="widget-list-item"><a class="widget-list-link"
                                                                    href="{{route('products',['data_from'=>'featured','page'=>1])}}">{{translate('featured_products')}}</a>
                                    </li>
                                    <li class="widget-list-item"><a class="widget-list-link"
                                                                    href="{{route('products',['data_from'=>'latest','page'=>1])}}">{{translate('latest_products')}}</a>
                                    </li>
                                    <li class="widget-list-item"><a class="widget-list-link"
                                                                    href="{{route('products',['data_from'=>'best-selling','page'=>1])}}">{{translate('best_selling_product')}}</a>
                                    </li>
                                    <li class="widget-list-item"><a class="widget-list-link"
                                                                    href="{{route('products',['data_from'=>'top-rated','page'=>1])}}">{{translate('top_rated_product')}}</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-md-4 footer-padding-bottom" style="{{Session::get('direction') === "rtl" ? 'padding-right:20px;' : ''}}">
                                <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">{{translate('account_&_shipping_info')}}</h6>
                                @php($refund_policy = \App\CPU\Helpers::get_business_settings('refund-policy'))
                                @php($return_policy = \App\CPU\Helpers::get_business_settings('return-policy'))
                                @php($cancellation_policy = \App\CPU\Helpers::get_business_settings('cancellation-policy'))
                                @if(auth('customer')->check())
                                    <ul class="widget-list __pb-10px">
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('user-account')}}">{{translate('profile_info')}}</a>
                                        </li>

                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('track-order.index')}}">{{translate('track_order')}}</a>
                                        </li>

                                        @if(isset($refund_policy['status']) && $refund_policy['status'] == 1)
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('refund-policy')}}">{{translate('refund_policy')}}</a>
                                        </li>
                                        @endif

                                        @if(isset($return_policy['status']) && $return_policy['status'] == 1)
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('return-policy')}}">{{translate('return_policy')}}</a>
                                        </li>
                                        @endif

                                        @if(isset($cancellation_policy['status']) && $cancellation_policy['status'] == 1)
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('cancellation-policy')}}">{{translate('cancellation_policy')}}</a>
                                        </li>
                                        @endif

                                    </ul>
                                @else
                                    <ul class="widget-list __pb-10px">
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('customer.auth.login')}}">{{translate('profile_info')}}</a>
                                        </li>
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('customer.auth.login')}}">{{translate('wish_list')}}</a>
                                        </li>

                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('track-order.index')}}">{{translate('track_order')}}</a>
                                        </li>

                                        @if(isset($refund_policy['status']) && $refund_policy['status'] == 1)
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('refund-policy')}}">{{translate('refund_policy')}}</a>
                                        </li>
                                        @endif

                                        @if(isset($return_policy['status']) && $return_policy['status'] == 1)
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('return-policy')}}">{{translate('return_policy')}}</a>
                                        </li>
                                        @endif

                                        @if(isset($cancellation_policy['status']) && $cancellation_policy['status'] == 1)
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="{{route('cancellation-policy')}}">{{translate('cancellation_policy')}}</a>
                                        </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>
                            <div class="col-md-5 footer-padding-bottom" >
                                    <div class="mb-2">
                                        <h6 class="text-uppercase mb-4 font-weight-bold footer-heder">{{translate('newsletter')}}</h6>
                                        <span>{{translate('subscribe_to_our_new_channel_to_get_latest_updates')}}</span>
                                    </div>
                                    <div class="text-nowrap mb-4 position-relative">
                                        <form action="{{ route('subscription') }}" method="post">
                                            @csrf
                                            <input type="email" name="subscription_email" class="form-control subscribe-border"
                                                placeholder="{{translate('your_Email_Address')}}" required style="padding: 11px;text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                            <button class="subscribe-button text-blue m-0 px-5" type="submit">
                                                {{translate('subscribe')}}
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mt-4 pt-lg-4 d-sm-none">
                                        <div class="mb-2">{{ translate('start_conversation') }}</div>
                                        <a class="widget-list-link text-center mb-2" href="tel: {{$web_config['phone']->value}}">
                                            <span class="">
                                                <i class="fa fa-phone m-2"></i><br>
                                                {{\App\CPU\Helpers::get_business_settings('company_phone')}}
                                            </span>
                                        </a>
                                        <a class="widget-list-link text-center mb-2" href="mailto: {{\App\CPU\Helpers::get_business_settings('company_email')}}">
                                            <span ><i class="fa fa-envelope m-2"></i><br> {{\App\CPU\Helpers::get_business_settings('company_email')}} </span>
                                        </a>
                                        @if(auth('customer')->check())
                                        <a class="widget-list-link text-center mb-" href="{{route('account-tickets')}}">
                                            <span ><i class="fa fa-user-o m-2"></i><br> {{ translate('support_ticket')}} </span>
                                        </a><br>
                                        @else
                                        <a class="widget-list-link text-center mb-" href="{{route('customer.auth.login')}}">
                                            <span ><i class="fa fa-user-o m-2"></i><br> {{ translate('support_ticket')}} </span>
                                        </a><br>
                                        @endif
                                        <div class="pl-2 text-center mb-4">
                                            <span class="__text-14px d-flex align- flex-column flex-sm-row ">
                                                <i class="fa fa-map-marker m-2"></i>
                                                <span>{{ \App\CPU\Helpers::get_business_settings('shop_address')}}</span>
                                            </span>
                                        </div>
                                        {{-- <h6 class="text-uppercase font-weight-bold footer-heder align-items-center">
                                            {{translate('download_our_app')}}
                                        </h6> --}}
                                    </div>
                                    <div class="max-sm-100 justify-content- d-none d-sm-flex flex-wrap mt-md-3 mt-0 mb-md-3 {{Session::get('direction') === "rtl" ? 'text-right' : 'text-left'}}">
                                        @if($web_config['social_media'])
                                            @foreach ($web_config['social_media'] as $item)
                                                <span class="social-media ">
                                                    @if ($item->name == "twitter")
                                                        <a class="social-btn text-white sb-light sb-{{$item->name}} {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2 d-flex justify-content-center align-items-center"
                                                        target="_blank" href="{{$item->link}}">
                                                            {{-- Twitter SVG --}}
                                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 24 24">
                                                                <g opacity=".3"><polygon fill="#fff" fill-rule="evenodd" points="16.002,19 6.208,5 8.255,5 18.035,19" clip-rule="evenodd"></polygon><polygon points="8.776,4 4.288,4 15.481,20 19.953,20 8.776,4"></polygon></g><polygon fill-rule="evenodd" points="10.13,12.36 11.32,14.04 5.38,21 2.74,21" clip-rule="evenodd"></polygon><polygon fill-rule="evenodd" points="20.74,3 13.78,11.16 12.6,9.47 18.14,3" clip-rule="evenodd"></polygon><path d="M8.255,5l9.779,14h-2.032L6.208,5H8.255 M9.298,3h-6.93l12.593,18h6.91L9.298,3L9.298,3z"  fill="currentColor"></path>
                                                            </svg>
                                                        </a>

                                                    @elseif ($item->name == "tiktok")
                                                        <a class="social-btn text-white sb-light sb-{{$item->name}} {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2 d-flex justify-content-center align-items-center"
                                                        target="_blank" href="{{$item->link}}">
                                                            {{-- TikTok SVG --}}
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                                            <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                                                            </svg>
                                                        </a>

                                                    @else
                                                        <a class="social-btn text-white sb-light sb-{{$item->name}} {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2"
                                                        target="_blank" href="{{$item->link}}">
                                                            <i class="{{$item->icon}}" aria-hidden="true"></i>
                                                        </a>
                                                    @endif

                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="store-contents d-none d-sm-flex justify-content- pr-lg-4" >
                                        @if($web_config['ios']['status'])
                                           <div class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2">
                                               <a class="" href="{{ $web_config['ios']['link'] }}" role="button">
                                                   <img width="100" src="{{asset("public/assets/front-end/png/apple_app.png")}}"
                                                       alt="">
                                               </a>
                                           </div>
                                        @endif

                                        @if($web_config['android']['status'])
                                           <div class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2">
                                               <a href="{{ $web_config['android']['link'] }}" role="button">
                                                   <img width="100" src="{{asset("public/assets/front-end/png/google_app.png")}}" alt="">
                                               </a>
                                           </div>
                                        @endif
                                   </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Footer links -->
            </div>
        </div>

        <!-- Grid row -->
        <div>
            <div class="container">
                <hr>
                <div class="d-flex flex-wrap end-footer footer-end last-footer-content-align">
                    <div class="mt-3">
                        <p class="{{Session::get('direction') === "rtl" ? 'text-right ' : 'text-left'}} __text-16px">{{ translate('copyright_tex')}}</p>
                        <!-- {{ $web_config['copyright_text']->value }} -->
                    </div>
                    <div class="max-sm-100 justify-content-center d-flex d-sm-none flex-wrap mt-md-3 mt-0 mb-md-3 {{Session::get('direction') === "rtl" ? 'text-right' : 'text-left'}}">
                        @if($web_config['social_media'])
                            @foreach ($web_config['social_media'] as $item)
                                <span class="social-media ">
                                    @if ($item->name == "twitter")
                                        <a class="social-btn text-white sb-light sb-{{$item->name}} {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2 d-flex justify-content-center align-items-center"
                                        target="_blank" href="{{$item->link}}">
                                            {{-- Twitter SVG --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 24 24">
                                                <g opacity=".3"><polygon fill="#fff" fill-rule="evenodd" points="16.002,19 6.208,5 8.255,5 18.035,19" clip-rule="evenodd"></polygon><polygon points="8.776,4 4.288,4 15.481,20 19.953,20 8.776,4"></polygon></g><polygon fill-rule="evenodd" points="10.13,12.36 11.32,14.04 5.38,21 2.74,21" clip-rule="evenodd"></polygon><polygon fill-rule="evenodd" points="20.74,3 13.78,11.16 12.6,9.47 18.14,3" clip-rule="evenodd"></polygon><path d="M8.255,5l9.779,14h-2.032L6.208,5H8.255 M9.298,3h-6.93l12.593,18h6.91L9.298,3L9.298,3z"  fill="currentColor"></path>
                                            </svg>
                                        </a>

                                    @elseif ($item->name == "tiktok")
                                        <a class="social-btn text-white sb-light sb-{{$item->name}} {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2 d-flex justify-content-center align-items-center"
                                        target="_blank" href="{{$item->link}}">
                                            {{-- TikTok SVG --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                            <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                                            </svg>
                                        </a>

                                    @else
                                        <a class="social-btn text-white sb-light sb-{{$item->name}} {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2"
                                        target="_blank" href="{{$item->link}}">
                                            <i class="{{$item->icon}}" aria-hidden="true"></i>
                                        </a>
                                    @endif

                                </span>
                            @endforeach
                        @endif
                    </div>
                    {{-- <div class="max-sm-100 justify-content-center d-flex flex-wrap mt-md-3 mt-0 mb-md-3 {{Session::get('direction') === "rtl" ? 'text-right' : 'text-left'}}">
                        @if($web_config['social_media'])
                            @foreach ($web_config['social_media'] as $item)
                                <span class="social-media ">
                                    @if ($item->name == "twitter")
                                        <a class="social-btn text-white sb-light sb-{{$item->name}} {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2 d-flex justify-content-center align-items-center"
                                        target="_blank" href="{{$item->link}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 24 24">
                                            <g opacity=".3"><polygon fill="#fff" fill-rule="evenodd" points="16.002,19 6.208,5 8.255,5 18.035,19" clip-rule="evenodd"></polygon><polygon points="8.776,4 4.288,4 15.481,20 19.953,20 8.776,4"></polygon></g><polygon fill-rule="evenodd" points="10.13,12.36 11.32,14.04 5.38,21 2.74,21" clip-rule="evenodd"></polygon><polygon fill-rule="evenodd" points="20.74,3 13.78,11.16 12.6,9.47 18.14,3" clip-rule="evenodd"></polygon><path d="M8.255,5l9.779,14h-2.032L6.208,5H8.255 M9.298,3h-6.93l12.593,18h6.91L9.298,3L9.298,3z"  fill="currentColor"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <a class="social-btn text-white sb-light sb-{{$item->name}} {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} mb-2"
                                        target="_blank" href="{{$item->link}}">
                                            <i class="{{$item->icon}}" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    </div> --}}
                    <div class="d-flex __text-14px">
                        <div class="{{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}" >
                            <a class="widget-list-link"
                            href="{{route('terms')}}">{{translate('terms_&_conditions')}}</a>
                        </div>
                        <div>
                            <a class="widget-list-link" href="{{route('privacy-policy')}}">
                                {{translate('privacy_policy')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grid row -->
        </div>
        <!-- Footer Links -->

        <!-- Cookie Settings -->
        @php($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true):null)
        @if($cookie && $cookie['status']==1)
        <section id="cookie-section"></section>
        @endif
    </footer>
</div>
