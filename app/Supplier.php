<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = 'supplier';
    protected $dates = ['deleted_at'];

    public function country() {
        return $this->belongsTo('App\Countries', 'country_id');
    }

    public function purchase_orders() {
        return $this->hasMany('App\PurchaseOrder', 'supplier_id');
    }
}
