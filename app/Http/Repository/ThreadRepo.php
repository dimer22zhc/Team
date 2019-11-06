<?php

namespace App\Http\Repository;
use App\Core\Thread;
class ThreadRepo{

	private $thread;

	public function __construct(Thread $thread)
	{
		$this->thread = $thread;
	}
	/**
     * create thread.
     *
     */
	public function newThread($channel,$user,$teamId,$body,$title,$description,$type,$archive){

		if ($channel && $user) {
			# code...
			$thread =  $channel->threads()->create([
				'user_id' => $user->id,
				'team_id' => $teamId,
				'body' => $body,
				'title'=>$title ? $title : null,
				'type'=>$type ? $type : 'normal',
				'description'=> $description ? $description : null
			]);
			if ($type!=='post') {
				# code...
				$archived = $this->archive($archive,$thread);
					if ($archived) {
						// code...
						$archived->c_name = $archived->channel->name;
						$archived->owner = $archived->owner()->newQuery()->selectRaw('name,id')->get();
						$thread->archives = [$archived];
					}
			}
			return $thread->load('owner','replies');
		}
	}

	public function archive($archive,$thread){

		if ($archive) {
			# code...
				$threadModel   = $this->thread;
        $threadObject  = ( new $threadModel() )->find( $archive[0] );
        if ($threadObject && $thread) {
            	# code...
        		return $thread->archives()->create([
					'user_id'=>$threadObject->owner->id,
					'archived_id'=>$threadObject->id,	
					// 'team_id'=> $threadObject->owner->currentTeam->id
					'channel_id'=>$threadObject->channel_id,
					'create_time' => $threadObject->created_at,
					'content'=>$threadObject->body,
					'type' => '1'
				]);
            }
		}

	}
	public function updateThread($thread,$body,$postDescription,$isPost){
		if (!$isPost) {
			# code...
			$thread->update([
				'body'=>$body
			]);
		}else{
			$thread->update([
				'description'=> $postDescription
			]);
		}


	}

}
