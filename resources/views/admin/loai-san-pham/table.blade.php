<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th>Tên loại sản phẩm</th>
    <th class="collapsing center aligned">Sản phẩm</th>
    <th class="center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($loai_san_phams as $stt => $loai_san_pham)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="loai-san-pham-id[]" value="{{ $loai_san_pham->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $loai_san_pham->ten_loai }}</td>
            <td class="collapsing center aligned">
                <a href="#">
                    <i class="fitted large laptop icon"></i>
                </a>
            </td>
            <td class="collapsing center aligned">
                <a class="ui green mini button" onclick="$('#modal-sua-loai-{{$loai_san_pham->id}}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui two column centered grid">
    {{ $loai_san_phams->links() }}
</div>