<?php

namespace Alley\Modules\Account\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'role', 'display_name',
    ];

    public $incrementing = false;



}
