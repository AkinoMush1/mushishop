<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductSoldCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param OrderPaid $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $order = $event->getOrder();

        $order->load('items.product');

        foreach ($order->items as $item) {
            $product = $item->product;

            $product->increment('sold_count', $item->amount);
        }
    }
}
