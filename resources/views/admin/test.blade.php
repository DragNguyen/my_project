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
</head>
<body>
<div class="ui error message">
    <i class="close icon"></i>
    <div class="header">
        There were some errors with your submission
    </div>
    <ul class="list">
        <li>You must include both a upper and lower case letters in your password.</li>
        <li>You need to select your home country.</li>
    </ul>
</div>
</body>
</html>