<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOff extends Model
{
    public function salesOffs() {
        return $this->hasMany(SalesOff::class);
    }

    public function getTotalOfChild() {
        return $this->salesOffs->count();
    }
}
