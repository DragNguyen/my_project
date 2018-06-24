<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th class="collapsing center aligned">Mã đơn hàng</th>
    <th>Ngày đặt hàng</th>
    <th>Người đặt hàng</th>
    <th class="center aligned">Số điện thoại</th>
    <th class="right aligned">Tổng tiền</th>
    <th class="center aligned collapsing">Tình trạng</th>
    <th class="center aligned collapsing">Duyệt</th>
    <th class="center aligned collapsing">Hủy</th>
    </thead>

    <tbody>
    @foreach($orders as $stt => $order)
        <tr>
            <td class="center aligned">
                @if($order->getStatus() != 0)
                    <input type="checkbox" id="table_records" class="flat"
                           name="order-ids[]" value="{{ $order->id }}">
                @endif
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td class="center aligned">
                <a href="{{ route('order.show', [$order->id]) }}">
                    {{ $order->code }}
                </a>
            </td>
            <td>{{ date_format(date_create($order->order_created_at), 'd/m/Y H:i:s') }}</td>
            <td>{{ $order->recipient }}</td>
            <td class="center aligned">{{ $order->phone }}</td>
            <td class="right aligned">{{ number_format($order->price) }} đ</td>
            <td class="center aligned collapsing">
                @if($order->getStatus() == 0)
                    <div style="color: #CC9F34">
                        <i class="warning fitted icon"></i>
                        Chưa duyệt
                    </div>
                @elseif($order->getStatus() == 1)
                    <div class="blue">
                        <i class="shipping fast fitted icon"></i>
                        Đang vận chuyển
                    </div>
                @else
                    <div class="green">
                        <i class="check fitted icon"></i>
                        Đã giao hàng
                    </div>
                @endif
            </td>
            <td class="center aligned">
                @if($order->getStatus() == 0)
                    <a class="ui green small label" onclick="return confirm('Xác nhận duyệt đơn hàng?')"
                       href="{{ route('order_approve', [$order->id]) }}">
                        <i class="check fitted icon"></i>
                    </a>
                @endif
            </td>
            <td class="center aligned">
                <a class="ui red small label" onclick="return confirm('Xác nhận hủy đơn hàng?')"
                   href="{{ route('order_destroy', [$order->id]) }}">
                    <i class="remove fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $orders->links() }}
</div>