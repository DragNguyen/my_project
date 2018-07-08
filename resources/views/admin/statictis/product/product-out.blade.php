<div class="ui bottom attached tab segment" data-tab="third">
    <div class="ui dividing header" style="margin-top: 5px;">
        <h5>Sản phẩm hết hàng</h5>
    </div>

    <table class="ui table celled striped compact">
        <thead>
        <tr>
            <th class="collapsing">STT</th>
            <th>Tên sản phẩm</th>
        </tr>
        </thead>
        <tbody>
            @foreach($product_outs as $stt => $product_out)
                <tr>
                    <td class="center aligned">{{ $stt+1 }}</td>
                    <td>
                        <img src="/{{ $product_out->avatar }}" class="ui mini image spaced">
                        <a href="{{ route('product.show', $product_out->id) }}">
                            {{ $product_out->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="ui column centered grid">
        {{ $product_outs->links() }}
    </div>
</div>