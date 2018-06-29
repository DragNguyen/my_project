<body>

{{--@include('sharing.components.message')--}}

<div class="ui grid tablet computer only">
    <div class="sixteen wide column">
        @include('customer.layouts.partials.top_segment')

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