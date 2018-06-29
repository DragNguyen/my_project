<div class="ui modal" id="modal-price-history-quantity">
    <div class="header modal-header">Lịch sử thay đổi số lượng</div>
    <div class="scrolling content">
        <table class="ui celled striped table">
            <thead>
                <th class="collapsing center aligned">STT</th>
                <th class="center aligned collapsing">Số lượng</th>
                <th class="center aligned collapsing">Số lượng cũ</th>
                <th class="center aligned collapsing">Số lượng thay đổi</th>
                <th class="collapsing">Nguồn gốc thay đổi</th>
                <th>Ngày cập nhật</th>
            </thead>

            <tbody>
            @foreach($product->quantities as $stt => $quantity)
                <tr>
                    <td class="center aligned">{{ $stt + 1 }}</td>
                    <td class="center aligned">
                        {{ $quantity->quantity }}
                    </td>
                    <td class="center aligned">
                        {{ $quantity->oldQuantity }}
                    </td>
                    <td class="center aligned">
                        {{ ($quantity->quantity_changed > 0)
                        ? "+$quantity->quantity_changed"
                        : $quantity->quantity_changed }}
                    </td>
                    <td>
                        {{ $quantity->getEvent() }}
                    </td>
                    <td class="collapsing">{{ date_format(date_create($quantity->quantity_updated_at), 'd/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="actions">
        <input type="submit" class="ui blue approve button" value="OK">
    </div>
</div>