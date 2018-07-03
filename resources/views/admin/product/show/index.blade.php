@extends('admin.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <h2 class="ui dividing header">
        <a href="{{ route('product.index') }}">
            Sản phẩm
        </a>
        >>
        <span class="header-2"> {{ $product->name }}</span>
    </h2>

    @include('admin.layouts.components.success')
    @include('admin.layouts.components.errors')
    @include('admin.layouts.components.error')
    @include('admin.product.show.modal-change-price')
    @include('admin.product.show.modal-history-price')
    {{--@include('admin.product.show.modal-history-quantity')--}}

    <h3 class="ui dividing header" style="margin-top: 0px">Thông tin cơ bản</h3>
    <div class="ui two column grid">
        <div class="column">
            <div class="ui grid">
                <div class="five wide column">
                    <strong>Tên sản phẩm:</strong>
                </div>
                <div class="eleven wide column">
                    {{ $product->name }}
                </div>
                <div class="five wide column">
                    <strong>Ngày tạo:</strong>
                </div>
                <div class="eleven wide column">
                    {{ date_format(date_create($product->product_created_at), 'd/m/Y H:i:s') }}
                </div>
                <div class="five wide column">
                    <strong>Ngày cập nhật:</strong>
                </div>
                <div class="eleven wide column">
                    {{ $product->product_updated_at }}
                </div>
                <div class="five wide column">
                    <strong>Số lượng tồn kho:</strong>
                </div>
                <div class="eleven wide column">
                    <strong>
                        {{ $product->getQuantity() }}
                    </strong>
                </div>
                <div class="five wide column">
                    <strong>Giá:</strong>
                </div>
                <div class="eleven wide column">
                    <strong style="margin-right: 15px">
                        {{ number_format($product->currentPrice()) }}<sup>đ</sup>
                    </strong>
                    @if(!$product->is_deleted)
                        <a class="blue small ui label" data-tooltip="Thay đổi giá"
                           onclick="$('#modal-change-price').modal('show')">
                            <i class="edit fitted icon"></i>
                            {{--Thay đổi--}}
                        </a>
                    @endif
                    <a class="small ui label" data-tooltip="Xem lịch sử"
                       onclick="$('#modal-price-history-price').modal('show')">
                        <i class="history fitted icon"></i>
                        {{--Lịch sử--}}
                    </a>
                </div>
                <div class="five wide column">
                    <strong>Tình trạng bán:</strong>
                </div>
                <div class="eleven wide column">
                    @if($product->getQuantity() == 0)
                        <span style="color: #CC9F34"><strong>Tạm hết hàng</strong></span>
                    @elseif(!$product->is_deleted)
                        <span class="green"><strong>Đang bán</strong></span>
                    @else
                        <span class="red"><strong>Ngừng kinh doanh</strong></span>
                    @endif
                </div>
                <div class="five wide column">
                    <strong>Thương hiệu:</strong>
                </div>
                <div class="eleven wide column">
                    {{ $product->trademark->name }}
                </div>
                <div class="five wide column">
                    <strong>Loại sản phẩm:</strong>
                </div>
                <div class="eleven wide column">
                    {{ $product->productType->name }}
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui grid">
                <div class="five wide column">
                    <strong>Ảnh đại diện:</strong>
                    <a class="ui small blue label"><i class="fitted edit icon"></i></a>
                </div>
                <div class="eleven wide column">
                    <div class="ui small image">
                        <img src="/{{ $product->avatar }}">
                    </div>
                </div>
            </div>
            <div class="ui grid">
                <div class="five wide column">
                    <strong>Ảnh chi tiết:</strong>
                    <a class="ui small blue label"><i class="fitted edit icon"></i></a>
                </div>
                <div class="eleven wide column">
                    <div class="ui three column grid">
                        @foreach($images as $image)
                            <div class="column">
                                <div class="ui small image">
                                    <img src="/{{ $image->link }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3 class="ui dividing header" style="margin-top: 40px">
        Thông số kỹ thuật
        <a class="ui small blue label"><i class="fitted edit icon"></i></a>
    </h3>
    @include('admin.product.show.table-spec')
    {{--<div class="ui two column grid">--}}
        {{--<div class="column">--}}
            {{--<div class="ui grid">--}}
                {{--@foreach($specs as $spec)--}}
                    {{--<div class="five wide column">--}}
                        {{--{{ $spec->getSpecName() }}:--}}
                    {{--</div>--}}
                    {{--<div class="eleven wide column">--}}
                    {{--{{ $product->getSpecValue($spec->specification_id) }}--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection