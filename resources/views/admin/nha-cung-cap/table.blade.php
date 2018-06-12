<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th>Tên nhà cung cấp</th>
    <th class="collapsing">Số điện thoại</th>
    <th>Địa chỉ</th>
    <th>Website</th>
    <th class="center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($nha_cung_caps as $stt => $nha_cung_cap)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="nha-cung-cap-id[]" value="{{ $nha_cung_cap->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $nha_cung_cap->ten_ncc }}</td>
            <td>{{ $nha_cung_cap->so_dien_thoai }}</td>
            <td>{{ $nha_cung_cap->dia_chi }}</td>
            <td class="collapsing center aligned">
                <a href="{{ $nha_cung_cap->website }}" target="_blank" data-tooltip="{{ $nha_cung_cap->website }}">
                    <i class="fitted large edge icon"></i>
                </a>
            </td>
            <td class="collapsing center aligned">
                <a class="ui green mini button" onclick="$('#modal-sua-ncc-{{$nha_cung_cap->id}}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui two column centered grid">
    {{ $nha_cung_caps->links() }}
</div>