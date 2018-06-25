@extends('admin.master')

@section('title', 'Nhập hàng')

@section('content')
    <h2 class="ui dividing header">
        <a href="{{ route('goods_receipt_note.index') }}">Nhập hàng</a>
        ({{ date_format(date_create($goods_receipt_note->date), 'd/m/Y') }}) >>
        <span class="header-2">Sản phẩm</span>
    </h2>

    @include('admin.layouts.components.success')
    @include('admin.layouts.components.errors')

    <form action="{{ route('goods_receipt_note_product.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-goods-receipt-note-product').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.goods-receipt-note.product.table')
    </form>

    @include('admin.goods-receipt-note.product.modal')

@endsection