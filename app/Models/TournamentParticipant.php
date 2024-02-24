<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_id',
        'user_id',
        'tournament_id',
        'p_name',
        'p_surname',
        'birthDate',
        'age',
        'town',
        'country',
        'organizator',
        'teacherName',
        'teacherSurname',
        'teacherPhoneNumber',
        'dance_style_id',


    ];
    

    // Relacja do użytkownika
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacja do turnieju
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

     // Relacja do wyników turnieju
     public function results()
     {
         return $this->hasMany(TournamentResult::class, 'participant_id');
     }
}
