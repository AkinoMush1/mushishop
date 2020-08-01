<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    $product = \App\Models\Product::query()->where('on_sale', true)->first();
    $sku = $product->skus()->inRandomOrder()->first();

    return [
        'product_id'     => $product->id,
        'product_sku_id' => $sku->id,
        'admount'        => random_int(1, 5),
        'price'          => $sku->price,
        'rating'         => null,
        'review'         => null,
        'reviewed_at'    => null,
    ];
});
