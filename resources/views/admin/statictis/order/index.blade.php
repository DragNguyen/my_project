@extends('admin.master')

@section('title', 'Đơn hàng')

@section('content')
    <h2 class="ui dividing header">Thống kê >> <span class="header-2">Đơn hàng</span></h2>

    <form action="{{ route('statictis.order.today') }}" method="get">
        <div class="ui labeled input" style="min-width: 240px">
            <div class="ui label">
                Tổng quan
            </div>
            <select class="ui fluid selection dropdown" name="dashboard" id="static-today" onchange="this.form.submit()">
                <option value="{{ date('Y-m-d') }}" selected>Ngày hôm nay</option>
                <option {{ ($date==date_format(date_modify(date_create(date('Y-m-d')), '-1 days'), 'Y-m-d'))?'selected':'' }}
                        value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 days'), 'Y-m-d') }}">Ngày hôm qua</option>
                <option {{ ($date==date_format(date_modify(date_create(date('Y-m-d')), '-1 weeks'), 'Y-m-d'))?'selected':'' }}
                        value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 weeks'), 'Y-m-d') }}">Tuần vừa rồi</option>
                <option {{ ($date==date_format(date_modify(date_create(date('Y-m-d')), '-1 months'), 'Y-m-d'))?'selected':'' }}
                        value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 months'), 'Y-m-d') }}">Tháng vừa rồi</option>
                <option {{ ($date==date_format(date_modify(date_create(date('Y-m-d')), '-1 years'), 'Y-m-d'))?'selected':'' }}
                        value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 years'), 'Y-m-d') }}">Năm vừa rồi</option>
            </select>
        </div>
    </form>

    @include('admin.statictis.order.today')

    <div class="ui divider"></div>
    <div class="ui divider"></div>
    <div class="ui divider"></div>

    @include('admin.statictis.order.table')

    @include('admin.statictis.order.js')
@endsection