<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{translate('Payment Failed')}}</title>
    <link rel="stylesheet" href="{{asset('Modules/Gateways/public/assets/modules/css/fatoorah.css')}}">
    <style>
        .modal {
            display: block; /* Show the modal by default */
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
            max-width: 400px;
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
        .icon {
            font-size: 50px;
            color: red;
        }
        .button {
            background-color: {{$web_config['primary_color']}};
            border-radius: 12px;
            color: white;
            padding: 12px 28px;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="icon">&#10060;</div> <!-- X mark icon -->
            <p>{{translate('Paymentـfailedـdueـtoـinsufficientـfunds')}}.</p>
            <a href="{{ route('checkout-payment') }}" class="button">الرجوع إلى عربة التسوق</a>
        </div>
    </div>

    <script>
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>
</body>
</html>
