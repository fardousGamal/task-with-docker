<?php

namespace App\Console\Commands;

use App\Mail\LowQuantityNotificationEmail;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckProductQuantities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:low-product-quantity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check product quantities and send email alerts to vendors if quantities less than 5';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve products with a quantity less than the threshold
        $products = Product::where('quantity', '<', 5)->get();

        foreach ($products as $product) {
            // Retrieve the vendor associated with the product
            $vendor = $product->vendor;

            // Send email alert to the vendor
            Mail::to($vendor->email)->send(new LowQuantityNotificationEmail($vendor, $product));
        }
    }
}
