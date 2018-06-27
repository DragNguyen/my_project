@extends('admin.master')

@section('title', 'Nhân viên')

@section('content')

    @include('admin.employee.modals')
    @include('admin.employee.modal-reset-password')

    <h2 class="ui dividing header">Nhân viên</h2>
    @include('admin.layouts.components.errors')

    <form action="{{ route('employee.destroy', [0]) }}" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Xác nhận xóa?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-employee').modal('show')"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.employee.table')
    </form>
@endsection