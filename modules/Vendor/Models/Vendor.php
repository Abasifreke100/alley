<?php

namespace Alley\Modules\Vendor\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'vendor_name', 'email', 'phone_number', 'location', 'password',
    ];


    public $incrementing = false;

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
