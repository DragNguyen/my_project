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
                <p><strong>Facebook cửa hàng</strong></p>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-page" data-href="https://www.facebook.com/mobiistar/" data-small-header="true"
                     data-adapt-container-width="true" data-hide-cover="false"
                     data-show-facepile="true"><blockquote cite="https://www.facebook.com/mobiistar/"
                     class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/mobiistar/">Mobiistar</a></blockquote></div>
                {{--<p><i class="home icon"></i>Ninh Kiều, Cần Thơ</p>--}}
                {{--<p><i class="phone icon"></i>01234567890</p>--}}
                {{--<p><i class="mail icon"></i>nguyentrongcp@gmail.com</p>--}}
            </div>
            <div class="eight wide column">
                <p><strong>Bản đồ</strong></p>
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=Tokyo&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
                    </div><style>.mapouter{text-align:right;height:150px;width:100%;}
                        .gmap_canvas {overflow:hidden;background:none!important;height:150px;width:100%;}</style></div>
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