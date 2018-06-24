@extends('admin.master')

@section('title', 'Khuyến mãi')

@section('content')
    <h2 class="ui dividing header">Khuyến mãi</h2>

    @include('admin.layouts.components.success')
    @include('admin.layouts.components.errors')
    @include('admin.layouts.components.error')

    <form action="{{ route('sales_off.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Xác nhận xóa?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-sales-off').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.sales-off.parent.table')
    </form>

    @include('admin.sales-off.parent.modals')
@endsection