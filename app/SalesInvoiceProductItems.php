<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInvoiceProductItems extends Model
{
    use SoftDeletes;

    protected $table = 'sales_invoice_product_items';
    protected $dates = ['deleted_at'];
}
