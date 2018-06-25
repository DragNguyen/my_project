<table class="ui celled striped table bulk_action">
    <thead>
        <th class="collapsing">
            <input type="checkbox" id="check-all" class="flat">
        </th>
        <th class="collapsing">STT</th>
        <th>Tên sản phẩm</th>
        <th>Loại sản phẩm</th>
        <th>Thương hiệu</th>
        <th class="right aligned collapsing">Giá tiền</th>
        <th class="center aligned">Số lượng</th>
    </thead>

    <tbody>
    @foreach($products as $stt => $product)
        <tr>
            <td>
                <input type="checkbox" id="table_records" class="flat"
                       name="product-ids[]" value="{{ $product->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>
                <a href="{{ route('product.show', [$product->id]) }}">
                    {{ $product->name }}
                </a>
            </td>
            <td>{{ $product->getProductType()->name }}</td>
            <td>{{ $product->getTrademark()->name }}</td>
            <td class="collapsing right aligned">{{ number_format($product->currentPrice()) }} đ</td>
            <td class="center aligned">{{ $product->quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $products->links() }}
</div>