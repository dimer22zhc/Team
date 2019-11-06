<?php

namespace App\Http\Controllers\Core\Channels;

use Illuminate\Http\Request;
use App\Http\Repository\ChannelRepo;
use App\Core\Team;
use App\Core\Channel;
use App\Http\Controllers\Controller;

class ChannelsController extends Controller
{
	private $repo;
	private $team;

	public function __construct(ChannelRepo $repo, Team $team)
	{
		$this->repo = $repo;
		$this->team = $team;
	}

     /**
     * Get the user team channels.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($team,Request $request){

    	// $team = $this->team->findOrFail($team);
			$channels=[];
			foreach ($request->user()->channels as $channel) {
				// code...
				$channel->name = $channel->name;
				$channel->isFavorited = $channel->isFavorited();
				$channel->members = 	$channel->users()->count();
				$channel->team_name = 	$channel->team->name;

				array_push($channels,$channel);

			}
    	return 	$channels;

    }
     /**
     * Get all channel threads.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function threads(Channel $channel, Request $request){
        $request->user()->current_channel_id = $channel->id;
        $request->user()->save();
        return $channel->threads;
        // ->newQuery()
        // ->get()
        // ->groupBy(function ($t) {
        //     return $t->created_at->format('Y-m-d h');
        // });

    }

    /**
     * Get all channel threads.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        $team = $this->team->findOrFail($request->user()->currentTeam->id);

        return $this->repo->createChannel(
            $team,
            $request->channelData['channel']['name']
        );

    }
}
