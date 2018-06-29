@extends('customer.master')

@section('title', $product->name)

@php
    $salesOffPercent = $product->getSalesOffPercent();
    $price = $product->currentPrice();
    $salesOffPrice = $product->getSalesOffPrice();
@endphp

@section('content')
    <div class="ui basic segment no-margin-top">
        <div class="ui container">
            <div class="ui divider hidden"></div>

            <div class="ui grid stackable">
                <div class="five wide column center-aligned">
                    @include('customer.product.slider')
                </div>

                <div class="eleven wide column">
                    <h3 class="ui dividing header">
                        {{ $product->name }}
                    </h3>

                    <div class="ui two columns grid stackable">
                        <div class="column">
                            <h3 class="ui header small-bot-margin">
                                @if (!empty($salesOffPercent))
                                    Giá: <span class="red-text">{{ number_format($salesOffPrice) }}<sup>đ</sup></span>
                                <strike style="margin-left: 15px; font-size: 17px">
                                    {{ number_format($price) }}</strike><sup>đ</sup>
                                    <span class="ui red label"> Tiết kiệm {{ $salesOffPercent }}% </span>
                                @else
                                    Giá: <span class="red-text">{{ number_format($salesOffPrice) }} đ</span>
                                @endif
                            </h3>
                            <span style="color: gray;">Giá trên đã có VAT</span>

                            <div class="ui divider hidden"></div>

                            {{--Kiểm tra ngừng kinh doanh --}}
                            @if ($product->getQuantity() < 1)
                                <div class="ui big red basic label">Tạm hết hàng</div>
                                <div class="normal-td-margin">Sản phẩm tạm hết hàng, quý khách vui lòng thử sản phẩm khác!</div>
                            @elseif (!$product->is_deleted)

                                @include('customer.product.form-order')

                            @else
                                <div class="ui basic red big label">Ngừng kinh doanh</div>
                            @endif

                        </div>
                        <div class="column">
                            {{--Đánh giá:--}}

                            {{--@component('sharing.components.star')--}}
                                {{--{{ $product->diem_danh_gia }}--}}
                            {{--@endcomponent--}}
                            {{--({{ $product->ratingCount() }} đánh giá)--}}

                            {{--@include('frontend.product_viewer.rating')--}}

                            <ul class="ui blue list">
                                <li>Bảo hành chính hãng 12 tháng</li>
                                <li>Giao hàng miễn phí</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


{{--            @include('frontend.product_viewer.infomation')--}}
        </div>
    </div>
@endsection

@push('script')
    <script>
        function updateTotalPrice() {
            let price = parseInt('{{ $salesOffPrice }}');
            let amount = $('#amount');

            if ($(amount).val() > 20)
                $(amount).val(20);

            let total = price * $(amount).val();
            total  = total.toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1,');
            $('#total-cost').text(total + " đ");
        }
    </script>
@endpush