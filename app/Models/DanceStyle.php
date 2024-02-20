<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanceStyle extends Model
{
    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'dance_style_tournament');
    }

    public function participants()
    {
        return $this->hasMany(TournamentParticipant::class);
    }
}
