<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
	public $timestamps = false;


    public function user() {
        return $this->hasOne('App\User', 'user_id');
    }
}
