@extends('admin.master')

@section('title', 'Phục hồi - nhân viên')

@section('content')
    <h2 class="ui dividing header">Phục hồi >>
        <span class="header-2">Nhân viên</span>
    </h2>

    <form action="{{ route('employee_restore.store', [0]) }}" method="post">
        {{ csrf_field() }}

        <button class="ui blue button" data-tooltip="Phục hồi đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Xác nhận xóa?')">
            <i class="undo fitted icon"></i>
        </button>

        @include('admin.restore.employee.table')
    </form>
@endsection