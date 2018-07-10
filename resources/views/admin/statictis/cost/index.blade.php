@extends('admin.master')

@section('title', 'Thu chi')

@section('content')
    @php use Illuminate\Support\Facades\Request @endphp
    <div class="ui two column stackable grid">
        <div class="sixteen wide column">
            <h2 class="ui dividing header">Thống kê >> <span class="header-2">thu chi</span></h2>
        </div>

        <div class="sixteen wide column" style="padding-bottom: 0">
            <form>
                <div class="ui labeled input" style="min-width: 240px">
                    <div class="ui label">
                        Tổng quan
                    </div>
                    <select class="ui fluid selection dropdown" name="dashboard" onchange="this.form.submit()">
                        <option value="{{ date('Y-m-d') }}" selected>Ngày hôm nay</option>
                        <option {{ (Request::get('dashboard')==
                        date_format(date_modify(date_create(date('Y-m-d')), '-1 days'), 'Y-m-d'))?'selected':'' }}
                                value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 days'), 'Y-m-d') }}">
                            Ngày hôm qua
                        </option>
                        <option {{ (Request::get('dashboard')==
                        date_format(date_modify(date_create(date('Y-m-d')), '-1 weeks'), 'Y-m-d'))?'selected':'' }}
                                value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 weeks'), 'Y-m-d') }}">
                            Tuần vừa rồi
                        </option>
                        <option {{ (Request::get('dashboard')==
                        date_format(date_modify(date_create(date('Y-m-d')), '-1 months'), 'Y-m-d'))?'selected':'' }}
                                value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 months'), 'Y-m-d') }}">
                            Tháng vừa rồi
                        </option>
                        <option {{ (Request::get('dashboard')==
                        date_format(date_modify(date_create(date('Y-m-d')), '-1 years'), 'Y-m-d'))?'selected':'' }}
                                value="{{ date_format(date_modify(date_create(date('Y-m-d')), '-1 years'), 'Y-m-d') }}">
                            Năm vừa rồi
                        </option>
                    </select>
                </div>
            </form>
        </div>

        <div class="sixteen wide column">
            @include('admin.statictis.cost.today')
        </div>

        @include('admin.statictis.cost.chart')
    </div>
@endsection