<div class="ui right thin sidebar vertical menu" id="sidebar-mobile">
    <div class="item">
        <img src="{{ asset('assets/images/logo_wide.png') }}" class="ui image">
    </div>
    {{--<a class="item" href="/">--}}
    {{--<i class="home icon"></i> Home--}}
    {{--</a>--}}
    {{--<a class="item" href="/hdd">--}}
    {{--<i class="hdd outline icon"></i> HDD--}}
    {{--</a>--}}
    {{--<a class="item">--}}
    {{--<i class="hdd icon"></i> SSD--}}
    {{--</a>--}}
    {{--<a class="item">--}}
    {{--<i class="microchip icon"></i> RAM--}}
    {{--</a>--}}
    {{--<a class="item">--}}
    {{--<i class="headphones icon"></i> Tai nghe--}}
    {{--</a>--}}
    {{--<a class="item">--}}
    {{--<i class="usb icon"></i> USB--}}
    {{--</a>--}}
    {{--<a class="item">--}}
    {{--<i class="headphones icon"></i> Headphone--}}
    {{--</a>--}}
    {{--<a class="item">--}}
    {{--<i class="keyboard icon"></i> Bàn phím--}}
    {{--</a>--}}
    {{--@foreach($menuItems as $item)--}}
        {{--<a class="item" href="{{ $item->link }}">--}}
            {{--<i class="{{ $item->icon }} icon"></i> {{ $item->name ?: 'Home' }}--}}
        {{--</a>--}}
    {{--@endforeach--}}

    <a class="item" href="#">
        <i class="percent icon"></i> Giảm giá
    </a>
    <a class="item" href="#">
        <i class="certificate icon"></i> Mới
    </a>
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