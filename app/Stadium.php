<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stadiums';
    protected $fillable = [
        'stadium_name', 'pitch_type','is_free', 'latitude', 'longitude'
    ];

    public function games() {
        return $this->hasMany('App\Game');
    }
}
