<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInvoice extends Model
{
    use SoftDeletes;

    protected $table = 'sales_invoice';
    protected $dates = ['deleted_at'];

    public function salesRep() {
        return $this->belongsTo('App\Staff', 'sales_rep_id');
    }

    public function branch() {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function salesinvoiceItems()
    {
        return $this->hasMany('App\SalesInvoiceProductItems', 'sales_invoice_id');
    }

}
