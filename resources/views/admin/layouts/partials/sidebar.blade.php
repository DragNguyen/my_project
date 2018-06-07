<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    @include('admin.layouts.partials.sidebar_header')

    <div class="menu_section">
        <ul class="nav side-menu">
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/tong-quan') ? 'current-page' : '' }}">
                <a href="{{ route('tong-quan.index') }}">
                    <i class="fa fa-dashboard"></i>
                    Tổng quan
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/thuong-hieu') ? 'current-page' : '' }}">
                <a href="{{ route('thuong-hieu.index') }}">
                    <i class="fa fa-trophy"></i>
                    Thương hiệu
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/nha-cung-cap') ? 'current-page' : '' }}">
                <a href="{{ route('nha-cung-cap.index') }}">
                    <i class="fa fa-rebel"></i>
                    Nhà cung cấp
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/san-pham') ? 'current-page' : '' }}">
                <a href="{{ route('san-pham.index') }}">
                    <i class="fa fa-laptop"></i>
                    Sản phẩm
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/loai-san-pham') ? 'current-page' : '' }}">
                <a href="{{ route('loai-san-pham.index') }}">
                    <i class="fa fa-sitemap"></i>
                    Loại sản phẩm
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/nhap-hang') ? 'current-page' : '' }}">
                <a href="{{ route('nhap-hang.index') }}">
                    <i class="fa fa-truck"></i>
                    Nhập hàng
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/don-hang') ? 'current-page' : '' }}">
                <a href="{{ route('don-hang.index') }}">
                    <i class="fa fa-clipboard"></i>
                    Đơn hàng
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/khuyen-mai') ? 'current-page' : '' }}">
                <a href="{{ route('khuyen-mai.index') }}">
                    <i class="fa fa-certificate"></i>
                    Khuyến mãi
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/tai-khoan/*') ? 'active' : '' }}">
                <a>
                    <i class="fa fa-users"></i>
                    Tài khoản<span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('nhan-vien.index') }}">Nhân viên</a></li>
                    <li><a href="{{ route('khach-hang.index') }}">Khách hàng</a></li>
                </ul>
            </li>
        </ul>
    </div>

    @include('admin.layouts.partials.sidebar_footer')
</div>
<!-- /sidebar menu -->