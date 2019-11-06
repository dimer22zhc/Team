<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserInvitedToTeam
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @type Model
     */
    protected $invite;

    public function __construct($invite)
    {
        $this->invite = $invite;
    }

    /**
     * @return Model
     */
    public function getInvite()
    {
        return $this->invite;
    }

    /**
     * @return int
     */
    public function getTeamId()
    {
        return $this->invite->team_id;
    }
}
