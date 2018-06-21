<div class="mini ui modal" id="modal-create-goods-receipt-note-child">
    <div class="header modal-header">Thêm nhà cung cấp vào phiếu nhập</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('goods_receipt_note_child.store') }}">
            {{ csrf_field() }}

            <input type="hidden" value="{{ $goods_receipt_note->id }}" name="parent-id">
            <div class="field">
                <label>Tên nhà cung cấp</label>
                <select class="ui search selection dropdown" name="supplier[]" multiple="">
                    <option value="">
                        Chọn nhiều nhà cung cấp...
                    </option>
                    @foreach($suppliers as $supplier)
                        @if($goods_receipt_note->matchedSupplier($supplier->id))
                            @continue
                        @endif
                        <option value="{{ $supplier->id }}">
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>

        </form>
    </div>
</div>