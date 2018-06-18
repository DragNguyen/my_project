@extends('admin.master')

@section('title', 'Sản phẩm')

@section('nav_title', 'Sản phẩm')

@section('content')
    @include('admin.product.index.modals')

    <h2 class="ui dividing header">Loại sản phẩm</h2>

    @include('admin.layouts.components.errors')

    <a onclick="$('#modal-create-product').modal('show')"
       class="blue ui button" data-tooltip="Thêm mới">
        <i class="fitted add icon"></i>
    </a>

    @include('admin.product.index.table')
@endsection