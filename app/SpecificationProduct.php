<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificationProduct extends Model
{
    public function specification() {
        return $this->belongsTo(Specification::class);
    }

    public function getSpecName() {
        return $this->specification->name;
    }
}
