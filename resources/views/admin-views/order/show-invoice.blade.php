<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{Session::get('direction')}}"
      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
    <style media="all">
        * {
            margin: 0;
            padding: 0;
            line-height: 1.3;
            font-family: sans-serif;
            color: #333542;
        }


        /* IE 6 */
        * html .footer {
            position: absolute;
            top: expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
        }
        /* تنسيق الفاتورة بحيث تكون مناسبة لورق A4 */
.first {
    margin: 0 auto;
    width: 21cm; /* عرض الورق A4 */
    height: 26.7cm; /* طول الورق A4 */
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* تخصيص العنوان والشعار */
.invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.invoice-header h1 {
    font-size: 24px;
    margin: 0;
}

.invoice-header img {
    width: 100px;
    height: auto;
}

/* تنسيق تفاصيل الفاتورة */
.invoice-details {
    margin-bottom: 20px;
}

.invoice-details h4 {
    margin: 5px 0;
}

/* تنسيق رمز الاستجابة السريعة */
.qr-code {
    text-align: center;
    margin-top: 20px;
}

.qr-code #qrcode {
    width: 128px;
    height: 128px;
    margin: 0 auto;
}
  .invoice-details th,
    .invoice-details td {
        border-bottom: 1px solid #ddd; /* خط فاصل بين الصفوف */
        padding: 8px; /* تباعد داخلي */
    }

    .invoice-details th.separator {
        border-right: 1px solid #ddd; /* خط فاصل بين الأعمدة */
    }

        body {
            font-size: .75rem;
        }

        img {
            max-width: 100%;
        }

        .customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        table {
            width: 100%;
        }

        table thead th {
            padding: 8px;
            font-size: 11px;
            padding-left: 78px;
        }

        table tbody th,
        table tbody td {
            padding: 8px;
            font-size: 11px;
        }

        table.fz-12 thead th {
            font-size: 12px;
        }

        table.fz-12 tbody th,
        table.fz-12 tbody td {
            font-size: 12px;
        }

        table.customers thead th {
            background-color: #0177CD;
            color: #fff;
        }

        table.customers tbody th,
        table.customers tbody td {
            background-color: #FAFCFF;
        }

        table.calc-table th {
            text-align: left;
        }

        table.calc-table td {
            text-align: right;
        }
        table.calc-table td.text-left {
            text-align: left;
        }

        .table-total {
            font-family: Arial, Helvetica, sans-serif;
        }


        .text-left {
            text-align: left !important;
        }

        .pb-2 {
            padding-bottom: 8px !important;
        }

        .pb-3 {
            padding-bottom: 16px !important;
        }

        .text-right {
            text-align: right;
        }

        table th.text-right {
            text-align: right !important;
        }

        .content-position {
            padding: 15px 40px;
        }

        .content-position-y {
            padding: 0px 40px;
        }

        .text-white {
            color: white !important;
        }

        .bs-0 {
            border-spacing: 0;
        }
        .text-center {
            text-align: center;
        }
        .mb-1 {
            margin-bottom: 4px !important;
        }
        .mb-2 {
            margin-bottom: 8px !important;
        }
        .mb-4 {
            margin-bottom: 24px !important;
        }
        .mb-30 {
            margin-bottom: 30px !important;
        }
        .px-10 {
            padding-left: 10px;
            padding-right: 10px;
        }
        .fz-14 {
            font-size: 14px;
        }
        .fz-12 {
            font-size: 12px;
        }
        .fz-10 {
            font-size: 10px;
        }
        .font-normal {
            font-weight: 400;
        }
        .border-dashed-top {
            border-top: 1px dashed #ddd;
        }
        .font-weight-bold {
            font-weight: 700;
        }
        .bg-light {
            background-color: #F7F7F7;
        }
        .py-30 {
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .py-4 {
            padding-top: 24px;
            padding-bottom: 24px;
        }
        .d-flex {
            display: flex;
        }
        .gap-2 {
            gap: 8px;
        }
        .flex-wrap {
            flex-wrap: wrap;
        }
        .align-items-center {
            align-items: center;
        }
        .justify-content-center {
            justify-content: center;
        }
        a {
            color: rgba(0, 128, 245, 1);
        }
        .p-1 {
            padding: 4px !important;
        }
        .h2 {
            font-size: 1.5em;
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .h4 {
            margin-block-start: 1.33em;
            margin-block-end: 1.33em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

    </style>
</head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="{{asset('public/assets/back-end/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/back-end/js/qrcode.js')}}"></script>

<body>
  

<div class="first">
    
    <div>
        <h1 class="text-center">فاتورة ضريبية</h1>
    </div>

    <div class="invoice-details">
   
                <table class="content-position-y fz-12">
                         <tr>
                             <td class="font-weight-bold p-1">
                                         <img src="{{ asset("storage/app/public/company/$company_web_logo") }}" alt="Company Logo" height="40">

                                  <div class="invoice-number">
            <h4>
                {{translate('Invoice_numder')}} #{{ $order->id }} {{ $order->order_type == 'POS' ? '(POS Order)' : '' }}
            </h4>
        </div>
        <div class="invoice-date">
            <h4>{{ translate('Date') }}: {{ date('d-m-Y h:i:s a', strtotime($order['created_at'])) }}</h4>
        </div>
        <div class="store-name">
            <h4>{{ translate('Store_Name') }}: {{ $order->seller_is == 'admin' ? $company_name : (isset($order->seller->shop) ? $order->seller->shop->name : 'Not Found') }}</h4>
            @if($order['seller_is'] != 'admin' && isset($order['seller']) && $order['seller']->gst != null)
                <h4 class="text-capitalize fz-12">{{ translate('GST_Number') }} : {{ $order['seller']->gst }}</h4>
            @endif
        </div>
                             </td>
                             <td class="font-weight-bold p-1">
                                 
    <div class="qr-code">
        <h5>
            <div id="qrcode"></div>
        </h5>
        <script type="text/javascript">
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: "{{ $result ?? '' }}",
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        </script>
    </div>
                                 
                             </td>
                         </tr>
                    
                    </table>
                    
               
       
    </div>

    <div class="">
    <section>
        <table class="content-position-y fz-12">
            <tr>
                <td class="font-weight-bold p-1">
                    <table>
                        <tr>
                            <td>
                                @if($order->shipping_address_data)
                                    @php
                                        $shipping_address = json_decode($order->shipping_address_data)
                                    @endphp
                                    <span class="h2" style="margin: 0px;">{{translate('shipping_to')}}</span>
                                    <div class="h4 montserrat-normal-600">
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$shipping_address->contact_person_name}}</p>
                                        @if($order->is_guest && isset($shipping_address->email))
                                            <p style=" margin-top: 6px; margin-bottom:0px;">{{$shipping_address->email}}</p>
                                        @endif
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$shipping_address->phone}}</p>
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$shipping_address->address}}</p>
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{ $shipping_address->city }} {{ $shipping_address->zip }} </p>
                                    </div>
                                @else
                                    <span class="h2" style="margin: 0px;">Customer Info</span>
                                    <div class="h4 montserrat-normal-600">
                                        @if($order->is_guest)
                                            <p style=" margin-top: 6px; margin-bottom:0px;">Guest User</p>
                                        @else
                                            <p style=" margin-top: 6px; margin-bottom:0px;">{{ $order->customer !=null? $order->customer['f_name'].' '.$order->customer['l_name']:'Name not found' }}</p>
                                        @endif

                                        @if (isset($order->customer) && $order->customer['id']!=0)
                                            <p style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['email']: 'Email not found' }}</p>
                                            <p style=" margin-top: 6px; margin-bottom:0px;">{{$order->customer !=null? $order->customer['phone']: 'Phone not found' }}</p>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>

                <td>
                    <table>
                        <tr>
                            <td class="text-right">
                                @if($order->billing_address_data)
                                    @php
                                        $billingAddress = json_decode($order->billing_address_data)
                                    @endphp
                                    <span class="h2" >{{translate('Billing_Address')}}</span>
                                    <div class="h4 montserrat-normal-600">
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$billingAddress->contact_person_name}}</p>
                                        @if($order->is_guest && isset($billingAddress->email))
                                            <p style=" margin-top: 6px; margin-bottom:0px;">{{$billingAddress->email}}</p>
                                        @endif
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$billingAddress->phone}}</p>
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$billingAddress->address}}</p>
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$billingAddress->city}} {{$billingAddress->zip}}</p>
                                    </div>
                                @elseif($order->billingAddress)
                                    <span class="h2" >Billing Address </span>
                                    <div class="h4 montserrat-normal-600">
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$order->billingAddress ? $order->billingAddress['contact_person_name'] : ""}}</p>
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$order->billingAddress ? $order->billingAddress['phone'] : ""}}</p>
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$order->billingAddress ? $order->billingAddress['address'] : ""}}</p>
                                        <p style=" margin-top: 6px; margin-bottom:0px;">{{$order->billingAddress ? $order->billingAddress['city'] : ""}} {{$order->billingAddress ? $order->billingAddress['zip'] : ""}}</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>


    </section>
