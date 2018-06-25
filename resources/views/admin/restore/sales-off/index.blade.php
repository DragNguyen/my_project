@extends('admin.master')

@section('title', 'Phục hồi - khuyến mãi')

@section('content')
    <h2 class="ui dividing header">Phục hồi >>
        <span class="header-2">Khuyến mãi</span>
    </h2>

    @include('admin.layouts.components.success')

    <form action="{{ route('sales_off_restore.store', [0])}}" method="post">
        {{ csrf_field() }}

        <button class="ui blue button" data-tooltip="Phục hồi đã chọn" type="submit"
                onclick="return confirm('Xác nhận phục hồi?')" data-position="right center">
            <i class="undo fitted icon"></i>
        </button>

        @include('admin.restore.sales-off.table')
    </form>
@endsection