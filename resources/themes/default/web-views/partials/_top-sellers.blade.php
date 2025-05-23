<div class="container rtl pt-4 px-0 px-md-3">
    <div class="seller-card">
        <div class="card h-100 border-0">
            <div class="card-body" style="background-color: #fafafc !important;">
                <div class="d-flex justify-content-between">
                    <div class="text-right fs-4 fw-bold px-3 text-dark mt-0"
                        style="color: {{ $web_config['primary_color'] }}">
                        {{ translate('top_sellers') }}
                    </div>
                    <div class="text-end px-3">
                        <a class="text-capitalize view-all-text d-md-none text-dark"
                        style="color: #66717C !important;"
                        href="{{ route('sellers') }}">
                        {{ translate('view_all') }}
                        </a>

                        <a class="text-capitalize view-all-text d-none d-md-inline text--primary"
                        href="{{ route('sellers') }}"
                        style="color: {{ $web_config['primary_color'] }} !important">
                        {{ translate('view_all') }}
                        </a>

                    </div>
                </div>

                <div class="mt-3">
                    <div class="others-store-slide row g-4 d-flex justify-content-between">
                        <!-- Others Store Card -->

                        @foreach ($top_sellers as $key=>$seller)
                            @if($key!=4)
                            {{-- <a href="{{route('shopView',['id'=>$seller['id']])}}" class="others-store-card text-capitalize"> --}}
                            <div class="col-sm-6 col-12">
                                <div class="row justify-content-center align-items-center g-2 p-0 overflow-hidden bg-white border" style="border-radius: 16px;">
                                    <div class="col-4" style="height: 190px;">
                                        <img src="{{ asset('storage/app/public/shop/banner/' . $seller->shop->banner) }}"
                                            onerror="this.src='{{ asset('/public/assets/front-end/img/seller-banner.png') }}'"
                                            class="w-100 h-100 object-cover" alt="">
                                    </div>
                                    <div class="col-8">
                                        <span>{{ $seller->shop->name }}</span>
                                        <div class="d-flex align-items-center">
                                            {{-- <h6 style="color:{{ $web_config['primary_color'] }}">
                                                {{ number_format($seller->average_rating, 1) }}</h6>
                                            <i class="tio-star text-star mx-1"></i>
                                            <small>{{ translate('rating') }}</small> --}}
                                            <span class="d-inline-block font-size-sm text-body">
                                                @for($inc=1;$inc<=5;$inc++)
                                                    @if ($inc <= (int)number_format($seller->average_rating, 1))
                                                        <i class="tio-star text-warning"></i>
                                                    @elseif (number_format($seller->average_rating, 1) != 0 && $inc <= (int)number_format($seller->average_rating, 1) + 1.1 && number_format($seller->average_rating, 1) > ((int)number_format($seller->average_rating, 1)))
                                                        <i class="tio-star-half text-warning"></i>
                                                    @else
                                                        <i class="tio-star-outlined text-warning"></i>
                                                    @endif
                                                @endfor
                                                <label class="badge-style">( {{ number_format($seller->average_rating, 1) }} )</label>
                                            </span>
                                        </div>
                                        <div class="info-item">
                                            <span>{{ translate('number_of_products') }} : </span>
                                            <span style="color:{{ $web_config['primary_color'] }}">
                                                {{ $seller->product_count < 1000 ? $seller->product_count : number_format($seller->product_count / 1000, 1) . 'K' }}
                                            </span>
                                        </div>
                                        <a href="{{route('shopView',['id'=>$seller->id])}}" class="btn btn--primary">{{ translate('explore_now') }}</a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            {{-- <div class="overflow-hidden other-store-banner">
                                    <img src="{{asset('storage/app/public/shop/banner/'.$seller->shop->banner)}}"
                                        onerror="this.src='{{ asset('/public/assets/front-end/img/seller-banner.png') }}'"
                                        class="w-100 h-100 object-cover" alt="">
                                </div>
                                <div class="name-area">
                                    <div class="position-relative">
                                        <div class="overflow-hidden other-store-logo rounded-full">
                                            <img class="rounded-full" onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                src="{{ asset('storage/app/public/shop/'.$seller->shop->image)}}" alt="others-store">
                                        </div>
                                        <!-- Temporary Closed Store Status -->
                                        @if ($seller->shop->temporary_close || ($seller->shop->vacation_status && $current_date >= $seller->shop->vacation_start_date && $current_date <= $seller->shop->vacation_end_date))
                                            <span class="temporary-closed position-absolute text-center rounded-full">
                                                <span>{{translate('closed_now')}}</span>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="info pt-2">
                                        <h5 >{{ $seller->shop->name }}</h5>
                                        <div class="d-flex align-items-center">
                                            <h6 style="color:{{$web_config['primary_color']}}">{{number_format($seller->average_rating,1)}}</h6>
                                            <i class="tio-star text-star mx-1"></i>
                                            <small>{{ translate('rating') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-area">
                                    <div class="info-item">
                                        <h6 style="color:{{$web_config['primary_color']}}">{{$seller->review_count < 1000 ? $seller->review_count : number_format($seller->review_count/1000 , 1).'K'}}</h6>
                                        <span>{{ translate('reviews') }}</span>
                                    </div>
                                    <div class="info-item">
                                        <h6 style="color:{{$web_config['primary_color']}}">{{$seller->product_count < 1000 ? $seller->product_count : number_format($seller->product_count/1000 , 1).'K'}}</h6>
                                        <span>{{ translate('products') }}</span>
                                    </div>
                                </div> --}}
                            {{-- </a> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
