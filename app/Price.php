<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
