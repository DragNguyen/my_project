@extends('admin.master')

@section('title', 'Đơn hàng')

@section('content')
    @php use Illuminate\Support\Facades\Request; @endphp
    <h2 class="ui dividing header">Thống kê >> <span class="header-2">đơn hàng</span></h2>

    <form>
        <div class="ui labeled input" style="min-width: 240px">
            <div class="ui label">
                Tổng quan
            </div>
            <select class="ui fluid selection dropdown" name="today" id="today" onchange="this.form.submit()">
                <option value="{{ date('Y-m-d') }}" selected>Ngày hôm nay</option>
                <option {{ (Request::get('today')==
                        date_format(date_modify(date_create(date('Y-m-d')), '-1 days'), 'Y-m-d'))?'selected':'' }}
                        value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 days'), 'Y-m-d') }}">
                    Ngày hôm qua
                </option>
                <option {{ (Request::get('today')==
                        date_format(date_modify(date_create(date('Y-m-d')), '-1 weeks'), 'Y-m-d'))?'selected':'' }}
                        value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 weeks'), 'Y-m-d') }}">Tuần vừa rồi</option>
                <option {{ (Request::get('today')==
                        date_format(date_modify(date_create(date('Y-m-d')), '-1 months'), 'Y-m-d'))?'selected':'' }}
                        value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 months'), 'Y-m-d') }}">Tháng vừa rồi</option>
                <option {{ (Request::get('today')==
                        date_format(date_modify(date_create(date('Y-m-d')), '-1 years'), 'Y-m-d'))?'selected':'' }}
                        value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 years'), 'Y-m-d') }}">Năm vừa rồi</option>
            </select>
        </div>
    </form>

    @include('admin.statictis.order.today')

    <div class="ui divider"></div>
    <div class="ui divider"></div>
    <div class="ui divider"></div>

    @include('admin.statictis.order.table')

    @push('script')
        <script src="/js/statistic.js"></script>
    @endpush
@endsection