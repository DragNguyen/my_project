<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        .wrapper {
            padding: 20px;
            font-family: 'DejaVu Sans';
            font-size: 12px;
        }
        p {
            margin: 5px;
        }
        .date {
            font-size: 12px;
        }

        .header-wrapper {
            width: 100%;
            text-align: center;
        }

        table {
            width: 100%;
            border-radius: 5px;
            text-align: center;
        }

        th {
            background-color: #F9FAFB;
        }

        th, td {
            padding: 5px;
            border-color: lightgray;
            border-style: solid;
            border-width: 1px 1px 0 0;
        }

        th:first-child, td:first-child {
            border-left: 1px solid lightgray;
        }

        tr:last-child td:last-child {
            border-bottom: 1px solid lightgray;
        }

        .right-aligned {
            text-align: right;
        }

        .left-aligned {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="date">{{ date_format(date_create(date('Y-m-d')), 'd/m/Y') }}</div>
    <div class="header-wrapper">
        <p><strong>HÓA ĐƠN BÁN HÀNG</strong></p>
        <p>Ngày: <strong>{{ date_format(date_create(date('Y-m-d H:i:s')), 'd/m/Y H:i:s') }}</strong> </p>
        <p>Mã đơn hàng: <strong>{{ $order->code }}</strong></p>
    </div>

    <div class="info">
        <p>Đơn vị bán hàng: <strong>Shop Di Động</strong></p>
        <p>Tên khách hàng: <strong>{{ $order->recipient }}</strong></p>
        <p>Địa chỉ: {{ $order->address }}</p>
        <p>Điện thoại: {{ $order->phone }}</p>
        <p>Hình thức thanh toán: tiền mặt khi nhận hàng</p>
    </div>

    <div class="product-table">
        <table cellspacing="0">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Khuyến mãi</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            @php $total = 0 @endphp
            @foreach($order_products as $stt => $order_product)
                @php $total += $order_product->totalOfPrice() @endphp
                <tr>
                    <td>{{ $stt + 1 }}</td>
                    <td>{{ $order_product->product->name }}</td>
                    <td>{{ $order_product->quantity }}</td>
                    <td>{{ number_format($order_product->price) }}<sup>đ</sup></td>
                    <td>{{ $order_product->sales_off_percent }}%</td>
                    <td>{{ number_format($order_product->totalOfPrice()) }}<sup>đ</sup></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" class="right-aligned">
                    <p>Thuế GTGT (10%): <strong>{{ number_format($total * 0.1) }}<sup>đ</sup></strong></p>
                    <p>Tổng tiền hàng (đã có thuế): <strong>{{ number_format($total) }}<sup>đ</sup></strong></p>
                    <p>Phí vận chuyển: <strong>0<sup>đ</sup></strong></p>
                    <p>Tổng cộng: <strong>{{ number_format($total) }}<sup>đ</sup></strong></p>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>