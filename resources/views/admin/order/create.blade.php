<div class="mini ui modal" id="modal-create-order">
    <div class="header modal-header">Thêm đơn hàng</div>
    <div class="content scrolling">
        <form class="ui form" method="post" id="form-create-order"
              action="{{ route('order.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Người đặt hàng</label>
                <input type="text" name="recipient" value="bla bla">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" name="email" value="bla bla">
            </div>
            <div class="field">
                <label>Số điện thoại</label>
                <input type="text" name="phone" value="bla bla">
            </div>
            <div class="field">
                <label>Địa chỉ</label>
                <input type="text" name="address" value="bla bla">
            </div>
            <div class="field">
                <label>Sản phẩm</label>
                <select class="ui search selection dropdown" multiple name="product-ids[]">
                    @foreach(\App\Product::all() as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="actions">
        <input type="submit" value="OK" form="form-create-order" class="ui fluid blue button">
    </div>
</div>