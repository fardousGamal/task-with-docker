<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOrderCreation()
    {
        // Create an product and set its initial stock quantity
        $product = Product::factory()->create([
            'quantity' => 10,
        ]);

        // Create an order with a required quantity
        $requiredQuantity = 5;

        $order = Order::create([
            'user_id' => 1,
            'item_count' => $requiredQuantity,
            'order_date' => Carbon::now()->format('Y-m-d'),
            'total_price' => $product->price
        ]);
        $order->details()->create([
            'quentity' => $requiredQuantity,  'price' => $product->price,
            'product_id' => $product->id
        ]);
        $product->update(['quantity' => ($product->quantity - $requiredQuantity)]);
        // Refresh the product from the database
        $product->refresh();



        // Assert that the item's stock is updated correctly
        $this->assertEquals(5, $product->quantity);
    }
}
