<div class="mini ui modal" id="modal-create-goods-receipt-note">
    <div class="header modal-header">Thêm phiếu nhập hàng</div>
    <div class="content scrolling">
        <form class="ui form" method="post" action="{{ route('goods_receipt_note.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên người nhập hàng</label>
                <select class="ui search selection dropdown" name="name">
                    <option value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                        {{ \Illuminate\Support\Facades\Auth::user()->name }}
                    </option>
                    @foreach($admins as $admin)
                        @if(\Illuminate\Support\Facades\Auth::user()->id == $admin->id)
                            @continue
                        @endif
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Ngày nhập hàng</label>
                <input type="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
            <div class="field">
                <label>Tên nhà cung cấp</label>
                <select class="ui search selection dropdown" name="supplier[]" multiple="">
                    <option value="">
                        Chọn nhiều nhà cung cấp...
                    </option>
                    @foreach($suppliers as $supplier)
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