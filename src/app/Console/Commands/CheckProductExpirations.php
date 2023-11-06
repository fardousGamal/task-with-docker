<?php

namespace App\Console\Commands;

use App\Mail\ProductExpirationNotificationEmail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckProductExpirations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:product-expirations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check product expirations and send email to vendors';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       // Retrieve products with an expiration date within a month
       $expirationDate = Carbon::now()->addMonth();
       $products = Product::where('expiration_date', '<', $expirationDate)->get();

       foreach ($products as $product) {
           // Retrieve the vendor associated with the product
           $vendor = $product->vendor;

           // Send email alert to the vendor
           Mail::to($vendor->email)->send(new ProductExpirationNotificationEmail($vendor, $product));
       }
   
    }
}
