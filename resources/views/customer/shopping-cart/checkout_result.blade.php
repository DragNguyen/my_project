@extends('frontend.layouts.master')

@section('title', 'Kết quả đặt hàng')

@section('content')

    <div class="ui segment basic">
        <div class="ui divider hidden"></div>
        <div class="ui divider hidden"></div>
        <div class="ui divider hidden"></div>
        @if(empty(session('orderCode')))
            <h3 class="ui header center aligned">
                <i class="frown outline fitted icon"></i>
                Xin lỗi
            </h3>

            <h4 class="ui header center aligned">
                Không thể xử lý đơn hàng hoặc không tồn tại, hãy thử lại sau!
            </h4>
        @else
            <h3 class="ui header center aligned">
                <i class="green check fitted icon"></i>
                Cảm ơn {{ session('name') }} đã mua hàng tại Easy Accessory
            </h3>
            <h4 class="ui header center aligned">
                Mã đơn hàng của bạn:
                <div class="ui right labeled small input">
                    <input type="text" id="order-code" value="{{ session('orderCode') }}">
                    <a class="ui label" onclick="copyOrderCode()" id="text">Copy</a>
                </div>

                @if (Auth::guard('customer')->check())
                    <a href="{{ route('customer.history') }}" class="ui blue label">
                        Lịch sử mua
                    </a>
                @else
                    <a href="{{ route('order.show', ['s']) }}?code={{ session('orderCode') }}"
                       class="ui blue label">
                        Xem chi tiết
                    </a>
                @endif
            </h4>
        @endif
    </div>

    <script type="text/javascript">
        function copyOrderCode() {
            document.getElementById('order-code').select();
            document.execCommand("Copy");
            document.getElementById('text').innerText = 'Đã copy';
        }
    </script>
@endsection