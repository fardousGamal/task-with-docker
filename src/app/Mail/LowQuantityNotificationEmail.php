<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowQuantityNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $product;

    public function __construct(Vendor $vendor, Product $product)
    {
        $this->vendor = $vendor;
        $this->product = $product;
    }

    public function build()
    {
        return $this->subject('Low Quantity Alert')
            ->view('emails.low_quantity_alert');
    }
}
