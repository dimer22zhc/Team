<?php

namespace App\Http\Controllers\Core\Team;

use Illuminate\Http\Request;
use App\Core\Team;
use App\Http\Repository\TeamRepo;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{

	private $team;
	private $repo;

	public function __construct(Team $team, TeamRepo $repo)
	{
		$this->team = $team;
		$this->repo = $repo;
	}
    
    /**
     * Get the user teams.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        return $this->repo->getUserTeams($request->user());

    }

    /**
     * Switch between teams.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function switchTeam($team,Request $request){
        $team = $this->team->findOrFail($team);
        return $this->repo->switchTeam($team,$request->user());

    }

    /**
     * Show the user team.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($team, Request $request){

        $team = $this->team->findOrFail($team);
        
        if ($team->id === $request->user()->currentTeam->id) {
            # code...
            return $team;
        }

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	if ($request->name) {
    		# code...
    		return $this->repo->createTeam($request->user(), $request->name);
    	}

    	if($request->channel_name){
    		return $this->repo->createFirstChannel($request->user(),$request->channel_name);
    	}

    	if($request->type){
    		return $this->repo->updateType($request->user()->currentTeam,$request->type);
    	}
    }

    public function members(Team $team){

         return $this->repo->getTeamMembers($team);

    }
}
