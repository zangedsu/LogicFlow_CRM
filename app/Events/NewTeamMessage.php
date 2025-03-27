<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTeamMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $team_id;

    public $message;


    /**
     * Create a new event instance.
     */
    public function __construct($team_id, $message, $sender_id, $chat_name)
    {
        //        $this->user = $user;
        $this->team_id = $team_id;
        $this->message = User::find($sender_id)->name . ' в ' . $chat_name. ': ' . $message;
        //        dd($user->currentTeam()->first()->id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('team.'.$this->team_id);
    }

}
