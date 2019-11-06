<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeamInvitesMail extends Mailable
{
    use Queueable, SerializesModels;

    private $invite;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite, $user)
    {
        $this->user = $user;
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $appUrl = config('app.client_url', config('app.url'));

        $url_accept = $appUrl.'/invite/accept/'.$this->invite->accept_token;

        $team = $this->user->currentTeam->name;  
            
        return $this->view('team.emails.invite', 
            [ 
                'invite' => $this->invite,
                'team' => $team,
                'sender' => $this->user->name,
                'url_accept' => $url_accept
            ]
        );
    }
}
