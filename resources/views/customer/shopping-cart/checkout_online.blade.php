@extends('frontend.layouts.master')

@section('title', 'Kết quả đặt hàng')

@section('content')

    <div class="ui segment basic">
        <div class="ui divider hidden"></div>
        <div class="ui divider hidden"></div>
        <div class="ui divider hidden"></div>

        @if (empty($errors))
            @php session(['checkout_online_token' => true]);@endphp
            <h3 class="ui icon header center aligned">
                <i class="spinner loading icon blue"></i>
                <span id="text">Chuyển sang trang thanh toán sau <span id="time">3</span> giây</span>
            </h3>

            <script type="text/javascript">
                let time = 3;
                window.onload = function() {
                    let it = setInterval(function() {
                        time--;
                        document.getElementById('time').innerText = time + '';
                        if (time === 0){
                            clearInterval(it);
                            document.getElementById('text').innerText = 'Đang chuyển ...';
                            window.location.href = '{!! $url !!}'
                        }
                    }, 1000);
                };
            </script>
        @else
            <h3 class="ui header center aligned">
                <i class="frown outline fitted icon"></i>
                Xin lỗi
            </h3>

            <h4 class="ui header center aligned">
                Cổng thanhh toán không thể kết nối hoặc không hợp lệ!
            </h4>
        @endif
    </div>
@endsection
