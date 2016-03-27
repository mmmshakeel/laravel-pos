<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;

    protected $table = 'quotation';
    protected $dates = ['deleted_at'];

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function salesRep()
    {
        return $this->belongsTo('App\Staff', 'sales_rep');
    }

    public function quotationItems()
    {
        return $this->hasMany('App\QuotationItems', 'quotation_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency', 'currency_id');
    }
}
