<?php

namespace Alley\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'id','name','phone','email','password',
    ];

    public $incrementing = false;
}
