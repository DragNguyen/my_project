<div class="row">
    <div class="sixteen wide column">
        <h5 class="ui header small-td-margin">Thống kê theo giá trị đơn hàng (đơn vị: triệu đồng)</h5>
    </div>
    <div class="ten wide column">
        <div class="ui segment">
            <canvas id="order-revenue-chart"></canvas>
        </div>
    </div>
    <div class="six wide column">
        <table class="ui very compact table celled striped center aligned" id="order-rev-table">
            <thead>
            <tr>
                <th id="order-rev-duration"></th>
                <th>Chưa duyệt</th><th>Đã duyệt</th><th>Đã giao hàng</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

@push('script')
    <script>
        let revCtx = null, revChart = null;
        let revConfig = {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    type: 'bar',
                    label: 'Chưa duyệt',
                    backgroundColor: window.chartColors.lred,
                    borderColor:  window.chartColors.red,
                    data: [],
                    borderWidth: 2
                }, {
                    type: 'bar',
                    label: 'Đã duyệt',
                    backgroundColor: window.chartColors.lblue,
                    borderColor:  window.chartColors.blue,
                    data: [],
                    borderWidth: 2
                }, {
                    type: 'bar',
                    label: 'Đã giao hàng',
                    backgroundColor: window.chartColors.lgreen,
                    borderColor:  window.chartColors.green,
                    data: [],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                tooltips: {mode: 'index', intersect: true,},
                hover: {mode: 'nearest', intersect: true},
            }
        };

        function createRevBarChart(id, source) {
            console.log(source);
            if (revCtx == null)
                revCtx = document.getElementById(id).getContext('2d');

            let labels = [], values = { uncheck: [], checked: [], delivered: [] };

            let uncheck = source.data.uncheck;
            let checked = source.data.checked;
            let delivered = source.data.delivered;

            for (let i = 0; i < delivered.length; i++) {
                let unck = getValidValue(uncheck[i], true);
                let ck = getValidValue(checked[i], true);
                let deli = getValidValue(delivered[i], true);
                labels.push(delivered[i].label);
                values.uncheck.push(unck);
                values.checked.push(ck);
                values.delivered.push(deli);
            }

            let scales = {
                xAxes: [{display: true, scaleLabel: {display: true, labelString: source.axes.x}}],
                yAxes: [{display: true, scaleLabel: {display: true, labelString: "Triệu đồng"}}]
            };

            // them ten cot
            revCols.unshift(toAscii(source.axes.x));

            revConfig.data.labels = labels;
            revConfig.data.datasets[0].data = values.uncheck;
            revConfig.data.datasets[1].data = values.checked;
            revConfig.data.datasets[2].data = values.delivered;
            revConfig.options.scales = scales;

            (revChart == null) ? revChart = new Chart(revCtx, revConfig) : revChart.update();
        }

        function renderRevTable(source) {
            let uncheck = source.data.uncheck;
            let checked = source.data.checked;
            let delivered = source.data.delivered;
            $('#order-rev-duration').text(source.axes.x);
            let tbody = buildRevTableBody(uncheck, checked, delivered);
            $('#order-rev-table').find('tbody').html(tbody);
        }

        function buildRevTableBody(uncheck, checked, delivered) {
            let tbody = '';
            let uncheckSum = 0, checkSum = 0, delSum = 0;
            for (let i = 0; i < delivered.length; i++) {
                tbody += buildRevRow(uncheck[i], checked[i], delivered[i]);
                uncheckSum += parseFloat(uncheck[i].extra);
                checkSum += parseFloat(checked[i].extra);
                delSum += parseFloat(delivered[i].extra);
            }
            tbody += `<tr>
                <td><strong>Tổng cộng:</strong></td>
                <td><strong>${uncheckSum.toFixed(2)}</strong></td>
                <td><strong>${checkSum.toFixed(2)}</strong></td>
                <td><strong>${delSum.toFixed(2)}</strong></td>
            </tr>`;

            revRows.push(['Tong cong', uncheckSum.toFixed(2), checkSum.toFixed(2), delSum.toFixed(2)]);

            return tbody;
        }

        function buildRevRow(u, c, d) {
            if (u.extra == 0 && c.extra == 0 && d.extra == 0)
                return '';
            let tr = '';
            tr += `<tr>
                <td><strong>${u.label}</strong></td>
                <td>${u.extra}</td>
                <td>${c.extra}</td>
                <td>${d.extra}</td>
            </tr>`;

            revRows.push([u.label, u.extra, c.extra, d.extra]);

            return tr;
        }
    </script>
@endpush