<div class="ui square-border no-margin menu">
        <a class="item" href="{{ route('customer.index') }}"><i class="ui home icon"></i>
                @if(!empty($home))
                    <strong>Trang chủ</strong>
                @else
                    Trang chủ
                @endif
        </a>
    @php $product_types = \App\ProductType::all() @endphp
    @foreach($product_types as $product_type)
        <a class="item" href="{{ route('customer.product_type', [str_slug($product_type->name)]) }}">
                <i class="{{ $product_type->icon }}"></i>
            @if($items[0]->slug == $product_type->slug)
                        <strong>
                                {{ $product_type->name }}
                        </strong>
                    @else
                        {{ $product_type->name }}
                @endif
        </a>
    @endforeach
</div>