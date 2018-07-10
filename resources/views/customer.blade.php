@extends('customer.master')

@section('title', 'Shop di động')

@section('content')
    <div class="ui basic segment">
        @foreach($items as $item)
            <h3 class="ui dividing header">{{ \App\ProductType::find($item[0]->product_type_id)->name }} mới</h3>

            <div class="ui six column computer four column tablet stackable grid" style="min-height: 300px">
                @foreach($item as $key => $product)
                    @if($key == 6)
                        @break
                    @endif
                    @php $product = \App\Product::find($product->id) @endphp
                    <div class="column">
                        <div class="ui fluid link card center-aligned" style="bottom: 0px"
                             onclick="window.location.href='{{ '/product/' . $product->slug }}'">
                            <div class="image">
                                <img class="lazyload" data-src="{{ asset($product->avatar) }}">
                            </div>

                            <div class="content">
                                <p>{{ $product->getName() }}</p>
                                <p class="no-margin">
                                    @if (!empty($product->isSalesOff()))
                                        <strong>
                                            <strike>{{ number_format($product->currentPrice()) }}</strike><sup>đ</sup>
                                        </strong>
                                        <span class="new-price">
                                        <strong>
                                            {{ number_format($product->getSalesOffPrice()) }}<sup>đ</sup>
                                        </strong>
                                    </span>
                                        <span class="ui red small label">
                                        -{{ $product->getSalesOffPercent() }}%
                                    </span>
                                    @else
                                        <strong>
                                            {{ number_format($product->currentPrice()) }}<sup>đ</sup></strong>
                                    @endif

                                    @if ($product->getQuantity() < 1)
                                        <span class="ui red label">Hết hàng</span>
                                    @endif

                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
@push('script')
    <script>
        $("img.lazyload").lazyload();
    </script>
@endpush