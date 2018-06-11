@extends('admin.master')

@section('title', 'Sản phẩm')

@section('nav_title', 'Sản phẩm')

@section('content')
    @include('admin.san-pham.index.modals')

    <h2 class="ui dividing header">Loại sản phẩm</h2>

    <a onclick="$('#modal-them-sp').modal('show')"
       class="blue ui button" data-tooltip="Thêm mới">
        <i class="fitted add icon"></i>
    </a>

    @include('admin.san-pham.index.table')
@endsection