<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'games';
    protected $fillable = [
        'stadium_id', 'game_title','description', 'price_per_person', 'date', 'time', 'duration', 'players_number_per_team', 'total_players_number', 'is_weekly', 'is_public', 'is_joinable'
    ];
    protected $appends = ['stadium_name'];

    public function stadium() {
        return $this->belongsTo('App\Stadium');
    }
    public function getStadiumNameAttribute(){
        return $this->stadium->stadium_name;
    }
    public function users() {
        return $this->belongsToMany('App\User');
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public static function boot()
    {
        parent::boot();
        static::deleted(function($game)
        {
            $game->comments()->delete();
            //$game->users()->delete();
        });
    }
}
