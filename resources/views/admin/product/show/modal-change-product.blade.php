<div class="mini ui modal" id="modal-edit-product-{{ $product->id }}">
    <div class="header modal-header">Sửa thông tin sản phẩm</div>
    <div class="content">
        <form class="ui form" id="form-edit-product-{{ $product->id }}"
              action="{{ route('product.update', [$product->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="field">
                <label>Thương hiệu - loại sản phẩm</label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="product-type-trademark-id">
                    <i class="dropdown icon"></i>
                    <div class="default text">
                        <span style="color: blue">{{ $product->getTrademarkName() }}</span>
                        - {{ $product->getProductTypeName() }}
                    </div>
                    <div class="menu">
                        @foreach($trademarks as $trademark)
                            <div class="header" style="border-bottom: 1px solid rgba(34,36,38,.15);">
                                <strong>{{ $trademark->name }}</strong>
                            </div>
                            @foreach(\App\ProductTypeTrademark::where('trademark_id', $trademark->id)->get() as $product_type_trademark)
                                <div class="item {{ ($product_type_trademark->id == $product->product_type_trademark_id)
                                         ? 'active selected' : '' }}"
                                     data-value="{{ $product_type_trademark->id }}">
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
                    <input type="text" name="product-name-{{ $product->id }}" placeholder="Nhập tên sản phẩm..."
                           value="{{ $product->name }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has("product-name-$product->id"))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first("product-name-$product->id") }}
                    </div>
                @endif
            </div>
            {{--<div class="field">--}}
            {{--<label>Thương hiệu</label>--}}
            {{--<select class="ui search selection dropdown" name="trademark-id">--}}
            {{--@foreach($trademarks as $trademark)--}}
            {{--<option value="{{ $trademark->id }}"--}}
            {{--{{ ($product->trademark_id==$trademark->id)?'selected':'' }}>--}}
            {{--{{ $trademark->name }}--}}
            {{--</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
            {{--</div>--}}
            {{--<div class="field">--}}
            {{--<label>Loại sản phẩm</label>--}}
            {{--<select class="ui search selection dropdown" name="product-type-id">--}}
            {{--@foreach($product_types as $product_type)--}}
            {{--<option value="{{ $product_type->id }}"--}}
            {{--{{ ($product->product_type_id==$product_type->id)?'selected':'' }}>--}}
            {{--{{ $product_type->name }}--}}
            {{--</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
            {{--</div>--}}
        </form>
    </div>

    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-edit-product-{{ $product->id }}">
    </div>
</div>