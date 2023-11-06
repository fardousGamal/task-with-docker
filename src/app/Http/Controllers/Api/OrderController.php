<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\NewOrderNotificationEmail;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('details')->get();

        return $this->response(Response::HTTP_OK, '', $orders);
    }
    public function store(OrderRequest $request)
    {
        // Retrieve the order details from the request

        $orderData = [
            'user_id' => auth()->id(),
            'item_count' => count($request->products),
            'order_date' => Carbon::now()->format('Y-m-d'),
            'total_price' => $this->calculateOrderPrice(
                $request->input('products')
            ),
        ];

        // Create the order
        $order = Order::create($orderData);

        // Save the order products
        foreach ($request['products'] as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $quantity = $productData['quantity'];

            // Deduct the ordered quantity from the product's stock
            $product->decrement('quantity', $quantity);

            // Associate the details with the order
            $order->details()->create([
                'quentity' => $quantity,  'price' => $product->price,
                'product_id' => $product->id
            ]);
        }

        // Send an email notification to the vendor
        $this->sendOrderNotification($order);

        return response()->json(['message' => 'Order created successfully']);
    }

    public function calculateOrderPrice($reqItems)
    {

        // associative array of item ids and their respective quantities
        $itemIdsQtys = [];

        foreach ($reqItems as $reqItem) {
            $itemIdsQtys[$reqItem['product_id']] = $reqItem['quantity'];
        }

        // get array of item ids and fetch their respective models
        $ids = array_keys($itemIdsQtys);
        $itemModels = Product::find($ids);

        // calculate total
        $priceTotal = 0;
        foreach ($itemModels as $model) {
            $subtotal = $model->price * $itemIdsQtys[$model->id];
            $priceTotal += $subtotal;
        }

        return $priceTotal;
    }

    private function sendOrderNotification(Order $order)
    {
        // Retrieve the vendor associated with each product in the order
        $vendors = $order->products()->with('vendor')->get()->pluck('vendor')->unique();
        foreach ($vendors as $vendor) {
            // Send email notification to the vendor
            Mail::to($vendor->email)->send(new NewOrderNotificationEmail($vendor, $order));
        }
    }
}
