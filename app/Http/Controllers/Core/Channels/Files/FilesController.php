<?php

namespace App\Http\Controllers\Core\Channels\Files;

use Illuminate\Http\Request;
use App\Core\File;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{
    //
    public function file(File $file){
    	return $file->load('owner');
    }

     public function files(Request $request){
    	return $request->user()->currentTeam->files->load('owner');
    }

}
