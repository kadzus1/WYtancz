<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'organizator',
        'numberPeople',
        'place',
        'fromAge',
        'toAge',
        'user_id',
        'type',
    ];

    public function participants()
    {
        return $this->hasMany(TournamentParticipant::class);
    }

    public function danceStyles()
{
    return $this->belongsToMany(DanceStyle::class, 'dance_style_tournament', 'tournament_id', 'dance_style_id');
}

}
