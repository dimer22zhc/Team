<?php

namespace App\Http\Repository;

class ChannelRepo
{
	public function getTeamChannels($team){
		if ($team) {
			# code...
			$channels = [];

			foreach ($team->channels as $channel) {
				# code...
				$channel = $channel;
				// $channel->loaded = false;

				array_push($channels, $channel);
			}

			return $channels;
		}
		
	}
	public function createChannel($team,string $name)
	{
		# code...
		if ($team && $name) {
			# code...
			return $team->createChannel($name);
		}
		
	}

}