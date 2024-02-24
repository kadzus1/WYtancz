<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentResult extends Model
{
    use HasFactory;
    /**
     *
     * @var array
     */
    protected $fillable = [
        'tournament_id', 'participant_id', 'user_id', 'style_id', 'points'
    ];

    /**
     * Zwraca turniej związany z wynikiem.
     */
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    /**
     * Zwraca uczestnika związany z wynikiem.
     */
    public function participant()
    {
        return $this->belongsTo(TournamentParticipant::class);
    }

    /**
     * Zwraca użytkownika, który wprowadził wynik.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Zwraca styl tańca związany z wynikiem.
     */
    public function style()
    {
        return $this->belongsTo(DanceStyle::class);
    }
}

