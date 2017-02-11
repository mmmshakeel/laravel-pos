<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customer';
    protected $dates = ['deleted_at'];

    public function country() {
        return $this->belongsTo('App\Country', 'country_id');
    }
}
