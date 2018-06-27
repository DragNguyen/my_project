@extends('admin.master')

@section('title', 'Phục hồi - loại sản phẩm')

@section('content')

    <h2 class="ui dividing header">Phục hồi >>
        <span class="header-2">Loại sản phẩm</span>
    </h2>

    <form action="{{ route('product_type_restore.store', [0])}}" method="post">
        {{ csrf_field() }}

        <button onclick="return confirm('Xác nhận phục hồi?')" type="submit"
                data-position="right center" class="blue ui button" data-tooltip="Phục hồi đã chọn">
            <i class="fitted undo icon"></i>
        </button>

        @include('admin.restore.product-type.table')
    </form>
@endsection