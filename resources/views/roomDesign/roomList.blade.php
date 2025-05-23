@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('3D Design Room List'))

@push('css_or_js')
<meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Brands of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Brands of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">
    <style>
        .page-item.active .page-link {
            background-color: {{$web_config['primary_color']}}    !important;
        }
        .design-items p, .design-items span {
          margin: 0 1px;
          padding: 0 1px;
        }
        .design-items p {
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
        }
        .design-items p:hover {
          overflow: visible;
          text-overflow: clip;
        }
    </style>

    <link rel="stylesheet" href="{{asset('public/assets/front-end')}}/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/front-end')}}/css/owl.theme.default.min.css"/>
    <link rel="stylesheet" href="{{asset('public/assets/front-end/css/room.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/front-end')}}/css/home.css"/>

  <script language="javascript" type="text/javascript">
  </script>
@endpush

@section('content')
    <div class="__inline-61">
        <div class="startdesigningpage" style="width: 100%;">
            <div class="designimage">
                <div class="contentdesign d-sm-none">
                    <div class="designtitle mb-0" style="text-align: center; font-size: 14px;">
                        {{ \App\CPU\translate('Design_your_3D_furniture_and_realize_your_unique_vision_in_an_innovative_way') }}
                    </div>
                    <div class="designtitle mb-0" style="text-align: center; font-size: 10px;font-weight: normal;">
                        {{ \App\CPU\translate('Create_exceptional_furniture_designs_that_combine_precision_and_beauty_using_the_latest_3D_design_technologies') }}
                    </div>
                    <div class="arrangementbutton mb-0">
                        <div class="buttongroup mb-0">
                            {{-- <a class="saveddesigning">Your Saved Designs</a> --}}
                            <a class="startdesigning btn btn--primary px-2" style="font-size: 6px;" href="{{route('room-design')}} ">{{ \App\CPU\translate('Start Designing')}}</a>
                            <!-- <button class="startdesigning" onclick="route('design')">Start Designing</button> -->
                        </div>
                    </div>
                </div>
                <div class="contentdesign d-none d-sm-block text-center aligh-item-center justify-content-center">
                    <div class="designtitle mb-2" style="text-align: center;">
                        {{ \App\CPU\translate('Design_your_3D_furniture_and_realize_your_unique_vision_in_an_innovative_way') }}
                    </div>
                    <div class="text-center">
                        <div class="designtitle w-50 mb-2" style="display:inline-block;text-align: center; font-size: 25px;font-weight: normal;">
                            {{ \App\CPU\translate('Create_exceptional_furniture_designs_that_combine_precision_and_beauty_using_the_latest_3D_design_technologies') }}
                        </div>
                    </div>
                    <div class="arrangementbutton text-center">
                        <div class="buttongroup">
                            {{-- <a class="saveddesigning">Your Saved Designs</a> --}}
                            <a class="startdesigning btn btn--primary px-4" href="{{route('room-design')}} ">{{ \App\CPU\translate('Start Designing')}}</a>
                            <!-- <button class="startdesigning" onclick="route('design')">Start Designing</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
              <div class="container rtl mb-3 overflow-hidden">
            <div class="py-2">
                <div class="new_arrival_product">
                    <div class="carousel-wrap">
                        <div class="owl-carousel owl-theme" id="new-arrivals-product">
                            @foreach($products as $key=>$product)

                                @include('web-views.partials._product-card-1',['product'=>$product, 'isRoom' => true])

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="container rtl">
            <div class="row g-3">
                    <!-- best selling product -->
                    @if ($bestSellProduct->count() >0)
                        @include('web-views.partials._best-selling')
                    @endif
                    <!-- top rated  product -->
                    @if ($topRated->count() >0)
                        @include('web-views.partials._top-rated')
                    @endif
            </div>
        </div> --}}
   {{-- whats description div --}}


        <!-- Products grid (featured products)-->
        @if ($products->count() > 0 )
            <div class="container mb-4">
                <div class="row __inline-62 shadow-0" style="background-color: #fafbfc !important;box-shadow: 0px 0px 0px !important;">
                    <div class="col-md-12" dir="rtl">
                        <div class="feature-product-title text-start">
                            {{ \App\CPU\translate('distinctive_3d_designs')}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="feature-product px-0 px-sm-4">
                            <div class="d-sm-none">
                                <div class="row" id="">
                                    @foreach($products as $product)
                                        <div class="col-6">
                                            @php($isRoomBuy = \App\Model\UserRoom::where([
                                                        'user_id' => auth('customer')->id(),
                                                        'room_id' => $product['id']
                                                    ])->get()->count())

                                            @include('web-views.partials._feature-product',['product'=>$product])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-none d-sm-block carousel-wrap p-1">
                                <div class="owl-carousel owl-theme " id="featured_products_list">
                                    @foreach($products as $product)
                                        <div>
                                            @php($isRoomBuy = \App\Model\UserRoom::where([
                                                        'user_id' => auth('customer')->id(),
                                                        'room_id' => $product['id']
                                                    ])->get()->count())

                                            @include('web-views.partials._feature-product',['product'=>$product])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif



        {{-- <div class="container rtl mt-4">
            <div class="arrival-title">
                <div>
                    <img src="{{asset('public/assets/front-end/png/new-arrivals.png')}}" alt="">

                </div>
                <div class="pl-2">
                    {{ \App\CPU\translate('ARRIVALS')}}
                </div>
            </div>
        </div> --}}

    </div>
@endsection

@push('script')

    {{-- Owl Carousel --}}
    <script src="{{asset('public/assets/front-end')}}/js/owl.carousel.min.js"></script>

    <script>
        $('#featured_products_list').owlCarousel({
            loop: true,
            autoplay: false,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{session("direction")}}': false,
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
                    items: 5
                },
                //Extra extra large
                1400: {
                    items: 5
                }
            }
        });
    </script>

@endpush
