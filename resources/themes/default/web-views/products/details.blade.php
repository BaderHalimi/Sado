@extends('layouts.front-end.app')

@section('title', $product['name'])

@push('css_or_js')
    <meta name="description" content="{{$product->slug}}">
    <meta name="keywords" content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
    @if($product->added_by=='seller')
        <meta name="author" content="{{ $product->seller->shop?$product->seller->shop->name:$product->seller->f_name}}">
    @elseif($product->added_by=='admin')
        <meta name="author" content="{{$web_config['name']->value}}">
    @endif
    <!-- Viewport-->

    @if($product['meta_image']!=null)
        <meta property="og:image" content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}"/>
        <meta property="twitter:card"
              content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}"/>
    @else
        <meta property="og:image" content="{{asset("storage/app/public/product/thumbnail")}}/{{$product->thumbnail}}"/>
        <meta property="twitter:card"
              content="{{asset("storage/app/public/product/thumbnail/")}}/{{$product->thumbnail}}"/>
    @endif

    @if($product['meta_title']!=null)
        <meta property="og:title" content="{{$product->meta_title}}"/>
        <meta property="twitter:title" content="{{$product->meta_title}}"/>
    @else
        <meta property="og:title" content="{{$product->name}}"/>
        <meta property="twitter:title" content="{{$product->name}}"/>
    @endif
    <meta property="og:url" content="{{route('product',[$product->slug])}}">

    @if($product['meta_description']!=null)
        <meta property="twitter:description" content="{!! $product['meta_description'] !!}">
        <meta property="og:description" content="{!! $product['meta_description'] !!}">
    @else
        <meta property="og:description"
              content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
        <meta property="twitter:description"
              content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
    @endif
    <meta property="twitter:url" content="{{route('product',[$product->slug])}}">

    <link rel="stylesheet" href="{{asset('public/assets/front-end/css/product-details.css')}}"/>
    <style>
        .cz-image-zoom-pane{
            direction: ltr;
        }
        .btn-number:hover {
            color: {{$web_config['secondary_color']}};

        }

        .for-total-price {
            margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: -30%;
        }

        .feature_header span {
            padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 15px;
        }

        .flash-deals-background-image{
            background: {{$web_config['primary_color']}}10;
        }

        @media (max-width: 768px) {
            .for-total-price {
                padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 30%;
            }

            .product-quantity {
                padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4%;
            }

            .for-margin-bnt-mobile {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 7px;
            }

        }

        @media (max-width: 375px) {
            .for-margin-bnt-mobile {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 3px;
            }

            .for-discount {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10% !important;
            }

            .for-dicount-div {
                margin-top: -5%;
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -7%;
            }

            .product-quantity {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4%;
            }

        }

        @media (max-width: 500px) {
            .for-dicount-div {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -5%;
            }

            .for-total-price {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: -20%;
            }

            .view-btn-div {
                float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}};
            }

            .for-discount {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7%;
            }
            .for-mobile-capacity {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7%;
            }
        }
    </style>
    <style>
        thead {
            background: {{$web_config['primary_color']}} !important;
        }
        /**/
    </style>
@endpush

@section('content')
    <!-- زر فتح المودال -->
{{-- <button type="button" onclick="togglerevModal()" class="btn btn-primary">
    عرض جميع التقييمات
</button> --}}

