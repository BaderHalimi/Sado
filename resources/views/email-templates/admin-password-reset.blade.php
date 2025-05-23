
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
      <title>{{\App\CPU\translate('Password Reset')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <style type="text/css">
  body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #fff;
    text-align: center;
}

.container {
    width: 100%;
    margin: auto;
}

header {
    background-color: #000;
    color: #fff;
    padding: 20px;
}

.logo {
    width: 50px;
}

.tagline {
    font-size: 18px;
}

.reset-password {
    background-color: #f5f5f7;
    padding: 20px;
    margin: 20px auto;
    width: 80%;
    border-radius: 10px;
}

.card-header {
    font-size: 22px;
    margin-bottom: 10px;
}

.btn {
    background-color: #fccb6a;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block;
}

footer {
    background-color: #000;
    color: #000;
    padding: 20px;
}

.store-links {
    margin-bottom: 20px;
    background-color: #f5f5f7; /* خلفية بيضاء شفافة لروابط المتاجر */
    padding: 10px 0;
}

.store-links a {
    margin: 0 20px; /* زيادة المسافات بين الروابط */
    display: inline-block;
    vertical-align: middle;
}

.store-links img {
    width: 100px; /* حجم الصور */
}

.content a {
    color: #1a82e2; /* لون الرابط */
    text-decoration: none; /* إزالة التسطير من الروابط */
    padding: 0 5px; /* تباعد قليل عند الجوانب لمزيد من الوضوح */
}

.content a:hover {
    text-decoration: underline; /* إضافة تسطير عند مرور الماوس لتحسين التفاعل */
}

    </style>

</head>
<body>
    <div class="container">
        <header>
            
            <img src="{{asset("storage/app/public/company")."/".$web_config['web_logo']->value}}" alt="Logo" class="logo">
            <h1>سدو</h1>
            <p class="tagline">مرحباً</p>
        </header>
        <div class="reset-password">
            <div class="card-header">
                {{\App\CPU\translate('Reset Your password')}}.
            </div>
            <div class="card-body">
                <a  class="btn btn--primary" href="{{$url}}">
                    {{\App\CPU\translate('Click to Reset')}}
                </a>
            </div>
        </div>
        <footer>
            <div class="store-links">
                <a href="https://apps.apple.com/sa/app/sado/id6476448200" target="_blank"><img src="https://sado-ksa.com/public/assets/front-end/png/apple_app.png" alt="App Store" /></a>
                <a href="https://play.google.com/store/apps/details?id=com.sado.ksa" target="_blank"><img src="https://sado-ksa.com/public/assets/front-end/png/google_app.png" alt="Google Play" /></a>
                <a href="https://sado-ksa.com/contacts" target="_blank" class="help-link">help.sado-ksa.com</a>
            </div>
            <div class="content">
                 <p>
        <a href="https://sado-ksa.com/terms" target="_blank">سياسة الخصوصية</a> · 
        <a href="https://sado-ksa.com/privacy-policy" target="_blank">شروط الاستخدام</a> · 
    </p>
                <p>جميع الحقوق محفوظة لشركة سدو 2024 م</p>
            </div>
        </footer>
    </div>
</body>
</html>


