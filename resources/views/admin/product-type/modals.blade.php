<div class="mini ui modal" id="modal-create-product-type">
    <div class="header modal-header">Thêm loại sản phẩm</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('product_type.store') }}" id="form-add-product-type">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên loại sản phẩm</label>
                <input type="text" name="product-type-name" value="bla bla" id="product_type_name">
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>
        </form>
    </div>
</div>

@foreach($product_types as $product_type)
    <div class="mini ui modal" id="modal-edit-product-type-{{ $product_type->id }}">
        <div class="header modal-header">Sửa loại sản phẩm</div>
        <div class="content">
            <form class="ui form" action="{{ route('product_type.update', [$product_type->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên loại sản phẩm</label>
                    <input type="text" name="product-type-name" value="{{ $product_type->name }}">
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