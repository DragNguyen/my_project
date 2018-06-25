<table class="ui celled striped table bulk_action">
    <thead>
    <th class="collapsing">
        <input type="checkbox" id="check-all" class="flat">
    </th>
    <th class="collapsing center aligned">STT</th>
    <th>Tên sản phẩm</th>
    <th class="collapsing center aligned">Sửa</th>
    </thead>

    <tbody>
    @foreach($sales_off_products as $stt => $sales_off_product)
        <tr>
            <td class="center aligned">
                <input type="checkbox" id="table_records" class="flat"
                       name="sales-off-product-ids[]" value="{{ $sales_off_product->id }}">
            </td>
            <td class="center aligned">{{ $stt + 1 }}</td>
            <td>{{ $sales_off_product->getProduct() }}</td>
            <td class="collapsing center aligned">
                <a class="ui green mini button"
                   onclick="$('#modal-edit-sales-off-product-{{ $sales_off_product->id }}').modal('show')">
                    <i class="edit fitted icon"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="ui column centered grid">
    {{ $sales_off_products->links() }}
</div>