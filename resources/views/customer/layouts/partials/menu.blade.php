<div class="ui square-border no-margin menu">
        <a class="item" href="{{ route('customer.index') }}"><i class="ui home icon"></i>
                @if(Request::is('/'))
                    <strong>Trang chủ</strong>
                @else
                    Trang chủ
                @endif
        </a>
    @foreach(\App\ProductType::all() as $product_type)
        @php $slug = str_slug($product_type->name) @endphp
        <a class="item" href="{{ route('customer.product_type', [$slug]) }}">
            <i class="{{ $product_type->icon }}"></i>
            @if(Request::is("type/$slug"))
                 <strong>
                      {{ $product_type->name }}
                 </strong>
            @else
                 {{ $product_type->name }}
            @endif
        </a>
    @endforeach
</div>