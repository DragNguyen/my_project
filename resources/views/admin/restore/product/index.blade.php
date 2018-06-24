@extends('admin.master')

@section('title', 'Phục hồi - Sản phẩm')

@section('content')

    <h2 class="ui dividing header">Phục hồi >>
        <span class="header-2">Sản phẩm</span>
    </h2>

    @include('admin.layouts.components.success')
    @include('admin.layouts.components.errors')

    <form action="{{ route('product.destroy', [0]) }}" method="post">
        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-product').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.restore.product.table')
    </form>
@endsection