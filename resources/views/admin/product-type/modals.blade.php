<div class="mini ui modal" id="modal-create-product-type">
    <div class="header modal-header">Thêm loại sản phẩm</div>
    <div class="content">
        <form class="ui form" method="post"
              action="{{ route('product_type.store') }}" id="form-add-product-type">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên loại sản phẩm</label>
                <div class="ui corner labeled input">
                    <input type="text" name="product-type-name" placeholder="Nhập tên loại sản phẩm..."
                           value="{{ old('product-type-name') }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('product-type-name'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('product-type-name') }}
                    </div>
                @endif
            </div>
            {{--<div class="field">--}}
                {{--<label>Thông số kỹ thuật</label>--}}
                {{--<select class="ui selection dropdown" name="specification" multiple>--}}
                    {{--<option value="">Chọn các thông số kỹ thuật...</option>--}}
                    {{--@foreach($specifications as $specification)--}}
                        {{--<option value="{{ $specification->id }}">--}}
                            {{--{{ $specification->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        </form>
    </div>

    <div class="actions">
        <input type="submit" value="OK" form="form-add-product-type" class="ui blue fluid button">
    </div>
</div>

@foreach($product_types as $product_type)
    <div class="mini ui modal" id="modal-edit-product-type-{{ $product_type->id }}">
        <div class="header modal-header">Sửa loại sản phẩm</div>
        <div class="content">
            <form class="ui form" id="form-edit-product-type-{{ $product_type->id }}"
                  action="{{ route('product_type.update', [$product_type->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên loại sản phẩm</label>
                    <div class="ui corner labeled input">
                        <input type="text" name="product-type-name-{{ $product_type->id }}"
                               value="{{ $product_type->name }}">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("product-type-name-$product_type->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("product-type-name-$product_type->id") }}
                        </div>
                    @endif
                </div>
                {{--<div class="field">--}}
                    {{--<label>Thông số kỹ thuật</label>--}}
                    {{--<select class="ui selection dropdown" name="specification[]" multiple>--}}
                        {{--<option value="">Chọn các thông số kỹ thuật...</option>--}}
                        {{--@foreach($specifications as $specification)--}}
                            {{--<option value="{{ $specification->id }}"--}}
                                    {{--{{ $product_type->matchedSpecification($product_type->id) ? 'selected' : '' }}>--}}
                                {{--{{ $specification->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
            </form>
        </div>
        <div class="actions">
            <input type="submit" value="OK"
                   form="form-edit-product-type-{{ $product_type->id }}" class="ui fluid blue button">
        </div>
    </div>
@endforeach