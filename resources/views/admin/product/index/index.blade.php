@extends('admin.master')

@section('title', 'Sản phẩm')

@section('content')
    @include('admin.product.index.modals')

    <h2 class="ui dividing header">Sản phẩm</h2>

    @include('admin.layouts.components.errors')

    <form action="{{ route('product.destroy', [0]) }}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-product').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.product.index.table')
    </form>
@endsection