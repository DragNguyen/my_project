<div class="mini ui modal" id="modal-create-product">
    <div class="header modal-header">Thêm sản phẩm</div>
    <div class="scrolling content">
        <form class="ui form" method="post" id="form-create-product"
              action="{{ route('product.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="ui secondary menu" style="margin-top: 0px">
                <a class="item active" data-tab="first">Thông tin</a>
                <a class="item" data-tab="second">Hình ảnh</a>
            </div>
            <div class="ui tab active segment" data-tab="first">
                @include('admin.product.create.tab-info')
            </div>
            <div class="ui tab segment" data-tab="second">
                @include('admin.product.create.tab-images')
            </div>
        </form>
    </div>
    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-create-product">
    </div>
</div>

@foreach($products as $product)
    <div class="mini ui modal" id="modal-edit-product-{{ $product->id }}">
        <div class="header modal-header">Sửa thông tin sản phẩm</div>
        <div class="content">
            <form class="ui form" id="form-edit-product-{{ $product->id }}"
                  action="{{ route('product.update', [$product->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

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
                <div class="field">
                    <label>Thương hiệu</label>
                    <select class="ui search selection dropdown" name="trademark-id">
                        @foreach($trademarks as $trademark)
                            <option value="{{ $trademark->id }}"
                                    {{ ($product->trademark_id==$trademark->id)?'selected':'' }}>
                                {{ $trademark->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label>Loại sản phẩm</label>
                    <select class="ui search selection dropdown" name="product-type-id">
                        @foreach($product_types as $product_type)
                            <option value="{{ $product_type->id }}"
                                    {{ ($product->product_type_id==$product_type->id)?'selected':'' }}>
                                {{ $product_type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="actions">
            <input type="submit" class="ui fluid blue button" value="OK" form="form-edit-product-{{ $product->id }}">
        </div>
    </div>
@endforeach