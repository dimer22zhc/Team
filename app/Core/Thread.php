<?php

namespace App\Core;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	use Favoritable;

	protected $fillable = ['user_id','channel_id','team_id','body','type','title','description','avatar'];
    //
    protected $appends = ['favoritesCount','c_name', 'isFavorited','isSubscribedTo','reactions'];

    protected $with =['owner','archives','replies','files'];

    public function serializeDate(DateTimeInterface $date){
        return $date->format('c');
    }
    public function owner(){

    	return $this->belongsTo('App\User','user_id');

    }
    public function replies()
    {
        return $this->morphMany('App\Core\Reply', 'replyTo');
    }
    public function archives(){

    	return $this->hasMany('App\Core\ThreadArchive');

    }

    public function files(){
        return $this->hasMany('App\Core\File');
    }
    public function reactions(){
        return $this->morphToMany('App\Core\Reaction','reactable');
    }
    public function getReactionsAttribute()
    {
         return $this->reactions()
            ->getQuery()
            // ->select('name')
            ->selectRaw('name, count(*) as count')
            ->distinct()
            ->groupBy('name')
            ->get();
        # code...
    }

    public function channel(){
        return $this->belongsTo('App\Core\Channel','channel_id');
    }

    public function getCnameAttribute(){
        return $this->channel()->getQuery()
                    ->selectRaw('name')
                    ->get();
    }


    /**
     * Subscribe a user to the current thread.
     *
     * @param  int|null $userId
     * @return $this
     */
    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);

        return $this;
    }

    /**
     * Unsubscribe a user from the current thread.
     *
     * @param int|null $userId
     */
    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    /**
     * A thread can have many subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany('App\Core\ThreadSubscription');
    }

    /**
     * Determine if the current user is subscribed to the thread.
     *
     * @return boolean
     */
    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

}
