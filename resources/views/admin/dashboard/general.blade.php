
<div class="ui segment">
    <div class="ui mini four statistics">
        <div class="statistic">
            <div class="value">
                <i class="box icon"></i>
                {{ $general['product'] }}
            </div>
            <div class="label">
                Sản phẩm
            </div>
        </div>

        <div class="statistic">
            <div class="value">
                <i class="comments outline icon"></i>
                {{ $general['product_out'] }}
            </div>
            <div class="label">
                Sản phẩm hết hàng
            </div>
        </div>

        <div class="statistic">
            <div class="value">
                <i class="clipboard icon"></i>
                {{ $general['order_unapprove'] }}
            </div>
            <div class="label">
                Đơn hàng chưa duyệt
            </div>
        </div>

        <div class="statistic">
            <div class="value">
                VNĐ
                {{ number_format($general['cost']) }}
            </div>
            <div class="label">
                Doanh thu
            </div>
        </div>
    </div>
</div>