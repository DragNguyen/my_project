<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificationProductType extends Model
{
    protected $table = 'specification_product_types';

    public function getSpecName() {
        $specName = Specification::find($this->specification_id);
        return $specName->name;
    }
}
