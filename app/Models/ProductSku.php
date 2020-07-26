<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $guarded = [];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
