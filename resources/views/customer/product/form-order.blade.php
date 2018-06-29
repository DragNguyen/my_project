<form action="" class="ui form" method="post">
    {{ csrf_field() }}

    <div class="field limit-size">
        <label for="">Số lượng (Còn <span class="red-text">{{ $product->getQuantity() }}</span> sản phẩm)</label>
        <input type="number" value="1" min="1"
               max="{{ $product->getQuantity() <= 5 ? $product->getQuantity() : 5  }}" name="amount" id="amount"
               onchange="updateTotalPrice()">
    </div>

    <div class="field">
        <label for="">Tổng số tiền</label>
        <span class="ui green header" id="total-cost">
            {{ number_format($salesOffPrice) }}<sup>đ</sup></span>
    </div>

    <div class="field">
        <button class="ui blue button">
            <i class="cart icon"></i> Thêm vào giỏ
        </button>
    </div>
</form>