<style>
    .__cart-table td {
        vertical-align: middle !important;
    }
</style>
@php($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method'))
@php($cart=\App\Model\Cart::where(['customer_id' => (auth('customer')->check() ? auth('customer')->id() : session('guest_id'))])->get()->groupBy('cart_group_id'))

@if($cart->count() != 0)
<div class="d-none d-sm-block feature_header mb-4 mt-5 pt-5">
    <span>{{ \App\CPU\translate('shopping_cart')}}</span>
</div>
<div class="d-sm-none container feature_header mb-4 mt-3 pt-3">
    <span>{{ \App\CPU\translate('shopping_cart')}}</span>
</div>
@endif


<div class="row m-0 container" style="max-width:100%;">
    <!-- List of items-->
    <section class="@if($cart->count() == 0) col-lg-12 @else col-lg-8 @endif">
            @if(count($cart)==0)
                @php($physical_product = false)
            @endif

            @foreach($cart as $group_key=>$group)
            <div class="card __card cart_information mb-3">
                @foreach($group as $cart_key=>$cartItem)
                    @if ($shippingMethod=='inhouse_shipping')
                            <?php

                            $admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first();
                            $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';

                            ?>
                    @else
                            <?php
                            if ($cartItem->seller_is == 'admin') {
                                $admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first();
                                $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                            } else {
                                $seller_shipping = \App\Model\ShippingType::where('seller_id', $cartItem->seller_id)->first();
                                $shipping_type = isset($seller_shipping) == true ? $seller_shipping->shipping_type : 'order_wise';
                            }
                            ?>
                    @endif

                    @if($cart_key==0 && $cartItem['product_type'] != 'room')
                        <div class="card-header">
                            @if($cartItem->seller_is=='admin')
                            <b>
                                <span>{{ \App\CPU\translate('shop_name')}} : </span>
                                <a href="{{route('shopView',['id'=>0])}}">{{\App\CPU\Helpers::get_business_settings('company_name')}}</a>
                            </b>
                        @else
                            <b>
                                <span>{{ \App\CPU\translate('shop_name')}}:</span>
                                <a href="{{route('shopView',['id'=>$cartItem->seller_id])}}">
                                    {{\App\Model\Shop::where(['seller_id'=>$cartItem['seller_id']])->first()->name}}
                                </a>
                            </b>
                        @endif
                        </div>
                    @endif
                @endforeach
                <div class="table-responsive mt-3">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table __cart-table">
                        <thead class="thead-light">
                            <tr class="">
                                <th class="font-weight-bold __w-5p d-none d-sm-table-cell">{{\App\CPU\translate('SL#')}}</th>
                                @if ( $shipping_type != 'order_wise')
                                <th class="font-weight-bold __w-30p">{{\App\CPU\translate('product_details')}}</th>
                                @else
                                <th class="font-weight-bold __w-45">{{\App\CPU\translate('product_details')}}</th>
                                @endif
                                <th class="font-weight-bold __w-15p">{{\App\CPU\translate('unit_price')}}</th>
                                <th class="font-weight-bold __w-15p">{{\App\CPU\translate('qty')}}</th>
                                <th class="font-weight-bold __w-15p">{{\App\CPU\translate('price')}}</th>
                                @if ( $shipping_type != 'order_wise')
                                    <th class="font-weight-bold __w-15p">{{\App\CPU\translate('shipping_cost')}} </th>
                                @endif
                                <th class="font-weight-bold __w-5p"></th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            $physical_product = false;
                            foreach ($group as $row) {
                                if ($row->product_type == 'physical') {
                                    $physical_product = true;
                                }
                            }
                        ?>
                        @foreach($group as $cart_key=>$cartItem)
                            <tr>
                                <td class="d-none d-sm-table-cell">{{$cart_key+1}}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center g-2">
                                        <div class="__w-30p">
                                            <a href="{{$cartItem['product_type'] == 'room'? route('room-view', $cartItem['product_id']) : route('product',$cartItem['slug'])}}">
                                                <img class="rounded __img-62 align-middle"
                                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                        src="{{$cartItem['product_type'] == 'room'? '' : \App\CPU\ProductManager::product_image_path('thumbnail').'/'}}{{$cartItem['thumbnail']}}"
                                                        alt="Product">
                                            </a>
                                        </div>
                                        <div class="ml-2 text-break __line-2 __w-70p">
                                            <a href="{{$cartItem['product_type'] == 'room'? route('room-view', $cartItem['product_id']) : route('product',$cartItem['slug'])}}">{{$cartItem['name']}}</a>

                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-center align-items-center g-2">

                                        @foreach(json_decode($cartItem['variations'],true) as $key1 =>$variation)
                                            <div class="text-muted mr-2">
                                                <span class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} __text-12px">
                                                    {{$key1}} : {{$variation}}</span>

                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div
                                            class=" text-accent">{!! \App\CPU\Helpers::currency_converter($cartItem['price']-$cartItem['discount']) !!}</div>
                                        @if($cartItem['discount'] > 0)
                                            <strike class="__inline-18">
                                                {!!\App\CPU\Helpers::currency_converter($cartItem['price'])!!}
                                            </strike>
                                        @endif
                                        </div>
                                </td>
                                <td>
                                    <div>
                                        @if($cartItem['product_type'] == 'room')
                                            <input class="__cart-input" type="number" name="quantity[{{ $cartItem['id'] }}]" id="cartQuantity{{$cartItem['id']}}"
                                             min="{{1}}" value="{{$cartItem['quantity']}}" disabled>
                                        @else
                                            @php($minimum_order=\App\Model\Product::select('minimum_order_qty')->find($cartItem['product_id']))
                                            <input class="__cart-input" type="number" name="quantity[{{ $cartItem['id'] }}]" id="cartQuantity{{$cartItem['id']}}"
                                            onchange="updateCartQuantity('{{ $minimum_order->minimum_order_qty }}', '{{$cartItem['id']}}')" min="{{ $minimum_order->minimum_order_qty ?? 1 }}" value="{{$cartItem['quantity']}}">
                                        @endif

                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {!! \App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity']) !!}
                                    </div>
                                </td>
                                <td>
                                    @if ( $shipping_type != 'order_wise')
                                        {!! \App\CPU\Helpers::currency_converter($cartItem['shipping_cost']) !!}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-link px-0 text-danger"
                                            onclick="removeFromCart({{ $cartItem['id'] }})" type="button"><i
                                            class="czi-close-circle {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"></i>
                                    </button>
                                </td>
                                </tr>

                                @if($physical_product && $shippingMethod=='sellerwise_shipping' && $shipping_type == 'order_wise')
                                    @php($choosen_shipping=\App\Model\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first())

                                    @if(isset($choosen_shipping)==false)
                                        @php($choosen_shipping['shipping_method_id']=0)
                                    @endif

                                    @php($shippings=\App\CPU\Helpers::get_shipping_methods($cartItem['seller_id'],$cartItem['seller_is']))
                                    <tr>
                                        <td colspan="4">

                                            @if($cart_key==$group->count()-1)

                                                <!-- choosen shipping method-->

                                                <div class="row">

                                                    <div class="col-12">
                                                        <select class="form-control"
                                                                onchange="set_shipping_id(this.value,'{{$cartItem['cart_group_id']}}')">
                                                            <option>{{\App\CPU\translate('choose_shipping_method')}}</option>
                                                            @foreach($shippings as $shipping)
                                                                <option
                                                                    value="{{$shipping['id']}}" {{$choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                                                                    {!!$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])!!}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                    @endif
                                </td>
                                <td colspan="3">
                                    @if($cart_key==$group->count()-1)
                                    <div class="row">
                                        <div class="col-12">
                                            <span>
                                                <b>{{\App\CPU\translate('shipping_cost')}} : </b>
                                            </span>
                                            {!!\App\CPU\Helpers::currency_converter($choosen_shipping['shipping_method_id']!= 0?$choosen_shipping->shipping_cost:0)!!}
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <div
                        class="text-left d-none d-sm-block"
                    >
                            <!-- تحقق من عدد العناصر في العربة -->
                            @if($cart->count() > 0)
                                <button id="empty-cart-button" onclick="removeAllFromCart()" class="btn btn-danger"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 21C6.45 21 5.97933 20.8043 5.588 20.413C5.19667 20.0217 5.00067 19.5507 5 19V6H4V4H9V3H15V4H20V6H19V19C19 19.55 18.8043 20.021 18.413 20.413C18.0217 20.805 17.5507 21.0007 17 21H7ZM9 17H11V8H9V17ZM13 17H15V8H13V17Z" fill="white"/>
                                    </svg>
                                     تفريغ العربة</button>
                            @endif
                    </div>
                    <div
                        class="text-right d-sm-none mx-2 mb-2"
                    >
                            <!-- تحقق من عدد العناصر في العربة -->
                            @if($cart->count() > 0)
                                <button id="empty-cart-button" onclick="removeAllFromCart()" class="btn btn-danger"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 21C6.45 21 5.97933 20.8043 5.588 20.413C5.19667 20.0217 5.00067 19.5507 5 19V6H4V4H9V3H15V4H20V6H19V19C19 19.55 18.8043 20.021 18.413 20.413C18.0217 20.805 17.5507 21.0007 17 21H7ZM9 17H11V8H9V17ZM13 17H15V8H13V17Z" fill="white"/>
                                    </svg>
                                     تفريغ العربة</button>
                            @endif
                    </div>

                </div>
            </div>
            @endforeach

@if($shippingMethod=='inhouse_shipping')
        <?php
            $admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first();
            $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
        ?>
    @if ($shipping_type == 'order_wise' && $physical_product)
        @php($shippings=\App\CPU\Helpers::get_shipping_methods(1,'admin'))
        @php($choosen_shipping=\App\Model\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first())

        @if(isset($choosen_shipping)==false)
            @php($choosen_shipping['shipping_method_id']=0)
        @endif
        <div class="row">
            <div class="col-12">
                <select class="form-control" onchange="set_shipping_id(this.value,'all_cart_group')">
                    <option>{{\App\CPU\translate('choose_shipping_method')}}</option>
                    @foreach($shippings as $shipping)
                        <option
                            value="{{$shipping['id']}}" {{$choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                            {!!$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])!!}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
@endif


<!-- رسالة "العربة فارغة" -->
@if($cart->count() == 0)
    <div class="text-center my-5 justify-content-center align-items-center">
        <svg width="250" height="250" viewBox="0 0 250 250" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="250" height="250" fill="url(#pattern0_114_4164)"/>
            <defs>
            <pattern id="pattern0_114_4164" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_114_4164" transform="scale(0.00195312)"/>
            </pattern>
            <image id="image0_114_4164" width="512" height="512" xlink:href="data:image/png;base64,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"/>
            </defs>
            </svg>

        <h4 class="text-primary text-capitalize">{{\App\CPU\translate('cart_empty')}}</h4>
        <label>{{ \App\CPU\translate('lets_do_some_shopping') }}</label>
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-sm-2 col-6 my-4">
                <a class="btn btn-primary w-100" href="{{ route('home') }}">{{ \App\CPU\translate('shop_now') }}</a>
                <style>
                    .btn-primary{
                        background-color: #2e7ec4 !important;
                        border-color: #2e7ec4 !important;
                    }
                </style>
            </div>
        </div>

    </div>
@else

        <form class="d-none d-sm-block" method="get">
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <label for="phoneLabel" class="form-label input-label">{{\App\CPU\translate('order_note')}} <span
                                            class="input-label-secondary">({{\App\CPU\translate('Optional')}})</span></label>
                        <textarea class="form-control w-100" id="order_note" name="order_note">{{ session('order_note')}}</textarea>
                    </div>
                </div>
            </div>
        </form>
@endif


        {{-- <div class="d-flex btn-full-max-sm align-items-center __gap-6px flex-wrap justify-content-between">
            <a href="{{route('home')}}" class="btn btn--primary">
                <i class="fa fa-{{Session::get('direction') === "rtl" ? 'forward' : 'backward'}} px-1"></i> {{\App\CPU\translate('continue_shopping')}}
            </a>
            <a onclick="checkout()"
            class="btn btn--primary pull-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}">
                {{\App\CPU\translate('checkout')}}
                <i class="fa fa-{{Session::get('direction') === "rtl" ? 'backward' : 'forward'}} px-1"></i>
            </a>

        </div> --}}
</section>
<!-- Sidebar-->
@if($cart->count() != 0)
@include('web-views.partials._order-summary')
<div class="">
<form class="d-sm-none w-100 mt-4" method="get">
    <div class="form-group">
        <div class="row">
            <div class="col-12">
                <label for="phoneLabel" class="form-label input-label">{{\App\CPU\translate('order_note')}} <span
                                    class="input-label-secondary">({{\App\CPU\translate('Optional')}})</span></label>
                <textarea class="form-control w-100" id="order_note" name="order_note">{{ session('order_note')}}</textarea>
            </div>
        </div>
    </div>
</form>
</div>

@endif

</div>


<script>
    cartQuantityInitialize();

    function set_shipping_id(id, cart_group_id) {
        $.get({
            url: '{{url('/')}}/customer/set-shipping-method',
            dataType: 'json',
            data: {
                id: id,
                cart_group_id: cart_group_id
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                location.reload();
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
</script>
<script>
    function checkout() {
        let order_note = $('#order_note').val();
        //console.log(order_note);
        $.post({
            url: "{{route('order_note')}}",
            data: {
                _token: '{{csrf_token()}}',
                order_note: order_note,

            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                let url = "{{ route('checkout-details') }}";
                location.href = url;

            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
function removeAllFromCart() {
    $.get({
        url: "{{ route('cart.remove-all') }}",
        beforeSend: function () {
            $('#loading').show();
        },
        success: function (data) {
            location.reload();
        },
        complete: function () {
            $('#loading').hide();
        },
    });
}

</script>
