<form class="ui small form" id="form-static-table">
    <div class="ui labeled input" style="min-width: 200px">
        <div class="ui label">
            Thống kê
        </div>
        <select class="ui fluid selection dropdown" name="static-table" id="static-table">
            <option value="year">Theo năm</option>
            <option value="trimester">Theo quý</option>
            <option value="month">Theo tháng</option>
            <option value="date">Theo ngày</option>
        </select>
    </div>
    <div style="margin-left: 10px; display: inline-block" class="hidden" id="static-year-div">
        <strong>Năm</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="changeYear()"
                    name="static-year" id="static-year">
                @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div style="margin-left: 10px; display: inline-block" class="hidden" id="static-begin-end">
        <strong>Tháng</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="changeMonth()"
                    name="static-month" id="static-month">
                @for($i=1; $i<=12; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <strong style="margin-left: 5px">Từ ngày</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="changeBegin()"
                    name="static-begin" id="static-begin">
                @for($i=1; $i<=31; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <strong style="margin-left: 5px">Đến ngày</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" name="static-end" id="static-end">
                @for($i=1; $i<=31; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
    <button class="ui blue mini button hidden" type="submit" style="margin-left: 15px" id="static-button">OK</button>
</form>

<div class="ui segment">
    <div class="ui grid">
        {{--<div class="sixteen wide column" style="padding-bottom: 0">--}}
        {{--<div class="ui dividing header">Bảng thống kế đơn hàng</div>--}}
        {{--</div>--}}
        <div class="eight wide column">
            <div class="ui dividing header"><h4>Số lượng đơn hàng</h4>
            </div>
            <table class="ui compact table celled striped center aligned" id="account-table">
                <thead>
                <tr>
                    <th>Năm</th>
                    <th>Chưa duyệt</th>
                    <th>Đã duyệt</th>
                    <th>Đã giao hàng</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($table_quantities as $table_quantity)
                        <tr>
                            <td>{{ $table_quantity['year'] }}</td>
                            <td>{{ $table_quantity['unapprove'] }}</td>
                            <td>{{ $table_quantity['approved'] }}</td>
                            <td>{{ $table_quantity['complete'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="eight wide column">
            <form>
                <div class="ui dividing header"><h4>Giá trị đơn hàng (đv: triệu đồng)</h4>

                </div>
            </form>
            <table class="ui compact table celled striped center aligned" id="account-table">
                <thead>
                <tr>
                    <th>Năm</th>
                    <th>Chưa duyệt</th>
                    <th>Đã duyệt</th>
                    <th>Đã giao hàng</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($table_prices as $table_price)
                        <tr>
                            <td>{{ $table_price['year'] }}</td>
                            <td>{{ number_format($table_price['unapprove']) }}<sup>đ</sup></td>
                            <td>{{ number_format($table_price['approved']) }}<sup>đ</sup></td>
                            <td>{{ number_format($table_price['complete']) }}<sup>đ</sup></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .ui.grid>.column:not(.row) {
        padding-top: unset;
    }
    .selection-custom {
        width: 70px;
        display: inline-block;
    }

</style>