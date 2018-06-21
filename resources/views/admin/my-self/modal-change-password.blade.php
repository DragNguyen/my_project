<div class="mini ui modal" id="modal-change-password">
    <div class="header modal-header">Thay đổi mật khẩu</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('update_password', [$admin->id]) }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Mật khẩu cũ</label>
                <input type="password" name="old-password" placeholder="Nhập lại mật khẩu cũ...">
            </div>
            <div class="field">
                <label>Mật khẩu mới</label>
                <input type="password" name="password" placeholder="Tối thiểu 6 ký tự...">
            </div>
            <div class="field">
                <label>Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu mới...">
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>

        </form>
    </div>
</div>