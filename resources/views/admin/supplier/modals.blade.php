<div class="mini ui modal" id="modal-create-supplier">
    <div class="modal-header">Thêm nhà cung cấp</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('supplier.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên nhà cung cấp</label>
                <input type="text" name="supplier-name"
                       value="{{ (old('id')==null)?old('supplier-name'):'' }}"
                       {{ ($errors->has('supplier-name')&&old('id')==null)?'autofocus':'' }}>
                @if($errors->has('supplier-name') && old('id')==null)
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('supplier-name') }}
                    </div>
                @endif

            </div>
            <div class="field">
                <label>Số điện thoại</label>
                <input type="text" name="phone"
                       value="{{ (old('id')==null)?old('phone'):'' }}"
                        {{ ($errors->has('phone')&&old('id')==null)?'autofocus':'' }}>
                @if($errors->has('phone') && old('id')==null)
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Địa chỉ</label>
                <input type="text" name="address" value="{{ (old('id')==null)?old('address'):'' }}"
                        {{ ($errors->has('address')&&old('id')==null)?'autofocus':'' }}>
                @if($errors->has('address') && old('id')==null)
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Website</label>
                <input type="text" name="website" value="{{ (old('id')==null)?old('website'):'' }}"
                        {{ ($errors->has('website')&&old('id')==null)?'autofocus':'' }}>
                @if($errors->has('website') && old('id')==null)
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('website') }}
                    </div>
                @endif
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
    <div class="mini ui modal" id="modal-edit-supplier-{{ $supplier->id }}">
        <div class="header modal-header">Sửa nhà cung cấp</div>
        <div class="content">
            <form class="ui form" action="{{ route('supplier.update', [$supplier->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <input type="hidden" name="id" value="{{ $supplier->id }}">
                <div class="field">
                    <label>Tên nhà cung cấp</label>
                    <input type="text" name="supplier-name" value="{{ $supplier->name }}"
                            {{ $errors->has('supplier-name')?'autofocus':'' }}>
                    @if($errors->has('supplier-name') && (old('id')==$supplier->id))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('supplier-name') }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="{{ $supplier->phone }}"
                            {{ $errors->has('phone')?'autofocus':'' }}>
                    @if($errors->has('phone') && (old('id')==$supplier->id))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="{{ $supplier->address }}"
                            {{ $errors->has('address')?'autofocus':'' }}>
                    @if($errors->has('address') && (old('id')==$supplier->id))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Website</label>
                    <input type="text" name="website" value="{{ $supplier->website }}"
                            {{ $errors->has('website')?'autofocus':'' }}>
                    @if($errors->has('website') && (old('id')==$supplier->id))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('website') }}
                        </div>
                    @endif
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