<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    public $guarded = [];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(ProductProperty::class);
    }
}
