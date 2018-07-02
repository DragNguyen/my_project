<div class="mini ui modal" id="modal-customer-register">
    <div class="modal-header">Thêm nhân viên</div>
    <div class="content">
        <form class="ui form" method="post" id="form-customer-register"
              action="{{ route('employee.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Họ và tên</label>
                <div class="ui corner labeled input">
                    <input type="text" name="name" placeholder="Nhập họ và tên..."
                           value="{{ old('name') }}"
                            {{ $errors->has('name')?'autofocus':'' }}>
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('name'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Email</label>
                <div class="ui corner labeled input">
                    <input type="text" name="email" placeholder="Nhập email..."
                           value="{{ old('email') }}"
                            {{ $errors->has('email')?'autofocus':'' }}>
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('email'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Số điện thoại</label>
                <div class="ui corner labeled input">
                    <input type="text" name="phone" placeholder="Nhập số điện thoại..."
                           value="{{ old('phone') }}"
                            {{ $errors->has('phone')?'autofocus':'' }}>
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('phone'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Giới tính</label>
                <select class="ui fluid selection dropdown" name="gender">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
            </div>
        </form>
    </div>

    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-customer-register">
    </div>
</div>