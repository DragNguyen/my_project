<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th>Tên thương hiệu</th>
    <th>Loại sản phẩm</th>
    </thead>

    <tbody>
    @foreach($trademarks as $stt => $trademark)
        @php $product_type_trademarks = $trademark->productTypeTrademarks @endphp
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="trademark-ids[]" value="{{ $trademark->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $trademark->name }}</td>
            <td>
                @foreach($product_type_trademarks as $product_type_trademark)
                    <span class="ui small label">
                        {{ $product_type_trademark->getProductTypeName() }}
                    </span>
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $trademarks->links() }}
</div>