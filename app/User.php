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

    public function games() {
        return $this->belongsToMany('App\Game');
    }
    public function acceptedGames() {
        return $this->belongsToMany('App\Game')->wherePivot('status', 'Accepted');
    }
    public function waitingGames() {
        return $this->belongsToMany('App\Game')->wherePivot('status', 'In Progress');
    }
}
