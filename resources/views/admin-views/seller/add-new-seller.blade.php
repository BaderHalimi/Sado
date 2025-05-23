@extends('layouts.back-end.app')

@section('title', translate('add_new_seller'))

@push('css_or_js')
<link href="{{asset('public/assets/back-end/css/select2.min.css')}}" rel="stylesheet"/>
<link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid main-card {{Session::get('direction')}}">

    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img src="{{asset('/public/assets/back-end/img/add-new-seller.png')}}" class="mb-1" alt="">
            {{translate('add_new_seller')}}
        </h2>
    </div>
    <!-- End Page Title -->

    <form class="user" action="{{route('shop.apply')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="card">
            <div class="card-body">
                <input type="hidden" name="status" value="approved">
                <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                    <img src="{{asset('/public/assets/back-end/img/seller-information.png')}}" class="mb-1" alt="">
                    {{translate('seller_information')}}
                </h5>
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="form-group">
                            <label for="exampleFirstName" class="title-color d-flex gap-1 align-items-center">{{translate('first_name')}}</label>
                            <input type="text" class="form-control form-control-user" id="exampleFirstName" name="f_name" value="{{old('f_name')}}" placeholder="{{translate('ex')}}: Jhone" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleLastName" class="title-color d-flex gap-1 align-items-center">{{translate('last_name')}}</label>
                            <input type="text" class="form-control form-control-user" id="exampleLastName" name="l_name" value="{{old('l_name')}}" placeholder="{{translate('ex')}}: Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone" class="title-color d-flex gap-1 align-items-center">{{translate('phone')}}</label>
                            <input type="number" class="form-control form-control-user" id="exampleInputPhone" name="phone" value="{{old('phone')}}" placeholder="{{translate('ex')}}: +09587498" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <center>
                                <img class="upload-img-view" id="viewer"
                                    src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                            </center>
                        </div>

                        <div class="form-group">
                            <div class="title-color mb-2 d-flex gap-1 align-items-center">{{translate('seller_Image')}} <span class="text-info">({{translate('ratio')}} {{translate('1')}}:{{translate('1')}})</span></div>
                            <div class="custom-file text-left">
                                <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <label class="custom-file-label" for="customFileUpload">{{translate('upload_image')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="title-color" for="store">Seller Type</label>
                            <select name="seller_type" class="form-control text-capitalize">
                                <option value="1" selected="">Seller</option>
                                <option value="2">Room Design Seller</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <input type="hidden" name="status" value="approved">
                <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                    <img src="{{asset('/public/assets/back-end/img/seller-information.png')}}" class="mb-1" alt="">
                    {{translate('account_information')}}
                </h5>
                <div class="row">
                    <div class="col-lg-4 form-group">
                        <label for="exampleInputEmail" class="title-color d-flex gap-1 align-items-center">{{translate('email')}}</label>
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" value="{{old('email')}}" placeholder="{{translate('ex')}}: Jhone@company.com" required>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="exampleInputPassword" class="title-color d-flex gap-1 align-items-center">{{translate('password')}}</label>
                        <input type="password" class="form-control form-control-user" minlength="8" id="exampleInputPassword" name="password" placeholder="{{translate('ex')}} : {{ translate('8+_Character') }}" required>
                    </div>
                    <div class="col-lg-4 form-group">
                        <label for="exampleRepeatPassword" class="title-color d-flex gap-1 align-items-center">{{translate('confirm_password')}}</label>
                        <input type="password" class="form-control form-control-user" minlength="8" id="exampleRepeatPassword" placeholder="{{translate('ex')}} : {{ translate('8+_Character') }}" required>
                        <div class="pass invalid-feedback">{{translate('repeat')}}  {{translate('password')}} {{translate('not_match')}} .</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                    <img src="{{asset('/public/assets/back-end/img/seller-information.png')}}" class="mb-1" alt="">
                    {{translate('shop_information')}}
                </h5>

                <div class="row">
                    <div class="col-lg-6 form-group">
                        <label for="shop_name" class="title-color d-flex gap-1 align-items-center">{{translate('shop_name')}}</label>
                        <input type="text" class="form-control form-control-user" id="shop_name" name="shop_name" placeholder="{{translate('ex')}}: Jhon" value="{{old('shop_name')}}" required>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="shop_address" class="title-color d-flex gap-1 align-items-center">{{translate('shop_address')}}</label>
                        <textarea name="shop_address" class="form-control" id="shop_address" rows="1" placeholder="{{translate('ex')}}: Doe">{{old('shop_address')}}</textarea>
                    </div>
                    <div class="col-lg-6 form-group">
                        <center>
                            <img class="upload-img-view" id="viewerLogo"
                                src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                        </center>

                        <div class="mt-4">
                            <div class="d-flex gap-1 align-items-center title-color mb-2">
                                {{translate('shop_logo')}}
                                <span class="text-info">({{translate('ratio')}} {{translate('1')}}:{{translate('1')}})</span>
                            </div>

                            <div class="custom-file">
                                <input type="file" name="logo" id="LogoUpload" class="custom-file-input"
                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <label class="custom-file-label" for="LogoUpload">{{translate('upload_logo')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <center>
                            <img class="upload-img-view upload-img-view__banner" id="viewerBanner"
                                    src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                        </center>

                        <div class="mt-4">
                            <div class="d-flex gap-1 align-items-center title-color mb-2">
                                {{translate('shop_banner')}}
                                <span class="text-info">{{translate('ratio')}} {{translate('4')}}:{{translate('1')}}</span>
                            </div>

                            <div class="custom-file">
                                <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <label class="custom-file-label" for="BannerUpload">{{translate('upload_Banner')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group" id="registry_Num_container">
                        <label for="registry_Num" class="title-color d-flex gap-1 align-items-center">{{translate('registry_number')}}</label>
                        <input type="number" class="form-control form-control-user" id="registry_Num" name="registry_Num" value="{{ old('registry_Num') }}" placeholder="{{ translate('ex')}}: 1234567890">
                    </div>
                    <div class="col-lg-6 form-group" id="PdfDocumentUpload_container">
                        <label for="PdfDocumentUpload" class="title-color d-flex gap-1 align-items-center">{{ translate('choose_PDF_document')}}</label>
                        <div class="custom-file">
                            <input type="file" name="pdf_document" id="PdfDocumentUpload" class="custom-file-input" accept=".pdf">
                            <label class="custom-file-label" for="PdfDocumentUpload">{{ translate('choose_PDF_document') }}</label>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group" id="PdfDocumentsUpload_container">
                        <label for="PdfDocumentsUpload" class="title-color d-flex gap-1 align-items-center">{{ translate('Added_tax_certificate')}}</label>
                        <div class="custom-file">
                            <input type="file" name="pdf_documents" id="PdfDocumentsUpload" class="custom-file-input" accept=".pdf">
                            <label class="custom-file-label" for="PdfDocumentsUpload">{{ translate('Added_tax_certificate') }}</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-10">
                    <input type="hidden" name="from_submit" value="admin">
                    <button type="reset" onclick="resetBtn()" class="btn btn-secondary">{{translate('reset')}} </button>
                    <button type="submit" class="btn btn--primary btn-user" id="apply">{{translate('submit')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $('select[name="seller_type"]').change(function(){
            var selectedValue = $(this).val();
            if(selectedValue == '2'){
                $('#registry_Num_container').hide();
                $('#PdfDocumentUpload_container').hide();
                $('#PdfDocumentsUpload_container').hide();
            } else {
                $('#registry_Num_container').show();
                $('#PdfDocumentUpload_container').show();
                $('#PdfDocumentsUpload_container').show();
            }
        });
    });

    $('#inputCheckd').change(function () {
        if ($(this).is(':checked')) {
            $('#apply').removeAttr('disabled');
        } else {
            $('#apply').attr('disabled', 'disabled');
        }
    });

    $('#exampleInputPassword ,#exampleRepeatPassword').on('keyup',function () {
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass === passRepeat){
            $('.pass').hide();
        } else {
            $('.pass').show();
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewer').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileUpload").change(function () {
        readURL(this);
    });

    function readlogoURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerLogo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readBannerURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerBanner').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#LogoUpload").change(function () {
        readlogoURL(this);
    });
    $("#BannerUpload").change(function () {
        readBannerURL(this);
    });
</script>
@endpush