<!-- المودال -->
<div dir="rtl" class="modal fade" id="revviewModal" tabindex="-1" aria-labelledby="revviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="revviewModalLabel">{{ translate('all_reviews') }}</h5>
                <button type="button" class="btn-close btn btn-outline-danger" data-bs-dismiss="modal" aria-label="إغلاق">×</button>
            </div>
            <div class="modal-body" style="max-height: 70vh;overflow-y:scroll;">
                @if($reviews->count() > 0)
                    <ul class="list-group">
                        @foreach($reviews as $review)
                            <li class="list-group-item">
                                <div class="row align-items-start">
                                    <!-- صورة المستخدم أو أفاتار بالأحرف الأولى -->
                                    @php
                                        $customer = $review->customer;
                                        $initials = strtoupper(substr($customer->f_name, 0, 1) . substr($customer->l_name, 0, 1)); // استخراج الأحرف الأولى
                                        $avatar_url = 'https://ui-avatars.com/api/?name='.urlencode($customer->f_name.' '.$customer->l_name).'&background=random&color=fff&size=100';
                                    @endphp

                                <span class="col-4 col-md-2 my-3 text-center">
                                    <img loading="lazy" src="/{{ $customer->image }}" style="width: 50%; border-radius: 50px;"
                                    alt="{{ $customer->f_name.' '.$customer->l_name.' image' }}"
                                    onerror="this.onerror=null; this.src='{{ $avatar_url }}';">
                                    {{-- <span class="fw-bold d-block mt-3">{{ $customer->f_name.' '.$customer->l_name }}</span> --}}
                                </span>
                                    <div class="col-8 col-md-10">
                                        <h6 class="mb-1">{{ $customer->f_name }} {{ $customer->l_name }}</h6>
                                        <div class="my-2">
                                            <span>{{ number_format((float)$review->rating, 1) }}</span>
                                            @for($inc=1;$inc<=5;$inc++)
                                                @if ($inc <= (int)$review->rating)
                                                    <i class="tio-star text-warning"></i>
                                                @elseif ($review->rating != 0 && $inc <= (int)$review->rating + 1.1 && $review->rating > ((int)$review->rating))
                                                    <i class="tio-star-half text-warning"></i>
                                                @else
                                                    <i class="tio-star-outlined text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>

                                        <p class="mb-0" style="color:#858585;">{{ $review->comment??translate('no_comment') }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center text-muted">لا توجد تقييمات بعد.</p>
                @endif
            </div>
        </div>
    </div>
</div>


    <div class="__inline-23">
        <!-- Page Content-->
        <div class="container mt-4 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <!-- General info tab-->
            <div class="row {{Session::get('direction') === "rtl" ? '__dir-rtl' : ''}}">
                <!-- Product gallery-->
                <div class="col-lg-12 col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-12">
                            <div class="cz-product-gallery">
                                <div class="cz-preview">
                                    @if($product->images!=null && json_decode($product->images)>0)
                                        @if(json_decode($product->colors) && $product->color_image)
                                            @foreach (json_decode($product->color_image) as $key => $photo)
                                                @if($photo->color != null)
                                                    <div class="cz-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                         id="image{{$photo->color}}">
                                                        <img class="cz-image-zoom img-responsive w-100 __max-h-323px"
                                                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                             src="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                             data-zoom="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                             alt="Product image" width="">
                                                        <div class="cz-image-zoom-pane"></div>
                                                    </div>
                                                @else
                                                    <div class="cz-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                         id="image{{$key}}">
                                                        <img class="cz-image-zoom img-responsive w-100 __max-h-323px"
                                                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                             src="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                             data-zoom="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                             alt="Product image" width="">
                                                        <div class="cz-image-zoom-pane"></div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="cz-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                     id="image{{$key}}">
                                                    <img class="cz-image-zoom img-responsive w-100 __max-h-323px"
                                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                         src="{{asset("storage/app/public/product/$photo")}}"
                                                         data-zoom="{{asset("storage/app/public/product/$photo")}}"
                                                         alt="Product image" width="">
                                                    <div class="cz-image-zoom-pane"></div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>

                                <div class="d-flex flex-column gap-3">
                                    <button type="button" onclick="addWishlist('{{$product['id']}}')"
                                            class="btn __text-18px border wishlight-pos-btn d-sm-none">
                                        <i class="fa {{($wishlist_status == 1?'fa-heart':'fa-heart-o')}} wishlist_icon_{{$product['id']}}" style="color: {{$web_config['primary_color']}}"
                                        aria-hidden="true"></i>
                                    </button>

                                    <div style="text-align:{{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                        class="sharethis-inline-share-buttons share--icons">
                                    </div>
                                </div>

                                <div class="cz d-sm-block">{{-- d-sm-block --}}
                                    <div class="table-responsive __max-h-515px" data-simplebar>
                                        <div class="d-flex">
                                            @if($product->images!=null && json_decode($product->images)>0)
                                                @if(json_decode($product->colors) && $product->color_image)
                                                    @foreach (json_decode($product->color_image) as $key => $photo)
                                                        @if($photo->color != null)
                                                            <div class="cz-thumblist">
                                                                <a class="cz-thumblist-item  {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                                   id="preview-img{{$photo->color}}" href="#image{{$photo->color}}">
                                                                    <img
                                                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                        src="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                                        alt="Product thumb">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="cz-thumblist">
                                                                <a class="cz-thumblist-item  {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                                   id="preview-img{{$key}}" href="#image{{$key}}">
                                                                    <img
                                                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                        src="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                                        alt="Product thumb">
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach (json_decode($product->images) as $key => $photo)
                                                        <div class="cz-thumblist">
                                                            <a class="cz-thumblist-item  {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                               id="preview-img{{$key}}" href="#image{{$key}}">
                                                                <img
                                                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                    src="{{asset("storage/app/public/product/$photo")}}"
                                                                    alt="Product thumb">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product details-->
                        <div class="col-lg-7 col-md-8 col-12 mt-md-0 mt-sm-3" style="direction: {{ Session::get('direction') }}">
                            <div class="details __h-100">
                                <span class="mb-2 __inline-24">{{$product->name}}</span>
                                <div class="d-flex flex-wrap align-items-center mb-2 pro">
                                    <div class="star-rating" style="{{Session::get('direction') === "rtl" ? 'margin-left: 10px;' : 'margin-right: 10px;'}}">
                                        @for($inc=1;$inc<=5;$inc++)
                                            @if ($inc <= (int)$overallRating[0])
                                                <i class="tio-star text-warning"></i>
                                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                <i class="tio-star-half text-warning"></i>
                                            @else
                                                <i class="tio-star-outlined text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span
                                        class="d-inline-block  align-middle mt-1 {{Session::get('direction') === "rtl" ? 'ml-md-2 ml-sm-0' : 'mr-md-2 mr-sm-0'}} fs-14 text-muted">({{$overallRating[0]}})</span>
                                    {{-- <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span style="color: {{$web_config['primary_color']}}">{{$overallRating[1]}}</span> {{translate('reviews')}}</span>
                                    <span class="__inline-25"></span>
                                    <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span style="color: {{$web_config['primary_color']}}">{{$countOrder}}</span> {{translate('orders')}}   </span>
                                    <span class="__inline-25">    </span>
                                    <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}} text-capitalize"> <span style="color: {{$web_config['primary_color']}}"> {{$countWishlist}}</span> {{translate('wish_listed')}} </span> --}}

                                </div>
                                <div class="mb-3">
                                    <span class="f-20 font-weight-normal text-accent text-dark">
                                        {!! \App\CPU\Helpers::get_price_range_with_discount($product) !!}
                                    </span>
                                </div>

                                <form id="add-to-cart-form" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="position-relative {{Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'}} mb-2">
                                        @if (count(json_decode($product->colors)) > 0)
                                            <div class="flex-start align-items-center mb-2">
                                                <div class="product-description-label m-0 text-dark font-bold">{{translate('color')}}:
                                                </div>
                                                <div>
                                                    <ul class="list-inline checkbox-color mb-0 flex-start {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;">
                                                        @foreach (json_decode($product->colors) as $key => $color)
                                                            <li>
                                                                <input type="radio"
                                                                    id="{{ $product->id }}-color-{{ str_replace('#','',$color) }}"
                                                                    name="color" value="{{ $color }}"
                                                                    @if($key == 0) checked @endif>
                                                                <label style="background: {{ $color }};"
                                                                    for="{{ $product->id }}-color-{{ str_replace('#','',$color) }}"
                                                                    data-toggle="tooltip" onclick="focus_preview_image_by_color('{{ str_replace('#','',$color) }}')">
                                                                <span class="outline"></span></label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $qty = 0;
                                            if(!empty($product->variation)){
                                            foreach (json_decode($product->variation) as $key => $variation) {
                                                    $qty += $variation->qty;
                                                }
                                            }
                                        @endphp
                                    </div>
                                    @foreach (json_decode($product->choice_options) as $key => $choice)
                                        <div class="row flex-start mx-0 align-items-center">
                                            <div
                                                class="product-description-label text-dark font-bold {{Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'}} text-capitalize mb-2">{{ $choice->title }}
                                                :
                                            </div>
                                            <div>
                                                <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 mx-1 flex-start row"
                                                    style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;">
                                                    @foreach ($choice->options as $key => $option)
                                                        <div>
                                                            <li class="for-mobile-capacity">
                                                                <input type="radio"
                                                                    id="{{ $choice->name }}-{{ $option }}"
                                                                    name="{{ $choice->name }}" value="{{ $option }}"
                                                                    @if($key == 0) checked @endif >
                                                                <label class="__text-12px"
                                                                    for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                            </li>
                                                        </div>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Quantity + Add to cart -->
                                    <div class="mt-3">
                                        <div class="product-quantity d-flex flex-column __gap-15 p-0 px-sm-2">
                                            <!-- quantity section -->
                                            {{-- <div class="d-flex align-items-center gap-3">
                                                <div class="product-description-label text-dark font-bold mt-0">{{translate('quantity')}}:</div>

                                            </div> --}}
                                            <div id="chosen_price_div p-0">
                                                <div class="d-none d-sm-flex justify-content-start align-items-center {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">
                                                    {{-- <div class="product-description-label text-dark font-bold text-capitalize"><strong>{{translate('total_price')}}</strong> : </div>
                                                    &nbsp; <strong id="chosen_price" class="text-base"></strong> --}}
                                                    <span class="{{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}  font-regular">
                                                        <small class="text-muted" style="font-size: 1rem;">* {{translate('tax')}} </small>
                                                        {{-- <span id="set-tax-amount"></span>) --}}
                                                    </span>
                                                </div>
                                                <div class="d-flex d-sm-none justify-content-start p-0">
                                                    {{-- <div class="product-description-label text-dark font-bold text-capitalize"><strong>{{translate('total_price')}}</strong> : </div>
                                                    &nbsp; <strong id="chosen_price" class="text-base"></strong> --}}
                                                    <span class="{{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}  font-regular">
                                                        <small class="text-muted" style="font-size: 12px;">* {{translate('tax')}} </small>
                                                        {{-- <span id="set-tax-amount"></span>) --}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters mt-2 flex-start d-flex">
                                        <div class="col-12">
                                            @if(($product['product_type'] == 'physical') && ($product['current_stock']<=0))
                                                <h5 class="mt-3 text-danger">{{translate('out_of_stock')}}</h5>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="__btn-grp mt-2 mb-3 d-flex">
                                        <div class="d-flex justify-content-center align-items-center quantity-box border rounded border-base"
                                                    style="color: {{$web_config['primary_color']}}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10" type="button"
                                                                data-type="minus" data-field="quantity"
                                                                disabled="disabled" style="color: {{$web_config['primary_color']}}">
                                                            -
                                                        </button>
                                                    </span>
                                                    <input type="text" name="quantity"
                                                        class="form-control input-number text-center cart-qty-field __inline-29 border-0 "
                                                        placeholder="1" value="{{ $product->minimum_order_qty ?? 1 }}" product-type="{{ $product->product_type }}" min="{{ $product->minimum_order_qty ?? 1 }}" max="{{$product['product_type'] == 'physical' ? $product->current_stock : 100}}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10" type="button" product-type="{{ $product->product_type }}" data-type="plus"
                                                                data-field="quantity" style="color: {{$web_config['primary_color']}}">
                                                        +
                                                        </button>
                                                    </span>
                                                </div>
                                        @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date <= $seller_vacation_end_date))) ||
                                         ($product->added_by == 'admin' && ($inhouse_temporary_close || ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <= $inhouse_vacation_end_date))))
                                                <button class="btn btn-warning string-limit" type="button" disabled>
                                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.85992 15.5761H18.6053C18.964 15.5761 19.2771 15.2814 19.2771 14.8854C19.2771 14.4894 18.964 14.1948 18.6053 14.1948H8.01627C7.49142 14.1948 7.16927 13.8263 7.08638 13.2649L6.93906 12.2981H18.6234C19.9678 12.2981 20.6584 11.4691 20.8517 10.1527L21.5883 5.28163C21.6081 5.16599 21.6204 5.04921 21.6252 4.93199C21.6252 4.49003 21.2937 4.18596 20.7873 4.18596H5.75145L5.57624 3.01681C5.48431 2.30771 5.22659 1.94824 4.28767 1.94824H1.05524C0.687131 1.94824 0.374023 2.27117 0.374023 2.63967C0.374023 3.01681 0.687131 3.33935 1.05563 3.33935H4.16745L5.64067 13.4491C5.83434 14.7566 6.52459 15.5761 7.85992 15.5761ZM20.0597 5.57628L19.4068 9.98689C19.3329 10.5577 19.0292 10.9077 18.4859 10.9077L6.73713 10.9168L5.95417 5.57628H20.0597ZM8.58749 20.0511C8.78383 20.0527 8.97853 20.0152 9.16024 19.9409C9.34196 19.8665 9.50704 19.7567 9.64588 19.6178C9.78472 19.479 9.89454 19.3139 9.96892 19.1322C10.0433 18.9505 10.0808 18.7558 10.0792 18.5594C10.0801 18.3633 10.0421 18.1689 9.96742 17.9875C9.89277 17.8062 9.78293 17.6414 9.64423 17.5027C9.50554 17.364 9.34075 17.2541 9.15937 17.1795C8.97799 17.1048 8.78363 17.0669 8.58749 17.0677C7.74992 17.0677 7.08677 17.7309 7.08677 18.5594C7.08677 19.3974 7.74992 20.0511 8.58749 20.0511ZM17.1966 20.0511C18.0345 20.0511 18.6973 19.3974 18.6973 18.5594C18.6973 17.7305 18.0345 17.0677 17.1966 17.0677C16.368 17.0677 15.6958 17.7309 15.6958 18.5594C15.6958 19.3974 16.368 20.0511 17.1966 20.0511Z" fill="#202020"/>
                                                    </svg> &ThinSpace;
                                                    {{translate('add_to_cart')}}
                                                </button>
                                            <button class="btn btn--primary" type="button" disabled>
                                                {{translate('buy_now')}}
                                            </button>
                                        @else
                                        <button
                                            class="btn btn-warning element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                            onclick="addToCart()" type="button">
                                            <span class="string-limit"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.85992 15.5761H18.6053C18.964 15.5761 19.2771 15.2814 19.2771 14.8854C19.2771 14.4894 18.964 14.1948 18.6053 14.1948H8.01627C7.49142 14.1948 7.16927 13.8263 7.08638 13.2649L6.93906 12.2981H18.6234C19.9678 12.2981 20.6584 11.4691 20.8517 10.1527L21.5883 5.28163C21.6081 5.16599 21.6204 5.04921 21.6252 4.93199C21.6252 4.49003 21.2937 4.18596 20.7873 4.18596H5.75145L5.57624 3.01681C5.48431 2.30771 5.22659 1.94824 4.28767 1.94824H1.05524C0.687131 1.94824 0.374023 2.27117 0.374023 2.63967C0.374023 3.01681 0.687131 3.33935 1.05563 3.33935H4.16745L5.64067 13.4491C5.83434 14.7566 6.52459 15.5761 7.85992 15.5761ZM20.0597 5.57628L19.4068 9.98689C19.3329 10.5577 19.0292 10.9077 18.4859 10.9077L6.73713 10.9168L5.95417 5.57628H20.0597ZM8.58749 20.0511C8.78383 20.0527 8.97853 20.0152 9.16024 19.9409C9.34196 19.8665 9.50704 19.7567 9.64588 19.6178C9.78472 19.479 9.89454 19.3139 9.96892 19.1322C10.0433 18.9505 10.0808 18.7558 10.0792 18.5594C10.0801 18.3633 10.0421 18.1689 9.96742 17.9875C9.89277 17.8062 9.78293 17.6414 9.64423 17.5027C9.50554 17.364 9.34075 17.2541 9.15937 17.1795C8.97799 17.1048 8.78363 17.0669 8.58749 17.0677C7.74992 17.0677 7.08677 17.7309 7.08677 18.5594C7.08677 19.3974 7.74992 20.0511 8.58749 20.0511ZM17.1966 20.0511C18.0345 20.0511 18.6973 19.3974 18.6973 18.5594C18.6973 17.7305 18.0345 17.0677 17.1966 17.0677C16.368 17.0677 15.6958 17.7309 15.6958 18.5594C15.6958 19.3974 16.368 20.0511 17.1966 20.0511Z" fill="#202020"/>
                                            </svg> &ThinSpace;
                                            {{translate('add_to_cart')}}</span>
                                        </button>
                                            <button class="btn btn--primary element-center __iniline-26 btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" onclick="buy_now()" type="button">
                                                <span class="string-limit">{{translate('buy_now')}}</span>
                                            </button>
                                        @endif
                                        <style>
                                            .btn-warning{
                                                background-color: #ffc146 !important;
                                                border-color: #ffc146 !important;
                                                color: black !important;
                                            }
                                        </style>

                                        @if($product->room_id > 0)
                                            <a
                                                class="btn btn--primary element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                                href="{{route('room-view',$product->room_id)}}" type="button">
                                                <span class="string-limit">{{translate('View 3D Room')}}</span>
                                            </a>
                                        @endif
                                        <button type="button" onclick="addWishlist('{{$product['id']}}')"
                                                class="btn __text-18px border d-none px-3 bg-light d-sm-block">
                                            <i class="fa {{($wishlist_status == 1?'fa-heart':'fa-heart-o')}} wishlist_icon_{{$product['id']}}" style="color: {{$web_config['primary_color']}}"
                                            aria-hidden="true"></i>
                                            {{-- <span class="fs-14 text-muted align-bottom countWishlist-{{$product['id']}}">{{$countWishlist}}</span> --}}
                                        </button>
                                        @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date <= $seller_vacation_end_date))) ||
                                         ($product->added_by == 'admin' && ($inhouse_temporary_close || ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <= $inhouse_vacation_end_date))))
                                            <div class="alert alert-danger" role="alert">
                                                {{translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')}}
                                            </div>
                                        @endif
                                    </div>
                                </form>
                                <hr>
                                @if($product->added_by=='seller')
                            @if(isset($product->seller->shop))
                                <div class="my-3">
                                    <label><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_96_2190)">
                                        <path d="M11.8187 0.5H8.18116L7.55358 4.26562H12.4463L11.8187 0.5ZM18.7147 0.900586C18.6758 0.783932 18.6012 0.682473 18.5014 0.610578C18.4016 0.538683 18.2818 0.499998 18.1588 0.5L13.0068 0.5L13.6344 4.26562H19.8363L18.7147 0.900586ZM7.448 5.4375H12.5523V9.20312H7.448V5.4375Z" fill="#307EC4"/>
                                        <path d="M13.724 5.4375V9.20305H17.5729V13.0521H2.42707V9.20305H6.27602V5.4375H0V8.61719C0 8.94078 0.262344 9.20309 0.585938 9.20309H1.2552V19.9141C1.2552 20.2376 1.51754 20.5 1.84113 20.5H18.1589C18.4825 20.5 18.7448 20.2376 18.7448 19.9141V9.20309H19.4141C19.7377 9.20309 20 8.94078 20 8.61719V5.4375H13.724ZM1.84113 0.5C1.71816 0.5 1.5983 0.538692 1.49854 0.610594C1.39878 0.682496 1.32417 0.783964 1.28527 0.900625L0.163594 4.26562H6.36555L6.99316 0.5H1.84113Z" fill="#307EC4"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_96_2190">
                                        <rect width="20" height="20" fill="white" transform="translate(0 0.5)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                         &ThinSpace; {{ translate('explore_other_products_from') }} <a class="text-primary" href="{{route('shopView',['id'=>$product->seller->id])}}">{{ $product->seller->shop->name }} ></a></label>


                                </div>
                                @endif
                                @endif
                                @if ($product['details'])
                                    <hr>
                                    <div class="d-flex justify-content-between pt-3">
                                        <div class="fw-bold">{{ translate('Description') }}</div>
                                        <div>
                                            <a class="text-primary" href="javascript:void(0);" onclick="showFullDescription()">
                                                <small>{{ translate('show_full_description') }}</small>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- الوصف المختصر (سطرين فقط) --}}
                                    <div id="short-description" class="text-body col-lg-12 col-md-12 fs-13 text-justify my-3" style="display: block; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {!! $product['details'] !!}
                                    </div>

                                    {{-- الوصف الكامل (مخفي بالبداية) --}}
                                    {{-- <div id="full-description" class="text-body col-lg-12 col-md-12 fs-13 text-justify my-3" style="display: none;">
                                        {!! $product['details'] !!}
                                    </div> --}}


                                @endif


                            </div>
                        </div>
                    </div>
                    <div class="row d-none" id="full-description">
                        <div class="mt-4 rtl col-12" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <div class="row" >
                                <div class="col-12">
                                    <div>
                                        <div class="px-4 pb-3 mb-3 mr-0 mr-md-2 bg-white __review-overview __rounded-10 pt-3">
                                            <!-- Tabs-->
                                            <ul class="nav nav-tabs nav--tabs d-flex justify-content-center mt-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link __inline-27 active " href="#overview" data-toggle="tab" role="tab">
                                                        {{translate('overview')}}
                                                    </a>
                                                </li>
                                                {{-- <li class="nav-item">
                                                    <a class="nav-link __inline-27" href="#reviews" data-toggle="tab" role="tab">
                                                        {{translate('reviews')}}
                                                    </a>
                                                </li> --}}
                                                {{-- @if($product->room_id > 0)
                                                    <li class="nav-item">
                                                        <a class="nav-link __inline-27" href="#comments" data-toggle="tab" role="tab">
                                                            {{translate('comments')}}
                                                        </a>
                                                    </li>
                                                @endif --}}
                                            </ul>
                                            <div class="tab-content px-lg-3">
                                                <!-- Tech specs tab-->
                                                <div class="tab-pane fade show active text-justify" id="overview" role="tabpanel">
                                                    <div class="row pt-2 specification">

                                                        @if($product->video_url != null && (str_contains($product->video_url, "youtube.com/embed/")))
                                                            <div class="col-12 mb-4">
                                                                <iframe width="420" height="315"
                                                                        src="{{$product->video_url}}">
                                                                </iframe>
                                                            </div>
                                                        @endif
                                                        @if ($product['details'])
                                                            <div class="text-body col-lg-12 col-md-12 overflow-scroll fs-13 text-justify">
                                                                {!! $product['details'] !!}
                                                            </div>
                                                        @endif

                                                    </div>
                                                    @if (!$product['details'] && ($product->video_url == null || !(str_contains($product->video_url, "youtube.com/embed/"))))
                                                        <div>
                                                            <div class="text-center text-capitalize">
                                                                <img class="mw-90" src="{{asset('/public/assets/front-end/img/icons/nodata.svg')}}" alt="">
                                                                <p class="text-capitalize mt-2">
                                                                    <small>{{translate('product_details_not_found')}}!</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Reviews tab-->
                                                {{-- <div class="tab-pane fade" id="reviews" role="tabpanel">
                                                    @if(count($product->reviews)==0 && $reviews_of_product->total() == 0)
                                                        <div>
                                                            <div class="text-center text-capitalize">
                                                                <img class="mw-100" src="{{asset('/public/assets/front-end/img/icons/empty-review.svg')}}" alt="">
                                                                <p class="text-capitalize">
                                                                    <small>{{translate('No_review_given_yet')}}!</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row pt-2 pb-3">
                                                            <div class="col-lg-4 col-md-5 ">
                                                                <div class=" row d-flex justify-content-center align-items-center">
                                                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                                                        <h2 class="overall_review mb-2 __inline-28">
                                                                            {{$overallRating[0]}}
                                                                        </h2>
                                                                    </div>
                                                                    <div  class="d-flex justify-content-center align-items-center star-rating ">
                                                                        @for($inc=1;$inc<=5;$inc++)
                                                                            @if ($inc <= (int)$overallRating[0])
                                                                                <i class="tio-star text-warning"></i>
                                                                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                                                <i class="tio-star-half text-warning"></i>
                                                                            @else
                                                                                <i class="tio-star-outlined text-warning"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <div class="col-12 d-flex justify-content-center align-items-center mt-2">
                                                                        <span class="text-center">
                                                                            {{$reviews_of_product->total()}} {{translate('ratings')}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0" >
                                                                <div class="d-flex align-items-center mb-2 font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle text-body">{{translate('excellent')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress text-body __h-5px">
                                                                            <div class="progress-bar " role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;width: <?php echo $widthRating = ($rating[0] != 0) ? ($rating[0] / $overallRating[1]) * 100 : (0); ?>%;"
                                                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 text-body">
                                                                        <span
                                                                            class=" {{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}} ">
                                                                            {{$rating[0]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('good')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;width: <?php echo $widthRating = ($rating[1] != 0) ? ($rating[1] / $overallRating[1]) * 100 : (0); ?>%; background-color: #a7e453;"
                                                                                aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                                {{$rating[1]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('average')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;width: <?php echo $widthRating = ($rating[2] != 0) ? ($rating[2] / $overallRating[1]) * 100 : (0); ?>%; background-color: #ffda75;"
                                                                                aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                            {{$rating[2]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt "><span
                                                                            class="d-inline-block align-middle">{{translate('below_Average')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;width: <?php echo $widthRating = ($rating[3] != 0) ? ($rating[3] / $overallRating[1]) * 100 : (0); ?>%; background-color: #fea569;"
                                                                                aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                                class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                            {{$rating[3]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('poor')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;backbround-color:{{$web_config['primary_color']}};width: <?php echo $widthRating = ($rating[4] != 0) ? ($rating[4] / $overallRating[1]) * 100 : (0); ?>%;"
                                                                                aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                                {{$rating[4]}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row pb-4 mb-3">
                                                            <div class="__inline-30">
                                                                <span class="text-capitalize">{{ translate('Product_review') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="row pb-4">
                                                        <div class="col-12" id="product-review-list">
                                                            @include('web-views.partials.product-reviews')
                                                        </div>

                                                        @if(count($product->reviews) > 2)
                                                        <div class="col-12">
                                                            <div class="card-footer d-flex justify-content-center align-items-center">
                                                                <button class="btn text-white view_more_button" style="background: {{$web_config['primary_color']}};" onclick="load_review()">{{translate('view_more')}}</button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div> --}}
{{-- @if($product->room_id > 0)
    <!-- Comments Tab -->
    <div class="tab-pane fade" id="comments" role="tabpanel">
        <div class="row pt-2 pb-3">
            <div class="col-12">
                <form action="{{ route('web.product.add-comment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group">
                        <label for="comment">{{ translate('Leave a comment') }}</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-secondary">{{ translate('comment') }}</button>
                </form>
            </div>
        </div>
        <div class="row pt-2 pb-3">
            <div class="col-12" id="comment-list">
                @include('web-views.partials.product-comments', ['product' => $product])
            </div>
        </div>
    </div>
@endif --}}



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
                    <div
                        class="my-5 row justify-content-center align-items-top g-2 px-3 px-sm-0"
                    >
                        <div class="col-sm-4 col-12 bg-white p-3" style="border-radius: 15px;">
                            <h4>{{ translate('customer_reviews') }}</h4>
                            <h2 class="fw-bold">{{ number_format((float)$overallRating[0], 1) }}</h2>
                            @for($inc=1;$inc<=5;$inc++)
                                @if ($inc <= (int)$overallRating[0])
                                    <i class="tio-star text-warning"></i>
                                @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                    <i class="tio-star-half text-warning"></i>
                                @else
                                    <i class="tio-star-outlined text-warning"></i>
                                @endif
                            @endfor
                            <label class="d-block" for="">({{ $total_reviews.' '.translate('review') }})</label>
                            <div>
                                <div class="px-3 row justify-content-center align-items-center g-2">
                                    <div class="col-1">5</div>
                                    <div class="col-10">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="height: 6px !important;width: {{ $total_reviews>0?(($rates_count['five_stars']/$total_reviews)*100):0 }}%;" aria-valuenow="{{$rates_count['five_stars']}}" aria-valuemin="0" aria-valuemax="5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">{{ $rates_count['five_stars'] }}</div>
                                    <div class="col-1">4</div>
                                    <div class="col-10">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="height: 6px !important;width: {{ $total_reviews>0?(($rates_count['four_stars']/$total_reviews)*100):0 }}%;" aria-valuenow="{{$rates_count['four_stars']}}" aria-valuemin="0" aria-valuemax="5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">{{ $rates_count['four_stars'] }}</div>
                                    <div class="col-1">3</div>
                                    <div class="col-10">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="height: 6px !important;width: {{ $total_reviews>0?(($rates_count['three_stars']/$total_reviews)*100):0 }}%;" aria-valuenow="{{$rates_count['three_stars']}}" aria-valuemin="0" aria-valuemax="5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">{{ $rates_count['three_stars'] }}</div>
                                    <div class="col-1">2</div>
                                    <div class="col-10">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="height: 6px !important;width: {{ $total_reviews>0?(($rates_count['two_stars']/$total_reviews)*100):0 }}%;" aria-valuenow="{{$rates_count['two_stars']}}" aria-valuemin="0" aria-valuemax="5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">{{ $rates_count['two_stars'] }}</div>
                                    <div class="col-1">1</div>
                                    <div class="col-10">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="height: 6px !important;width: {{ $total_reviews>0?(($rates_count['one_star']/$total_reviews)*100):0 }}%;" aria-valuenow="{{$rates_count['one_star']}}" aria-valuemin="0" aria-valuemax="5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">{{ $rates_count['one_star'] }}</div>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-4 col-12 p-3">
                            <h4 class="mb-5 d-none d-sm-block">{{ translate('top_rated') }}</h4>
                            <div class="d-sm-none d-flex justify-content-between">
                                <h5 class="d-sm-none pt-2">{{ translate('top_rated') }}</h5>
                                <button data-bs-toggle="modal" data-bs-target="#revviewModal" class="btn text-primary fs-4 py-0">{{ translate('read_all_reviews') }}</button>
                            </div>
                            @if(isset($top_rated[0]))
                            <div>
                                <span class="d-block mb-2" style="color: #858585 !important;">{{ $top_rated[0]->created_at->format('M d,Y') }}</span>
                                <div class="my-2">
                                    @for($inc=1;$inc<=5;$inc++)
                                        @if ($inc <= (int)$top_rated[0]->rating)
                                            <i class="tio-star text-warning"></i>
                                        @elseif ($top_rated[0]->rating != 0 && $inc <= (int)$top_rated[0]->rating + 1.1 && $top_rated[0]->rating > ((int)$top_rated[0]->rating))
                                            <i class="tio-star-half text-warning"></i>
                                        @else
                                            <i class="tio-star-outlined text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                @php
                                    $customer = $top_rated[0]->customer;
                                    $initials = strtoupper(substr($customer->f_name, 0, 1) . substr($customer->l_name, 0, 1)); // استخراج الأحرف الأولى
                                    $avatar_url = 'https://ui-avatars.com/api/?name='.urlencode($customer->f_name.' '.$customer->l_name).'&background=random&color=fff&size=100';
                                @endphp

                                <span class="d-block my-3">
                                    <span class="fw-bold">{{ $customer->f_name.' '.$customer->l_name }}</span>
                                    <img src="/{{ $customer->image }}" style="width: 36px;height: 36px; border-radius: 36px;"
                                        alt="{{ $customer->f_name.' '.$customer->l_name.' image' }}"
                                        onerror="this.onerror=null; this.src='{{ $avatar_url }}';">
                                </span>
                                <span class="d-block">
                                    {{ translate('"').$top_rated[0]->comment.translate('"') }}
                                </span>
                            </div>
                            @elseif (!isset($top_rated[1]))
                            <span>{{ translate('no_comment_found') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 col-12 d-none d-sm-block p-3">
                            <div class="d-block text-left">
                                <button data-bs-toggle="modal" data-bs-target="#revviewModal" class="btn mb-5 text-primary fs-4">{{ translate('read_all_reviews') }}</button>
                            </div>
                            @if (isset($top_rated[1]))
                            <div>
                                <span class="d-block mb-2" style="color: #858585 !important;">{{ $top_rated[1]->created_at->format('M d,Y') }}</span>
                                <div class="my-2">
                                    @for($inc=1;$inc<=5;$inc++)
                                        @if ($inc <= (int)$top_rated[1]->rating)
                                            <i class="tio-star text-warning"></i>
                                        @elseif ($top_rated[1]->rating != 0 && $inc <= (int)$top_rated[1]->rating + 1.1 && $top_rated[1]->rating > ((int)$top_rated[1]->rating))
                                            <i class="tio-star-half text-warning"></i>
                                        @else
                                            <i class="tio-star-outlined text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                @php
                                    $customer = $top_rated[1]->customer;
                                    $initials = strtoupper(substr($customer->f_name, 0, 1) . substr($customer->l_name, 0, 1)); // استخراج الأحرف الأولى
                                    $avatar_url = 'https://ui-avatars.com/api/?name='.urlencode($customer->f_name.' '.$customer->l_name).'&background=random&color=fff&size=100';
                                @endphp

                                <span class="d-block my-3">
                                    <span class="fw-bold">{{ $customer->f_name.' '.$customer->l_name }}</span>
                                    <img src="/{{ $customer->image }}" style="width: 36px;height: 36px; border-radius: 36px;"
                                        alt="{{ $customer->f_name.' '.$customer->l_name.' image' }}"
                                        onerror="this.onerror=null; this.src='{{ $avatar_url }}';">

                                </span>
                                <span class="d-block">
                                    {{ translate('"').$top_rated[1]->comment.translate('"') }}
                                </span>

                            </div>
                            @endif

                        </div>
                    </div>


                {{-- <div class="col-lg-3">
                    <!-- company reliability -->
                    @php($company_reliability = \App\CPU\Helpers::get_business_settings('company_reliability'))
                    @if($company_reliability != null)
                        <div class="product-details-shipping-details">
                            @foreach ($company_reliability as $key=>$value)
                            @if ($value['status'] == 1 && !empty($value['title']))
                                    <div class="shipping-details-bottom-border">
                                        <div class="px-3 py-3">
                                            <img class="{{Session::get('direction') === "rtl" ? 'float-right ml-2' : 'mr-2'}} __img-20"  src="{{asset("/storage/app/public/company-reliability").'/'.$value['image']}}"
                                            onerror="this.src='{{asset('/public/assets/front-end/img').'/'.$value['item'].'.png'}}'"
                                                    alt="">
                                            <span>{{translate($value['title'] ?? 'title_not_found')}}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <!-- end -->
                    <div class="__inline-31">
                        <!--seller section-->
                        @if($product->added_by=='seller')
                            @if(isset($product->seller->shop))
                                <div class="row position-relative">
                                    <div class="col-12 position-relative">
                                        <a href="{{route('shopView',['id'=>$product->seller->id])}}" class="d-block">
                                            <div class="d-flex __seller-author align-items-center">
                                                <div>
                                                    <img class="__img-60 img-circle" src="{{asset('storage/app/public/shop')}}/{{$product->seller->shop->image}}"
                                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                        alt="">
                                                </div>
                                                <div class="{{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}} w-0 flex-grow">
                                                    <h6 >
                                                        {{$product->seller->shop->name}}
                                                    </h6>
                                                    <span>{{translate('seller_info')}}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">

                                                @if(($product->added_by == 'seller' && ($seller_temporary_close || ($product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date <= $seller_vacation_end_date))))
                                                    <span class="chat-seller-info" style="position: absolute; inset-inline-end: 24px; inset-block-start: -4px" data-toggle="tooltip" title="{{translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')}}">
                                                        <img src="{{asset('/public/assets/front-end/img/info.png')}}" alt="i">
                                                    </span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row d-flex justify-content-between">
                                            <div class="col-6 ">
                                                <div class="d-flex justify-content-center align-items-center rounded __h-79px hr-right-before">
                                                    <div class="text-center">
                                                        <img src="{{asset('/public/assets/front-end/img/rating.svg')}}" class="mb-2" alt="">
                                                        <div class="__text-12px text-base">
                                                            <strong>{{$total_reviews}}</strong> {{translate('reviews')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex justify-content-center align-items-center rounded __h-79px">
                                                    <div class="text-center">
                                                    <img src="{{asset('/public/assets/front-end/img/products.svg')}}" class="mb-2" alt="">
                                                        <div class="__text-12px text-base">
                                                            <strong>{{$products_for_review->count()}}</strong> {{translate('products')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 position-static mt-3">
                                        <div class="chat_with_seller-btns">
                                            @if (auth('customer')->id())
                                                <button class="btn w-100 d-block text-center" style="background: {{$web_config['primary_color']}};color:#ffffff" data-toggle="modal"
                                                data-target="#chatting_modal" {{ ($product->seller->shop->temporary_close || ($product->seller->shop->vacation_status && date('Y-m-d') >= date('Y-m-d', strtotime($product->seller->shop->vacation_start_date)) && date('Y-m-d') <= date('Y-m-d', strtotime($product->seller->shop->vacation_end_date)))) ? 'disabled' : '' }}>
                                                <img src="{{asset('/public/assets/front-end/img/chat-16-filled-icon.png')}}" class="mb-1" alt="">
                                                    <span class="d-none d-sm-inline-block">{{translate('chat_with_seller')}}</span>
                                                </button>
                                            @else
                                                <a href="{{route('customer.auth.login')}}" class="btn w-100 d-block text-center" style="background: {{$web_config['primary_color']}};color:#ffffff" >
                                                    <img src="{{asset('/public/assets/front-end/img/chat-16-filled-icon.png')}}" class="mb-1" alt="">
                                                        <span class="d-none d-sm-inline-block">{{translate('chat_with_seller')}}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="row d-flex justify-content-between">
                                <div class="col-9 ">
                                    <a href="{{route('shopView',[0])}}" class="row d-flex ">
                                        <div>
                                            <img class="__inline-32"
                                                src="{{asset("storage/app/public/company")}}/{{$web_config['fav_icon']->value}}"
                                                onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                alt="">
                                        </div>
                                        <div class="{{Session::get('direction') === "rtl" ? 'right' : 'mt-3 ml-2'}}" onclick="location.href='{{route('shopView',[0])}}'">
                                            <span class="font-bold __text-16px">
                                                {{$web_config['name']->value}}
                                            </span><br>
                                        </div>

                                        @if($product->added_by == 'admin' && ($inhouse_temporary_close || ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <= $inhouse_vacation_end_date)))
                                            <div class="{{Session::get('direction') === "rtl" ? 'right' : 'ml-3'}}">
                                                <span class="chat-seller-info" data-toggle="tooltip" title="{{translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')}}">
                                                    <img src="{{asset('/public/assets/front-end/img/info.png')}}" alt="i">
                                                </span>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6 ">
                                            <div class="d-flex justify-content-center align-items-center rounded __h-79px hr-right-before">
                                                <div class="text-center">
                                                    <img src="{{asset('/public/assets/front-end/img/rating.svg')}}" class="mb-2" alt="">
                                                    <div class="__text-12px text-base">
                                                        <strong>{{$total_reviews}}</strong> {{translate('reviews')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-center align-items-center rounded __h-79px">
                                                <div class="text-center">
                                                   <img src="{{asset('/public/assets/front-end/img/products.svg')}}" class="mb-2" alt="">
                                                    <div class="__text-12px text-base">
                                                        <strong>{{$products_for_review->count()}}</strong> {{translate('products')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <a href="{{ route('shopView',[0]) }}" class="text-center d-block w-100">
                                        <button class="btn text-center d-block w-100" style="background: {{$web_config['primary_color']}};color:#ffffff" >
                                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                            {{translate('visit_Store')}}
                                        </button>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 pb-3">
                        <span class=" __text-16px font-bold text-capitalize">
                            {{ translate('more_from_the_store')}}
                        </span>
                    </div>
                    <div>
                        @foreach($more_product_from_seller as $item)
                            @include('web-views.partials.seller-products-product-details',['product'=>$item,'decimal_point_settings'=>$decimal_point_settings])
                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- for mobile -->
        <div class="bottom-sticky bg-white d-none">
            <div class="d-flex flex-column gap-1 py-2">
                <div class="d-flex justify-content-center align-items-center fs-13">
                    <div class="product-description-label text-dark font-bold"><strong class="text-capitalize">{{translate('total_price')}}</strong> : </div>
                    &nbsp; <strong id="chosen_price_mobile" class="text-base"></strong>
                    <small class="ml-2  font-regular">
                        (<small>{{translate('tax')}} : </small>
                        <small id="set-tax-amount-mobile"></small>)
                    </small>
                </div>
                <div class="d-flex gap-3 justify-content-center">
                    @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date <= $seller_vacation_end_date))) ||
                        ($product->added_by == 'admin' && ($inhouse_temporary_close || ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <= $inhouse_vacation_end_date))))
                        <button class="btn btn-secondary btn-sm btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" type="button" disabled>
                            {{translate('buy_now')}}
                        </button>
                        <button class="btn btn--primary btn-sm string-limit btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" type="button" disabled>
                            {{translate('add_to_cart')}}
                        </button>
                   @else
                       <button class="btn btn-secondary btn-sm btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" onclick="buy_now()" type="button">
                           <span class="string-limit">{{translate('buy_now')}}</span>
                       </button>
                       <button
                           class="btn btn--primary btn-sm string-limit btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                           onclick="addToCart()" type="button">
                           <span class="string-limit">{{translate('add_to_cart')}}</span>
                       </button>
                   @endif
                </div>
            </div>
        </div>
        <!-- end -->

        @if (count($relatedProducts)>0)
            <div class="container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                <div class="card _card border-0 mt-5" style="background-color: #fafafc !important;">
                    <div class="card-body">
                        <div class="row flex-between">
                            <div style="{{Session::get('direction') === "rtl" ? 'margin-right: 5px;' : 'margin-left: 5px;'}}">
                                <h4 class="text-capitalize font-bold mt-2">{{ translate('similar_products')}}</h4>
                            </div>
                            <div class="view_all d-flex justify-content-center align-items-center">
                                <div>
                                    @php($category=json_decode($product['category_ids']))
                                    @if($category)
                                        <a class="text-capitalize view-all-text py-0" style="color: #66717C !important;{{Session::get('direction') === "rtl" ? 'margin-left:10px;' : 'margin-right: 8px;'}}"
                                        href="{{route('products',['id'=> $category[0]->id,'data_from'=>'category','page'=>1])}}">{{ translate('view_all')}}
                                        {{-- <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 ' : 'right ml-1 mr-n1'}}"></i> --}}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Grid-->

                        <!-- Product-->
                        <div class="row g-3 mt-1 d-flex flex-nowrap overflow-auto">
                            @foreach($relatedProducts as $key => $relatedProduct)
                                @if($key < 4)
                                <div class="col-xl-3 col-sm-3 col-8">
                                    @include('web-views.partials._single-product',['product'=>$relatedProduct,'decimal_point_settings'=>$decimal_point_settings])
                                </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade rtl" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
            aria-hidden="true" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body flex justify-content-center">
                        <button class="btn btn-default __inline-33" style="{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -7px;"
                                data-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                        <img class="element-center" id="attachment-view" src="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('layouts.front-end.partials.modal._chatting',['seller'=>$product->seller])

    <div class="modal fade" id="remove-wishlist-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <div class="text-center">
                        <img src="{{asset('/public/assets/front-end/img/icons/remove-wishlist.png')}}" alt="">
                        <h6 class="font-semibold mt-3 mb-4 mx-auto __max-w-220">{{translate('Product_has_been_removed_from_wishlist')}}?</h6>
                    </div>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="javascript:" class="btn btn--primary __rounded-10" data-dismiss="modal">
                            {{translate('Okay')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
             $('.nav-tabs a[href="#comments"]').on('shown.bs.tab', function (e) {
        console.log('Comments tab is now visible');
    });


            const $stickyElement = $('.bottom-sticky');
            const $offsetElement = $('.product-details-shipping-details');

            $(window).on('scroll', function() {
                const elementOffset = $offsetElement.offset().top;
                const scrollTop = $(window).scrollTop();

                if (scrollTop >= elementOffset) {
                    $stickyElement.addClass('stick');
                } else {
                    $stickyElement.removeClass('stick');
                }
            });
        });
    </script>

    <script type="text/javascript">
        cartQuantityInitialize();
        getVariantPrice();
        $('#add-to-cart-form input').on('change', function () {
            getVariantPrice();
        });

        function showInstaImage(link) {
            $("#attachment-view").attr("src", link);
            $('#show-modal-view').modal('toggle')
        }

        function focus_preview_image_by_color(key){
            $('a[href="#image'+key+'"]')[0].click();
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
$(document).ready(function() {
    $('.nav-tabs a[href="#comments"]').on('shown.bs.tab', function (e) {
        console.log('Comments tab is now visible');
    });

    $('form[action="{{ route('web.product.add-comment') }}"]').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let data = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                // Assuming the response contains the newly added comment
                $.ajax({
                    url: "{{ route('web.product.comments', $product->id) }}",
                    type: 'GET',
                    success: function (commentsHtml) {
                        $('#comment-list').html(commentsHtml);
                        form[0].reset();
                        toastr.success('Comment added successfully');
                    },
                    error: function (xhr) {
                        toastr.error('Error loading comments');
                    }
                });
            },
            error: function (xhr) {
                toastr.error('Error adding comment');
            }
        });
    });

  $('.delete-comment-btn').on('click', function() {
        var commentId = $(this).data('comment-id');
        if(confirm('Are you sure you want to delete this comment?')) {
            $.ajax({
                url: '/comments/' + commentId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        alert('Comment deleted successfully');
                        location.reload();
                    } else {
                        alert('Error deleting comment');
                    }
                }
            });
        }
    });

        // التعامل مع زر الحذف للردود
    $('.delete-reply-btn').on('click', function() {
        var replyId = $(this).data('reply-id');
        if(confirm('Are you sure you want to delete this reply?')) {
            $.ajax({
                url: '/replies/' + replyId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        alert('Reply deleted successfully');
                        location.reload();
                    } else {
                        alert('Error deleting reply');
                    }
                }
            });
        }
    });
    // التعامل مع زر الرد
    $(document).on('click', '.reply-btn', function() {
        let commentId = $(this).data('comment-id');
        let replyFormHtml = `
            <div class="reply-form-container">
                <form class="reply-form" action="{{ route('web.product.add-reply') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="comment_id" value="${commentId}">
                    <div class="form-group">
                        <label for="reply">{{ translate('Reply') }}</label>
                        <textarea class="form-control" id="reply" name="comment" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ translate('Reply') }}</button>
                </form>
            </div>
        `;
        $(this).parent().append(replyFormHtml);
        $(this).remove(); // إزالة زر الرد بعد النقر
    });

    // التعامل مع إرسال نموذج الرد
    $(document).on('submit', '.reply-form', function(e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let data = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                $.ajax({
                    url: "{{ route('web.product.comments', $product->id) }}",
                    type: 'GET',
                    success: function(commentsHtml) {
                        $('#comment-list').html(commentsHtml);
                        toastr.success('Reply added successfully');
                    },
                    error: function(xhr) {
                        toastr.error('Error loading comments');
                    }
                });
            },
            error: function(xhr) {
                toastr.error('Error adding reply');
            }
        });
    });

    // التعامل مع زر الإعجاب
 $(document).on('click', '.like-btn', function() {
    let commentId = $(this).data('comment-id');
    let likeButton = $(this);

    $.ajax({
        url: '{{ route('web.product.like-comment') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            comment_id: commentId
        },
        success: function(response) {
            if (response.message === 'Comment liked successfully!') {
                likeButton.addClass('liked');
                likeButton.text('{{ translate("Unlike") }}');
            } else {
                likeButton.removeClass('liked');
                likeButton.text('{{ translate("Like") }}');
            }
            toastr.success(response.message);
        },
        error: function(xhr) {
            toastr.error('Error processing like');
        }
    });
});

});


    </script>
    <script>
        let load_review_count = 1;
        function load_review()
        {

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
            $.ajax({
                    type: "post",
                    url: '{{route('review-list-product')}}',
                    data:{
                        product_id:{{$product->id}},
                        offset:load_review_count
                    },
                    success: function (data) {
                        $('#product-review-list').append(data.productReview)
                        if(data.checkReviews == 0){
                            $('.view_more_button').removeClass('d-none').addClass('d-none')
                        }else{
                            $('.view_more_button').addClass('d-none').removeClass('d-none')
                        }
                    }
                });
                load_review_count++
        }
    </script>

    {{-- Messaging with shop seller --}}
    <script>
         $('#chat-form').on('submit', function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: '{{route('messages_store')}}',
                data: $('#chat-form').serialize(),
                success: function (respons) {

                    toastr.success('{{translate("message_send_successfully")}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $('#chat-form').trigger('reset');
                }
            });

        });
    </script>


    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"
            async="async"></script>
            <!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            {{-- <script>
                function togglerevModal() {
                    var modalElement = document.getElementById('revviewModal');
                    var myModal = bootstrap.Modal.getInstance(modalElement);

                    if (myModal) {
                        myModal.hide(); // إذا كان مفتوحًا، يتم إغلاقه
                    } else {
                        myModal = new bootstrap.Modal(modalElement);
                        myModal.show(); // إذا كان مغلقًا، يتم فتحه
                    }
                }
            </script> --}}
            <script>
                function showFullDescription() {
                    // document.getElementById('short-description').style.display = 'none';
                    document.getElementById('full-description').classList.remove('d-none');
                    document.getElementById('full-description').classList.add('d-block');
                }
            </script>
@endpush
