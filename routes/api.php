<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    /*
    |--------------------------------------------------------------------------
    | Settings API's
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

     /*
    |--------------------------------------------------------------------------
    | *****Teams API's
    |--------------------------------------------------------------------------
    |*/

    Route::post('user/team', 'Core\Team\TeamController@store');
    Route::get('members/{team}', 'Core\Team\TeamController@members');
    Route::get('user/teams', 'Core\Team\TeamController@index');
    Route::get('user/team/{team}', 'Core\Team\TeamController@show');
    Route::patch('user/switch/{team}', 'Core\Team\TeamController@switchTeam');

    /*
    *End of- Workplace API's---------------------------------------------------
    */

     /*
    |--------------------------------------------------------------------------
    | *****Channels API's
    |--------------------------------------------------------------------------
    |*/

    Route::get('user/{team}/channels', 'Core\Channels\ChannelsController@index');  
    Route::get('channel/threads/{channel}', 'Core\Channels\ChannelsController@threads');
    Route::post('channel/create', 'Core\Channels\ChannelsController@store');
    Route::post('favorite-channel/{channel}', 'Core\Favorites\FavoritesController@favChannel');
    Route::delete('favorite-channel/{channel}', 'Core\Favorites\FavoritesController@unfavChannel'); 
    /*

     /*
    |--------------------------------------------------------------------------
    | *****Threads API's
    |--------------------------------------------------------------------------
    |*/

    Route::post('thread/{channel}', 'Core\Channels\Threads\ThreadsController@store');
    Route::patch('thread/update/{thread}', 'Core\Channels\Threads\ThreadsController@update');
    Route::delete('thread/delete/{thread}', 'Core\Channels\Threads\ThreadsController@delete');
    
    Route::post('favorite/{thread}', 'Core\Favorites\FavoritesController@favThread');
    Route::delete('favorite/{thread}', 'Core\Favorites\FavoritesController@unfavThread');  

    Route::post('sub/{thread}',
        'Core\Channels\Threads\Subscriptions\SubscriptionsController@store');
    Route::delete('sub/{thread}',
        'Core\Channels\Threads\Subscriptions\SubscriptionsController@destroy');

    Route::post('react/{thread}', 
        'Core\Channels\Threads\Reactions\ReactionsController@reactTo');

    Route::get('thread/{thread}', 
        'Core\Channels\Threads\ThreadsController@thread'); 
    
    Route::get('threads', 
        'Core\Channels\Threads\ThreadsController@getUserFavoriteThreads');
        /*
        |--------------------------------------------------------------------------
        | *****Threads API's
        |--------------------------------------------------------------------------
        |*/
        Route::post('reply/{thread}', 
            'Core\Channels\Threads\Replies\RepliesController@store');
        Route::post('favorite-reply/{reply}', 'Core\Favorites\FavoritesController@favReply');
        Route::delete('favorite-reply/{reply}', 'Core\Favorites\FavoritesController@unfavReply'); 
        Route::delete('reply/{reply}', 'Core\Channels\Threads\Replies\RepliesController@destroy'); 
    /*
    *End of- Threads API's---------------------------------------------------
    */

     Route::post('invite/{team}', 'Core\Invites\TeamInvitesController@invite');
     Route::get('auth/invite/accept/{token}', 'Core\Invites\TeamInvitesController@acceptInvite')->name('teams.accept_invite');

});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::patch('save/password', 'Settings\PasswordController@update');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');

    Route::get('invite/accept/{token}', 'Core\Invites\TeamInvitesController@acceptInvite')->name('teams.accept_invite');
});
