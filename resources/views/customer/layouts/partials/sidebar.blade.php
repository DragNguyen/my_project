<div class="ui right thin sidebar vertical menu" id="sidebar-mobile">
    <div class="item">
        <img src="{{ asset('assets/images/logo_wide.png') }}" class="ui image">
    </div>
    <div class="ui white small dropdown item">
        <i class="user icon"></i><strong> Tài khoản</strong>
        <div class="menu">
            <div class="item" onclick="$('#modal-auth').modal('show')">
                <i class="sign in alternate icon"></i>Đăng nhập
            </div>

            <a href="#" class="item">
                <i class="key icon"></i>Đăng ký
            </a>

            <a href="#" class="item">
                <i class="search icon"></i>Tra cứu đơn hàng</a>
        </div>
    </div>
</div>