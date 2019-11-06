<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class TeamInvite extends Model
{
     //
    protected $fillable =['user_id','type','email','accept_token','deny_token','team_id'];
    protected $table = 'team_invites';

    /**
     * Has-One relations with the team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function team()
    {
        return $this->hasOne( 'App\Core\Team', 'id', 'team_id' );
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->hasOne( 'App\User', 'email', 'email' );
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inviter()
    {
        return $this->hasOne( 'App\User', 'id', 'user_id' );
    }
}
