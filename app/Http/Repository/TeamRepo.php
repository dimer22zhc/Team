<?php
namespace App\Http\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\UserNotInTeamException;
use App\Core\Team;
class TeamRepo
{
	protected $team;

	public function __construct(Team $team)
	{
		$this->team = $team;
	}
	
	/**
     * Get user Teams team
     *
     * @return $teams
     */

	public function getUserTeams($user)
	{
		# code...
		if ($user) {
			# code...
            $teams = [];
            foreach ($user->teams as $team) {
                # code...
                $team = $team;
                $team->channels_count = $team->channels()->count();
                array_push($teams, $team);
            }

            return $teams;
		}

	}

	/**
     * Create team
     *
     * @return $team
     */
	public function createTeam( $user ,$name )
    {
    	
    	$team = null;

    	if (!$user->currentTeam) {
    		# code...
    		/**
	         * If the user has no current team,
	         * create  him one
	         */
	    	$team = $user->currentTeam()->create([
	            'name' => $name,
	            'owner_id' => auth()->id()
	        ]);
    	}

		/**
         * If the user has no current team,
         * update  his team
         */
    	if ($user->currentTeam) {
    		# code...
	    	$user->currentTeam->name = $name;
	    	$user->currentTeam->save();
    	}
    	
		
		if ($team != null) {

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
		}
    	  
        $user->save();

        return $user->currentTeam;    
    }
    /**
     *  Associate the user team to a new channel 
     *	@return $channel
     */
    public function createFirstChannel($user, $name){
    	/**
         *  Create a channel for the newly created 
         *	team,
         */
    	$channel = null;

    	if (!$user->currentChannel) {
    		# code...
    		$channel = $user->currentTeam->createChannel($name);
    	}
    	
		
		if ($channel !=null) {
			# code...
			if (!$user->channels->contains( $channel )) {
				# code...
	    		/**
		         *  Attache the user to the newly channel 
		         *	
		         */
				$channel->users()->attach($user);
				
			}

			if (is_null($user->current_channel_id)) {
	    		/**
		         *  Associate the user to the new channel 
		         *	
		         */
	    		$user->current_channel_id = $channel->id;
	    		$user->save();
	    	}
		}
		if ($user->currentChannel) {
			# code...
			$channel = $user->currentChannel;
			$channel->name = $name;
			$channel->save();
		}

		
    	return $channel;
    }
    public function updateType($team, $type){
    	/**
         *  Update the team type if is null
         *	
         */
		$team->type = $type;
		$team->save();
    	
    	return $team;
    }

    public function getTeamMembers($team){

    	$members=[];

        foreach ($team->users as $member) {

            $team->owner->id === $member->id 
            ?  $member->team_owner = true :  $member->team_owner = false ;
            
            array_push($members, $member);
        }

        return $members;

    }
    public function switchTeam( $team, $user )
    {
        if( $team !== 0 && $team !== null )
        {
            $team        = $team->id;
            $teamModel   = $this->team;
            $teamObject  = ( new $teamModel() )->find( $team );
            if( !$teamObject )
            {
                $exception = new ModelNotFoundException();
                $exception->setModel( $teamModel );
                throw $exception;
            }
            if( !$teamObject->users->contains( $user->id ) )
            {
                $exception = new UserNotInTeamException();
                $exception->setTeam( $teamObject->name );
                throw $exception;
            }
        }
        $user->current_team_id = $team;
        $user->save();
        
    }
}