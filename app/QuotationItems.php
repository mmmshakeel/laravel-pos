<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationItems extends Model
{
    use SoftDeletes;

    protected $table = 'quotation_items';
    protected $dates = ['deleted_at'];

    public function quotation()
    {
        return $this->belongsTo('App\Quotation', 'quotation_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
