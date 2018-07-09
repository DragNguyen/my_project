<div class="ui segment">
    <div class="ui tiny three statistics">
        <div class="statistic">
            <div class="value">
                <i class="dolly yellow circular icon"></i>
                <span>{{ number_format($today['out']) }}</span><sup>đ</sup>
            </div>
            <div class="label">
                Mua vào
            </div>
        </div>
        <div class="statistic">
            <div class="value">
                <i class="shipping fast green circular icon"></i>
                <span>{{ number_format($today['in']) }}</span><sup>đ</sup>
            </div>
            <div class="label">
                Bán ra
            </div>
        </div>
        <div class="statistic">
            <div class="value">
                <i class="bottom right corner blue chart line circular icon"></i>
                <span>{{ number_format($today['minus']) }}</span><sup>đ</sup>
            </div>
            <div class="label">
                Hiệu số
            </div>
        </div>
    </div>

</div>