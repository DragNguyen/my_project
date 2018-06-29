<div class="mini ui modal" id="modal-create-sales-off-child">
    <div class="header modal-header">Thêm khuyến mãi</div>
    <div class="content">
        <form class="ui form" id="form-add-sales-off-child" method="post"
              action="{{ route('sales_off_child.store') }}">
            {{ csrf_field() }}

            <input type="hidden" value="{{ $sales_off->id }}" name="sales-off-id">
            <div class="field">
                <label>Giá trị khuyến mãi (%)</label>
                <div class="ui corner labeled input">
                    <div class="ui fluid multiple search selection dropdown dropdown-tag">
                        <input type="hidden" name="sales-off-values" value="{{ old('sales-off-values') }}">
                        <div class="default text">Chọn hoặc nhập nhiều giá trị...</div>
                        <div class="menu">
                            @for($i=5; $i<100; $i=$i+5)
                                @if($sales_off->matchedValue($i))
                                    @continue
                                @endif
                                <div class="item" data-value="{{ $i }}">{{ $i }}</div>
                            @endfor
                        </div>
                    </div>
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('sales-off-values'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('sales-off-values') }}
                    </div>
                @endif
            </div>
            <span style="margin-top: 10px">
                    <strong>Lưu ý:</strong>
                    chỉ nhập số nguyên
                    <strong>không vượt quá 99</strong> hoặc <strong>nhỏ hơn 1</strong>,
                    dùng dấu (<strong>,</strong>) để kết thúc một giá trị nhập.
            </span>
        </form>
    </div>
    <div class="actions">
        <input type="submit" value="OK"
               form="form-add-sales-off-child" class="ui fluid blue button">
    </div>
</div>

@foreach($sales_off_childs as $sales_off_child)
    <div class="mini ui modal" id="modal-edit-sales-off-child-{{ $sales_off_child->id }}">
        <div class="header modal-header">Sửa khuyến mãi</div>
        <div class="content">
            <form class="ui form" id="form-edit-sales-off-child-{{ $sales_off_child->id }}" method="post"
                  action="{{ route('sales_off_child.update', [$sales_off_child->id]) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Giá trị khuyến mãi (%)</label>
                    <div class="ui corner labeled input">
                        <input type="text" name="sales-off-value-{{ $sales_off_child->id }}" placeholder="Nhập giá trị..."
                               value="{{ $sales_off_child->value }}">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("sales-off-value-$sales_off_child->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("sales-off-value-$sales_off_child->id") }}
                        </div>
                    @endif
                </div>
                <span style="margin-top: 10px">
                    <strong>Lưu ý:</strong>
                    Chỉ nhập số nguyên <strong>không vượt quá 99</strong> hoặc <strong>nhỏ hơn 1</strong>.
            </span>
            </form>
        </div>
        <div class="actions">
            <input type="submit" value="OK"
                   form="form-edit-sales-off-child-{{ $sales_off_child->id }}" class="ui fluid blue button">
        </div>
    </div>
@endforeach