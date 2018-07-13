@extends('admin.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <h2 class="ui dividing header">
        <a href="{{ route('product.index') }}">
            Sản phẩm
        </a>
        >>
        <span class="header-2"> {{ $product->getName() }}</span>
    </h2>

    @include('admin.layouts.components.success')
    @include('admin.layouts.components.errors')
    @include('admin.layouts.components.error')
    @include('admin.product.show.modal-change-price')
    @include('admin.product.show.modal-history-price')
    @include('admin.product.show.modal-change-product')
    @include('admin.product.show.modal-edit-avatar')
    {{--@include('admin.product.show.modal-history-quantity')--}}

    <div class="ui top attached tabular menu">
        <a class="item active" data-tab="first">Thông tin</a>
        <a class="item" data-tab="second">Hình ảnh</a>
    </div>

    <div class="ui bottom attached tab segment active" data-tab="first">
        <h3 class="ui dividing header" style="margin-top: 5px">
            Thông tin cơ bản
            <a class="ui small green label" onclick="$('#modal-edit-product-{{ $product->id }}').modal('show')">
            <i class="fitted edit icon"></i>
            </a>
        </h3>
        <div class="ui two column grid">
            <div class="column">
                <div class="ui grid">
                    <div class="five wide column">
                        <strong>Tên sản phẩm:</strong>
                    </div>
                    <div class="eleven wide column">
                        {{ $product->getName() }}
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
                            <a class="green small ui label"
                               onclick="$('#modal-change-price').modal('show')">
                                <i class="edit fitted icon"></i>
                                {{--Thay đổi--}}
                            </a>
                        @endif
                        <a class="small ui label" data-tooltip="Xem lịch sử giá"
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
                        {{ $product->getTrademarkName() }}
                    </div>
                    <div class="five wide column">
                        <strong>Loại sản phẩm:</strong>
                    </div>
                    <div class="eleven wide column">
                        {{ $product->getProductTypeName() }}
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui grid">
                    <div class="five wide column">
                        <strong>Ảnh đại diện:</strong>
                        <a class="ui small green label" onclick="$('#modal-change-product-avatar').modal('show')">
                            <i class="fitted edit icon"></i>
                        </a>
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
    </div>

    <div class="ui bottom attached tab segment" data-tab="second">
        @include('admin.product.show.table-images')
    </div>

    <style>
        .ui.top.attached.tabular {
            border-width: 0 0 1px 0 !important;
            border-color: lightgray;
            border-style: solid;
        }
        .bottom.attached.tab.segment {
            border: none !important;
            padding: 15px 0 0 0;
        }
        .tabular.menu .item.active {
            border: none;
            border-bottom: 3px solid #2185d0 !important;
        }
    </style>
@endsection