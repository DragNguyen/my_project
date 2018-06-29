@extends('customer.master')

@section('title', 'Thanh toán')

@section('content')

    @php
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach ($cart_products as $cart_product) {
            $totalPrice += \App\Product::find($cart_product->id)->getSalesOffPrice();
            $totalQuantity += $cart_product->qty;
        }
    @endphp

    <div class="ui segment basic layout-padding">
        {{--<div class="ui blue segment">--}}
        <div class="ui basic segment">
            <h2 class="ui header center aligned">
                Thanh toán
            </h2>

            <div class="ui stackable grid">
                <div class="four wide column">
                    <div class="ui basic segment no-lr-padding">
                        <h4 class="ui blue-text dividing header">Tổng số tiền:</h4>

                        <span class="ui red big label">{{ number_format($totalPrice) }}<sup>đ</sup></span>

                        <div class="ui divider hidden"></div>

                        <div class="ui blue label pointer" onclick="$('#order-detail').modal('show')">
                            Xem đơn hàng
                        </div>
                    </div>
                </div>

                <div class="twelve wide column">
                    <form action="{{ route('checkout.store') }}" method="post"
                          class="ui basic form segment no-lr-padding">

                        <h4 class="ui blue-text dividing header">Phương thức thanh toán</h4>

                        {{ csrf_field() }}

                        <input type="hidden" name="total-cost" value="{{ $totalPrice }}">

                        <div class="field">
                            <div class="ui radio checkbox disabled">
                                <input type="radio" name="type-checkout" value="cash" id="cash" checked>
                                <label for="cash">Tiền mặt khi nhận hàng</label>
                            </div>
                        </div>

                        <h4 class="ui blue-text dividing header">
                            Thông tin khách hàng

                            @if (! Auth::guard('admin')->check())
                                <span type="button" class="ui basic blue label pointer no-lr-margin small-td-margin"
                                      onclick="$('#modal-auth').modal('show');">
                                        Đã có tài khoản?
                                    </span>
                            @endif

                        </h4>

                        <div class="three fields">

                            @if (Auth::guard('admin')->check())
                                <input type="hidden" name="admin-id" value="{{ Auth::guard('admin')->user()->id }}">

                                <div class="field required">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" id="name" name="name"
                                           value="{{ Auth::guard('admin')->user()->name }}">
                                </div>

                                <div class="field required">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email"
                                           value="{{ Auth::guard('admin')->user()->email }}">
                                </div>

                                <div class="field required">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" id="phone" name="phone"
                                           value="{{ Auth::guard('admin')->user()->phone }}" >
                                </div>
                            @else
                                <div class="field required">
                                    <label>Họ và tên</label>
                                    <div class="ui corner labeled input">
                                        <input type="text" name="name" value="Nguyen Van A">
                                        <div class="ui corner label">
                                            <i class="asterisk icon"></i>
                                        </div>
                                    </div>
                                    @if($errors->has('product-type-name'))
                                        <div style="color: red; margin-top: 5px; font-size: 13px">
                                            {{ $errors->first('product-type-name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="field required">
                                    <label>Email</label>
                                    <div class="ui corner labeled input">
                                        <input type="text" name="email" value="nva@gmail.com">
                                        <div class="ui corner label">
                                            <i class="asterisk icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="field required">
                                    <label>Số điện thoại</label>
                                    <div class="ui corner labeled input">
                                        <input type="text" name="phone" value="0969696969" >
                                        <div class="ui corner label">
                                            <i class="asterisk icon"></i>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="field required">
                            <label>Địa chỉ nhận hàng</label>
                            <div class="ui corner labeled input">
                                <textarea name="address" rows="2">Ninh Kieu, Can Tho</textarea>
                                <div class="ui corner label">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>

                        </div>

                        <div class="field">
                            <label>Ghi chú</label>
                            <div class="ui corner labeled input">
                                <textarea name="note" rows="2">Giao hàng vào đầu tuần</textarea>
                                <div class="ui corner label">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <button class="ui large fluid blue button">
                                <i class="cart arrow down fitted icon"></i>
                                <strong>Đặt hàng</strong>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--</div>--}}
    </div>

    <div class="ui scrolling modal" id="order-detail">
        <div class="content">
            <h3 class="ui blue-text dividing header">Thông tin đơn hàng</h3>

            <table class="ui compact table square-border center aligned">
                <thead>
                <tr>
                    <th>Mặt hàng</th>
                    <th>Đơn giá</th>
                    <th>Giảm giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart_products as $cart_product)
                    @php $product = \App\Product::find($cart_product->id) @endphp
                    <tr>
                        <td class="left aligned">
                            <img src="/{{ $product->avatar }}" class="ui mini image spaced">
                            {{ $product->name }}
                        </td>
                        <td>{{ number_format($product->currentPrice()) }}<sup>đ</sup></td>
                        <td>{{ $product->getSalesOffPercent() }}%</td>
                        <td>{{ $cart_product->qty }}</td>
                        <td>{{ number_format($product->getSalesOffPrice()) }}<sup>đ</sup></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="right aligned" colspan="3"><strong>Tổng cộng</strong></th>
                    <th>{{ $totalQuantity }}</th>
                    <th><span class="ui red label">{{ number_format($totalPrice) }}<sup>đ</sup></span></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.ui.radio.checkbox').checkbox();
    </script>
@endpush