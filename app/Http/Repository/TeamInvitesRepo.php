<?php

namespace App\Http\Repository;

use App\Core\TeamInvite;
use Carbon\Carbon;
use App\User;
class TeamInvitesRepo{

	private $invites;
	private $user;

	public function __construct(TeamInvite $invites, User $user)
	{
		$this->invites = $invites;
		$this->user = $user;
	}
	public function hasPendingInvite($email,$team){

		 if( is_object( $team ) )
        {
            $team = $team->getKey();
        }
        if( is_array( $team ) )
        {
            $team = $team["id"];
        }
        return $this->invites->where('email', "=", $email)->where('team_id', "=", $team )->first() ? true : false;
	}

	public function inviteToTeam( $user,$email, $team = null){

		$invite               = $this->invites;
        $invite->user_id      = $user->id;
        $invite->team_id      = $team->id;
        $invite->type         = 'invite';
        $invite->email        = $email;
        $invite->accept_token = md5( uniqid( microtime() ) );
        $invite->deny_token   = md5( uniqid( microtime() ) );
        $invite->save();

        if ($invite->email) {
        	# code...
        	\Mail::to($invite->email)->send(new \App\Mail\TeamInvitesMail($invite,$user) );
        }
        return [
        	'email' => $invite->email,
        ];
	}

	public function getInviteFromAcceptToken($token){

		return $this->invites->where('accept_token', '=', $token)->first();
	}

	public function createNewUser($invite){

		if ($invite) {
			# code...

			$user = $this->user;
			$user->name = $invite->email;
			$user->email = $invite->email;
			$user->email_verified_at = Carbon::now();
			$user->password = bcrypt($invite->email);
			$user->save();

            return $user;
		}
			
	}
	public function acceptInvite( $invite, $user)
    {
    	$team = $invite->team;
        # code...
			if (!$user->teams->contains( $team )) {
	    		# code... 
	    		/**
		         * If the user has no current team,
		         * use the attached one
		         */
	    		$team->users()->attach($user);
	    	}
	    	if( is_null( $user->current_team_id ) ){
				/**
		         * If the user has no current team,
		         * associate him  to his team
		         */
	        	$user->currentTeam()->associate($team);
	        }

	        if( !is_null( $user->current_team_id ) ){
				/**
		         * If the user has no current team,
		         * associate him  to his team
		         */
	        	$user->current_team_id = $team->id ;
	        }

	        $user->save();

	    return $user->currentTeam;
    }
}