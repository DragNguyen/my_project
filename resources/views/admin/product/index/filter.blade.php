<div class="ui green scrolling floating icon dropdown button" id="key-filter">
    <input type="hidden" name="key-filter">
    <i class="filter icon"></i>
    <div class="menu">
        @foreach($trademarks as $trademark)
            <div class="header" style="border-bottom: 1px solid rgba(34,36,38,.15);">
                <strong>{{ $trademark->name }}</strong>
            </div>
            <div class="item" data-value="all-{{ $trademark->id }}">
                <span style="color: blue">{{ $trademark->name}}</span>
                - <strong>Tất cả</strong>
            </div>
            @foreach(\App\ProductTypeTrademark::where('trademark_id', $trademark->id)->get() as $product_type_trademark)
                <div class="item" data-value="{{ $product_type_trademark->id }}">
                    <span style="color: blue">{{ $product_type_trademark->getTrademarkName() }}</span>
                    - {{ $product_type_trademark->getProductTypeName() }}
                </div>
            @endforeach
        @endforeach
    </div>
</div>

@if (!empty($key_filter))
    @php $key_filter_input = explode('-', $key_filter); @endphp
    @if (count($key_filter_input) > 1)
        <div class="ui small label">
            <span class="blue">{{ \App\Trademark::find($key_filter_input[1])->name }} </span> - Tất cả
            <a href="{{ route('product.index') }}"><i class="delete fitted icon"></i></a>
        </div>
    @else
        @php $product_type_trademark_filter =
                \App\ProductTypeTrademark::find($key_filter_input[0]) @endphp
        <div class="ui small label">
                    <span class="blue">
                        {{ $product_type_trademark_filter->getTrademarkName() }}
                    </span> - {{ $product_type_trademark_filter->getProductTypeName() }}
            <a href="{{ route('product.index') }}"><i class="delete fitted icon"></i></a>
        </div>
    @endif
@endif