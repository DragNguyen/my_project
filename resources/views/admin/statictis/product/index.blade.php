@extends('admin.master')

@section('title', 'Sản phẩm')

@section('content')
    @php use Illuminate\Support\Facades\Request @endphp
    <h2 class="ui dividing header">Thống kê >> <span class="header-2">sản phẩm</span></h2>

    <div class="ui top attached tabular menu">
        <a class="item {{ Request::has('quantity')?'':'active' }}" data-tab="first">Tổng quan</a>
        <a class="item {{ Request::has('quantity')?'active':'' }}" data-tab="second">Mua nhiều</a>
        <a class="item" data-tab="third">Hết hàng</a>
    </div>

    @include('admin.statictis.product.dashboard')
    @include('admin.statictis.product.product-hot')
    @include('admin.statictis.product.product-out')


    <style>
        .ui.top.attached.tabular {
            border-width: 0 0 1px 0 !important;
            border-color: lightgray;
            border-style: solid;
        }
        .bottom.attached.tab.segment {
            border: none !important;
            padding: 10px 0 0 0;
        }
        .tabular.menu .item.active {
            border: none;
            border-bottom: 3px solid #2185d0 !important;
        }
        .ui.grid>.column:not(.row) {
            padding-top: unset;
        }
    </style>
@endsection