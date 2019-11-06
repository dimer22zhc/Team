<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class ThreadArchive extends Model
{
    //
    protected $fillable=['content','user_id','archived_id','create_time','channel_id','type','thread_id'];


    protected $appends=['c_name','owner'];

    public function thread()
    {
    	# code...
    	return $this->belongsTo(Thread::class);
    }
    public function owner(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function channel(){
        return $this->belongsTo('App\Core\Channel','channel_id');
    }
    public function getCNameAttribute(){
      return $this->channel->name;
    }
    public function getOwnerAttribute(){
      return $this->owner()->newQuery()->selectRaw('name,id')->get();
    }
}
