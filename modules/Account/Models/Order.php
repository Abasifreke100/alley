<?php

namespace Alley\Modules\Account\Models;

use Alley\Modules\Vendor\Models\Product;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable=[
        'id','user_id','product_id','status',
    ];

    public $incrementing = false;


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
