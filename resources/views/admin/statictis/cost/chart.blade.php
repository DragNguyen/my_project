<div class="ui grid">
    <div class="sixteen wide column" style="margin-top: 15px; padding-bottom: unset">
        <form class="ui small form" id="form-static-table">
            <div class="ui labeled input" style="min-width: 200px">
                <div class="ui label">
                    Thống kê
                </div>
                <select class="ui fluid selection dropdown" name="static-table" id="static-table">
                    <option value="year">Theo năm</option>
                    <option value="trimester" {{ (Request::get('static-table')=='trimester') ? 'selected' : '' }}>Theo quý</option>
                    <option value="month" {{ (Request::get('static-table')=='month') ? 'selected' : '' }}>Theo tháng</option>
                    <option value="date" {{ (Request::get('static-table')=='date') ? 'selected' : '' }}>Theo ngày</option>
                </select>
            </div>
            <div style="margin-left: 10px; display: inline-block" id="static-year-div"
                 class="{{ ((Request::get('static-table')=='trimester') ||
        (Request::get('static-table')=='month') || (Request::get('static-table')=='date')) ? '' : 'hidden' }}">
                <strong>Năm</strong>
                <div class="selection-custom">
                    <select class="ui fluid small selection dropdown" onchange="changeYear()"
                            name="static-year" id="static-year">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ (Request::get('static-year')==$year) ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="margin-left: 10px; display: inline-block" class="{{ Request::get('static-table') == 'date' ? '' : 'hidden' }}" id="static-begin-end">
                <strong>Tháng</strong>
                <div class="selection-custom">
                    <select class="ui fluid small selection dropdown" onchange="changeMonth()"
                            name="static-month" id="static-month">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ (Request::get('static-month')==$i) ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <strong style="margin-left: 5px">Từ ngày</strong>
                <div class="selection-custom">
                    <select class="ui fluid small selection dropdown" onchange="changeBegin()"
                            name="static-begin" id="static-begin">
                        @for($i=1; $i<=31; $i++)
                            <option value="{{ $i }}" {{ (Request::get('static-begin')==$i) ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <strong style="margin-left: 5px">Đến ngày</strong>
                <div class="selection-custom">
                    <select class="ui fluid small selection dropdown" name="static-end" id="static-end">
                        @for($i=1; $i<=31; $i++)
                            <option value="{{ $i }}" {{ (Request::get('static-end')==$i) ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <button class="ui blue mini button {{ ((Request::get('static-table')=='trimester') ||
            (Request::get('static-table')=='month') || (Request::get('static-table')=='date')) ? '' : 'hidden' }}"
                    type="submit" style="margin-left: 15px" id="static-button">OK</button>
        </form>
    </div>
    <div class="ten wide column" style="padding-top: unset">
        <div class="ui dividing header"><h4>Biểu đồ thống kê (đv: triệu đồng)</h4></div>
        <div id="chart_div" style="width: 100%; height: 270px;"></div>
    </div>
    <div class="six wide column" style="padding-top: unset">
        <div class="ui dividing header"><h4>Bảng thống kê (đv: triệu đồng)</h4></div>
        <table class="ui compact table celled striped center aligned">
            <thead>
            <tr>
                <th>{{ $type }}</th>
                <th>Mua vào</th>
                <th>Bán ra</th>
                <th>Hiệu số</th>
            </tr>
            </thead>
            <tbody>
            @php $total = [0,0,0] @endphp
            @foreach($costs as $cost)
                @php
                    $total[0] += $cost[1];
                    $total[1] += $cost[2];
                    $total[2] += $cost[2] - $cost[1];
                @endphp
                <tr>
                    <td>{{ $cost[0] }}</td>
                    <td>{{ $cost[1] }}</td>
                    <td>{{ $cost[2] }}</td>
                    <td>{{ $cost[2] - $cost[1] }}</td>
                </tr>
            @endforeach
                <tr class="tr-strong">
                    <td class="collapsing">
                        Tổng
                    </td>
                    <td>{{ $total[0] }}</td>
                    <td>{{ $total[1] }}</td>
                    <td>{{ $total[2] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    /*.ui.grid>.column:not(.row) {*/
        /*padding-top: unset;*/
    /*}*/
    .selection-custom {
        width: 70px;
        display: inline-block;
    }

</style>

@include('admin.statictis.cost.js')

@push('script')
    <script>
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["{{ $type }}", 'Mua vào', 'Bán ra'],
                @foreach($costs as $key => $cost)
                    ["{{ $cost[0] }}", parseFloat("{{ $cost[1] }}"), parseFloat("{{ $cost[2] }}")],
                @endforeach
            ]);

            var options = {
                bars: 'vertical',
                vAxis: {format: 'decimal'},
                colors: ['#1b9e77', '#d95f02']
            };

            var chart = new google.charts.Bar(document.getElementById('chart_div'));

            chart.draw(data, google.charts.Bar.convertOptions(options))}

        $(window).resize(function(){
            drawChart();
        });

    </script>
@endpush