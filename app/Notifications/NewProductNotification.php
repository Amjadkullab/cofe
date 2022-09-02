<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{
    use Queueable;
     protected $product,$admin ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(product $product,Admin $admin)
    {
        $this->product=$product;
        $this->admin=$admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['database'];
        if($notifiable->notify_mail){
            $via []='mail';
        }
        if($notifiable->notify_sms){
            $via []='nexmo';
        }


        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable){
        $body = sprintf('%s applied for a job %s',$this->product->name,$this->category->name);
       return [
       'title'=>'New Product',
       'body'=> $body,
       'icon'=>'icon-material-outline-group',
       'url'=>route('products.index',$this->product->id)
       ];


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
