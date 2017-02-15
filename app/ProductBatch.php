<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBatch extends Model
{
    use SoftDeletes;

    protected $table = 'product_batch';
    protected $dates = ['deleted_at'];

    public function product() {
        return $this->belongsTo(App\Product::class, 'product_id');
    }
}
