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
    @foreach($suppliers as $stt => $supplier)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="supplier-ids[]" value="{{ $supplier->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>{{ $supplier->address }}</td>
            <td class="collapsing center aligned">
                <a href="{{ $supplier->website }}" target="_blank" data-position="left center"
                   data-tooltip="{{ $supplier->website }}">
                    <i class="fitted large edge icon"></i>
                </a>
            </td>
            <td class="collapsing center aligned">
                <a class="ui green small label" onclick="$('#modal-edit-supplier-{{$supplier->id}}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $suppliers->links() }}
</div>