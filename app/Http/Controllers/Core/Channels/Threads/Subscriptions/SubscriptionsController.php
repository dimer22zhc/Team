<?php

namespace App\Http\Controllers\Core\Channels\Threads\Subscriptions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Thread;

class SubscriptionsController extends Controller
{
     /**
     * Store a new thread subscription.
     *
     * @param int    $channelId
     * @param Thread $thread
     */
    public function store(Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Delete an existing thread subscription.
     *
     * @param int    $channelId
     * @param Thread $thread
     */
    public function destroy(Thread $thread)
    {
        $thread->unsubscribe();
    }
}
