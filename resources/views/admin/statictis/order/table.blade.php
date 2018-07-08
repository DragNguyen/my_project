<form class="ui small form" id="form-static-table">
    <div class="ui labeled input" style="min-width: 200px">
        <div class="ui label">
            Thống kê
        </div>
        <select class="ui fluid selection dropdown" name="static-table" id="static-table">
            <option value="year">Theo năm</option>
            <option value="trimester" {{ ($static_table=='trimester') ? 'selected' : '' }}>Theo quý</option>
            <option value="month" {{ ($static_table=='month') ? 'selected' : '' }}>Theo tháng</option>
            <option value="date" {{ ($static_table=='date') ? 'selected' : '' }}>Theo ngày</option>
        </select>
    </div>
    <div style="margin-left: 10px; display: inline-block" class="{{ (($static_table=='trimester') || ($static_table=='month') || ($static_table=='date')) ? '' : 'hidden' }}"
         id="static-year-div">
        <strong>Năm</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="changeYear()"
                    name="static-year" id="static-year">
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ ($year_selected==$year) ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div style="margin-left: 10px; display: inline-block" class="{{ $static_table == 'date' ? '' : 'hidden' }}" id="static-begin-end">
        <strong>Tháng</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="changeMonth()"
                    name="static-month" id="static-month">
                @for($i=1; $i<=12; $i++)
                    <option value="{{ $i }}" {{ ($month_selected==$i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <strong style="margin-left: 5px">Từ ngày</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="changeBegin()"
                    name="static-begin" id="static-begin">
                @for($i=1; $i<=31; $i++)
                    <option value="{{ $i }}" {{ ($begin_selected==$i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <strong style="margin-left: 5px">Đến ngày</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" name="static-end" id="static-end">
                @for($i=1; $i<=31; $i++)
                    <option value="{{ $i }}" {{ ($end_selected==$i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
    <button class="ui blue mini button {{ (($static_table=='trimester') ||
            ($static_table=='month') || ($static_table=='date')) ? '' : 'hidden' }}"
            type="submit" style="margin-left: 15px" id="static-button">OK</button>
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
                    <th>{{ $table_header }}</th>
                    <th>Chưa duyệt</th>
                    <th>Đã duyệt</th>
                    <th>Đã giao hàng</th>
                </tr>
                </thead>
                <tbody>
                    @php $total_quantity = ['unapprove' => 0, 'approved' => 0, 'complete' => 0]; @endphp
                    @foreach($table_quantities as $key => $table_quantity)
                        @php
                            $total_quantity['unapprove'] += $table_quantity['unapprove'];
                            $total_quantity['approved'] += $table_quantity['approved'];
                            $total_quantity['complete'] += $table_quantity['complete'];
                        @endphp
                        <tr>
                            <td class="tr-strong">{{ ($table_quantity['year'] != '') ? $table_quantity['year'] : $key+1 }}</td>
                            <td>{{ $table_quantity['unapprove'] }}</td>
                            <td>{{ $table_quantity['approved'] }}</td>
                            <td>{{ $table_quantity['complete'] }}</td>
                        </tr>
                    @endforeach
                    <tr class="tr-strong">
                        <td>Tổng cộng</td>
                        <td>
                            {{ $total_quantity['unapprove'] }}
                        </td>
                        <td>
                            {{ $total_quantity['approved'] }}
                        </td>
                        <td>
                            {{ $total_quantity['complete'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="eight wide column">
            <form>
                <div class="ui dividing header"><h4>Giá trị đơn hàng</h4>

                </div>
            </form>
            <table class="ui compact table celled striped" id="account-table">
                <thead>
                <tr class="right aligned">
                    <th class="center aligned">{{ $table_header }}</th>
                    <th>Chưa duyệt</th>
                    <th>Đã duyệt</th>
                    <th>Đã giao hàng</th>
                </tr>
                </thead>
                <tbody>
                    @php $total_price = ['unapprove' => 0, 'approved' => 0, 'complete' => 0] @endphp
                    @foreach($table_prices as $key => $table_price)
                        @php
                            $total_price['unapprove'] += $table_price['unapprove'];
                            $total_price['approved'] += $table_price['approved'];
                            $total_price['complete'] += $table_price['complete'];
                        @endphp
                        <tr class="right aligned">
                            <td class="tr-strong center aligned">{{ ($table_price['year'] != '') ? $table_price['year'] : $key+1 }}</td>
                            <td>{{ number_format($table_price['unapprove']) }}<sup>đ</sup></td>
                            <td>{{ number_format($table_price['approved']) }}<sup>đ</sup></td>
                            <td>{{ number_format($table_price['complete']) }}<sup>đ</sup></td>
                        </tr>
                    @endforeach
                    <tr class="tr-strong right aligned">
                        <td class="center aligned">Tổng cộng</td>
                        <td>{{ number_format($total_price['unapprove']) }}<sup>đ</sup></td>
                        <td>{{ number_format($total_price['approved']) }}<sup>đ</sup></td>
                        <td>{{ number_format($total_price['complete']) }}<sup>đ</sup></td>
                    </tr>
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