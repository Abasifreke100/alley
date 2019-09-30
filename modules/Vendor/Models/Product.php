<?php

namespace Alley\Modules\Vendor\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','vendor_id','description','role','category','street','city','state','feature','price',
    ];


    public $incrementing = false;


    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }
}


