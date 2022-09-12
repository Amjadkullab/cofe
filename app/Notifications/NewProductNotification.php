<?php

namespace App\Notifications;

use App\Models\Admin;
use App\Models\category;
use App\Models\product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{
    use Queueable;
    protected $category;
    protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, category $category)
    {
        $this->category = $category;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['database','mail','broadcast'];
        //     if(!$notifiable instanceof AnonymousNotifiable){
        //     if($notifiable->notify_mail){
        //         $via []='mail';
        //     }
        //     if($notifiable->notify_sms){
        //         $via []='nexmo';
        //     }
        // }

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
        $message = new MailMessage;
        $message->subject('New Admin')->from('admin@gmail.com')->greeting('Hello' . ($notifiable->name ?? ''))
            ->line('The admin is added successfully')
            ->action('all admins that added', url(route('admin.index', $this->admin->id)))
            ->salutation('Thank you!');
        return $message;
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $body = sprintf(' applied for a category %s', $this->category->name);
        return [
            'title' => 'New Product',
            'body' => $body,
            'icon' => 'icon-material-outline-group',
            'url' => route('categories.index', $this->category_id)
        ];
    }
    public function toBroadcast($notifiable)
    {
        $body = sprintf(' applied for a category %s', $this->category->name);
        return [
            'title' => 'New Product',
            'body' => $body,
            'icon' => 'icon-material-outline-group',
            'url' => route('categories.index', $this->category_id)
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
