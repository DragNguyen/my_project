<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_phams';

    public function giaTiens() {
        return $this->hasMany(GiaTien::class);
    }

    public function loaiSanPham() {
        return $this->belongsTo(LoaiSanPham::class);
    }

    public function thuongHieu() {
        return $this->belongsTo(ThuongHieu::class);
    }

    public function tinhTrang() {
        return ($this->dang_ban) ? 'Đang bán' : 'Ngừng kinh doanh';
    }

    public function giaHienTai() {
        return $this->giaTiens->max()->gia;
    }
}
