@extends('admin.master')

@section('title', 'Sản phẩm')

@section('content')
    @include('admin.product.index.modals')

    <h2 class="ui dividing header">Sản phẩm</h2>

    @include('admin.layouts.components.errors')

    <form id="form-search-product" method="get" action="{{ route('product.index') }}">

        <button class="ui red button" data-tooltip="Xóa đã chọn" type="submit" form="form-delete-product"
                data-position="right center"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>

        <a onclick="$('#modal-create-product').modal('show')" style="margin-top: 2px"
           class="blue ui button" data-tooltip="Thêm mới">
            <i class="fitted add icon"></i>
        </a>
        <div class="ui green scrolling floating icon dropdown button" id="key-filter">
            <input type="hidden" name="key-filter">
            <i class="filter icon"></i>
            <div class="menu">
                @foreach($trademarks as $trademark)
                    <div class="header" style="border-bottom: 1px solid rgba(34,36,38,.15);">
                        <strong>{{ $trademark->name }}</strong>
                    </div>
                    <div class="item" data-value="all-{{ $trademark->id }}">
                        <span style="color: blue">{{ $trademark->name}}</span>
                        - <strong>Tất cả</strong>
                    </div>
                    @foreach(\App\ProductTypeTrademark::where('trademark_id', $trademark->id)->get() as $product_type_trademark)
                        <div class="item" data-value="{{ $product_type_trademark->id }}">
                            <span style="color: blue">{{ $product_type_trademark->getTrademarkName() }}</span>
                            - {{ $product_type_trademark->getProductTypeName() }}
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        @if (!empty($key_filter))
            @php $key_filter_input = explode('-', $key_filter); @endphp
            @if (count($key_filter_input) > 1)
                <div class="ui small label">
                    <span class="blue">{{ \App\Trademark::find($key_filter_input[1])->name }} </span> - Tất cả
                    <a href="{{ route('product.index') }}"><i class="delete fitted icon"></i></a>
                </div>
            @else
                @php $product_type_trademark_filter =
                \App\ProductTypeTrademark::find($key_filter_input[0]) @endphp
                <div class="ui small label">
                    <span class="blue">
                        {{ $product_type_trademark_filter->getTrademarkName() }}
                    </span> - {{ $product_type_trademark_filter->getProductTypeName() }}
                    <a href="{{ route('product.index') }}"><i class="delete fitted icon"></i></a>
                </div>
            @endif
        @endif

        <div style="float: right">
            @if(!empty($key_search))
                <div class="ui small label">
                    <a href="{{ route('product.index') }}"><i class="delete fitted icon"></i></a>
                    {{ $key_search }}
                </div>
            @endif
            <div class="ui transparent icon input" style="margin-top: 20px;">
                <input type="text" name="key-search" placeholder="Tìm kiếm">
                <i class="search icon"></i>
            </div>
            {{--<div class="ui action input right floating" style="margin-top: 2px">--}}
                {{--<input type="text" name="key-search" placeholder="Tìm kiếm">--}}
                {{--<button class="ui button">--}}
                    {{--Tìm--}}
                {{--</button>--}}
            {{--</div>--}}
        </div>
    </form>
    <form class="hidden" action="" method="" id="form-filter-product2">{{ csrf_field() }}</form>

    <form action="{{ route('product.destroy', [0]) }}"
          method="post" id="form-delete-product" >
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        @include('admin.product.index.table')
    </form>
@endsection