<?php

namespace Alley\Modules\Vendor\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','images','names','category','description','location','monthly_price',
    ];


    public $incrementing = false;
}
