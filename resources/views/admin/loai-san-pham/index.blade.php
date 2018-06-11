@extends('admin.master')

@section('title', 'Loại sản phẩm')

@section('nav_title', 'Loại sản phẩm')

@section('content')
    @include('admin.loai-san-pham.modals')

    <h2 class="ui dividing header">Loại sản phẩm</h2>

    <form action="{{ route('loai-san-pham.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-them-loai').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.loai-san-pham.table')
    </form>
@endsection