<script type="text/javascript" src="{{ asset('style/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('style/smui/semantic.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('smui/range.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('style/plugin/axios.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('style/js/semantic-plugin.js') }}"></script>
{{-- <script src="{{ asset('plugin/pace/pace.min.js') }}"></script> --}}
<script src="{{ asset('style/plugin/fotorama/fotorama.js') }}"></script>
<script src="{{ asset('style/plugin/jq-toast/jquery.toast.min.js') }}"></script>
{{--<script src="{{ asset('plugin/barrating/jquery.barrating.min.js') }}"></script>--}}
{{-- script quan trọng --}}
<script type="text/javascript" src="{{ asset('style/plugin/lazyload.min.js') }}"></script>
<script src="{{ asset('style/plugin/zoom/smooth-products/smoothproducts.min.js') }}"></script>

<script>
    function redirectTo(url) {
        window.location.href = url;
    }
    function pressEnter(event, callback) {
        if (event.keyCode === 13)
            callback();
    }
    function toCurrency(number) {
        return number.toString().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1,');
    }
</script>
@stack('script')

{{--@php--}}
    {{--$info = \App\CuaHang::first();--}}
{{--@endphp--}}

<div id="fb-root"></div>
<div class="ui inverted segment no-margin square-border">
    <div class="ui container">
        <div class="ui padded stackable grid" style="color: #fff !important;">
            <div class="four wide column">
                <p><strong>Thông tin cửa hàng</strong></p>
                <p><i class="home icon"></i>Ninh Kiều, Cần Thơ</p>
                <p><i class="phone icon"></i>01234567890</p>
                <p><i class="mail icon"></i>nguyentrongcp@gmail.com</p>
            </div>
            <div class="eight wide column center aligned">
                {{--<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FEasy-Accessory-2000685583519065%2F&tabs=timeline&width=340&height=120&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="400" height="120" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>--}}
                <p><strong>Bản đồ</strong></p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d491.10426995160077!2d105.76886057643145!3d10.030540440643941!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0883d21f664f9%3A0x67f88a60aa3d4272!2sKhoa+CNTT%26TT+(College+of+ICT)!5e0!3m2!1svi!2s!4v1524308584535" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="four wide column">
                {{--<p>--}}
                {{--<img src="{{ $info->logo }}" class="ui mini image spaced" alt="{{ $info->ten_cua_hang }} logo">--}}
                {{--<strong>{{ $info->ten_cua_hang }}</strong>--}}
                {{--</p>--}}
                <p><strong>Chăm sóc khách hàng</strong></p>
                <p><i class="shipping fast icon"></i>Chính sách giao hàng</p>
                <i class="exchange icon"></i>Chính sách đổi trả</p>
                <i class="clipboard list icon"></i>Phương thức thanhh toán</p>
            </div>

            <div class="sixteen wide column center aligned">
                Bản quyền &copy; {{ date('Y') }}, thuộc về easy.accessory.com
            </div>
        </div>
    </div>
</div>