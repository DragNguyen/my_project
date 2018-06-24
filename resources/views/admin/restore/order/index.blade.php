@extends('admin.master')

@section('title', 'Đơn hàng')

@section('content')
    <div class="ui dividing header">
        <h2>Phục hồi >>
            <span class="header-2">Đơn hàng</span>
        </h2>
    </div>

    @include('admin.layouts.components.success')

    <form action="{{ route('order_restore.store', [0]) }}" method="post">
        {{ csrf_field() }}

        <button class="ui blue button" data-tooltip="Phục hồi đã chọn" type="submit"
                onclick="return confirm('Xác nhận phục hồi?')" data-position="right center">
            <i class="undo fitted icon"></i>
        </button>

        @include('admin.restore.order.table')
    </form>
@endsection