<div class="mini ui modal" id="modal-create-sales-off">
    <div class="header modal-header">Thêm khuyến mãi</div>
    <div class="scrolling content">
        <form class="ui form" id="form-add-sales-off" method="post"
              action="{{ route('sales_off.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên khuyến mãi</label>
                <input type="text" name="sales-off-name" value="Quốc tế thiếu nhi 1/6">
            </div>
            <div class="field">
                <label>Ngày bắt đầu</label>
                <input type="date" name="begin-at" value="{{ date('Y-m-d') }}">
            </div>
            <div class="field">
                <label>Ngày kết thúc</label>
                <input type="date" name="end-at"
                       value="{{ date_format(date_modify(date_create(date('Y-m-d')), '+5 days'), 'Y-m-d') }}">
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

{{--@foreach($goods_receipt_notes as $goods_receipt_note)--}}
    {{--<div class="mini ui modal" id="modal-edit-goods-receipt-note-{{ $goods_receipt_note->id }}">--}}
        {{--<div class="header modal-header">Sửa phiếu nhập hàng</div>--}}
        {{--<div class="scrolling content">--}}
            {{--<form class="ui form" id="form-edit-goods-receipt-note-{{ $goods_receipt_note->id }}" method="post"--}}
                  {{--action="{{ route('goods_receipt_note.update', [$goods_receipt_note->id]) }}">--}}
                {{--{{ csrf_field() }}--}}
                {{--{{ method_field('PUT') }}--}}

                {{--<div class="field">--}}
                    {{--<label>Tên nhà cung cấp</label>--}}
                    {{--<select class="ui search selection dropdown" name="supplier">--}}
                        {{--@foreach($suppliers as $supplier)--}}
                            {{--<option value="{{ $supplier->id }}"--}}
                                    {{--{{ ($goods_receipt_note->supplier_id==$supplier->id)?'selected':'' }}>--}}
                                {{--{{ $supplier->name }}--}}
                            {{--</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="field">--}}
                    {{--<label>Ngày nhập hàng</label>--}}
                    {{--<input type="date" name="date" value="{{ $goods_receipt_note->date }}">--}}
                {{--</div>--}}
                {{--<div class="field">--}}
                    {{--<label>Tên người nhập hàng</label>--}}
                    {{--<select class="ui selection dropdown" name="admin" disabled>--}}
                        {{--<option value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">--}}
                            {{--{{ \Illuminate\Support\Facades\Auth::user()->name }}--}}
                        {{--</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
        {{--<div class="actions">--}}
            {{--<input type="submit" value="OK"--}}
                   {{--form="form-edit-goods-receipt-note-{{ $goods_receipt_note->id }}" class="ui fluid blue button">--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endforeach--}}