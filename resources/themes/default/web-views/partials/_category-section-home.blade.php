@if ($categories->count() > 0)
    <section class="pb-4 rtl">
        <div class="container">
            <div class="__inlin-62">
                <div class="d-flex justify-content-between">
                    <div class="text-right fs-4 fw-bold px-3 text-dark mt-0"
                        style="color: {{ $web_config['primary_color'] }}">
                        {{ translate('categories') }}
                    </div>

                </div>
            </div>
            <div>
                <div class="card p-0 h-100 max-md-shadow-0 border-0">
                    <div class="card-body border-0 p-0" style="background-color: #fafafc;">
                        {{-- <div class="d-flex justify-content-between">
                            <div class="categories-title m-0">
                                <span class="font-semibold">{{ translate('categories')}}</span>
                            </div>
                            <div>
                                <a class="d-none d-sm-inline text-capitalize view-all-text" style="color: {{$web_config['primary_color']}}!important"
                                    href="{{route('categories')}}">{{ translate('view_all')}}
                                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                </a>
                            </div>
                        </div> --}}
                        <div class="d-none d-md-block">
                            <div class="row mt-3">
                                @foreach ($categories as $key => $category)
                                    @if ($key < 10)
                                        <div class="text-center __m-5px __cate-item">
                                            <a
                                                href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                                                <div class="__img">
                                                    <img style="border-radius: 100px;"
                                                        onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                        src="{{ asset("storage/app/public/category/$category->icon") }}"
                                                        alt="{{ $category->name }}">
                                                </div>
                                                <p class="text-center small mt-2">{{ Str::limit($category->name, 12) }}
                                                </p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="d-md-none">
                            <div class="row mt-3">
                                <div class="d-flex flex-row overflow-auto" style="gap: 10px;">                                    @foreach ($categories as $key => $category)
                                        @if ($key < 10)
                                            <div class="text-center __m-5px __cate-item">
                                                <a
                                                    href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                                                    <div class="__img">
                                                        <img style="border-radius: 100px;"
                                                            onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                            src="{{ asset("storage/app/public/category/$category->icon") }}"
                                                            alt="{{ $category->name }}">
                                                    </div>
                                                    <p class="text-center small mt-2">{{ Str::limit($category->name, 12) }}
                                                    </p>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
