
@foreach($products as $product)
    <div class="col-sm-4">
        <a class="thumbnail add-item"
            product-id="{{ $product['id'] }}"
            model-price="{{ $product['unit_price'] }}"
            model-name="{{ $product['name'] }}" 
            model-url="models/js/{{ $product['model'] }}"
            model-axios="1"
            model-type="1">

            <img src="{{asset('storage/app/public/product/thumbnail')}}/{{ $product['thumbnail'] }}" alt="Add Item">
            <div>{{ $product['name'] }}  <span> {{ $product['unit_price'] }}SAR </span></div>
            
        </a>
    </div>
@endforeach