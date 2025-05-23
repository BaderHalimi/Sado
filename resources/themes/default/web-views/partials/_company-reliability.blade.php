<div class="container rtl pb-3 pt-3 px-0 px-md-3">
    <div class="shipping-policy-web">
        <div class="row g-3 justify-content-center mx-max-md-0">
            @foreach ($company_reliability as $key=>$value)
                @if ($value['status'] == 1 && !empty($value['title']))
                    <div class="col-3 d-flex justify-content-center px-max-md-0">
                        <div class="shipping-method-system pb-0 h-100">
                            <div class="text-center">
                                <img class="{{Session::get('direction') === "rtl" ? 'float-right ml-2' : 'mr-2'}} size-60"  src="{{asset("/storage/app/public/company-reliability").'/'.$value['image']}}"
                                    onerror="this.src='{{asset('/public/assets/front-end/img').'/'.$value['item'].'.png'}}'"
                                        alt="">
                            </div>
                            <div class="text-center">
                                <p class="m-0">
                                    {{translate($value['title'])}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
