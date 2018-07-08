<div class="ui bottom attached tab segment
{{ Request::has('quantity')?'':'active' }}" data-tab="first">

    <div class="ui segment">
        <div class="ui tiny five statistics">

            <div class="statistic">
                <div class="value">
                    <i class="box icon"></i>
                    {{ $dashboard_products[0] }}
                </div>
                <div class="label">
                    Sản phẩm
                </div>
            </div>

            <div class="statistic">
                <div class="value">
                    <i class="icons">
                        <i class="box icon"></i>
                        <i class="bottom right corner green bookmark icon"></i>
                    </i>
                    {{ $dashboard_products[1] }}
                </div>
                <div class="label">
                    Sản phẩm Mới
                </div>
            </div>

            <div class="statistic">
                <div class="value">
                    <i class="icons">
                        <i class="box icon"></i>
                        <i class="bottom right corner red certificate icon"></i>
                    </i>
                    {{ $dashboard_products[2] }}
                </div>
                <div class="label">
                    Đang khuyến mãi
                </div>
            </div>

            <div class="statistic">
                <div class="value">
                    <i class="icons">
                        <i class="box icon"></i>
                        <i class="bottom right corner yellow exclamation circle icon"></i>
                    </i>
                    {{ $dashboard_products[3] }}
                </div>
                <div class="label">
                    Hết hàng
                </div>
            </div>

            <div class="statistic">
                <div class="value">
                    <i class="icons">
                        <i class="box icon"></i>
                        <i class="bottom right corner red times circle outline icon"></i>
                    </i>
                    {{ $dashboard_products[4] }}
                </div>
                <div class="label">
                    Ngừng kinh doanh
                </div>
            </div>
        </div>
    </div>

    @include('admin.statictis.product.dashboard-table')
</div>