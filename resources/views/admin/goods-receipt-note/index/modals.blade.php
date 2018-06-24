<div class="mini ui modal" id="modal-create-goods-receipt-note">
    <div class="header modal-header">Thêm phiếu nhập hàng</div>
    <div class="scrolling content">
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
                <input type="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
            <div class="field">
                <label>Tên người nhập hàng</label>
                <select class="ui selection dropdown" name="admin">
                    <option value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                        {{ \Illuminate\Support\Facades\Auth::user()->name }}
                    </option>
                </select>
            </div>
        </form>
    </div>
    <div class="actions">
        <input type="submit" value="OK" form="form-add-goods-receipt-note" class="ui fluid blue button">
    </div>
</div>

@foreach($goods_receipt_notes as $goods_receipt_note)
    <div class="mini ui modal" id="modal-edit-goods-receipt-note-{{ $goods_receipt_note->id }}">
        <div class="header modal-header">Sửa phiếu nhập hàng</div>
        <div class="scrolling content">
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
                    <input type="date" name="date" value="{{ $goods_receipt_note->date }}">
                </div>
                <div class="field">
                    <label>Tên người nhập hàng</label>
                    <select class="ui selection dropdown" name="admin" disabled>
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