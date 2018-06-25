<div class="mini ui modal" id="modal-create-goods-receipt-note-product">
    <div class="header modal-header">Thêm sản phẩm cho phiếu nhập hàng</div>
    <div class="content">
        <form class="ui form" id="form-add-goods-receipt-note-product" method="post"
              action="{{ route('goods_receipt_note_product.store') }}">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $goods_receipt_note->id }}" name="id">

            <div class="field">
                <label>Sản phẩm</label>
                <select class="ui search selection dropdown" name="product-name">
                    @foreach($products as $product)
                        @if($goods_receipt_note->matchedProduct($product->id))
                            @continue
                        @endif
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Số lượng</label>
                <input type="text" name="quantity" value="" autofocus placeholder="Chỉ nhập số...">
            </div>
            <div class="field">
                <label>Đơn giá</label>
                <input type="text" name="price" value="" placeholder="2990000 hoặc 2,990,000...">
            </div>
            <span style="margin-top: 10px">
                <strong>Lưu ý:</strong>
                Số lượng không được <strong>nhỏ hơn 1</strong> hoặc <strong>vượt quá 500</strong>.
            </span>
        </form>
    </div>
    <div class="actions">
        <input type="submit" value="OK" form="form-add-goods-receipt-note-product" class="ui fluid blue button">
    </div>
</div>

@foreach($goods_receipt_note_products as $goods_receipt_note_product)
    <div class="mini ui modal" id="modal-edit-goods-receipt-note-product-{{ $goods_receipt_note_product->id }}">
        <div class="header modal-header">Sửa sản phẩm trên phiếu nhập hàng</div>
        <div class="content">
            <form class="ui form" id="form-edit-goods-receipt-note-product-{{ $goods_receipt_note_product->id }}" method="post"
                  action="{{ route('goods_receipt_note_product.update', [$goods_receipt_note_product->id]) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Sản phẩm</label>
                    <select class="ui search disabled selection dropdown" name="product-name">
                        <option value="{{ $goods_receipt_note_product->product_id }}">
                            {{ $goods_receipt_note_product->product->name }}
                        </option>
                    </select>
                </div>
                <div class="field">
                    <label>Số lượng</label>
                    <input type="text" name="quantity" placeholder="Chỉ nhập số..."
                           value="{{ $goods_receipt_note_product->quantity }}" autofocus>
                </div>
                <div class="field">
                    <label>Đơn giá</label>
                    <input type="text" name="price" value="{{ number_format($goods_receipt_note_product->price) }}"
                           placeholder="2990000 hoặc 2,990,000...">
                </div>
                <span style="margin-top: 10px">
                <strong>Lưu ý:</strong>
                Số lượng không được <strong>nhỏ hơn 1</strong> hoặc <strong>vượt quá 500</strong>.
            </span>
            </form>
        </div>
        <div class="actions">
            <input type="submit" value="OK"
                   form="form-edit-goods-receipt-note-product-{{ $goods_receipt_note_product->id }}"
                   class="ui fluid blue button">
        </div>
    </div>
@endforeach