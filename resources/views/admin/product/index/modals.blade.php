<div class="mini ui modal" id="modal-create-product">
    <div class="header modal-header">Thêm sản phẩm</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('product.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên sản phẩm</label>
                <input type="text" name="product-name" value="Obi worldphone SF1">
            </div>
            <div class="field">
                <label>Giá</label>
                <input type="text" name="price" placeholder="Chấp nhận khoảng trắng">
            </div>
            <div class="field">
                <label>Loại sản phẩm</label>
                <select class="ui search selection dropdown" name="product-type-name">
                    <option value="">Loại sản phẩm</option>
                    @foreach(\App\ProductType::all() as $product_type)
                        <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Thương hiệu</label>
                <select class="ui search selection dropdown" name="trademark-name">
                    <option value="">Thương hiệu</option>
                    @foreach(\App\Trademark::all() as $trademark)
                        <option value="{{ $trademark->id }}">{{ $trademark->name }}</option>
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