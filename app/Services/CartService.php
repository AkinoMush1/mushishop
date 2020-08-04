<?php

namespace App\Services;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function get()
    {
        return Auth::user()->cartItems()->with('productSku.product')->get();
    }

    public function add($skuId, $amount)
    {
        $skuId = $skuId;
        $amount = $amount;
        $user = Auth::user();

        if ($cart = $user->cartItems()->where('product_sku_id', $skuId)->first()) {

            $cart->update([
                'amount' => $amount + $cart->amount
            ]);
        } else {
            $cart = new CartItem(['amount' => $amount]);
            $cart->user()->associate($user);
            $cart->productSku()->associate($skuId);
            $cart->save();
        }

        return $cart;
    }

    public function remove($skuIds)
    {
        // 可以传单个 ID，也可以传 ID 数组
        if (!is_array($skuIds)) {
            $skuIds = [$skuIds];
        }
        Auth::user()->cartItems()->whereIn('product_sku_id', $skuIds)->delete();
    }
}
