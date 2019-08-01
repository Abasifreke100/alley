<?php

namespace Alley\Modules\Vendor\Models;

use Alley\Modules\Account\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','vendor_id','images','names','category','description','location','monthly_price',
    ];


    public $incrementing = false;

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}


