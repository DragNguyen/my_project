<table class="ui celled striped table">
    <thead>
        <th class="collapsing">
            <input type="checkbox" id="chon-tat-ca" class="flat">
        </th>
        <th class="collapsing">STT</th>
        <th>Tên nhà cung cấp</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Website</th>
    </thead>

    <tbody>
        @foreach($nha_cung_caps as $stt => $nha_cung_cap)
            <tr>
                <td class="center aligned">
                    <input type="checkbox" id="{{ $nha_cung_cap->id }}" class="flat">
                </td>
                <td class="center aligned">{{ $stt + 1 }}</td>
                <td>{{ $nha_cung_cap->ten_ncc }}</td>
                <td>{{ $nha_cung_cap->so_dien_thoai }}</td>
                <td>{{ $nha_cung_cap->dia_chi }}</td>
                <td class="collapsing center aligned">
                    <a href="{{ $nha_cung_cap->website }}" target="_blank">
                        <i class="ui large edge icon"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>