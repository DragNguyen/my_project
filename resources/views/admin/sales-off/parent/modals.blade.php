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
                           name="sales-off-name" value="Quốc tế thiếu nhi 1/6">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Ngày bắt đầu</label>
                <div class="ui corner labeled input">
                    <input type="date" name="begin-at" value="{{ date('Y-m-d') }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Ngày kết thúc</label>
                <div class="ui corner labeled input">
                    <input type="date" name="end-at"
                           value="{{ date_format(date_modify(date_create(date('Y-m-d')), '+5 days'), 'Y-m-d') }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Giá trị khuyến mãi</label>
                <select name="values[]" class="ui search selection dropdown" multiple>
                    <option value="">Chọn các giá trị hoặc nhập sau...</option>
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
                    <input type="text" name="sales-off-name" value="{{ $sales_off->name }}">
                </div>
                <div class="field">
                    <label>Ngày bắt đầu</label>
                    <input type="date" name="begin-at" value="{{ $sales_off->begin_at }}">
                </div>
                <div class="field">
                    <label>Ngày kết thúc</label>
                    <input type="date" name="end-at"
                           value="{{ $sales_off->end_at }}">
                </div>
            </form>
        </div>
        <div class="actions">
            <input type="submit" value="OK" form="form-edit-sales-off-{{ $sales_off->id }}" class="ui fluid blue button">
        </div>
    </div>
@endforeach