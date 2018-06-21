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

    public function matchedProduct($product_id) {
        $goods_receipt_note_products = GoodsReceiptNoteProduct::where('goods_receipt_note_id', $this->id)->get();
        foreach ($goods_receipt_note_products as $goods_receipt_note_product) {
            if ($goods_receipt_note_product->product_id == $product_id) {
                return true;
            }
        }
        return false;
    }

    public function canDelete() {
        return GoodsReceiptNoteProduct::where('goods_receipt_note_id', $this->id)->count() == 0;
    }
}
