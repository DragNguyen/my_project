<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th>Người nhập hàng</th>
    <th class="center aligned">Ngày nhập</th>
    <th class="collapsing center aligned">Xem</th>
    <th class="collapsing center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($goods_receipt_notes as $stt => $goods_receipt_note)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="goods-receipt-note-id[]" value="{{ $goods_receipt_note->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $goods_receipt_note->name }}</td>
            <td>{{ $goods_receipt_note->date }}</td>
            <td class="collapsing center aligned">
                <a href="#" class="ui blue mini button">
                    <i class="fitted eye icon"></i>
                </a>
            </td>
            <td class="collapsing center aligned">
                <a class="ui green mini button" onclick="$('#modal-edit-product-type-').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $goods_receipt_notes->links() }}
</div>