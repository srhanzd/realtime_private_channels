<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Str;

class NewComment implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $user_id;
    public $comment;
    public $user_name;
    public $post_id;
    public $date_time;
    //public $time;

    public function __construct($data = [])
    {
        $this->user_id = $data['user_id'];
        $this->user_name = $data['user_name'];
        $this->comment = $data['comment'];
        $this->post_id = $data['post_id'];
        $this->date_time = Carbon::now()->toDateTime()->format('Y-m-d H:i:s');//date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PresenceChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('post.'.$this->comment->post_id);//.'.$this->comment->post_id);
//        return new PresenceChannel('post.'.$this->comment->post_id);//.'.$this->comment->post_id);
    }

}
