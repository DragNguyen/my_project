<div class="field">
    <label>Tên sản phẩm</label>
    <input type="text" name="product-name" value="Obi worldphone SF1">
</div>
<div class="field">
    <label>Giá</label>
    <input type="text" name="price" placeholder="2990000 hoặc 2,990,000...">
</div>
<div class="field">
    <label>Thương hiệu - loại sản phẩm</label>
    <div class="ui selection dropdown" id="product-type-trademark-name">
        <input type="hidden" name="product-type-trademark-name">
        <i class="dropdown icon"></i>
        <div class="default text">Chọn thương hiệu - loại sản phẩm</div>
        <div class="menu">
            @foreach($product_type_trademarks as $product_type_trademark)
                <div class="item" data-value="{{  $product_type_trademark->id  }}">
                    <span class="ui label">
                        {{ $product_type_trademark->getTrademark() }}
                    </span>
                    {{ $product_type_trademark->getProductType() }}
                </div>
            @endforeach
        </div>
    </div>
    {{--<select class="ui fluid search selection dropdown" name="product-type-trademark-name">--}}
        {{--@foreach($product_type_trademarks as $product_type_trademark)--}}
            {{--<option value="{{ $product_type_trademark->id }}">--}}
                    {{--<span class="label-dropdown">--}}
                        {{--{{ $product_type_trademark->getTrademark() }}--}}
                    {{--</span>--}}
                {{--{{ $product_type_trademark->getProductType() }}--}}
            {{--</option>--}}
        {{--@endforeach--}}
    {{--</select>--}}
</div>