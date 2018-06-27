<div class="mini ui modal" id="modal-create-supplier">
    <div class="modal-header">Thêm nhà cung cấp</div>
    <div class="content">
        <form class="ui form" method="post" id="form-add-supplier"
              action="{{ route('supplier.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên nhà cung cấp</label>
                <input type="text" name="supplier-name" placeholder="Nhập tên nhà cung cấp..."
                       value="{{ old('supplier-name') }}"
                       {{ $errors->has('supplier-name')?'autofocus':'' }}>
                @if($errors->has('supplier-name'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('supplier-name') }}
                    </div>
                @endif

            </div>
            <div class="field">
                <label>Số điện thoại</label>
                <input type="text" name="supplier-phone" placeholder="Nhập số điện thoại..."
                       value="{{ old('supplier-phone') }}"
                        {{ $errors->has('supplier-phone')?'autofocus':'' }}>
                @if($errors->has('supplier-phone'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('supplier-phone') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Địa chỉ</label>
                <input type="text" name="supplier-address" placeholder="Nhập địa chỉ..."
                       value="{{ old('supplier-address') }}"
                        {{ $errors->has('supplier-address')?'autofocus':'' }}>
                @if($errors->has('supplier-address'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('supplier-address') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Website</label>
                <input type="text" name="supplier-website" placeholder="Nhập website..."
                       value="{{ old('supplier-website') }}"
                        {{ $errors->has('supplier-website')?'autofocus':'' }}>
                @if($errors->has('supplier-website'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('supplier-website') }}
                    </div>
                @endif
            </div>
        </form>
    </div>

    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-add-supplier">
    </div>
</div>

@foreach($suppliers as $supplier)
    <div class="mini ui modal" id="modal-edit-supplier-{{ $supplier->id }}">
        <div class="header modal-header">Sửa nhà cung cấp</div>
        <div class="content">
            <form class="ui form" id="form-edit-supplier-{{ $supplier->id }}"
                  action="{{ route('supplier.update', [$supplier->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên nhà cung cấp</label>
                    <input type="text" name="supplier-name-{{ $supplier->id }}" placeholder="Nhập tên nhà cung cấp..."
                           value="{{ $supplier->name }}"
                            {{ $errors->has("supplier-name-$supplier->id")?'autofocus':'' }}>
                    @if($errors->has("supplier-name-$supplier->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("supplier-name-$supplier->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Số điện thoại</label>
                    <input type="text" name="supplier-phone-{{ $supplier->id }}" placeholder="Nhập số điện thoại..."
                           value="{{ $supplier->phone }}"
                            {{ $errors->has("supplier-phone-$supplier->id")?'autofocus':'' }}>
                    @if($errors->has("supplier-phone-$supplier->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("supplier-phone-$supplier->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Địa chỉ</label>
                    <input type="text" name="supplier-address-{{ $supplier->id }}" placeholder="Nhập địa chỉ..."
                           value="{{ $supplier->address }}"
                            {{ $errors->has("supplier-address-$supplier->id")?'autofocus':'' }}>
                    @if($errors->has("supplier-address-$supplier->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("supplier-address-$supplier->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Website</label>
                    <input type="text" name="supplier-website-{{ $supplier->id }}" placeholder="Nhập website..."
                           value="{{ $supplier->website }}"
                            {{ $errors->has("supplier-website-$supplier->id")?'autofocus':'' }}>
                    @if($errors->has("supplier-website-$supplier->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("supplier-website-$supplier->id") }}
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="actions">
            <input type="submit" class="ui fluid blue button" value="OK" form="form-edit-supplier-{{ $supplier->id }}">
        </div>
    </div>
@endforeach