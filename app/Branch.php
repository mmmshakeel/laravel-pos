<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model {

    use SoftDeletes;

    protected $table = 'branch';
    protected $dates = ['deleted_at'];

    public function country() {
        return $this->belongsTo('App\Countries', 'country_id');
    }
}
