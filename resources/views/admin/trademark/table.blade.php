<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th>Tên thương hiệu</th>
    <th class="collapsing center aligned">Sản phẩm</th>
    <th class="center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($trademarks as $stt => $trademark)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="trademark-ids[]" value="{{ $trademark->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $trademark->name }}</td>
            <td class="collapsing center aligned">
                <a href="#" class="ui small label">
                    <i class="fitted blue laptop icon"></i>
                </a>
            </td>
            <td class="collapsing center aligned">
                <a class="ui green small label" onclick="$('#modal-edit-trademark-{{$trademark->id}}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $trademarks->links() }}
</div>