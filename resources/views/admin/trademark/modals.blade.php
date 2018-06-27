<div class="mini ui modal" id="modal-create-trademark">
    <div class="header modal-header">Thêm thương hiệu</div>
    <div class="content">
        <form class="ui form" method="post"
              action="{{ route('trademark.store') }}" id="form-add-trademark">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên thương hiệu</label>
                <div class="ui corner labeled input">
                    <input type="text" name="trademark-name" placeholder="Nhập tên thương hiệu..."
                           value="{{ old('trademark-name') }}">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('trademark-name'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('trademark-name') }}
                    </div>
                @endif
            </div>
            <span style="margin-top: 10px">
                <strong>Lưu ý:</strong>
                Chỉ nhập các <strong>ký tự tiếng Việt</strong>.
            </span>
        </form>
    </div>

    <div class="actions">
        <input type="submit" value="OK" form="form-add-trademark" class="ui blue fluid button">
    </div>
</div>

@foreach($trademarks as $trademark)
    <div class="mini ui modal" id="modal-edit-trademark-{{ $trademark->id }}">
        <div class="header modal-header">Sửa loại sản phẩm</div>
        <div class="content">
            <form class="ui form" id="form-edit-trademark-{{ $trademark->id }}"
                  action="{{ route('trademark.update', [$trademark->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên loại sản phẩm</label>
                    <div class="ui corner labeled input">
                        <input type="text" name="trademark-name-{{ $trademark->id }}"
                               value="{{ $trademark->name }}">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("trademark-name-$trademark->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("trademark-name-$trademark->id") }}
                        </div>
                    @endif
                </div>
                <span style="margin-top: 10px">
                    <strong>Lưu ý:</strong>
                    Chỉ nhập các <strong>ký tự tiếng Việt</strong>.
                </span>
            </form>
        </div>
        <div class="actions">
            <input type="submit" value="OK"
                   form="form-edit-trademark-{{ $trademark->id }}" class="ui fluid blue button">
        </div>
    </div>
@endforeach