<form class="ui small form">
    <div class="ui labeled input" style="min-width: 200px">
        <div class="ui label">
            Thống kê
        </div>
        <select class="ui fluid selection dropdown" name="type" id="type">
            <option value="year">Theo năm</option>
            <option value="trimester" {{ (Request::get('type')=='trimester') ? 'selected' : '' }}>Theo quý</option>
            <option value="month" {{ (Request::get('type')=='month') ? 'selected' : '' }}>Theo tháng</option>
            <option value="date" {{ (Request::get('type')=='date') ? 'selected' : '' }}>Theo ngày</option>
        </select>
    </div>
    <div style="margin-left: 10px; display: inline-block" class="{{ ((Request::get('type')=='trimester') || (Request::get('type')=='month') ||
                            (Request::get('type')=='date')) ? '' : 'hidden' }}"
         id="year-div">
        <strong>Năm</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="yearChanged()"
                    name="year" id="year">
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ (Request::get('year')==$year) ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div style="margin-left: 10px; display: inline-block" class="{{ Request::get('type') == 'date' ? '' : 'hidden' }}" id="begin-end-div">
        <strong>Tháng</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="monthChanged()"
                    name="month" id="month">
                @for($i=1; $i<=12; $i++)
                    <option value="{{ $i }}" {{ (Request::get('month')==$i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <strong style="margin-left: 5px">Từ ngày</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" onchange="beginChanged()"
                    name="begin" id="begin">
                @for($i=1; $i<=31; $i++)
                    <option value="{{ $i }}" {{ (Request::get('begin')==$i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <strong style="margin-left: 5px">Đến ngày</strong>
        <div class="selection-custom">
            <select class="ui fluid small selection dropdown" name="end" id="end">
                @for($i=1; $i<=31; $i++)
                    <option value="{{ $i }}" {{ (Request::get('end')==$i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
    <button class="ui blue mini button {{ ((Request::get('type')=='trimester') ||
            (Request::get('type')=='month') || (Request::get('type')=='date')) ? '' : 'hidden' }}"
            type="submit" style="margin-left: 15px" id="button">OK</button>
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
                    @php $total = ['unapprove' => 0, 'approved' => 0, 'complete' => 0]; @endphp
                    @foreach($table_quantities as $key => $table_quantity)
                        @php
                            $total['unapprove'] += $table_quantity['unapprove'];
                            $total['approved'] += $table_quantity['approved'];
                            $total['complete'] += $table_quantity['complete'];
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
                            {{ $total['unapprove'] }}
                        </td>
                        <td>
                            {{ $total['approved'] }}
                        </td>
                        <td>
                            {{ $total['complete'] }}
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
                    @php $total = ['unapprove' => 0, 'approved' => 0, 'complete' => 0] @endphp
                    @foreach($table_costs as $key => $table_cost)
                        @php
                            $total['unapprove'] += $table_cost['unapprove'];
                            $total['approved'] += $table_cost['approved'];
                            $total['complete'] += $table_cost['complete'];
                        @endphp
                        <tr class="right aligned">
                            <td class="tr-strong center aligned">{{ ($table_cost['year'] != '') ? $table_cost['year'] : $key+1 }}</td>
                            <td>{{ number_format($table_cost['unapprove']) }}<sup>đ</sup></td>
                            <td>{{ number_format($table_cost['approved']) }}<sup>đ</sup></td>
                            <td>{{ number_format($table_cost['complete']) }}<sup>đ</sup></td>
                        </tr>
                    @endforeach
                    <tr class="tr-strong right aligned">
                        <td class="center aligned">Tổng cộng</td>
                        <td>{{ number_format($total['unapprove']) }}<sup>đ</sup></td>
                        <td>{{ number_format($total['approved']) }}<sup>đ</sup></td>
                        <td>{{ number_format($total['complete']) }}<sup>đ</sup></td>
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