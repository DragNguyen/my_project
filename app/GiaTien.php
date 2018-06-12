<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaTien extends Model
{
    protected $table = 'gia_tiens';

    public function sanPhams() {
        return $this->belongsTo(SanPham::class);
    }
}
