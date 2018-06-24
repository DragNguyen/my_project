<table class="ui celled striped table">
    <thead>
        <th class="collapsing">STT</th>
        <th>Tên sản phẩm</th>
        <th class="center aligned collapsing">Số lượng</th>
        <th class="center aligned">Đơn giá</th>
    </thead>

    <tbody>
        @foreach($order_products as $stt => $order_product)
            <tr>
                <td class="center aligned">{{ $stt + 1 }}</td>
                <td></td>
                <td class="center aligned"></td>
                <td class="collapsing center aligned"></td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $order_products->links() }}
</div>