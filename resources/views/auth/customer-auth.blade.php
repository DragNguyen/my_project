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
                Chưa có tài khoản? <a href="{{ route('customer.register.show') }}"><strong>Đăng ký ngay</strong></a>
            </div>
        </form>
    </div>

    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-customer-login">
    </div>
</div>