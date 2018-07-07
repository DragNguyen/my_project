<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing">STT</th>
    <th>Tên thương hiệu</th>
    <th>Loại sản phẩm</th>
    <th class="collapsing center aligned">Sản phẩm</th>
    <th class="center aligned">Sửa</th>
    </thead>

    @foreach($trademarks as $stt => $trademark)
        <form class="hidden" method="get" id="form-key-filter-{{ $trademark->id }}"
              action="{{ route('product.index') }}">
            <input type="hidden" name="key-filter" value="all-{{ $trademark->id }}">
        </form>
    @endforeach

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
            <td class="collapsing center aligned">
                <button type="submit" form="form-key-filter-{{ $trademark->id }}" class="ui small label">
                    <i class="fitted blue laptop icon"></i>
                </button>
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