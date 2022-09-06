<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{
    use Queueable;

     protected $admin ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Admin $admin)
    {

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
        $via = ['database','mail'];
        if(!$notifiable instanceof AnonymousNotifiable){
        if($notifiable->notify_mail){
            $via []='mail';
        }
        if($notifiable->notify_sms){
            $via []='nexmo';
        }
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
        $message= new MailMessage;
        $message->subject('New Admin')->from('admin@gmail.com')->greeting('Hello'.($notifiable->name ?? ''))
        ->line('The admin is added successfully')
        ->action('all admins that added', url(route('admin.index',$this->admin->id)))
        ->salutation('Thank you!');
        return $message;
    }
     /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable){
        $body = sprintf('%s applied for a job %s',$this->product->name,$this->product->category_name);
       return [
       'title'=>'New Product',
       'body'=> $body,
       'icon'=>'icon-material-outline-group',
       'url'=>route('products.index',$this->product_id)
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
