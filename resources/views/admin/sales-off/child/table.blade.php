<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing center aligned">STT</th>
    <th>Giá trị</th>
    <th class="collapsing center aligned">Sản phẩm</th>
    <th class="collapsing center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($sales_off_childs as $stt => $sales_off_child)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="sales-off-child-ids[]" value="{{ $sales_off_child->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $sales_off_child->value }}%</td>
            <td class="center aligned">
                <a href="{{ route('sales_off_child.show', [$sales_off_child->id]) }}">
                    <i class="laptop fitted icon"></i>
                </a>
            </td>
            <td class="collapsing center aligned">
                <a class="ui green mini button"
                   onclick="$('#modal-edit-sales-off-child-{{ $sales_off_child->id }}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $sales_off_childs->links() }}
</div>