<div class="ui segment">
    <div class="ui grid">
        {{--<div class="sixteen wide column" style="padding-bottom: 0">--}}
        {{--<div class="ui dividing header">Bảng thống kế đơn hàng</div>--}}
        {{--</div>--}}
        <div class="eight wide column">
            <div class="ui dividing header"><h4>Sản phẩm theo thương hiệu</h4>
            </div>
            <table class="ui compact table celled striped" id="account-table">
                <thead>
                <tr>
                    <th class="center aligned collapsing">STT</th>
                    <th>Thương hiệu</th>
                    <th class="center aligned">Số lượng</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($trademarks as $stt => $trademark)
                        @php
                            $quantity = 0;
                            $product_type_trademarks = $trademark->productTypeTrademarks;
                            foreach($product_type_trademarks as $product_type_trademark) {
                                $quantity += $product_type_trademark->products->count();
                            }
                        @endphp
                        <tr>
                            <td class="center aligned">{{ $stt+1 }}</td>
                            <td>{{ $trademark->name }}</td>
                            <td class="center aligned">{{ $quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="eight wide column">
            <form>
                <div class="ui dividing header"><h4>Sản phẩm theo loại</h4></div>
            </form>
            <table class="ui compact table celled striped" id="account-table">
                <thead>
                    <tr>
                        <th class="center aligned collapsing">STT</th>
                        <th>Loại sản phẩm</th>
                        <th class="center aligned">Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_types as $stt => $product_type)
                        @php
                            $quantity = 0;
                            $product_type_trademarks = $product_type->productTypeTrademarks;
                            foreach($product_type_trademarks as $product_type_trademark) {
                                $quantity += $product_type_trademark->products->count();
                            }
                        @endphp
                        <tr>
                            <td class="center aligned">{{ $stt+1 }}</td>
                            <td>{{ $product_type->name }}</td>
                            <td class="center aligned">{{ $quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>