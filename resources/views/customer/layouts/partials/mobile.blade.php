<div class="ui square-border no-margin borderless blue inverted menu">
    <a class="item normal-padding" href="/">
        <img src="{{ asset('assets/images/favicon.png') }}" class="ui mini image">
    </a>
    <div class="item no-padding">
{{--        @include('frontend.layouts.partials.search_mobile')--}}
    </div>
    <div class="right menu">
        <a class="normal-padding item" href="#">
            <i class="cart icon"></i>
            <span class="ui red circular tiny floating label" style="top: 3px !important; right: 2px !important;">1
                {{--{{ \App\Helper\FrontendHelper::totalProductsInCart() }}--}}
            </span>
        </a>
        <div class="normal-padding item" id="toggle-sidebar"><i class="sidebar icon"></i></div>
    </div>
</div>