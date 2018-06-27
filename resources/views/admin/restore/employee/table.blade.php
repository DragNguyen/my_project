<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th>Tên nhân viên</th>
    <th class="collapsing">Email</th>
    <th>Số điện thoại</th>
    <th class="collapsing center aligned">Giới tính</th>
    <th class="collapsing center aligned">Vai trò</th>
    </thead>

    <tbody>
    @foreach($employees as $stt => $employee)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="employee-ids[]" value="{{ $employee->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
            <td class="center aligned">{{ $employee->getGender() }}</td>
            <td class="collapsing center aligned">{{ $employee->getRole() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $employees->links() }}
</div>