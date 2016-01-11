<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_order';
    protected $dates = ['deleted_at'];

    public function supplier() {
        return $this->belongsTo('App\Supplier', 'supplier_id');
    }
}
