<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'user_name','email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }
    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }*/
    public function games() {
        return $this->belongsToMany('App\Game')->withPivot('status');
    }
    public function acceptedGames() {
        return $this->belongsToMany('App\Game')->wherePivot('status', 'Accepted');
    }
    public function declinedGames() {
        return $this->belongsToMany('App\Game')->wherePivot('status', 'Declined');
    }
    public function waitingGames() {
        //return $this->belongsToMany('App\Game')->wherePivotIn('status', ['In Progress', 'Declined']);
        return $this->belongsToMany('App\Game')->wherePivot('status', 'In Progress');
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
