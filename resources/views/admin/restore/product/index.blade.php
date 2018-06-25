@extends('admin.master')

@section('title', 'Phục hồi - Sản phẩm')

@section('content')

    <h2 class="ui dividing header">Phục hồi >>
        <span class="header-2">Sản phẩm</span>
    </h2>

    @include('admin.layouts.components.success')

    <form action="{{ route('product_restore.store', [0]) }}" method="post">
        {{ csrf_field() }}

        <button class="ui blue button" data-tooltip="Phục hồi đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="undo fitted icon"></i>
        </button>

        @include('admin.restore.product.table')
    </form>
@endsection