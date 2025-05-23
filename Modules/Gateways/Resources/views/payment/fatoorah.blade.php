<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{translate('Embedded Payment')}}</title>
    <link rel="stylesheet" href="{{asset('Modules/Gateways/public/assets/modules/css/fatoorah.css')}}">
        <style>
        /* تنسيق النافذة المنبثقة */
        .modal {
            display: none; /* إخفاء النافذة افتراضيًا */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            text-align: center;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="class-1">
<div class="class-2">
    <h1 style="text-align: center;">{{translate('Embedded Payment')}}</h1>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <span id="error_message"></span>
    </div>
    @if(env('APP_DEBUG'))
        <script src="https://demo.myfatoorah.com/cardview/v2/session.js"></script>

    @elseif ($country_code == 'SAU')
        <script src="https://portal.myfatoorah.com/cardview/v2/session.js"></script>

    @else
        <script src="https://sa.myfatoorah.com/cardview/v2/session.js"></script>
    @endif

    <div class="w-400px">
        <div id="card-element"></div>
    </div>
  
<div style="text-align: center;">
      <button id="btn" style="
  background-color: #008CBA; /* Green */
  border-radius: 12px;
  color: white;
  padding: 12px 28px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
">{{translate('Pay Now')}}</button>
</div>
</div>
<!-- النافذة المنبثقة -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>رصيد غير كافٍ</p>
        <button onclick="goHome()">الرجوع إلى الصفحة الرئيسية</button>
    </div>
</div>


<script>
    'use strict';
    const config = {
        countryCode: "{{$country_code}}",
        sessionId: "{{$session_id}}",
        cardViewId: "card-element",
        style: {
            direction: "ltr",
            cardHeight: 140,
            input: {
                color: "black",
                fontSize: "13px",
                fontFamily: "sans-serif",
                inputHeight: "32px",
                inputMargin: "2px",
                borderColor: "c7c7c7",
                borderWidth: "1px",
                borderRadius: "8px",
                boxShadow: "0px",
                placeHolder: {
                    holderName: "Name On Card",
                    cardNumber: "Number",
                    expiryDate: "MM / YY",
                    securityCode: "CVV",
                }
            },
            label: {
                display: false,
                color: "black",
                fontSize: "13px",
                fontWeight: "normal",
                fontFamily: "sans-serif",
                text: {
                    holderName: "Card Holder Name",
                    cardNumber: "Card Number",
                    expiryDate: "Expiry Date",
                    securityCode: "Security Code",
                },
            },
            error: {
                borderColor: "red",
                borderRadius: "8px",
                boxShadow: "0px",
            },
        },
    };
    myFatoorah.init(config);

    let btn = document.getElementById("btn")
    btn.addEventListener("click", submit)

    function submit() {
        myFatoorah.submit()
            // On success
            .then(function (response) {
              var sessionId = response.sessionId;
            var cardBrand = response.cardBrand;

            var request = new XMLHttpRequest();
            request.open("POST", "{{route('fatoorah.checkout', ['payment_id' => $payment_data->id])}}");
                request.onreadystatechange = function () {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            console.log(JSON.parse(this.responseText));
                            location.href = JSON.parse(this.responseText);
                        } else {
                            console.log(this.response);
                            var error_field = document.getElementById("error_message");
                            var error_message = this.responseText;
                            let finalString = error_message.split('"').join('')
                            error_field.innerText = finalString;
                            error_field.parentElement.style.display = 'block';
                        }
                    }
                };
                var data = new FormData();
                data.append('_token', '{{csrf_token()}}');
                data.append('sessionId', sessionId);
                data.append('cardBrand', cardBrand);
                request.send(data);
            })
            // In case of errors
            .catch(function (error) {
                var error_field = document.getElementById("error_message");
                error_field.innerText = error;
                error_field.parentElement.style.display = 'block';
                console.log(error);
            });
    }

</script>

</body>

</html>
