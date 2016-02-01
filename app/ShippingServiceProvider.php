<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingServiceProvider extends Model {

    use SoftDeletes;

    protected $table = 'shipping_service_provider';
	protected $dates = ['deleted_at'];
}
