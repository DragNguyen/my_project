<div class="mini ui modal" id="modal-change-password">
    <div class="header modal-header">Thay đổi mật khẩu</div>
    <div class="content">
        <form class="ui form" method="post" id="form-change-password"
              action="{{ route('update_password', [$admin->id]) }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Mật khẩu cũ</label>
                <div class="ui corner labeled input">
                    <input type="password" name="old-password" placeholder="Nhập lại mật khẩu cũ...">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
            </div>
            @if($errors->has('old-password'))
                <div style="color: red; margin-top: 5px; font-size: 13px">
                    {{ $errors->first('old-password') }}
                </div>
            @endif
            <div class="field">
                <label>Mật khẩu mới</label>
                <div class="ui corner labeled input">
                    <input type="password" name="password" placeholder="Tối thiểu 6 ký tự...">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
            </div>
            @if($errors->has('password'))
                <div style="color: red; margin-top: 5px; font-size: 13px">
                    {{ $errors->first('password') }}
                </div>
            @endif
            <div class="field">
                <label>Nhập lại mật khẩu</label>
                <div class="ui corner labeled input">
                    <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu mới...">
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
            </div>
            @if($errors->has('password_confirmation'))
                <div style="color: red; margin-top: 5px; font-size: 13px">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
            <span style="margin-top: 10px">
                <strong>Lưu ý:</strong> Chỉ được dùng ký tự <strong>không dấu</strong>
                và các ký tự đặc biệt sau: <strong>! @ # $ &</strong>
            </span>

        </form>
    </div>
    <div class="actions">
        <input type="submit" value="OK" form="form-change-password" class="ui fluid blue button">
    </div>
</div>