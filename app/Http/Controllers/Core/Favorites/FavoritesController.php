<?php

namespace App\Http\Controllers\Core\Favorites;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Channel;
use App\Core\Thread;
use App\Core\Reply;

class FavoritesController extends Controller
{
   /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new favorite in the database.
     *
     * @param  Thread $thread
     */
    public function favThread(Thread $thread)
    {
        $thread->favorite();
    }

    /**
     * Delete the favorite.
     *
     * @param Thread $thread
     */
    public function unfavThread(Thread $thread)
    {
        $thread->unfavorite();
    }
    /**
     * Store a new favorite in the database.
     *
     * @param  Reply $reply
     */
    public function favReply(Reply $reply)
    {
        $reply->favorite();
    }

    /**
     * Delete the favorite.
     *
     * @param Reply $reply
     */
    public function unfavReply(Reply $reply)
    {
        $reply->unfavorite();
    }
     /**
     * Store a new favorite in the database.
     *
     * @param  Channel $channel
     */
    public function favChannel(Channel $channel)
    {
        $channel->favorite();
    }

    /**
     * Delete the favorite.
     *
     * @param Channel $channel
     */
    public function unfavChannel(Channel $channel)
    {
        $channel->unfavorite();
    }
}
