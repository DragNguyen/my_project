<div class="ui blue segment">
    <h4 class="ui dividing header">Theo dõi hệ thống</h4>
    <div class="ui segment basic no-padding table-responsive">
        <table class="ui table striped celled compact unstackable">
            <thead>
            <tr class="center aligned"><th>Thời gian</th><th>Admin</th><th>Hoạt động</th></tr>
            </thead>
            <tbody>
            @foreach($histories as $history)
                <tr>
                    <td class="collapsing">{{ \App\Helper\StringHelper::longDate($history->time) }}</td>
                    <td >{{ $history->name }}</td>
                    <td>
                        {{ $history->description }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>