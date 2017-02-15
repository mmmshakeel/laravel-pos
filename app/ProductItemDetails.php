<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductItemDetails extends Model
{
    use SoftDeletes;

    protected $table = 'product_item_details';
    protected $dates = ['deleted_at'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_batch() {
        return $this->belongsTo(ProductBatch::class, 'product_batch_id');
    }
}
