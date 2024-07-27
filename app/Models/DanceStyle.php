<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanceStyle extends Model
{
    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'dance_style_tournament', 'dance_style_id', 'tournament_id');
    }

    public function participants()
    {
        return $this->hasMany(TournamentParticipant::class);
    }
}
