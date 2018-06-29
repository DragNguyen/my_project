<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    {{--<meta name="description" content="Website bán linh phụ kiện máy tính chất lượng cao, giá rẻ">--}}
    {{--<link rel="icon" href="{{ asset('assets/images/favicon.png') }}">--}}
    {{--<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">--}}

    <link rel="stylesheet" type="text/css" href="{{ asset('style/smui/semanticoff.min.css') }}">
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('smui/range.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('style/css/semantic-override.css') }}">
    <link rel="stylesheet" href="{{ asset('style/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugin/pace/white/pace-theme-minimal.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugin/fotorama/fotorama.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugin/jq-toast/jquery.toast.min.css') }}">
    {{--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">--}}
    {{--<link rel="stylesheet" href="{{ asset('plugin/barrating/themes/fontawesome-stars-o.css') }}">--}}
    <style type="text/css">
        *:not(i) {
            font-family: 'Segoe UI', Tahoma, Arial, san-serif !important;
        }
    </style>
    @include('customer.layouts.components.pagination-style')

</head>