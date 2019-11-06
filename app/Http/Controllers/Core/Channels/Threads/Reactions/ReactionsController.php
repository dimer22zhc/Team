<?php

namespace App\Http\Controllers\Core\Channels\Threads\Reactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Thread;
class ReactionsController extends Controller
{
    //

    public function reactTo(Thread $thread, Request $request){

    	return $thread->reactions()->create(['name'=>$request->name]);
    }
}
