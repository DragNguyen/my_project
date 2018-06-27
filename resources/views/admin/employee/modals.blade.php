<div class="mini ui modal" id="modal-create-employee">
    <div class="modal-header">Thêm nhân viên</div>
    <div class="content">
        <form class="ui form" method="post" id="form-add-employee"
              action="{{ route('employee.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên nhân viên</label>
                <div class="ui corner labeled input">
                    <input type="text" name="employee-name" placeholder="Nhập tên nhân viên..."
                           value="{{ old('employee-name') }}"
                            {{ $errors->has('employee-name')?'autofocus':'' }}>
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('employee-name'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('employee-name') }}
                    </div>
                @endif

            </div>
            <div class="field">
                <label>Số điện thoại</label>
                <div class="ui corner labeled input">
                    <input type="text" name="employee-phone" placeholder="Nhập số điện thoại..."
                           value="{{ old('employee-phone') }}"
                            {{ $errors->has('employee-phone')?'autofocus':'' }}>
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('employee-phone'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('employee-phone') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Email</label>
                <div class="ui corner labeled input">
                    <input type="text" name="employee-email" placeholder="Nhập email..."
                           value="{{ old('employee-email') }}"
                            {{ $errors->has('employee-email')?'autofocus':'' }}>
                    <div class="ui corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
                @if($errors->has('employee-email'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('employee-email') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Giới tính</label>
                <select class="ui fluid selection dropdown" name="employee-gender">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
            </div>
        </form>
    </div>

    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-add-employee">
    </div>
</div>

@foreach($employees as $employee)
    <div class="mini ui modal" id="modal-edit-employee-{{ $employee->id }}">
        <div class="header modal-header">Sửa nhân viên</div>
        <div class="content">
            <form class="ui form" id="form-edit-employee-{{ $employee->id }}"
                  action="{{ route('employee.update', [$employee->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên nhân viên</label>
                    <div class="ui corner labeled input">
                        <input type="text" name="employee-name-{{ $employee->id }}" placeholder="Nhập tên nhân viên..."
                               value="{{ $employee->name }}"
                                {{ $errors->has("employee-name-$employee->id")?'autofocus':'' }}>
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("employee-name-$employee->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("employee-name-$employee->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Số điện thoại</label>
                    <div class="ui corner labeled input">
                        <input type="text" name="employee-phone-{{ $employee->id }}" placeholder="Nhập số điện thoại..."
                               value="{{ $employee->phone }}"
                                {{ $errors->has("employee-phone-$employee->id")?'autofocus':'' }}>
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("employee-phone-$employee->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("employee-phone-$employee->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Địa chỉ</label>
                    <div class="ui corner labeled input">
                        <input type="text" name="employee-email-{{ $employee->id }}" placeholder="Nhập email..."
                               value="{{ $employee->email }}"
                                {{ $errors->has("employee-email-$employee->id")?'autofocus':'' }}>
                        <div class="ui corner label">
                            <i class="asterisk icon"></i>
                        </div>
                    </div>
                    @if($errors->has("employee-email-$employee->id"))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first("employee-email-$employee->id") }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Giới tính</label>
                    <select class="ui fluid selection dropdown" name="employee-gender">
                        <option value="1" {{ ($employee->gender == 1) ? 'selected' : '' }}>Nam</option>
                        <option value="0" {{ ($employee->gender == 0) ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="actions">
            <input type="submit" class="ui fluid blue button" value="OK" form="form-edit-employee-{{ $employee->id }}">
        </div>
    </div>
@endforeach