<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    @include('admin.layouts.partials.sidebar_header')

    <div class="menu_section">
        <ul class="nav side-menu">
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/dashboard') ? 'current-page' : '' }}">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard"></i>
                    Tổng quan
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/trademark') ? 'current-page' : '' }}">
                <a href="{{ route('trademark.index') }}">
                    <i class="fa fa-trophy"></i>
                    Thương hiệu
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/supplier') ? 'current-page' : '' }}">
                <a href="{{ route('supplier.index') }}">
                    <i class="fa fa-rebel"></i>
                    Nhà cung cấp
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/product_type') ? 'current-page' : '' }}">
                <a href="{{ route('product_type.index') }}">
                    <i class="fa fa-sitemap"></i>
                    Loại sản phẩm
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/product') ? 'current-page' : '' }}">
                <a href="{{ route('product.index') }}">
                    <i class="fa fa-laptop"></i>
                    Sản phẩm
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/goods_receipt_note') ? 'current-page' : '' }}">
                <a href="{{ route('goods_receipt_note.index') }}">
                    <i class="fa fa-truck"></i>
                    Nhập hàng
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/order') ? 'current-page' : '' }}">
                <a href="{{ route('order.index') }}">
                    <i class="fa fa-clipboard"></i>
                    Đơn hàng
                </a>
            </li>
            <li class="{{ \Illuminate\Support\Facades\Request::is('admin/sales_off') ? 'current-page' : '' }}">
                <a href="{{ route('sales_off.index') }}">
                    <i class="fa fa-certificate"></i>
                    Khuyến mãi
                </a>
            </li>
            @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 0)
                <li class="{{ \Illuminate\Support\Facades\Request::is('admin/employee') ? 'current-page' : '' }}">
                    <a href="{{ route('employee.index') }}">
                        <i class="fa fa-users"></i>
                        Nhân viên
                    </a>
                </li>
            @endif
            <li>
                <a>
                    <i class="fa fa-undo"></i>
                    Thống kê
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('statictis.order.index') }}">Đơn hàng</a></li>
                </ul>
            </li>
            <li >
                <a>
                    <i class="fa fa-undo"></i>
                    Phục hồi
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('trademark_restore.index') }}">Thương hiệu</a></li>
                    <li><a href="{{ route('supplier_restore.index') }}">Nhà cung cấp</a></li>
                    <li><a href="{{ route('product_type_restore.index') }}">Loại sản phẩm</a></li>
                    <li><a href="{{ route('product_restore.index') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('goods_receipt_note_restore.index') }}">Nhập hàng</a></li>
                    <li><a href="{{ route('order_restore.index') }}">Đơn hàng</a></li>
                    <li><a href="{{ route('sales_off_restore.index') }}">Khuyến mãi</a></li>
                    @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->role == 0)
                        <li><a href="{{ route('employee_restore.index') }}">Nhân viên</a></li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>

    @include('admin.layouts.partials.sidebar_footer')
</div>
<!-- /sidebar menu -->