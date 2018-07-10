@extends('admin.master')

@section('title', 'Dashboard')

{{--@php $histories = \App\History::orderBy('time', 'desc')->get(); @endphp--}}

@section('content')
    <div class="ui two column stackable grid">
        <div class="sixteen wide column">
            <h2 class="ui header dividing">Tổng quan</h2>
        </div>

        <div class="sixteen wide column">
            @include('admin.dashboard.general')
        </div>

        <div class="column">
            @include('admin.dashboard.order')
            {{--@include('admin.dashboard.trademark')--}}
        </div>

        {{-- 	<div class="column">
                @include('admin.dashboard.statistic.branding')
            </div> --}}

        <div class="column">
            @include('admin.dashboard.trademark')
        </div>

        <div class="sixteen wide column">
{{--            @include('admin.dashboard.history')--}}
        </div>
    </div>
@endsection

