<?php

namespace App\Notifications;

use App\Models\Invoices;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewInvoice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $invoice ;
    public function __construct( $invoice)
    {
        $this->invoice = $invoice ;
    }


    public function via($notifiable)
    {
        return ['database'];
    }
    

   
    
    public function toArray($notifiable)
    {
        return [
            'invoice_id' => $this->invoice->id,
            'title' => "new invoice",
            'user'=>Auth::user()->name
        ];
    }
}
