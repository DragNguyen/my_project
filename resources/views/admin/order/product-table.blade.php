<table class="ui celled striped table">
    <thead>
        <th class="collapsing">STT</th>
        <th>Tên sản phẩm</th>
        <th class="right aligned">Đơn giá</th>
        <th class="collapsing center aligned">Giảm giá</th>
        <th class="center aligned collapsing">Số lượng</th>
        <th class="right aligned">Tổng tiền</th>
    </thead>

    @php $totalQuantity = 0; $totalPrice = 0; @endphp

    <tbody>
        @foreach($order_products as $stt => $order_product)
            @php $totalQuantity += $order_product->quantity;
            $totalPrice += $order_product->price * $order_product->quantity @endphp
            <tr>
                <td class="center aligned">{{ $stt + 1 }}</td>
                <td>{{ $order_product->product->name }}</td>
                <td class="collapsing right aligned">{{ number_format($order_product->price) }}<sup>đ</sup></td>
                <td class="center aligned">{{ $order_product->sales_off_percent }}%</td>
                <td class="center aligned">{{ $order_product->quantity }}</td>
                <td class="collapsing right aligned">
                    {{ number_format($order_product->price * $order_product->quantity) }}<sup>đ</sup>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th class="right aligned" colspan="4"><strong>Tổng cộng</strong></th>
            <th class="center aligned">{{ $totalQuantity }}</th>
            <th><span class="ui red label">{{ number_format($totalPrice) }}<sup>đ</sup></span></th>
        </tr>
    </tfoot>
</table>

<div class="ui column centered grid">
    {{ $order_products->links() }}
</div>