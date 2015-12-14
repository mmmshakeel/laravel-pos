<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
    use SoftDeletes;

    protected $table = 'category';
    protected $dates = ['deleted_at'];

    public function brands() {
        return $this->hasMany('App\Brand', 'category_id', 'id');
    }
}
