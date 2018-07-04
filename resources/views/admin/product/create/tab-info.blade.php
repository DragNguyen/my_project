<div class="field">
    <label>Thương hiệu - loại sản phẩm</label>
    <div class="ui fluid search selection dropdown">
        <input type="hidden" name="product-type-trademark-id">
        <i class="dropdown icon"></i>
        <div class="default text">Chọn thương hiệu - loại sản phẩm...</div>
        <div class="menu">
            @foreach($trademarks as $trademark)
                <div class="header" style="border-bottom: 1px solid rgba(34,36,38,.15);">
                    <strong>{{ $trademark->name }}</strong>
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
</div>
<div class="field">
    <label>Tên sản phẩm</label>
    <div class="ui corner labeled input">
        <input type="text" name="product-name" value="{{ old('product-name') }}" placeholder="Nhập tên sản phẩm...">
        <div class="ui corner label">
            <i class="asterisk icon"></i>
        </div>
    </div>
    @if($errors->has('product-name'))
        <div style="color: red; margin-top: 5px; font-size: 13px">
            {{ $errors->first('product-name') }}
        </div>
    @endif
</div>
{{--<div class="field">--}}
    {{--<label>Thương hiệu</label>--}}
        {{--<select class="ui fluid search selection dropdown" name="trademark-id" id="trademark">--}}
            {{--@foreach($trademarks as $stt => $trademark)--}}
                {{--<option value="{{ $trademark->id }}" {{ ($stt == 0) ? 'selected' : '' }}>--}}
                    {{--{{ $trademark->name }}--}}
                {{--</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
{{--</div>--}}
{{--<div class="field">--}}
    {{--<label>Loại sản phẩm</label>--}}
    {{--<select class="ui fluid search selection dropdown" name="product-type-id" id="product-type" onchange="loadProductType()">--}}
        {{--@foreach($product_types as $stt => $product_type)--}}
            {{--<option value="{{ $product_type->id }}" {{ ($stt == 0) ? 'selected' : '' }}>--}}
                {{--{{ $product_type->name }}--}}
            {{--</option>--}}
        {{--@endforeach--}}
    {{--</select>--}}
{{--</div>--}}
<div class="field">
    <label>Giá</label>
    <div class="ui corner labeled input">
        <input type="text" name="price" placeholder="2990000 hoặc 2,990,000..." value="{{ old('price') }}">
        <div class="ui corner label">
            <i class="asterisk icon"></i>
        </div>
    </div>
    @if($errors->has('price'))
        <div style="color: red; margin-top: 5px; font-size: 13px">
            {{ $errors->first('price') }}
        </div>
    @endif
</div>

<span style="margin-top: 10px">
    <strong>Lưu ý:</strong>
    Giá tiền <strong>không vượt quá</strong> 100,000,000<sup>đ</sup> hoặc
    <strong>không nhỏ hơn</strong> 1,000<sup>đ</sup>.
</span>

{{--<div class="ui selection dropdown" id="product-type-trademark-name">--}}
{{--<input type="hidden" name="product-type-trademark-name">--}}
{{--<i class="dropdown icon"></i>--}}
{{--<div class="default text">Chọn thương hiệu - loại sản phẩm</div>--}}
{{--<div class="menu">--}}
{{--@foreach($product_type_trademarks as $product_type_trademark)--}}
{{--<div class="item" data-value="{{  $product_type_trademark->id  }}">--}}
{{--<span class="ui label">--}}
{{--{{ $product_type_trademark->getTrademark() }}--}}
{{--</span>--}}
{{--{{ $product_type_trademark->getProductType() }}--}}
{{--</div>--}}
{{--@endforeach--}}
{{--</div>--}}
{{--</div>--}}