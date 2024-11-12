<?php

namespace App\Events;

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
    //    public User $user;

    /**
     * Create a new event instance.
     */
    public function __construct($team_id)
    {
        //        $this->user = $user;
        $this->team_id = $team_id;
        $this->message = 'Тест 123 Тест!';
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

    //    public function broadcastAs(): string
    //    {
    //        return 'NewTeamMessage';
    //    }
}
