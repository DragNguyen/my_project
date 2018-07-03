<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">STT</th>
    <th class="right aligned">Thông số kỹ thuật</th>
    <th>Giá trị</th>
    </thead>

    <tbody>
    @foreach($specs as $stt => $spec)
        @php $value = $spec->specification->getValue($product->id) @endphp
        <tr>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td class="right aligned">{{ $spec->getSpecName() }}</td>
            <td>
                {{ $value }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">

</div>