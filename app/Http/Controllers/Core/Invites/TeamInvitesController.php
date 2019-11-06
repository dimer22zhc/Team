<?php

namespace App\Http\Controllers\Core\Invites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\TeamInvitesRepo;
use App\Core\Team;
use App\User;
class TeamInvitesController extends Controller
{

    private $user;
	private $team;
    private $repo;

	public function __construct(Team $team,TeamInvitesRepo $repo, User $user )
	{
		$this->team = $team;
        $this->repo = $repo;
        $this->user = $user;
	}
    /**
     * Invite the user to  channel
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    
   public function invite(Request $request, $team)
    {
        $teamModel = $this->team ;

        $team = $this->team->findOrFail($team);

        if(!$this->repo->hasPendingInvite( $request->email, $team) )
        {
           
           return  $this->repo->inviteToTeam( $request->user(), $request->email , $team);

        } else {
            return [
                'status' => 0
            ];
        }
        
        // return $team->id;
    }

    /**
     * Accept the Invites
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function acceptInvite(Request $request,$token)

    {
        $invite = $this->repo->getInviteFromAcceptToken($token);

        if (!$invite) {
            abort(404);
        }

        if (auth()->check()) {

            if ($request->user()->email === $invite->email) {
                # code... 
                
                $this->repo->acceptInvite($invite,$request->user());
            }
           
            return [
                "status" => "auth"
            ];
        } else {
            $user = $this->user->where('email','=',$invite->email)->first();

            if (!$user) {

                $newUser = $this->repo->createNewUser($invite);

                if ($newUser) {
                    # code... 
                    $team = $this->repo->acceptInvite($invite, $newUser);
                    # code...
                }
               

                return [
                    'email' => $invite->email,
                    'teamName' => $team->name
                ];
            }
            return ['status' => 'not login'];
        }
    }
}
