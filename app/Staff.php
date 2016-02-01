<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staff';
	protected $dates = ['deleted_at'];


    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
