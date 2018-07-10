{{--@include ('frontend.layouts.components.modal_auth')--}}
@include('auth.customer-auth')

<div class="ui inverted blue square-border no-margin segment clearing">

    <div class="ui basic blue inverted segment left floated no-margin">
        <a class="ui header" href="/">
            <img src="{{ asset('assets/img/favicon.png') }}" alt="">
            Shop di động
        </a>
    </div>

    @include('customer.layouts.partials.search')
    {{--    @include('frontend.layouts.partials.search_computer')--}}
{{--    @include('admin.layouts.components.success_msg')--}}

    <div class="ui inverted blue basic segment right floated no-margin">
        @if (Auth::guard('customer')->check())

            {{--@include('frontend.customer.modal_change_info')--}}
            {{--@include('frontend.customer.modal_change_password')--}}

            <div class="ui white small dropdown button">
                <i class="user icon"></i><strong>{{ Auth::guard('customer')->user()->name }}</strong>
                <div class="menu">
                    {{--<a class="item" onclick="$('#modal-change-info').modal('show')">--}}
                        {{--<i class="edit icon"></i>--}}
                        {{--Cập nhật thông tin--}}
                    {{--</a>--}}
                    {{--<a class="item" onclick="$('#modal-change-password').modal('show')">--}}
                        {{--<i class="refresh icon"></i>--}}
                        {{--Đổi mật khẩu--}}
                    {{--</a>--}}

                    {{--<a class="item" href="#">--}}
                        {{--<i class="history icon"></i>--}}
                        {{--Lịch sử mua hàng--}}
                    {{--</a>--}}
                    <a href="#" class="item" onclick="$('#form-logout').submit()">
                        <i class="log out icon"></i>Đăng xuất</a>
                    <form class="force-hidden" method="post" action="{{ route('customer.logout') }}" id="form-logout">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        @else
            <div class="ui white small dropdown button">
                <i class="user icon"></i><strong> Tài khoản</strong>
                <div class="menu">
                    <div class="item" onclick="$('#modal-customer-login').modal('show')">
                        <i class="sign in alternate icon"></i>Đăng nhập
                    </div>

                    <div onclick="$('#modal-customer-register').modal('show')" class="item">
                        <i class="key icon"></i>Đăng ký
                    </div>

                    {{--<a href="#" class="item">--}}
                        {{--<i class="search icon"></i>Tra cứu đơn hàng</a>--}}
                </div>
            </div>
        @endif

        <a href="{{ route('shopping_cart.index') }}" class="ui white small button" style="position:relative;">
            <i class="cart icon"></i>
            <strong>Giỏ hàng</strong>
            <span class="ui red mini floating label">
                {{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}
                {{--{{ \App\Helper\FrontendHelper::totalProductsInCart() }}--}}
            </span>
        </a>
    </div>
</div>