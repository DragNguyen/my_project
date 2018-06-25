@extends('admin.master')

@section('title', 'Nhà cung cấp')

@section('content')

    @include('admin.supplier.modals')

    <h2 class="ui dividing header">Nhà cung cấp<a class="anchor" id="introduction"></a></h2>

    @include('admin.layouts.components.errors')

    <form action="{{ route('supplier.destroy', [0]) }}" method="post">
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

        @include('admin.supplier.table')
    </form>
@endsection