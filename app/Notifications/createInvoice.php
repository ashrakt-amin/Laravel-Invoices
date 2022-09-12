<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class createInvoice extends Notification
{
    use Queueable;
    private $invoice_id;
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('http://localhost:8000/invoice/details/'.$this->invoice_id);
 
        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('create new invoice')
                    ->action('View Invoice', $url)
                    ->line('Thank you for using our application!');
    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
