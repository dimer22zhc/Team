<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
     protected $fillable=[
    	'title',
    	'content',
    	'url',
    	'description',
    	'typeFile',
    	'file_id',
    ];
}
