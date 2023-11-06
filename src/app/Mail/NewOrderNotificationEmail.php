<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $order;

    public function __construct(Vendor $vendor, Order $order)
    {
        $this->vendor = $vendor;
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('New Order Notification')
            ->view('emails.new_order_notification');
    }
}
