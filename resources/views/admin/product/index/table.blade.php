<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">STT</th>
    <th>Tên sản phẩm</th>
    <th class="collapsing">Giá tiền</th>
    <th>Số lượng</th>
    <th>Tình trạng</th>
    <th class="center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($products as $stt => $product)
        <tr>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->currentPrice()) }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->status() }}</td>
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