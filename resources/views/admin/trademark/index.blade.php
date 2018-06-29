@extends('admin.master')

@section('title', 'Thương hiệu')

@section('content')
    @include('admin.trademark.modals')

    <h2 class="ui dividing header">Thương hiệu</h2>
    @include('admin.layouts.components.errors')

    <form action="{{ route('trademark.destroy', [0])}}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Xác nhận xóa?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-trademark').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.trademark.table')
    </form>
@endsection