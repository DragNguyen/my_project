<body>

@include('admin.layouts.components.error')
@include('admin.layouts.components.success')

@php use Illuminate\Support\Facades\Request; @endphp

<div class="ui grid tablet computer only">
    <div class="sixteen wide column">
        @include('customer.layouts.partials.top_segment')
        @include('customer.layouts.partials.menu')
    </div>
    @if (!empty($trademarks))
        <div class="sixteen wide column" style="padding-top: 0">
            @include('customer.layouts.partials.custom_menu')
        </div>
    @endif
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
</body>