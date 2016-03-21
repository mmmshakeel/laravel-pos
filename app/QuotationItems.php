<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationItems extends Model
{
    use SoftDeletes;

    protected $table = 'quotation_items';
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Quotation', 'quotation_id');
    }
}
