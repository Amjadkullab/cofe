<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Support\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     public $message ;
     public $sender ;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message=$message;
        $this->sender =Auth::user();
      }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('messages',$this->message->recipient_id);
    }
    public function broadcastAs(){// هاي من خلالها بتغر اسم الحدث ال بيجيني في ال pusher في deug console
        return 'message.created';

    }
    public function broadcastwith(){
        return [
            'message '=> $this->message,
            'user '=> Auth::user()->name,
            'time'=> Carbon::now()->diffForHumans(),
        ];
    }
}
