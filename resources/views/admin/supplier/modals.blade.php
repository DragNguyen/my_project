<div class="mini ui modal" id="modal-create-supplier">
    <div class="modal-header">Thêm nhà cung cấp</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('supplier.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên nhà cung cấp</label>
                <input type="text" name="supplier-name" value="{{ old('supplier-name') }}">
            </div>
            <div class="field">
                <label>Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
            </div>
            <div class="field">
                <label>Địa chỉ</label>
                <input type="text" name="address" value="{{ old('address') }}">
            </div>
            <div class="field">
                <label>Website</label>
                <input type="text" name="website" value="{{ old('website') }}">
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>

        </form>
    </div>
</div>

@foreach($suppliers as $supplier)
    <div class="mini ui modal" id="modal-sua-ncc-{{ $supplier->id }}">
        <div class="header modal-header">Sửa nhà cung cấp</div>
        <div class="content">
            <form class="ui form" action="{{ route('supplier.update', [$supplier->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên nhà cung cấp</label>
                    <input type="text" name="supplier-name" value="{{ $supplier->name }}">
                </div>
                <div class="field">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="{{ $supplier->phone }}">
                </div>
                <div class="field">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="{{ $supplier->address }}">
                </div>
                <div class="field">
                    <label>Website</label>
                    <input type="text" name="website" value="{{ $supplier->website }}">
                </div>
                <div class="field">
                    <button class="ui fluid blue button" type="submit">
                        <strong>OK</strong>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endforeach