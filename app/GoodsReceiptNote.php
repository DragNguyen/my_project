<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsReceiptNote extends Model
{
    protected $table = 'goods_receipt_notes';

    public function matchedSupplier($supplier_id) {
        $childs = GoodsReceiptNote::where('goods_receipt_note_id', $this->id)->get();

        foreach($childs as $child) {
            if ($supplier_id == $child->supplier_id) {
                return true;
            }
        }
        return false;
    }
}
