<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoiceProductItems extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_invoice_product_items';
    protected $dates = ['deleted_at'];

    public function purchaseInvoice() {
        return $this->belongsTo('App\PurchaseInvoice', 'purchase_invoice_id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
