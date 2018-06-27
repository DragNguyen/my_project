@extends('admin.master')

@section('title', 'Phục hồi - thương hiệu')

@section('content')

    <h2 class="ui dividing header">Thương hiệu</h2>

    <form action="{{ route('trademark_restore.store', [0])}}" method="post">
        {{ csrf_field() }}

        <button class="ui blue button" data-tooltip="Phục hồi đã chọn" type="submit" data-position="right center"
                onclick="return confirm('Xác nhận phục hồi?')">
            <i class="undo fitted icon"></i>
        </button>

        @include('admin.restore.trademark.table')
    </form>
@endsection