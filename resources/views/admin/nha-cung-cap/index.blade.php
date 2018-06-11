@extends('admin.master')

@section('title', 'Nhà cung cấp')

@section('nav_title', 'Nhà cung cấp')

@section('content')

    @include('admin.nha-cung-cap.modals')

    <h2 class="ui dividing header">Nhà cung cấp<a class="anchor" id="introduction"></a></h2>

    <form action="{{ route('nha-cung-cap.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-them-ncc').modal('show')"
                class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.nha-cung-cap.table')
    </form>
@endsection