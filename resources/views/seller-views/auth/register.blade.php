@extends('layouts.front-end.app')

@section('title', translate('Seller Apply'))

@push('css_or_js')
    <link href="{{ asset('public/assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('public/assets/back-end/css/croppie.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .image-upload-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .upload-box {
            width: 100%;
            /* max-width: 500px; */
            height: 200px;
            border: 1px solid #d1d1d1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            /* background-color: #f9f9f9; */
        }

        .upload-box:hover {
            border-color: #007bff;
            background-color: #f1f1f1;
        }

        .upload-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .upload-content img {
            width: 50px;
            height: 50px;
            opacity: 0.6;
        }

        .upload-content p {
            font-size: 16px;
            color: #333;
        }

        .upload-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .custom-file-input {
            display: none;
        }
    </style>
@endpush


@section('content')

    <div class="container my-5 py-5 p-sm-5 rtl bg-sm-white border-sm rounded"
        style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">

        <h3 class="mb-3 text-center"> {{ translate('Sellerـregistration') }}</h3>
        <form class="_shop-apply mx-sm-5" id="form-id" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card __card mb-3">
                <div class="card-header">
                    <h5 class="card-title m-0 text-primary fw-bold pt-3">
                        {{-- <svg width="20" height="20" x="0" y="0" viewBox="0 0 482.9 482.9"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <!-- SVG content -->
                        </svg> --}}
                        {{ translate('seller_Info') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="exampleFirstName">{{ translate('first_name') }}</label>
                            <input type="text" class="form-control form-control-user mt-2 mt-2" id="exampleFirstName"
                                name="f_name" value="{{ old('f_name') }}" placeholder="" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleLastName">{{ translate('last_name') }}</label>
                            <input type="text" class="form-control form-control-user mt-2" id="exampleLastName"
                                name="l_name" value="{{ old('l_name') }}" placeholder="" required>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <label for="exampleInputEmail">{{ translate('email_address') }}</label>
                            <input type="email" class="form-control form-control-user mt-2" id="exampleInputEmail"
                                name="email" value="{{ old('email') }}" placeholder="" required>
                        </div>
                        <div class="col-sm-6">
                            {{-- <small class="text-danger">( * {{translate('country_code_is_must_like_for_BD')}} +966 )</small> --}}
                            <label for="exampleInputPhone">{{ translate('phone_number') }}</label>
                            <input type="number" class="form-control form-control-user mt-2" id="exampleInputPhone"
                                name="phone" value="{{ old('phone') }}" placeholder="" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputPassword">{{ translate('password') }}</label>
                            <input type="password" class="form-control form-control-user mt-2" minlength="6"
                                id="exampleInputPassword" name="password" placeholder="" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleRepeatPassword">{{ translate('repeat_password') }}</label>
                            <input type="password" class="form-control form-control-user mt-2" minlength="6"
                                id="exampleRepeatPassword" placeholder="" required>
                            <div class="pass invalid-feedback">{{ translate('repeat_password_not_match') }} .</div>
                        </div>
                        {{-- <div class="image-upload-container px-2">
                            <label for="customFileUpload" class="upload-box">
                                <div class="upload-content">
                                    <img id="viewer" src="{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}"
                                        alt="banner image" />
                                    <p><span class="upload-link">{{ translate('click_here') }}</span>
                                        {{ translate('upload_image') }}</p>
                                </div>
                            </label>
                            <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        </div> --}}
                        <div class="file-upload-container col-12">
                            <label for="customFileUpload" class="upload-box image-upload">
                                <div class="upload-content">
                                    <img id="viewerimage" src="{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}" />
                                    <p><span class="upload-link">{{ translate('click_here') }}</span>
                                        {{ translate('upload_image') }}</p>
                                </div>
                            </label>
                            <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        </div>
                        {{-- <div class="col-sm-12">
                        <center>
                            <img class="__img-125px object-cover" id="viewer"
                                src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                        </center>
                        <div class="custom-file mt-3">
                            <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="custom-file-label" for="customFileUpload">{{translate('upload_image')}}</label>
                        </div>
                    </div> --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="title-color" for="store">{{ translate('SellerـType') }}</label>
                                <select name="seller_type" class="form-control text-capitalize">
                                    <option value="1" selected="">Seller</option>
                                    <option value="2">Room Design Seller</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card __card">
                <div class="card-header">
                    <h5 class="card-title text-primary m-0">
                        {{-- <svg width="22" height="22" x="0" y="0" viewBox="0 0 128 128"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <!-- SVG content -->
                        </svg> --}}
                        {{ translate('shop_Info') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6 ">
                            <label for="shop_name">{{ translate('shop_name') }}</label>
                            <input type="text" class="form-control form-control-user mt-2" id="shop_name"
                                name="shop_name" placeholder="" value="{{ old('shop_name') }}" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="shop_address">{{ translate('shop_address') }}</label>
                            <textarea name="shop_address" class="form-control  mt-2" id="shop_address"rows="1" placeholder="">{{ old('shop_address') }}</textarea>
                        </div>
                        <div class="col-sm-12" id="registry_Num_container">
                            <label for="registry_Num">{{ translate('registry_number') }}</label>
                            <input type="number" class="form-control form-control-user mt-2" id="registry_Num"
                                name="registry_Num" value="{{ old('registry_Num') }}" placeholder="">
                        </div>
                        <!-- رفع مستند PDF -->
                        <div id="PdfDocumentUpload_container" class="file-upload-container col-12">
                            <label for="PdfDocumentUpload" class="upload-box pdf-upload">
                                <div class="upload-content">
                                    <img id="viewerPdfDocumentUpload"
                                        src="{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}"
                                        alt="pdf image" />
                                    <p><span class="upload-link">{{ translate('click_here') }}</span>
                                        {{ translate('choose_PDF_document') }}</p>
                                </div>
                            </label>
                            <input type="file" name="pdf_document" id="PdfDocumentUpload" class="custom-file-input"
                                accept=".pdf">
                        </div>

                        <!-- رفع الشعار -->
                        <div class="file-upload-container col-12">
                            <label for="LogoUpload" class="upload-box image-upload">
                                <div class="upload-content">
                                    <img id="viewerLogo" src="{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}"
                                        alt="logo image" />
                                    <p><span class="upload-link">{{ translate('click_here') }}</span>
                                        {{ translate('upload_logo') }}</p>
                                </div>
                            </label>
                            <input type="file" name="logo" id="LogoUpload" class="custom-file-input"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        </div>

                        <!-- رفع البانر -->
                        <div class="file-upload-container col-12">
                            <label for="BannerUpload" class="upload-box image-upload">
                                <div class="upload-content">
                                    <img id="viewerBanner"
                                        src="{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}"
                                        alt="banner image" />
                                    <p><span class="upload-link">{{ translate('click_here') }}</span>
                                        {{ translate('upload_Banner') }}</p>
                                </div>
                            </label>
                            <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        </div>

                        <!-- رفع شهادة الضريبة (PDF) -->
                        <div id="PdfDocumentsUpload_container" class="file-upload-container col-12">
                            <label for="PdfDocumentsUpload" class="upload-box pdf-upload">
                                <div class="upload-content">
                                    <img id="viewerPdfDocumentsUpload"
                                        src="{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}"
                                        alt="PdfDocumentsUpload image" />
                                    <p><span class="upload-link">{{ translate('click_here') }}</span>
                                        {{ translate('Added_tax_certificate') }}</p>
                                </div>
                            </label>
                            <input type="file" name="pdf_documents" id="PdfDocumentsUpload" class="custom-file-input"
                                accept=".pdf">
                        </div>

                        {{-- <div class="col-sm-12" id="PdfDocumentUpload_container">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="pdf_document" id="PdfDocumentUpload"
                                        class="custom-file-input" accept=".pdf">
                                    <label class="custom-file-label"
                                        for="PdfDocumentUpload">{{ translate('choose_PDF_document') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="pb-3">
                                <center>
                                    <img class="__img-125px object-cover" id="viewerLogo"
                                        src="{{ asset('public\assets\back-end\img\400x400\img2.jpg') }}"
                                        alt="banner image" />
                                </center>
                            </div>
                            <div class="form-group mb-0">
                                <div class="custom-file">
                                    <input type="file" name="logo" id="LogoUpload" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label"
                                        for="LogoUpload">{{ translate('upload_logo') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="pb-3">
                                <center>
                                    <img class="__img-125px object-cover" id="viewerBanner"
                                        src="{{ asset('public\assets\back-end\img\400x400\img2.jpg') }}"
                                        alt="banner image" />
                                </center>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="banner" id="BannerUpload"
                                        class="custom-file-input overflow-hidden __p-2p"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label"
                                        for="BannerUpload">{{ translate('upload_Banner') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" id="PdfDocumentsUpload_container">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="pdf_documents" id="PdfDocumentsUpload"
                                        class="custom-file-input" accept=".pdf">
                                    <label class="custom-file-label"
                                        for="PdfDocumentsUpload">{{ translate('Added_tax_certificate') }}</label>
                                </div>
                            </div>
                        </div> --}}
                        {{-- recaptcha --}}
                        @php($recaptcha = \App\CPU\Helpers::get_business_settings('recaptcha'))
                        @if (isset($recaptcha) && $recaptcha['status'] == 1)
                            <div id="recaptcha_element" class="w-100" data-type="image"></div>
                            <br />
                        @else
                            <div class="col-12">
                                <div class="row py-2">
                                    <div class="col-10 pr-0">
                                        <input type="text" class="form-control __h-40"
                                            name="default_recaptcha_id_seller_regi" value=""
                                            placeholder="{{ translate('enter_captcha_value') }}" class="border-0"
                                            autocomplete="off">
                                    </div>
                                    <div class="col-2 input-icons mb-2 w-100 rounded bg-white">
                                        <a onclick="javascript:re_captcha();"
                                            class="d-flex align-items-center align-items-center">
                                            <img src="{{ URL('/seller/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_seller_regi') }}"
                                                class="rounded __h-40" id="default_recaptcha_id">
                                            <i class="tio-refresh position-relative cursor-pointer p-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="form-group mb-0 p-0 d-flex flex-wrap justify-content-between">
                                <label class="form-group mb-3 d-flex align-items-center flex-grow-1">
                                    <strong>
                                        <input type="checkbox" class="mr-1" name="remember" id="inputCheckd">
                                    </strong>
                                    <span class="mb-4px d-block w-0 flex-grow pl-1">
                                        <span class="text-primary"> &ThinSpace; {{ translate('i_agree_to_Your_terms') }}</span>
                                        <a class="font-size-sm text-primary" target="_blank" href="{{ route('terms') }}">
                                            {{ translate('terms_and_condition') }}
                                        </a>
                                    </span>
                                </label>
                            </div>
                            <input type="hidden" name="from_submit" value="seller">
                            <button type="submit" class="btn btn--primary btn-user btn-block d-none d-sm-inline" id="apply" disabled>
                                <span>{{ translate('apply_Shop') }}</span>
                                <span class="spinner-border spinner-border-sm d-none" id="loading-spinner" role="status"
                                    aria-hidden="true"></span>
                            </button>
                            <div class="text-center mt-3 mb-4 d-none d-sm-inline">
                                {{ translate('already_have_an_account?') }} <a class="text-primary text-underline"
                                    href="{{ route('seller.auth.login') }}">{{ translate('login') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn--primary btn-user btn-block mt-4 d-sm-none" id="apply" disabled>
                <span>{{ translate('apply_Shop') }}</span>
                <span class="spinner-border spinner-border-sm d-none" id="loading-spinner" role="status"
                    aria-hidden="true"></span>
            </button>
            <div class="text-center mt-3 mb-4 d-sm-none">
                {{ translate('already_have_an_account?') }} <a class="text-primary text-underline"
                    href="{{ route('seller.auth.login') }}">{{ translate('login') }}</a>
            </div>
        </form>
    </div>
@endsection
@push('script')
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', Error, {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach
        </script>
    @endif
    <script>
        // function readURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function(e) {
        //             $('#viewer').attr('src', e.target.result).css("opacity", "1");
        //         }
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }


        // تحميل الصور وعرضها كمعاينة
        function readImage(input, viewerId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(viewerId).attr('src', e.target.result).css("opacity", "1");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // $("#customFileUpload").change(function() {
        //     readURL(this);
        // });
        // تحميل PDF وتحديث الأيقونة
        function handlePDFUpload(input, label) {
            if (input.files.length > 0) {
                $(label).find('.upload-content p').text("تم اختيار ملف PDF");
                $(label).find('.upload-content i').css("color", "#28a745");
            }
        }

        // استماع لتغييرات المدخلات
        $("#customFileUpload").change(function() {
            readImage(this, '#viewerimage');
        });
        $("#LogoUpload").change(function() {
            readImage(this, '#viewerLogo');
        });
        $("#BannerUpload").change(function() {
            readImage(this, '#viewerBanner');
        });
        $("#PdfDocumentUpload").change(function() {
            handlePDFUpload(this, 'label[for="PdfDocumentUpload"]');
        });
        $("#PdfDocumentsUpload").change(function() {
            handlePDFUpload(this, 'label[for="PdfDocumentsUpload"]');
        });


        $(document).ready(function() {
            // عند تغيير قيمة القائمة المنسدلة لـ Seller Type
            $('select[name="seller_type"]').change(function() {
                // احصل على القيمة المحددة
                var selectedValue = $(this).val();

                // إذا كانت القيمة المحددة هي "2" (Room Design Seller)
                if (selectedValue == '2') {
                    // قم بإخفاء حقل "registry_Num"
                    $('#registry_Num_container').hide();
                    $('#PdfDocumentUpload_container').hide();
                    $('#PdfDocumentsUpload_container').hide();
                } else {
                    // إلا إذا كانت القيمة غير ذلك، قم بإظهار الحقول
                    $('#registry_Num_container').show();
                    $('#PdfDocumentUpload_container').show();
                    $('#PdfDocumentsUpload_container').show();
                }
            });
        });
    </script>

    <script>
        $('#inputCheckd').change(function() {
            if ($(this).is(':checked')) {
                $('#apply').removeAttr('disabled');
            } else {
                $('#apply').attr('disabled', 'disabled');
            }
        });

        $('#exampleInputPassword ,#exampleRepeatPassword').on('keyup', function() {
            var pass = $("#exampleInputPassword").val();
            var passRepeat = $("#exampleRepeatPassword").val();
            if (pass == passRepeat) {
                $('.pass').hide();
            } else {
                $('.pass').show();
            }
        });

        $('#form-id').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('shop.apply') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#apply').attr('disabled', 'disabled');
                    $('#loading-spinner').removeClass('d-none');
                    $('#apply span:first-child').addClass('d-none');
                },
                success: function(response) {
                    Swal.fire({
                        title: "{{ translate('Success') }}",
                        text: "{{ translate('Your registration was successful!') }}",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "{{ route('seller.auth.login') }}";
                    });
                },
                error: function(response) {
                    $('#apply').removeAttr('disabled');
                    $('#loading-spinner').addClass('d-none');
                    $('#apply span:first-child').removeClass('d-none');
                    toastr.error("{{ translate('Something went wrong! Please try again.') }}", {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        function Validate(file) {
            var x;
            var le = file.length;
            var poin = file.lastIndexOf(".");
            var accu1 = file.substring(poin, le);
            var accu = accu1.toLowerCase();
            if ((accu != '.png') && (accu != '.jpg') && (accu != '.jpeg')) {
                x = 1;
                return x;
            } else {
                x = 0;
                return x;
            }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });

        function readlogoURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewerLogo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readBannerURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewerBanner').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#LogoUpload").change(function() {
            readlogoURL(this);
        });
        $("#BannerUpload").change(function() {
            readBannerURL(this);
        });
    </script>
    {{-- recaptcha scripts start --}}
    @if (isset($recaptcha) && $recaptcha['status'] == 1)
        <script type="text/javascript">
            var onloadCallback = function() {
                grecaptcha.render('recaptcha_element', {
                    'sitekey': '{{ \App\CPU\Helpers::get_business_settings('recaptcha')['site_key'] }}'
                });
            };
        </script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
        <script>
            $("#form-id").on('submit', function(e) {
                console.log('okay')
                var response = grecaptcha.getResponse();

                if (response.length === 0) {
                    e.preventDefault();
                    toastr.error("{{ translate('please_check_the_recaptcha') }}");
                }
            });
        </script>
    @else
        <script type="text/javascript">
            function re_captcha() {
                $url = "{{ URL('/seller/auth/code/captcha') }}";
                $url = $url + "/" + Math.random() + '?captcha_session_id=default_recaptcha_id_seller_regi';
                document.getElementById('default_recaptcha_id').src = $url;
                console.log('url: ' + $url);
            }
        </script>
    @endif
    {{-- recaptcha scripts end --}}
@endpush
