<body>

{{--@include('sharing.components.message')--}}
@include('admin.layouts.components.error')
@include('admin.layouts.components.success')

<div class="ui grid tablet computer only">
    <div class="sixteen wide column">
        @include('customer.layouts.partials.top_segment')
        {{--<div class="ui square-border no-margin menu">--}}
            {{--@foreach($menuItems as $item)--}}
                {{--<a class="item" href="{{ $item->link }}">--}}
                    {{--{{ $item->name }}--}}
                {{--</a>--}}
            {{--@endforeach--}}

            {{--<a class="item" href="{{ route('product.special', ['sale']) }}">--}}
                {{--<i class="percent icon"></i> Giảm giá--}}
            {{--</a>--}}
            {{--<a class="item" href="{{ route('product.special', ['new']) }}">--}}
                {{--<i class="certificate icon"></i> Mới--}}
            {{--</a>--}}
        {{--</div>--}}

{{--        @include('frontend.layouts.partials.menu.menu')--}}
    </div>
</div>
@include('customer.layouts.partials.sidebar')
<div class="ui padded grid mobile only">
    <div class="sixteen wide column no-margin no-padding">
        @include('customer.layouts.partials.mobile')
    </div>
</div>

<div class="pusher">
    @yield('content')
</div>

{{--@include('sharing.components.scrolltop_button')--}}
</body>