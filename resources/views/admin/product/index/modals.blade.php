<div class="mini ui modal" id="modal-create-product">
    <div class="header modal-header">Thêm sản phẩm</div>
    <div class="scrolling content">
        <form class="ui form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="ui secondary menu" style="margin-top: 0px">
                <a class="item active" data-tab="first">Thông tin</a>
                <a class="item" data-tab="second">Hình ảnh</a>
            </div>
            <div class="ui tab active segment" data-tab="first">
                @include('admin.product.create.tab-info')
            </div>
            <div class="ui tab segment" data-tab="second">
                @include('admin.product.create.tab-image')
            </div>

            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>
        </form>
    </div>
</div>

@foreach($products as $product)
    <div class="mini ui modal" id="modal-edit-product-{{ $product->id }}">
        <div class="header modal-header">Sửa thông tin sản phẩm</div>
        <div class="content">
            <form class="ui form" action="{{ route('product.update', [$product->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="product-name" value="{{ $product->name }}">
                </div>
                <div class="field">
                    <label>Loại sản phẩm</label>
                    <select class="ui search selection dropdown" name="product-type-name">
                        @foreach(\App\ProductType::all() as $product_type)
                            <option value="{{ $product_type->id }}"
                                    {{ ($product->product_type_id==$product_type->id)?'selected':'' }}>
                                {{ $product_type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label>Thương hiệu</label>
                    <select class="ui search selection dropdown" name="trademark-name">
                        @foreach(\App\Trademark::all() as $trademark)
                            <option value="{{ $trademark->id }}"
                                    {{ ($product->trademark_id==$trademark->id)?'selected':'' }}>
                                {{ $trademark->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <button class="ui fluid blue button" type="submit">
                        <strong>OK</strong>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endforeach