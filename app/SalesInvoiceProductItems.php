<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInvoiceProductItems extends Model
{
    use SoftDeletes;

    protected $table = 'sales_invoice_product_items';
    protected $dates = ['deleted_at'];

    public function quotation()
    {
        return $this->belongsTo('App\SalesInvoice', 'sales_invoice_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

}
