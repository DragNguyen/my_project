<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th>Tên sản phẩm</th>
    <th>Đơn giá</th>
    <th>Số lượng</th>
    <th>Tồn kho</th>
    <th class="collapsing center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($goods_receipt_note_products as $stt => $goods_receipt_note_product)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="goods-receipt-note-product-ids[]" value="{{ $goods_receipt_note_product->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>
                <a href="{{ route('product.show', [$goods_receipt_note_product->product_id]) }}">
                    {{ $goods_receipt_note_product->product->name }}
                </a>
            </td>
            <td>{{ number_format($goods_receipt_note_product->price) }} đ</td>
            <td>{{ $goods_receipt_note_product->quantity }}</td>
            <td>{{ $goods_receipt_note_product->product->quantity }}</td>
            <td class="collapsing center aligned">
                <a class="ui green mini button"
                   onclick="$('#modal-edit-goods-receipt-note-product-{{ $goods_receipt_note_product->id }}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $goods_receipt_note_products->links() }}
</div>