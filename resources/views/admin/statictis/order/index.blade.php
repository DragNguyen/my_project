@extends('admin.master')

@section('title', 'Đơn hàng')

@section('content')
    <h2 class="ui dividing header">Thống kê >> <span class="header-2">Đơn hàng</span></h2>

    <form action="{{ route('statictis.order.index') }}" method="get">
        <select class="ui selection dropdown" name="today" id="static-order" onchange="this.form.submit()">
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
    </form>

    @include('admin.statictis.order.today')

    <div class="ui divider"></div>

    @include('admin.statictis.order.table')
@endsection