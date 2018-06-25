<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing center aligned">STT</th>
    <th>Tên khuyến mãi</th>
    <th>Ngày bắt đầu</th>
    <th>Ngày kết thúc</th>
    </thead>

    <tbody>
    @foreach($sales_offs as $stt => $sales_off)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="sales-off-restore-ids[]" value="{{ $sales_off->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>
                <a href="{{ route('sales_off.show', [$sales_off->id]) }}">
                    {{ $sales_off->name }}
                </a>
            </td>
            <td>{{ date_format(date_create($sales_off->begin_at), 'd/m/Y') }}</td>
            <td>{{ date_format(date_create($sales_off->end_at), 'd/m/Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $sales_offs->links() }}
</div>