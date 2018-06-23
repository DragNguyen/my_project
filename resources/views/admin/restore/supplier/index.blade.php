@extends('admin.master')

@section('title', 'Phục hồi - Nhà cung cấp')

@section('content')

    <h2 class="ui dividing header">Phục hồi >>
        <span class="header-2">Nhà cung cấp</span>
    </h2>

    @include('admin.layouts.components.errors')

    <form action="{{ route('supplier.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-supplier').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.restore.supplier.table')
    </form>
@endsection