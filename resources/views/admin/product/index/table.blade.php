<table class="ui celled striped table bulk_action">
    <thead>
        <th class="collapsing">
            <input type="checkbox" id="check-all" class="flat">
        </th>
        <th class="collapsing">STT</th>
        <th>Tên sản phẩm</th>
        <th>Thương hiệu</th>
        <th>Loại sản phẩm</th>
        <th class="right aligned">Giá tiền</th>
        <th class="center aligned">Số lượng</th>
        {{--<th class="center aligned">Tình trạng</th>--}}
        <th class="center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($products as $stt => $product)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="product-ids[]" value="{{ $product->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>
                <a href="{{ route('product.show', [$product->id]) }}">
                    {{ $product->name }}
                </a>
            </td>
            <td>{{ $product->getTrademarkName() }}</td>
            <td>{{ $product->getProductTypeName() }}</td>
            <td class="collapsing right aligned">{{ number_format($product->currentPrice()) }}<sup>đ</sup></td>
            <td class="center aligned">{{ $product->getQuantity() }}</td>
            {{--<td class="center aligned">{{ $product->status() }}</td>--}}
            <td class="collapsing center aligned">
                <a class="ui green small label" onclick="$('#modal-edit-product-{{$product->id}}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $products->links() }}
</div>