</div>
<br>

<div class="">
    <div class="content-position-y">
        <table class="customers bs-0">
            <thead>
                <tr>
                    <th>{{translate('SL')}}</th>
                    <th>{{translate('item_description')}}</th>
                    <th>{{translate('Unit_Price')}}</th>
                    <th>{{translate('QTY')}}</th>
                    <th class="text-right">{{translate('total')}}</th>
                </tr>
            </thead>
            @php
                $subtotal=0;
                $total=0;
                $sub_total=0;
                $total_tax=0;
                $total_shipping_cost=0;
                $total_discount_on_product=0;
                $ext_discount=0;
            @endphp
            <tbody>
            @foreach($order->details as $key=>$details)
                @php $subtotal=($details['price'])*$details->qty @endphp
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        {{$details['product']?$details['product']->name:''}}
                        @if($details['variant'])
                        <br>
                        Variation : {{$details['variant']}}
                        @endif
                    </td>
                    <td>{!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($details['price']))!!}</td>
                    <td>{{$details->qty}}</td>
                    <td>{!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($subtotal))!!}</td>
                </tr>

                @php
                    $sub_total+=$details['price']*$details['qty'];
                    $total_tax+=$details['tax'];
                    $total_shipping_cost+=$details->shipping ? $details->shipping->cost :0;
                    $total_discount_on_product+=$details['discount'];
                    $total+=$subtotal;
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<?php
    if ($order['extra_discount_type'] == 'percent') {
        $ext_discount = ($sub_total / 100) * $order['extra_discount'];
    } else {
        $ext_discount = $order['extra_discount'];
    }
