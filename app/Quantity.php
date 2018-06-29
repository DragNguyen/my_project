<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    public function getEvent() {
        $event = [
            '0' => 'Tạo sản phẩm',
            '1' => 'Tạo đơn hàng',
            '-1' => 'Hủy đơn hàng',
            '2' => 'Nhập hàng',
            '-2' => 'Thay đổi phiếu nhập hàng',
            '-3' => 'Hủy phiếu nhập hàng'
        ];
        return $event[$this->event];
    }
}
