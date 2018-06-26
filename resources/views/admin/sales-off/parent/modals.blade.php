<div class="mini ui modal" id="modal-create-sales-off">
    <div class="header modal-header">Thêm khuyến mãi</div>
    <div class="scrolling content">
        <form class="ui form" id="form-add-sales-off" method="post"
              action="{{ route('sales_off.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên khuyến mãi</label>
                <div class="ui corner labeled input">
                    <input type="text" placeholder="Nhập tên khuyến mãi..."
                           {{ $errors->has("sales-off-name")?'autofocus':'' }}
                           name="sales-off-name" value="{{ old('sales-off-name') }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('sales-off-name'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('sales-off-name') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Ngày bắt đầu</label>
                <div class="ui corner labeled input">
                    <input type="date" name="begin-at" {{ $errors->has("begin-at")?'autofocus':'' }}
                           value="{{ $errors->has("begin-at")?old('begin-at'):date('Y-m-d') }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('begin-at'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('begin-at') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Ngày kết thúc</label>
                <div class="ui corner labeled input">
                    <input type="date" name="end-at" {{ $errors->has("end-at")?'autofocus':'' }}
                           value="{{ date_format(date_modify(date_create(date('Y-m-d')), '+5 days'), 'Y-m-d') }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('end-at'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('end-at') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Giá trị khuyến mãi</label>
                <select name="values[]" class="ui search selection dropdown" multiple>
                    <option value="">Chọn các giá trị có sẵn...</option>
                    @for($i=5; $i<100; $i=$i+5)
                        <option value="{{ $i }}">{{ "$i%" }}</option>
                    @endfor
                </select>
            </div>
        </form>
    </div>
    <div class="actions">
        <input type="submit" value="OK" form="form-add-sales-off" class="ui fluid blue button">
    </div>
</div>

@foreach($sales_offs as $sales_off)
    <div class="mini ui modal" id="modal-edit-sales-off-{{ $sales_off->id }}">
        <div class="header modal-header">Sửa khuyến mãi</div>
        <div class="scrolling content">
            <form class="ui form" id="form-edit-sales-off-{{ $sales_off->id }}" method="post"
                  action="{{ route('sales_off.update', [$sales_off->id]) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <input type="hidden" value="true" name="sales-off-parent">
                <div class="field">
                    <label>Tên khuyến mãi</label>
                    <div class="ui corner labeled input">
                        <input type="text" name="sales-off-name-{{ $sales_off->id }}"
                               {{ $errors->has("sales-off-name-$sales_off->id")?'autofocus':'' }}
                               value="{{ $sales_off->name }}">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("sales-off-name-$sales_off->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("sales-off-name-$sales_off->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Ngày bắt đầu</label>
                    <div class="ui corner labeled input">
                        <input type="date" name="begin-at-{{ $sales_off->id }}"
                               {{ $errors->has("begin-at-$sales_off->id")?'autofocus':'' }}
                               value="{{ $sales_off->begin_at }}">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("begin-at-$sales_off->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("begin-at-$sales_off->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Ngày kết thúc</label>
                    <div class="ui corner labeled input">
                        <input type="date" name="end-at-{{ $sales_off->id }}"
                               {{ $errors->has("end-at-$sales_off->id")?'autofocus':'' }}
                               value="{{ $sales_off->end_at }}">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("end-at-$sales_off->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("end-at-$sales_off->id") }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="actions">
            <input type="submit" value="OK" form="form-edit-sales-off-{{ $sales_off->id }}" class="ui fluid blue button">
        </div>
    </div>
@endforeach