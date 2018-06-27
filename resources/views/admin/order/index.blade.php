@extends('admin.master')

@section('title', 'Đơn hàng')

@section('content')
    <div class="ui dividing header">
        <h2>Đơn hàng</h2>
    </div>

    @include('admin.layouts.components.errors')
    @include('admin.layouts.components.success')

    <form action="{{ route('order.destroy', [0]) }}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>
        <a class="ui blue button" onclick="$('#modal-create-order').modal('show')" data-tooltip="Thêm mới">
            <i class="add fitted icon"></i>
        </a>

        @include('admin.order.table')
    </form>

    @include('admin.order.create')
@endsection