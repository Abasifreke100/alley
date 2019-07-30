<?php

namespace Alley\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'id','first_name','last_name','phone_number','email','password',
    ];

    public $incrementing = false;
}
