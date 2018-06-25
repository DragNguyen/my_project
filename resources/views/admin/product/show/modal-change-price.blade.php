<div class="ui mini modal" id="modal-change-price">
    <div class="header modal-header">Thay đổi giá</div>
    <div class="content">
        <form class="ui form" method="get" id="form-change-price"
              action="{{ route('product_change_price', [$product->id]) }}">

            {{ csrf_field() }}

            <div class="field">
                <input type="text" name="price" placeholder="2990000 hoặc 2,990,000">
            </div>
            <span style="margin-top: 10px">
                <strong>Lưu ý:</strong>
                Giá tiền <strong>không vượt quá</strong> 100,000,000đ hoặc
                <strong>không nhỏ hơn</strong> 1,000đ.
            </span>
        </form>
    </div>
    <div class="actions">
        <input type="submit" form="form-change-price" class="ui fluid blue button" value="OK">
    </div>
</div>