<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order_data;
    public $user_name;

    public function __construct($order_data,$user_name)
    {
        $this->order_data = $order_data;
        $this->user_name = $user_name;
    }

   
    public function build()
    {
        return $this->view('email.OrderCancelled')
        ->subject('Your Order has been Cancelled')
       ->with(['order_data' => $this->order_data,'name'=>$this->user_name]);
    }
}
