<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\post;
class NewProduct implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
  public $post;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(post $post)
    {
        $this->post=$post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('home');
    }

    public function broadcastWith(){
        return [
            'name'=>$this->post->name,
            'description'=>$this->post->description,
            'price'=>$this->post->price,
//           image'=>$this->post->image,
            'thumbnail'=>$this->post->thumbnail,

        ];
    }
}
