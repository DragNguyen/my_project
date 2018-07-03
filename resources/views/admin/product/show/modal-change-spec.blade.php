<div class="ui mini modal" id="modal-change-price">
    <div class="header modal-header">Cập nhật thông số kỹ thuật</div>
    <div class="content">
        <form class="ui form" method="get" id="form-change-price"
              action="{{ route('product_change_price', [$product->id]) }}">

            {{ csrf_field() }}

            @foreach($specs as $spec)
                <div class="field">
                    <label>{{ $spec->getSpecName() }}</label>
                    <div class="ui corner labeled input">
                        <input type="text" name="{{  }}" value="{{ old('price') }}"
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
            @endforeach
            <span style="margin-top: 10px">
                <strong>Lưu ý:</strong>
                Giá tiền <strong>không vượt quá</strong> 100,000,000đ hoặc
                <strong>nhỏ hơn</strong> 1,000đ.
            </span>
        </form>
    </div>
    <div class="actions">
        <input type="submit" form="form-change-price" class="ui fluid blue button" value="OK">
    </div>
</div>