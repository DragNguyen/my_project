@extends('admin.master')

@section('title', 'Loại sản phẩm')

@section('content')
    @include('admin.product-type.modals')

    <h2 class="ui dividing header">Loại sản phẩm</h2>

    @include('admin.layouts.components.errors')

    <form action="{{ route('product_type.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-product-type').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.product-type.table')
    </form>
@endsection