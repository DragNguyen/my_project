@extends('admin.master')

@section('title', 'Chi tiết khuyến mãi')

@section('content')
    <h2 class="ui dividing header">
        <a href="{{ route('sales_off.index') }}">Khuyến mãi</a>
        >>
        <span class="header-2">
            <a href="{{ route('sales_off.show', [$sales_off_child->salesOff->id]) }}">
            {{ $sales_off_child->salesOff->name }}</a>
            >>
        </span>
        <span class="header-3">{{ $sales_off_child->value }}%</span>
    </h2>

    @include('admin.layouts.components.success')
    @include('admin.layouts.components.errors')
    @include('admin.layouts.components.error')

    <form action="{{ route('sales_off_product.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Xác nhận xóa?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-sales-off-product').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.sales-off.product.table')
    </form>

    @include('admin.sales-off.product.modals')
@endsection