<style>
    .filter-group {
        margin-bottom: 20px;
    }

    .filter-title {
        font-weight: bold;
        color: #007bff;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .price-slider {
        position: relative;
        width: 100%;
        height: 6px;
        background: #ddd;
        border-radius: 5px;
    }

    .range-input {
        position: relative;
        width: 100%;
    }

    .range-input input {
        position: absolute;
        width: 100%;
        top: -5px;
        z-index: 10;
        -webkit-appearance: none;
        appearance: none;
        background: transparent;
        pointer-events: none;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        background: #ffffff;
        border: 1px solid #007bff;
        border-radius: 50%;
        cursor: pointer;
        pointer-events: all;
        position: relative;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .progress-bar {
        position: absolute;
        height: 6px;
        background: #5b91cf;
        border-radius: 5px;
        z-index: 1;
    }

    /* .price-values {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
        font-weight: bold;
        position: relative;
    }
    .price-bubble {
        position: absolute;
        top: -30px;
        background: #007bff;
        color: white;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
        transform: translateX(-50%);
    } */
    #searchInputBtn {
        pointer-events: auto !important;
        z-index: 9999; /* اجعله فوق جميع العناصر الأخرى */
    }

</style>
<div class="filter-sidebar">

    <!-- 🔍 شريط البحث -->
    <div class="mb-3 position-relative d-sm-none">
        <button id="searchInputBtn" class="btn p-0 m-0 position-absolute" style="left: 10px; top:7px;">
            <span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_109_1646)">
                        <path
                            d="M19.4062 19.3281L15.7969 15.7344C16.4531 15.0885 16.9427 14.349 17.2656 13.5156C17.5885 12.6927 17.7474 11.8542 17.7422 11C17.737 10.1458 17.5677 9.30729 17.2344 8.48438C16.901 7.65104 16.401 6.91146 15.7344 6.26562C15.099 5.61979 14.375 5.13542 13.5625 4.8125C12.75 4.47917 11.9167 4.3151 11.0625 4.32031C10.2083 4.32552 9.36979 4.49479 8.54688 4.82812C7.72396 5.16146 6.98438 5.66146 6.32812 6.32812C5.68229 6.98438 5.19792 7.72396 4.875 8.54688C4.55208 9.36979 4.39062 10.2109 4.39062 11.0703C4.39062 11.9297 4.5625 12.7708 4.90625 13.5938C5.23958 14.4167 5.73958 15.151 6.40625 15.7969C6.96875 16.3698 7.60938 16.8177 8.32812 17.1406C9.03646 17.4531 9.77344 17.6432 10.5391 17.7109C11.3047 17.7786 12.0677 17.7188 12.8281 17.5312C13.5781 17.3333 14.2812 17 14.9375 16.5312L18.5938 20.2031C18.6979 20.2969 18.8333 20.3438 19 20.3438C19.1667 20.3438 19.3021 20.2969 19.4062 20.2031C19.5312 20.0677 19.5938 19.9141 19.5938 19.7422C19.5938 19.5703 19.5312 19.4323 19.4062 19.3281ZM5.67188 11.0625C5.67188 10.3125 5.8125 9.60938 6.09375 8.95312C6.38542 8.28646 6.77865 7.70573 7.27344 7.21094C7.76823 6.71615 8.34896 6.32292 9.01562 6.03125C9.68229 5.73958 10.3906 5.59375 11.1406 5.59375C11.8906 5.59375 12.5938 5.73958 13.25 6.03125C13.9167 6.32292 14.4974 6.71615 14.9922 7.21094C15.487 7.70573 15.8802 8.28646 16.1719 8.95312C16.4531 9.60938 16.5938 10.3125 16.5938 11.0625C16.5938 11.8125 16.4531 12.5208 16.1719 13.1875C15.8802 13.8542 15.487 14.4349 14.9922 14.9297C14.4974 15.4245 13.9167 15.8125 13.25 16.0938C12.5938 16.3854 11.8906 16.5312 11.1406 16.5312C10.3906 16.5312 9.68229 16.3854 9.01562 16.0938C8.34896 15.8125 7.76823 15.4245 7.27344 14.9297C6.77865 14.4349 6.38542 13.8542 6.09375 13.1875C5.8125 12.5208 5.67188 11.8125 5.67188 11.0625Z"
                            fill="#ABABAB" />
                    </g>
                    <defs>
                        <clipPath id="clip0_109_1646">
                            <rect width="16" height="16" fill="white" transform="matrix(1 0 0 -1 4 20)" />
                        </clipPath>
                    </defs>
                </svg>

            </span>
        </button>
        <input id="searchInputText" type="text" class="form-control" placeholder="بحث">
    </div>

    <!-- 🏠 الفئات -->
    <div class="filter-group">
        <div class="fs-3 mb-2 text-primary filter-title">{{ translate('Categories') }}</div>
        @foreach (\App\CPU\CategoryManager::parents() as $category)
            <div>
                {{-- onclick="location.href='{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}'" --}}
                <input type="checkbox" id="category{{$category['id']}}">
                <label for="category{{$category['id']}}">{{ $category['name'] }} @if ($category->product->count() > 0)
                    ({{$category->product->count()}})
                @endif</label>
            </div>
            {{-- <div class="menu--caret-accordion">
                <div class="card-header flex-between">
                    <div>
                        <label class="for-hover-lable cursor-pointer"
                            >

                        </label>
                    </div>
                    <div class="px-2 cursor-pointer menu--caret">
                        <strong class="pull-right for-brand-hover">
                            @if ($category->childes->count() > 0)
                                <i class="tio-next-ui fs-13"></i>
                            @endif
                        </strong>
                    </div>
                </div>
                <div class="card-body p-0 {{ Session::get('direction') === 'rtl' ? 'mr-2' : 'ml-2' }}"
                    id="collapse-{{ $category['id'] }}" style="display: none">
                    @foreach ($category->childes as $child)
                        <div class="menu--caret-accordion">
                            <div class="for-hover-lable card-header flex-between">
                                <div>
                                    <label class="cursor-pointer"
                                        onclick="location.href='{{ route('products', ['id' => $child['id'], 'data_from' => 'category', 'page' => 1]) }}'">
                                        {{ $child['name'] }}
                                    </label>
                                </div>
                                <div class="px-2 cursor-pointer menu--caret">
                                    <strong class="pull-right">
                                        @if ($child->childes->count() > 0)
                                            <i class="tio-next-ui fs-13"></i>
                                        @endif
                                    </strong>
                                </div>
                            </div>
                            <div class="card-body p-0 {{ Session::get('direction') === 'rtl' ? 'mr-2' : 'ml-2' }}"
                                id="collapse-{{ $child['id'] }}" style="display: none">
                                @foreach ($child->childes as $ch)
                                    <div class="card-header">
                                        <label class="for-hover-lable d-block cursor-pointer text-left"
                                            onclick="location.href='{{ route('products', ['id' => $ch['id'], 'data_from' => 'category', 'page' => 1]) }}'">
                                            {{ $ch['name'] }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
        @endforeach

        {{-- <div>
            <input type="checkbox" id="category2">
            <label for="category2">غرف نوم (30)</label>
        </div>
        <div>
            <input type="checkbox" id="category3">
            <label for="category3">أسرّة ومراتب (50)</label>
        </div>
        <div>
            <input type="checkbox" id="category4">
            <label for="category4">كراسي (40)</label>
        </div> --}}
    </div>



    <!-- 🎨 اللون -->
    <div class="filter-group">
        <div class="mt-4 mb-2 fs-3 text-primary filter-title">اللون</div>

        @php
            $colors = \App\Model\Color::all();
            $visibleColors = $colors->take(10); // أول 10 ألوان
            $hiddenColors = $colors->slice(10); // الألوان المخفية
        @endphp

        @foreach ($visibleColors as $color)
        <div>
            <input type="checkbox" id="color{{ $color->id }}">
            <label for="color{{ $color->id }}">{{ translate($color->name) }}</label>
        </div>
        @endforeach

        <div id="hiddenColors" style="display: none;">
            @foreach ($hiddenColors as $color)
            <div>
                <input type="checkbox" id="color{{ $color->id }}">
                <label for="color{{ $color->id }}">{{ translate($color->name) }}</label>
            </div>
            @endforeach
        </div>

        @if ($hiddenColors->count() > 0)
        <a href="#" class="text-primary small" id="showMoreColors">المزيد..</a>
        @endif
    </div>

    <!-- 💰 السعر -->
    <div class="filter-sidebar">

        <!-- 💰 شريط السعر المحسّن -->
        <div class="filter-group">
            <div class="filter-title">السعر</div>
            <div class="price-slider">
                <div class="progress-bar" id="progress"></div>
                <div class="range-input">
                    <input type="hidden" id="priceChanged" value="false">
                    <input type="range" id="minPrice" min="0" max="3000" value="0" step="50">
                    <input type="range" id="maxPrice" min="50" max="3000" value="1000" step="50">
                </div>
            </div>
            <div class="price-values mt-3">
                <span>{{ translate('price') }}</span>
                <span class="price-bubble" id="minPriceBubble">SAR 100</span> -
                <span class="price-bubble" id="maxPriceBubble">SAR 75</span>
            </div>
        </div>

    </div>

</div>

<script>
    const minPrice = document.getElementById("minPrice");
    const maxPrice = document.getElementById("maxPrice");
    const minPriceBubble = document.getElementById("minPriceBubble");
    const maxPriceBubble = document.getElementById("maxPriceBubble");
    const progress = document.getElementById("progress");

    function updatePriceRange() {
        document.getElementById("priceChanged").value="true";
        let minVal = parseInt(minPrice.value);
        let maxVal = parseInt(maxPrice.value);

        if (minVal >= maxVal) {
            minVal = maxVal - 1;
            minPrice.value = minVal;
        }

        const minPercent = ((minVal - minPrice.min) / (minPrice.max - minPrice.min)) * 100;
        const maxPercent = ((maxVal - minPrice.min) / (minPrice.max - minPrice.min)) * 100;

        progress.style.right = minPercent + "%";
        progress.style.width = (maxPercent - minPercent) + "%";

        minPriceBubble.textContent = `SAR ${minVal}`;
        maxPriceBubble.textContent = `SAR ${maxVal==3000?'100,000':maxVal}`;

        minPriceBubble.style.right = minPercent + "%";
        maxPriceBubble.style.right = maxPercent + "%";
    }

    minPrice.addEventListener("input", updatePriceRange);
    maxPrice.addEventListener("input", updatePriceRange);

    updatePriceRange(); // تحديث القيم عند التحميل

    document.addEventListener("DOMContentLoaded", function () {
        let showMoreBtn = document.getElementById("showMoreColors");
        let hiddenColorsDiv = document.getElementById("hiddenColors");

        if (showMoreBtn) {
            showMoreBtn.addEventListener("click", function (e) {
                e.preventDefault();
                hiddenColorsDiv.style.display = "block";
                showMoreBtn.style.display = "none"; // إخفاء زر المزيد بعد الضغط
            });
        }
    });
</script>
