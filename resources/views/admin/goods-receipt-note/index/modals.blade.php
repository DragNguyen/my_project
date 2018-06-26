<div class="mini ui modal" id="modal-create-goods-receipt-note">
    <div class="header modal-header">Thêm phiếu nhập hàng</div>
    <div class="content">
        <form class="ui form" id="form-add-goods-receipt-note" method="post"
              action="{{ route('goods_receipt_note.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên nhà cung cấp</label>
                <select class="ui search selection dropdown" name="supplier">
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Ngày nhập hàng</label>
                <div class="ui corner labeled input">
                    <input type="date" name="date" value="{{ date('Y-m-d') }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('date'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Tên người nhập hàng</label>
                <select class="ui disabled selection dropdown" name="admin">
                    <option value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                        {{ \Illuminate\Support\Facades\Auth::user()->name }}
                    </option>
                </select>
            </div>
            <span style="margin-top: 10px">
                <strong>Lưu ý:</strong>
                Ngày nhập hàng <strong>không trước</strong> ngày 01/01/2018 hoặc <strong>sau</strong> ngày hiện tại.
            </span>
        </form>
    </div>
    <div class="actions">
        <input type="submit" value="OK" form="form-add-goods-receipt-note" class="ui fluid blue button">
    </div>
</div>

@foreach($goods_receipt_notes as $goods_receipt_note)
    <div class="mini ui modal" id="modal-edit-goods-receipt-note-{{ $goods_receipt_note->id }}">
        <div class="header modal-header">Sửa phiếu nhập hàng</div>
        <div class="content">
            <form class="ui form" id="form-edit-goods-receipt-note-{{ $goods_receipt_note->id }}" method="post"
                  action="{{ route('goods_receipt_note.update', [$goods_receipt_note->id]) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên nhà cung cấp</label>
                    <select class="ui search selection dropdown" name="supplier">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                    {{ ($goods_receipt_note->supplier_id==$supplier->id)?'selected':'' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label>Ngày nhập hàng</label>
                    <div class="ui corner labeled input">
                        <input type="date" name="date-{{ $goods_receipt_note->id }}" value="{{ $goods_receipt_note->date }}">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("date-{{ $goods_receipt_note->id }}"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("date-$goods_receipt_note->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Tên người nhập hàng</label>
                    <select class="ui selection dropdown disabled" name="admin">
                        <option value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                        </option>
                    </select>
                </div>
            </form>
        </div>
        <div class="actions">
            <input type="submit" value="OK"
                   form="form-edit-goods-receipt-note-{{ $goods_receipt_note->id }}" class="ui fluid blue button">
        </div>
    </div>
@endforeach