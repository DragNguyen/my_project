<div class="mini ui modal" id="modal-customer-login">
    <div class="ui blue header center-aligned">Đăng nhập</div>
    <div class="content">
        <form class="ui form" method="post" id="form-customer-login"
              action="{{ route('customer.login.submit') }}">
            {{ csrf_field() }}
            <div class="field">
                <label>Email</label>
                {{--<input type="text" name="email" placeholder="Nhập email..."--}}
                       {{--value="{{ old('email') }}"--}}
                <input type="text" name="email" placeholder="Nhập email..."
                       value="nguyennguyencp@gmail.com"
                        {{ $errors->has('email')?'autofocus':'' }}>
                @if($errors->has('email'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="field">
                <label>Mật khẩu</label>
                {{--<input type="password" name="password" placeholder="Nhập mật khẩu..."--}}
                       {{--value="{{ old('password') }}"--}}
                        {{--{{ $errors->has('password')?'autofocus':'' }}>--}}
                <input type="password" name="password" placeholder="Nhập mật khẩu..."
                       value="635982359"
                        {{ $errors->has('password')?'autofocus':'' }}>
                @if($errors->has('password'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="field center-aligned">
                Chưa có tài khoản?
                <a onclick="$('#modal-customer-register').modal('show')" href="#"><strong>Đăng ký ngay</strong></a>
            </div>
        </form>
    </div>

    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-customer-login">
    </div>
</div>

<div class="tiny ui modal" id="modal-customer-register">
    <div class="ui blue header center-aligned">Đăng ký</div>
    <div class="content">
        <form action="{{ route('customer.register.submit') }}"
              class="ui form" id="form-customer-register" method="post">
            {{ csrf_field() }}

            <div class="two fields">
                <div class="required field">
                    <label>Họ và tên</label>
                    <input type="text" name="name" placeholder="Nhập họ và tên..."
                           value="{{ old('name') }}"
                            {{ $errors->has('name')?'autofocus':'' }}>
                    @if($errors->has('name'))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Nhập email..."
                           value="{{ old('email') }}"
                            {{ $errors->has('email')?'autofocus':'' }}>
                    @if($errors->has('email'))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="two fields">
                <div class="required field">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu..."
                            {{ $errors->has('password')?'autofocus':'' }}>
                    @if($errors->has('password'))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" name="password-confirm" placeholder="Nhập lại mật khẩu...">
                    @if($errors->has('password-confirm'))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('password-confirm') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="two fields">
                <div class="required field">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" placeholder="Nhập số điện thoại..."
                           value="{{ old('phone') }}"
                            {{ $errors->has('phone')?'autofocus':'' }}>
                    @if($errors->has('phone'))
                        <div style="color: red; margin-top: 5px; font-size: 13px">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label>Giới tính</label>
                    <select class="ui selection dropdown" name="gender">
                        <option value="1" selected>Nam</option>
                        <option value="0">Nữ</option>
                    </select>
                </div>
            </div>
            <div class="required field">
                <label>Địa chỉ</label>
                <textarea name="address" rows="2" placeholder="Nhập địa chỉ..."
                        {{ $errors->has('address')?'autofocus':'' }}></textarea>
                @if($errors->has('address'))
                    <div style="color: red; margin-top: 5px; font-size: 13px">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>

            <div class="field center-aligned">
                Đã có tài khoản?
                <a href="#" onclick="$('#modal-customer-login').modal('show')"><strong>Đăng nhập</strong></a>
            </div>

            {{--<div class="ui divider hidden"></div>--}}
        </form>
    </div>

    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-customer-register">
    </div>
</div>