<div class="ui segment">
    <div id="order" style="width: 100%; height: 350px;"></div>
</div>

@push('script')
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Status', 'Quantity'],
                @foreach($orders as $order)
                    ["{{ $order[0] }}", parseInt("{{ $order[1] }}")],
                @endforeach
            ]);

            var options = {
                title: 'Tình trạng đơn hàng',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('order'));
            chart.draw(data, options);

            $(window).resize(function(){
                drawChart();
            });
        }
    </script>
@endpush