<?php

namespace App;

use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject , MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','current_team_id','current_channel_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'photo_url'
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=mm';
    }

    /**
     * Get the oauth providers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oauthProviders()
    {
        return $this->hasMany(OAuthProvider::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
     /**
     * A user belongs to a team.
     *
     * @return belongsTo
     */
    public function threads(){
        return $this->hasMany('App\Core\Thread');
    }
    /**
     * A user belongs to a team.
     *
     * @return belongsTo
     */
    public function currentTeam(){
        return $this->belongsTo('App\Core\Team','current_team_id');
    }
    
    /**
     * A user belongsToMany  team.
     *
     * @return belongsToMany
     */
    public function teams(){
        return $this->belongsToMany('App\Core\Team');
    }

    /**
     * A user belongs to a channel.
     *
     * @return belongsTo
     */
    public function currentChannel()
    {
        return $this->belongsTo('App\Core\Channel','current_channel_id');
    }
    /**
     * A user belongs to a channels.
     *
     * @return belongsToMany
     */

    public function channels()
    {
        return $this->belongsToMany('App\Core\Channel'::class)->withTimestamps();
    }

    /**
     * A user hasMany invites.
     *
     * @return belongsToMany
     */

    public function invites()
    {
        return $this->hasMany('App\Core\TeamInvites', 'email', 'email' );
    }
}

