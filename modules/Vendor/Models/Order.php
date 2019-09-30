<?php

namespace Alley\Modules\Vendor\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable=[
        'id','product_id','status','first_name','last_name','email','phone','gender','location',
    ];

    public $incrementing = false;


}
