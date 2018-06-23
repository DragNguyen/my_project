<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = 'suppliers';

    public function goodsReceiptNotes() {
        return $this->hasMany(GoodsReceiptNote::class);
    }

    public function canDelete() {
        return $this->goodsReceiptNotes->count() == 0;
    }
}
