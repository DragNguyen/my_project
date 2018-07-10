@extends('admin.master')

@section('title', 'Sản phẩm')

@section('content')
    @include('admin.product.index.modals')

    <h2 class="ui dividing header">Sản phẩm</h2>

    @include('admin.layouts.components.errors')

    <form id="form-search-product">

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" form="form-delete-product"
                data-position="right center"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-product').modal('show')" style="margin-top: 2px"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>

        @include('admin.product.index.filter')

        <div style="float: right">
            @if(!empty($key_search))
                <div class="ui small label">
                    <a href="{{ route('product.index') }}"><i class="delete fitted icon"></i></a>
                    {{ $key_search }}
                </div>
            @endif
            <form>
                <div class="ui transparent icon input" style="margin-top: 20px;">
                    <input type="text" name="key-search" placeholder="Tìm kiếm">
                    <i class="search icon"></i>
                </div>
            </form>
            {{--<div class="ui action input right floating" style="margin-top: 2px">--}}
                {{--<input type="text" name="key-search" placeholder="Tìm kiếm">--}}
                {{--<button class="ui button">--}}
                    {{--Tìm--}}
                {{--</button>--}}
            {{--</div>--}}
        </div>
    </form>
    {{--<form class="hidden" action="" method="" id="form-filter-product2">{{ csrf_field() }}</form>--}}

    <form action="{{ route('product.destroy', [0]) }}"
          method="post" id="form-delete-product" >
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        @include('admin.product.index.table')
    </form>
@endsection