<?php

namespace App\Http\Controllers\Core\Channels\Threads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\ThreadRepo;
use App\Core\Thread;
use App\Core\Channel;

class ThreadsController extends Controller
{
	private $repo;
	private $channel;

	function __construct(Channel $channel, ThreadRepo $repo)
	{
		$this->channel = $channel;
		$this->repo = $repo;
	}
    /**
     * Create a threads.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store($channel,Request $request){

    	$channelModel = $this->channel->findOrFail($channel);
    	return $this->repo->newThread(
            $channelModel, 
            $request->user(),
            $request->user()->current_team_id, 
            $request->body,
            $request->title,
            $request->description,
            $request->type,
            $request->archive
        );
    }
    public function update(Thread $thread,Request $request){

        $this->repo->updateThread(
            $thread, 
            $request->body,
            $request->postDescription,
            $request->isPost
        );
    }
    public function delete(Thread $thread){

       $thread->delete();

       return ["ok"=>"deleted"];
    }
    //get single thread
    public function thread(Thread $thread,Request $request){
        return $thread;
    }
    public function getUserFavoriteThreads(Request $request){
        

        return $request->user()->threads()
            ->getQuery()
            ->join('thread_subscriptions','threads.id','=','thread_subscriptions.thread_id')
            ->where('team_id','=',$request->user()->current_team_id)
            ->distinct()
            ->selectRaw('threads.*')
            ->get();
       
    }
}
