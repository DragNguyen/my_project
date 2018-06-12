<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">STT</th>
    <th>Tên sản phẩm</th>
    <th class="collapsing">Giá tiền</th>
    <th>Số lượng</th>
    <th>Tình trạng</th>
    <th class="center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($san_phams as $stt => $san_pham)
        <tr>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $san_pham->ten_san_pham }}</td>
            <td>{{ number_format($san_pham->giaHienTai()) }}</td>
            <td>{{ $san_pham->so_luong }}</td>
            <td>{{ $san_pham->tinhTrang() }}</td>
            <td class="collapsing center aligned">
                <a class="ui green mini button" onclick="$('#modal-sua-sp-{{$san_pham->id}}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui two column centered grid">
    {{ $san_phams->links() }}
</div>