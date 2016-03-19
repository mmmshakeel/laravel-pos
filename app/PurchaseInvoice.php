<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoice extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_invoice';
    protected $dates = ['deleted_at'];

    public function productInvoiceItems() {
        return $this->hasMany('App\PurchaseInvoiceProductItems', 'purchase_invoice_id');
    }

    public function supplier() {
        return $this->belongsTo('App\Supplier', 'supplier_id');
    }

    public function currency() {
        return $this->belongsTo('App\Currency', 'currency_id');
    }

    public function shipToBranch() {
        return $this->belongsTo('App\Branch', 'ship_to_branch_id');
    }

    public function term() {
        return $this->belongsTo('App\Term', 'terms_id');
    }

    public function location() {
        return $this->belongsTo('App\Branch', 'location_id');
    }

    public function purchaseRep() {
        return $this->belongsTo('App\Staff', 'purchase_rep');
    }

    public function purchaseOrder() {
        return $this->belongsTo('App\PurchaseOrder', 'purchase_order_id');
    }
}
