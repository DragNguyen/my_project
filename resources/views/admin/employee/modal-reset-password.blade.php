@foreach($employees as $employee)
    <div class="mini ui modal" id="modal-reset-password-{{ $employee->id }}">
        <div class="header modal-header">Đặt lại mật khẩu</div>
        <div class="content">
            <form class="ui form" id="form-reset-password-{{ $employee->id }}"
                  action="{{ route('reset_password', [$employee->id]) }}" method="post">
                {{ csrf_field() }}

                <div class="field">
                    <label>Mật khẩu mới</label>
                    <div class="ui corner labeled input">
                        <input type="password" name="employee-password-{{ $employee->id }}"
                               placeholder="Nhập mật khẩu...">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("employee-password-$employee->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("employee-password-$employee->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Nhập lại mật khẩu</label>
                    <div class="ui corner labeled input">
                        <input type="password" name="employee-password-confirm-{{ $employee->id }}"
                               placeholder="Nhập lại mật khẩu...">
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("employee-password-$employee->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("employee-password-$employee->id") }}
                        </div>
                    @endif
                </div>
                <span style="margin-top: 10px">
                    <strong>Lưu ý:</strong>
                    chỉ nhập các ký tự <strong>không dấu</strong>
                    hoặc các ký tự đặc biệt sau: <strong>! @ # $ &</strong>
                </span>
            </form>
        </div>

        <div class="actions">
            <input type="submit" class="ui fluid blue button" value="OK" form="form-reset-password-{{ $employee->id }}">
        </div>
    </div>
@endforeach