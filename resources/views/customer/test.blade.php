@extends('customer.master')

@section('title', 'Test')

@section('content')
    <div class="ui basic segment">

        <h3 class="ui dividing header">Test</h3>

        <div class="ui six column computer four column tablet stackable grid" style="min-height: 300px">
            @foreach($products as $product)
                <div class="column">
                    <div class="ui fluid link card center-aligned"
                         onclick="window.location.href='{{ '/product_viewer/' . $product->slug }}'">
                        <div class="image">
                            <img class="lazyload" data-src="{{ asset($product->avatar) }}">
                        </div>

                        <div class="content">

                            <p>{{ $product->name }}</p>

                            <p class="no-margin">

                                @if (!empty($product->isSalesOff()))
                                    <span class="old-price">{{ number_format($product->currentPrice()) }}đ</span>
                                    <span class="new-price">
                                            <strong>{{ number_format($product->currentPrice()*(1 - (float)$product->getSalesOff()/100)) }}đ</strong>
                                        </span>
                                    <span class="ui basic red small label">
                                            -{{ $product->getSalesOff() }}%
                                        </span>
                                @else
                                    <strong>{{ number_format($product->currentPrice()) }}đ</strong>
                                @endif

                                @if ($product->getQuantity() < 1)
                                    <span class="ui red label">Hết hàng</span>
                                @endif

                            </p>
                            {{--@component('sharing.components.star')--}}
                                {{--{{ $plainProduct->diem_danh_gia }}--}}
                            {{--@endcomponent--}}
                        </div>
                    </div>
                </div>
            @endforeach
            {{--@if ($products->count() == 0)--}}
                {{--<div class="sixteen wide column">--}}
                    {{--<h3 class="ui header center aligned">Chưa có chương trình giảm giá nào </h3>--}}
                {{--</div>--}}
            {{--@endif--}}
        </div>

        <div class="ui column centered grid">
            {{ $products->links() }}
        </div>

        {{--<div class="ui basic segment center aligned no-padding">--}}

            {{--{{ $products->render('vendor.pagination.smui') }}--}}
        {{--</div>--}}
    </div>
@endsection
@push('script')
    <script>
        $("img.lazyload").lazyload();
    </script>
@endpush