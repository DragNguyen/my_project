<div class="row">
    <div class="sixteen wide column">
        <h5 class="ui header small-td-margin">Thống kê theo số lượng đơn hàng </h5>
    </div>
    <div class="ten wide column">
        <div class="ui segment">
            <canvas id="order-chart"></canvas>
        </div>
    </div>
    <div class="six wide column">
        <table class="ui very compact table celled striped center aligned" id="order-amount-table">
            <thead>
            <tr>
                <th id="order-amount-duration"></th>
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
        let title = 'Thong ke don hang theo ';
        let amountCols = ['Chua duyet', 'Da duyet', 'Da giao hang'];
        let amountRows = [];
        let revCols = ['Chua duyet', 'Da duyet', 'Da giao hang'];
        let revRows = [];

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(60, 179, 113)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)',
            lred: 'rgba(255, 99, 132, .2)',
            lorange: 'rgba(255, 159, 64, .2)',
            lyellow: 'rgba(255, 205, 86, .2)',
            lgreen: 'rgba(60, 179, 113, .2)',
            lblue: 'rgba(54, 162, 235, .2)',
            lpurple: 'rgba(153, 102, 255, .2)',
            lgrey: 'rgba(201, 203, 207, .2)'
        };

        renderChart();

        let needShow = {
            year: [],
            quarter: ['year'],
            month: ['year'],
            day: ['year', 'month', 'day-start', 'day-end']
        };

        function show() {
            let type = $('#type').val();
            if (type === 'all')
                return $('.will-hide').hide();
            $('.will-hide').hide();
            needShow[type].forEach((e) => $('#select-' + e).show());
        }

        function renderChart(e = null) {
            if (e !== null)
                e.preventDefault();

            let query = getQueryData();

            cleanData();

            axios.get('/admin/ajax-request/statistic/order?' + query)
                .then(rs => {
                    createBarChart('order-chart', rs.data);
                    createRevBarChart('order-revenue-chart', rs.data);
                    renderTable(rs.data);
                    renderRevTable(rs.data);
                })
                .catch(err => console.log(err));
        }

        function getQueryData() {
            let type, year, month, quarter, dayStart, dayEnd;
            type = $('#type').val();
            year = $('#year').val();
            month = $('#month').val();
            quarter = $('#quarter').val();
            dayStart = $('#day-start').val();
            dayEnd = $('#day-end').val();
            let data = {type, year, month, quarter, dayStart, dayEnd};
            return Object.keys(data).map(key => (key + "=" + data[key])).join('&');

        }

        function cleanData() {
            title = 'Thong ke don hang theo ';
            amountCols = ['Chua duyet', 'Da duyet', 'Da giao hang'];
            amountRows = [];
            revCols = ['Chua duyet', 'Da duyet', 'Da giao hang'];
            revRows = [];
        }

        let ctx, chart = null;
        let config = {
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

        function createBarChart(id, source) {
            console.log(source);
            if (ctx == null)
                ctx = document.getElementById(id).getContext('2d');

            let labels = [], values = { uncheck: [], checked: [], delivered: [] };

            let uncheck = source.data.uncheck;
            let checked = source.data.checked;
            let delivered = source.data.delivered;

            for (let i = 0; i < delivered.length; i++) {
                let unck = getValidValue(uncheck[i]);
                let ck = getValidValue(checked[i]);
                let deli = getValidValue(delivered[i]);
                labels.push(delivered[i].label);
                values.uncheck.push(unck);
                values.checked.push(ck);
                values.delivered.push(deli);

            }

            let scales = {
                xAxes: [{display: true, scaleLabel: {display: true, labelString: source.axes.x}}],
                yAxes: [{display: true, scaleLabel: {display: true, labelString: source.axes.y}}]
            };

            // them ten cot
            amountCols.unshift(toAscii(source.axes.x));
            title += source.axes.x.toLowerCase();
            if (type == 'month' || type == 'quarter')
                title += ' nam ' + year;
            if (type == 'day')
                title += ' trong thang ' + month + "/" + year;
            title = toAscii(title);

            config.data.labels = labels;
            config.data.datasets[0].data = values.uncheck;
            config.data.datasets[1].data = values.checked;
            config.data.datasets[2].data = values.delivered;
            config.options.scales = scales;

            (chart == null) ? chart = new Chart(ctx, config) : chart.update();
        }

        function getValidValue(item, useExtraVal = false) {
            if (item == null)
                return 0;
            return useExtraVal ? item.extra: item.value;
        }

        function renderTable(source) {
            let uncheck = source.data.uncheck;
            let checked = source.data.checked;
            let delivered = source.data.delivered;
            $('#order-amount-duration').text(source.axes.x);
            let tbody = buildTableBody(uncheck, checked, delivered);
            $('#order-amount-table').find('tbody').html(tbody);
        }

        function buildTableBody(uncheck, checked, delivered) {
            let tbody = '';
            let uncheckSum = 0, checkSum = 0, delSum = 0;
            for (let i = 0; i < delivered.length; i++) {
                tbody += buildRow(uncheck[i], checked[i], delivered[i]);
                uncheckSum += parseFloat(uncheck[i].value);
                checkSum += parseFloat(checked[i].value);
                delSum += parseFloat(delivered[i].value);
            }
            tbody += `<tr>
                <td><strong>Tổng cộng:</strong></td>
                <td><strong>${uncheckSum}</strong></td>
                <td><strong>${checkSum}</strong></td>
                <td><strong>${delSum}</strong></td>
            </tr>`;

            amountRows.push(['Tong cong', uncheckSum, checkSum, delSum]);

            return tbody;
        }

        function buildRow(u, c, d) {
            if (u.value == 0 && c.value == 0 && d.value == 0)
                return '';
            let tr = '';
            tr += `<tr>
                <td><strong>${u.label}</strong></td>
                <td>${u.value}</td>
                <td>${c.value}</td>
                <td>${d.value}</td>
            </tr>`;

            amountRows.push([u.label, u.value, c.value, d.value]);
            return tr;
        }
    </script>
@endpush
