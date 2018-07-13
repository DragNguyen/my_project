@extends('admin.master')

@section('title', 'Đơn hàng')

@section('content')
    @php use Illuminate\Support\Facades\Request; @endphp

    <div class="ui dividing header">
        <h2>Đơn hàng</h2>
    </div>

    @include('admin.layouts.components.errors')
    @include('admin.layouts.components.success')

    <form id="form-search-product">
        <button class="ui red button" data-tooltip="Xóa đã chọn" form="form-delete-order"
                type="submit" data-position="right center"
                onclick="return confirm('Bạn chắc chắn muốn xóa các mục đã chọn?')">
            <i class="delete fitted icon"></i>
        </button>
        {{--<a class="ui blue button" onclick="$('#modal-create-order').modal('show')" data-tooltip="Thêm mới">--}}
            {{--<i class="add fitted icon"></i>--}}
        {{--</a>--}}
        @include('admin.order.filter')

        <div style="float: right">
            @if(!empty($key_search))
                <div class="ui small label">
                    <a href="{{ route('order.index') }}"><i class="delete fitted icon"></i></a>
                    {{ $key_search }}
                </div>
            @endif
            <form>
                <div class="ui transparent icon input" style="margin-top: 20px;">
                    <input type="text" name="key-search" placeholder="Tìm kiếm">
                    <i class="search icon"></i>
                </div>
            </form>
        </div>
    </form>

    <form action="{{ route('order.destroy', [0]) }}" method="post" id="form-delete-order">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        @include('admin.order.table')
    </form>

{{--    @include('admin.order.create')--}}
@endsection