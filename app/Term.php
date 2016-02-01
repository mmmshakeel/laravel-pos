<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model {

    use SoftDeletes;

    protected $table = 'term';
	protected $dates = ['deleted_at'];
}
