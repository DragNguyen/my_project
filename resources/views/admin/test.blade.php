<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" type="text/css" href="../semantic/semantic.min.css">
    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <script src="../semantic/semantic.min.js"></script>
    <script>
        $('.menu .item')
            .tab()
        ;
        $('.item')
            .on('click', function() {
                // programmatically activating tab
                $.tab('change tab', 'tab-name');
            })
        ;
    </script>
</head>
<body>
<div class="ui top attached tabular menu">
    <a class="item active" data-tab="first">First</a>
    <a class="item" data-tab="second">Second</a>
    <a class="item" data-tab="third">Third</a>
</div>
</body>
</html>