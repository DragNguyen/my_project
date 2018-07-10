<div class="ui segment">
    <div id="trademark" style="width: 100%; height: 350px;"></div>
</div>

@push('script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart2);
        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Trademark', 'Quantity'],
                    @foreach($trademarks as $trademark)
                ["{{ $trademark[0] }}", parseInt("{{ $trademark[1] }}")],
                @endforeach
            ]);

            var options = {
                title: 'Sản phẩm theo thương hiệu',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('trademark'));
            chart.draw(data, options);
        }

        $(window).resize(function(){
            drawChart2();
        });
    </script>
@endpush