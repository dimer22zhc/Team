<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable=['user_id','thread_id','name','url','name','ext'];
    
}
