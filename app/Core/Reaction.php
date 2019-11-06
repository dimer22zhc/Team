<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    //
    protected $fillable = ['name','responder_id',];

    public function threads(){

    	return $this->morphByMany('App\Core\Thread','reactable');
    }

    public function user(){

    	return $this->morphByMany('App\Thread','responder');
    }
}
