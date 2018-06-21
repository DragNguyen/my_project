<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">STT</th>
    <th>Tên sản phẩm</th>
    <th>Loại sản phẩm</th>
    <th>Thương hiệu</th>
    <th class="center aligned">Giá tiền</th>
    <th class="center aligned">Số lượng</th>
    <th class="center aligned">Tình trạng</th>
    <th class="center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($products as $stt => $product)
        <tr>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>
                <a href="{{ route('product.show', [$product->id]) }}">
                    {{ $product->name }}
                </a>
            </td>
            <td>{{ $product->productType->name }}</td>
            <td>{{ $product->trademark->name }}</td>
            <td class="collapsing center aligned">{{ number_format($product->currentPrice()) }} đ</td>
            <td class="center aligned">{{ $product->quantity }}</td>
            <td class="green center aligned">{{ $product->status() }}</td>
            <td class="collapsing center aligned">
                <a class="ui green mini button" onclick="$('#modal-edit-product-{{$product->id}}').modal('show')">
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