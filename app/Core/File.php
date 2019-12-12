<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable=[
    	'title',
    	'content',
    	'url',
    	'description',
    	'typeFile',
    	'thread_id',
    	'team_id',
    	'channel_id',
        'user_id'
    ];

    protected $with = ['post'];

    public function owner(){
        return $this->belongsTo('App\User','user_id');
    }

    public function post(){
        return $this->hasOne('App\Core\Post','file_id');
    }
    
}
