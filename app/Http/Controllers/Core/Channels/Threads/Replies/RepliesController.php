<?php

namespace App\Http\Controllers\Core\Channels\Threads\Replies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Thread;
use App\Core\Reply;

class RepliesController extends Controller
{
    public function store(Thread $thread,Request $request){
   		$reply = $thread->replies()->create(['body' => $request->body,'user_id' => $request->user()->id ]);

    	return $reply->load('owner');
    }

    public function update(Request $request, Reply $reply){

    	$reply->update([
    		'body' => $request->body
    	]);
    }

    public function destroy(Reply $reply){
    	$reply->delete();
    }


}
