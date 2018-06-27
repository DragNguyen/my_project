<div class="ui mini modal" id="modal-change-price">
    <div class="header modal-header">Thay đổi giá</div>
    <div class="content">
        <form class="ui form" method="get" id="form-change-price"
              action="{{ route('product_change_price', [$product->id]) }}">

            {{ csrf_field() }}

            <div class="field">
                <div class="ui corner labeled input">
                    <input type="text" name="price" value="{{ old('price') }}"
                           placeholder="2990000 hoặc 2,990,000">
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
                Giá tiền <strong>không vượt quá</strong> 100,000,000đ hoặc
                <strong>không nhỏ hơn</strong> 1,000đ.
            </span>
        </form>
    </div>
    <div class="actions">
        <input type="submit" form="form-change-price" class="ui fluid blue button" value="OK">
    </div>
</div>