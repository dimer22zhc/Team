<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use Favoritable;
    //
    protected $fillable=['name','user_id','team_id','description','type'];


	/**
     * A channel Belongs to many users/members.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function users(){
        return $this->belongsToMany('App\User');
    }

    /**
     * A channel Belongs to a team .
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function team(){
        return $this->belongsTo('App\Core\Team','team_id');
    }

    /**
     * A channel hasmany threads.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function threads(){
        return $this->hasMany('App\Core\Thread');
    }
}
