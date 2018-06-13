@extends('admin.master')

@section('title', 'Nhà cung cấp')

@section('nav_title', 'Nhà cung cấp')

@section('content')

    @include('admin.supplier.modals')

    <h2 class="ui dividing header">Nhà cung cấp<a class="anchor" id="introduction"></a></h2>

    @if ($errors->any())

        <div class="ui error message">
            <i class="close icon"></i>
            <div class="header">
                There were some errors with your submission
            </div>
            <ul class="list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

        @include('admin.supplier.table')
    </form>
@endsection