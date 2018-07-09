@extends('admin.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')

    <h2 class="ui dividing header">
        <a href="{{ route('order.index') }}">Đơn hàng</a>
        >>
        <span class="header-2">Chi tiết đơn hàng</span>
    </h2>

    @include('admin.layouts.components.success')

    <h3 class="ui dividing header">Thông tin cơ bản
        <a class="ui small label" style="float: right;" href="{{ route('order_print', [$order->id]) }}" target="_blank">
            <i class="print fitted icon"></i>
            In
        </a>
    </h3>

    <div class="ui two column grid">
        <div class="column">
            <div class="ui grid">
                <div class="five wide column">
                    <strong>Người đặt hàng:</strong>
                </div>
                <div class="eleven wide column">
                    {{ $order->recipient }}
                </div>
                <div class="five wide column">
                    <strong>Email:</strong>
                </div>
                <div class="eleven wide column">
                    {{ $order->email }}
                </div>
                <div class="five wide column">
                    <strong>Số điện thoại:</strong>
                </div>
                <div class="eleven wide column">
                    {{ $order->phone }}
                </div>
                <div class="five wide column">
                    <strong>Địa chỉ:</strong>
                </div>
                <div class="eleven wide column">
                    {{ $order->address }}
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui grid">
                <div class="seven wide column">
                    <strong>Ngày tạo đơn hàng:</strong>
                </div>
                <div class="nine wide column">
                    {{ date_format(date_create($order->order_created_at), 'd/m/Y H:i:s') }}
                </div>
                <div class="seven wide column">
                    <strong>Tình trạng đơn hàng:</strong>
                </div>
                <div class="nine wide column">
                    @if($order->getStatus() == 0)
                        <span style="color: #CC9F34">
                            <i class="warning fitted icon"></i>
                            Chưa duyệt
                        </span>
                    @elseif($order->getStatus() == 1)
                        <span class="blue">
                            <i class="shipping fast fitted icon"></i>
                            Đang vận chuyển
                        </span>
                        @if($order->is_deleted == false)
                            <a href="{{ route('order_change_status', [$order->id]) }}"
                               onclick="return confirm('Xác nhận thay đổi sang (đã giao hàng)?')"
                               class="ui small blue label">
                                Thay đổi
                            </a>
                        @endif
                    @else
                        <span class="green">
                            <i class="check fitted icon"></i>
                            Đã giao hàng
                        </span>
                        @if($order->is_deleted == false)
                            <a href="{{ route('order_change_status', [$order->id]) }}"
                               onclick="return confirm('Xác nhận thay đổi sang (đang vận chuyển)?')"
                               class="ui small blue label">
                                Thay đổi
                            </a>
                        @endif
                    @endif
                </div>
                <div class="seven wide column">
                    <strong>Người duyệt đơn hàng:</strong>
                </div>
                <div class="nine wide column">
                    {{ $order->getApprover() }}
                </div>
                <div class="seven wide column">
                    <strong>Thời gian duyệt đơn hàng:</strong>
                </div>
                <div class="nine wide column">
                    {{ date_format(date_create($order->orderStatus->first()->approved_at), 'd/m/Y H:i:s') }}
                </div>
            </div>
        </div>
    </div>

    <h3 class="ui dividing header" style="margin-top: 40px">Danh sách sản phẩm</h3>

    @include('admin.order.product-table')

@endsection