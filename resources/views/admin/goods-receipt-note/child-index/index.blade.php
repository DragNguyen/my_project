@extends('admin.master')

@section('title', 'Chi tiết nhập hàng')

@section('nav_title', 'Chi tiết nhập hàng')

@section('content')
    <h2 class="ui dividing header">
        Nhập hàng >> <span class="header-2">
            Chi tiết nhập hàng ({{ $goods_receipt_note->date }})
        </span>
    </h2>

    @include('admin.layouts.components.success')

    <form action="{{ route('goods_receipt_note.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-goods-receipt-note-child').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>
    </form>

    @include('admin.goods-receipt-note.child-index.table')
    @include('admin.goods-receipt-note.child-index.modal')

@endsection