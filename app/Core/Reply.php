<?php

namespace App\Core;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable;

	protected $fillable = ['user_id','replyTo_type','replyTo_id','body'];

    protected $appends = ['isFavorited'];

    protected $with =['owner'];

    protected $hidden=['user_id','replyTo_type'];
	
    public function replyTo()
    {
        return $this->morphTo();
    }

    public function owner()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function serializeDate(DateTimeInterface $date){
        return $date->format('c');
    }
}
