@extends('customer.master')

@section('title', 'Giỏ hàng')

@section('content')

    <div class="ui segment basic layout-padding clearing">
        {{--<div class="ui blue segment clearing">--}}
        <h3 class="ui dividing header">Giỏ hàng của bạn
            @if(! Auth::guard('customer')->check())
                <button type="button" class="ui blue basic label pointer small-td-margin no-lr-margin"
                        onclick="$('#modal-customer-login').modal('show')">
                    Đăng nhập để lưu giỏ hàng của bạn!</button>
            @endif
        </h3>

        <div class="ui basic segment no-padding table-responsive">
            <table class="ui celled striped table center aligned unstackable">
                <thead>
                <tr>
                    <th class="center aligned collapsing">STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th class="collapsing">Thao tác</th>
                </tr>

                </thead>
                <tbody>
                @if(true)
                    @php $idx = 1; $total = 0; $products = \Gloudemans\Shoppingcart\Facades\Cart::content();@endphp
                @else

                @endif
                @foreach($cart_products as $slug => $cart_product)
                    @php $product = \App\Product::find($cart_product->id); $quantity = $cart_product->qty @endphp
                    <tr>
                        <td class="center aligned">{{ $idx++ }}</td>
                        <td class="left aligned">
                            <img src="/{{ $product->avatar }}" class="ui spaced mini image">
                            {{ $product->getName() }}</td>
                        <td>
                            <form action="{{ route('shopping_cart.update', [$cart_product->rowId]) }}"
                                  class="ui form no-padding no-margin force-inline"
                                  method="post" id="{{ 'form-update-amount' . $idx }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="field limit-size">
                                    <input type="number" value="{{ $quantity }}"
                                           name="quantity" min="1"
                                           max="{{ ($product->getQuantity() < 5) ? $product->getQuantity() : 5 }}"
                                           class="small-lr-padding"
                                           onchange="$('#{{ 'form-update-amount' . $idx }}').submit()">
                                </div>
                            </form>
                        </td>
                        <td>
                            @php $total += $product->getSalesOffPrice()*$quantity; @endphp
                            {{ number_format(($product->getSalesOffPrice())) }}<sup>đ</sup>
                        </td>
                        <td class="center-aligned">
                            <form action="{{ route('shopping_cart.destroy', [$cart_product->rowId]) }}"
                                  method="post"
                                  class="force-inline no-padding no-margin">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button class="ui red small label pointer">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3" class="center aligned"><strong>Tổng tiền</strong></th>
                    <th colspan="2" class="center aligned">
                        <span class="ui basic red large label">
                            <strong>{{ number_format($total) }}<sup>đ</sup></strong>
                        </span>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="ui divider hidden clearing no-margin no-padding"></div>

        <div class="ui basic segment right floated no-padding no-margin">
            <a href="/" class="ui icon button">
                <i class="backward icon"></i>
                <strong>Trở lại</strong>
            </a>

            @if (!empty($products))
                <a href="{{ route('checkout.index') }}" class="ui blue icon button">
                    <strong>Thanh toán</strong>
                    <i class="forward right icon"></i>
                </a>
            @endif
        </div>
        {{--</div>--}}
        <div class="ui divider hidden"></div>
    </div>
@endsection
