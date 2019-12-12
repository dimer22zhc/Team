<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable=['name','owner_id','description','type'];

    public function owner(){
        return $this->belongsTo('App\User','owner_id');
    }
    /**
     * One-to-Many relation with the invite model

     * @return mixed
    */
    public function invites()
    {
        return $this->hasMany( 'App\Core\TeamInvites', 'team_id', 'id');
    }

    /**
     * belongsToMany relation with the users model
     
     * @return mixed
    */
    public function users(){

    	return $this->belongsToMany('App\User');
    }
    
    /**
     * hasMany relation with the users model
     *
     * @return mixed
    */
    public function channels()
    {
        return $this->hasMany('App\Core\Channel');
    }

    /**
     * a team can have Many files 
     *
     * @return mixed
    */
    public function files()
    {
        return $this->hasMany('App\Core\File','team_id');
    }

    /**
     * Create Channel model
     *
     * @return mixed
    */
    public function createChannel(string $name)
    {
        $channel =  $this->channels()
            ->create(['name' => $name,'user_id'=> auth()->id()]);

        $channel->users()->attach(auth()->user());
        $channel->threads = [];

        return $channel;
    }
}
