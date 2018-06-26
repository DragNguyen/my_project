<div class="ui tiny modal" id="modal-price-history">
    <div class="header modal-header">Lịch sử thay đổi giá</div>
    <div class="scrolling content">
        <table class="ui celled striped table">
            <thead>
                <th class="collapsing center aligned">STT</th>
                <th class="right aligned">Giá tiền</th>
                <th>Ngày cập nhật</th>
            </thead>

            <tbody>
            @foreach($product->prices as $stt => $price)
                <tr>
                    <td class="center aligned">{{ $stt + 1 }}</td>
                    <td class="collapsing right aligned">
                        {{ number_format($price->price) }} đ
                    </td>
                    <td class="collapsing">{{ date_format(date_create($price->price_updated_at), 'd/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="actions">
        <input type="submit" class="ui blue approve button" value="OK">
    </div>
</div>