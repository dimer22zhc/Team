<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        $user = User::where('email',$request->email)->update([
            'password' => bcrypt($request->password),
        ]);
    }
}