?>
@php($shipping=$order['shipping_cost'])
<div class="content-position-y">
    <table class="fz-12">
        <tr>
            <th>
                <h4 class="fz-12 mb-1">Payment Details</h4>
                <p class="fz-12 font-normal">
                    {{$order->payment_status}}
                    , {{date('y-m-d',strtotime($order['created_at']))}}
                </p>

                @if ($order->delivery_type !=null)
                    <h4 class="fz-12 mb-1">Delivery Info </h4>
                    @if ($order->delivery_type == 'self_delivery')
                        <p class="fz-12 font-normal">
                            <span>
                                Self Delivery
                            </span>
                            <br>
                            <span>
                                Delivery Man Name : {{$order->delivery_man['f_name'].' '.$order->delivery_man['l_name']}}
                            </span>
                            <br>
                            <span>
                                Delivery Man Phone : {{$order->delivery_man['phone']}}
                            </span>
                        </p>
                    @else
                    <p>
                        <span>
                            {{$order->delivery_service_name}}
                        </span>
                        <br>
                        <span>
                            Tracking Id : {{$order->third_party_delivery_tracking_id}}
                        </span>
                    </p>
                    @endif
                @endif

            </th>

            <th>
                <table class="calc-table">
                    <tbody>
                        <tr>
                            <td class="p-1 text-left">{{translate('Subtotal')}}</td>
                            <td class="p-1">{!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($sub_total))!!}</td>
                        </tr>
                        <tr>
                            <td class="p-1 text-left">{{translate('tax')}}</td>
                            <td class="p-1">{!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total_tax))!!}</td>
                        </tr>
                        @if ($order->order_type=='default_type')
                            <tr>
                                <td class="p-1 text-left">{{translate('shipping_charge')}}</td>
                                <td class="p-1">{!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($shipping - ($order['is_shipping_free'] ? $order['extra_discount'] : 0)))!!}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="p-1 text-left">{{translate('Coupon_discount')}}</td>
                            <td class="p-1">
                                - {!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->discount_amount))!!} </td>
                        </tr>
                        @if ($order->order_type=='POS')
                            <tr>
                                <td class="p-1 text-left">{{translate('Extra_Discount')}}</td>
                                <td class="p-1">
                                    - {!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($ext_discount))!!} </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="p-1 text-left">{{translate('Discount_on_product')}}</td>
                            <td class="p-1">
                                - {!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total_discount_on_product))!!} </td>
                        </tr>
                        <tr>
                            <td class="border-dashed-top font-weight-bold text-left"><b>{{translate('Total_taxx')}}</b></td>
                            <td class="border-dashed-top font-weight-bold">
                                {!!\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->order_amount))!!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </th>
        </tr>
    </table>
</div>
<br>
<br><br><br>

<div class="row">
    <section>
        <table class="">
            <tr>
                <th class="fz-12 font-normal pb-3">
                    If you require any assistance or have feedback or suggestions about our site you can email us at <a href="mailto:{{ $company_email }}">({{ $company_email }})</a>
                </th>
            </tr>
            <tr>
                <th class="content-position-y bg-light py-4">
                    <div class="d-flex justify-content-center gap-2">
                        <div class="mb-2">
                            <i class="fa fa-phone"></i>
                            Phone : {{ $company_phone }}
                        </div>
                        <div class="mb-2">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            Email : {{$company_email}}
                        </div>
                    </div>
                    <div class="mb-2">
                        {{url('/')}}
                    </div>
                
                    <div>
                        All Copyright Reserved © {{ date('Y') }} {{ $company_name }}
                    </div>
                </th>
            </tr>
        </table>
    </section>
</div>
</div>







@push('script')




@endpush



</body>

</html>
