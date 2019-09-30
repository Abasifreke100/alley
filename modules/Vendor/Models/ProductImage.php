<?php

namespace Alley\Modules\Vendor\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'id','filename','product_id',
    ];

    public $incrementing = false;


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
