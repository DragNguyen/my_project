@extends('admin.master')

@section('title', 'Nhà cung cấp')

@section('content')

    @include('admin.layouts.components.errors')
    @include('admin.supplier.modals')

    <h2 class="ui dividing header">Nhà cung cấp</h2>

    <form action="{{ route('supplier.destroy', [0]) }}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Xác nhận xóa?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-supplier').modal('show')"
                class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.supplier.table')
    </form>
@endsection