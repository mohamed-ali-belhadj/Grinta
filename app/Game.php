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

    public function stadium() {
        return $this->belongsTo('App\Stadium');
    }

}
