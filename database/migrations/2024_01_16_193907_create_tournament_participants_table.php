<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentParticipantsTable extends Migration
{
    public function up(): void
    {
        Schema::create('tournament_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Klucz obcy do użytkownika
            $table->foreignId('tournament_id')->constrained()->onDelete('cascade'); // Klucz obcy do turnieju
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null');

            $table->text('p_name');
            $table->text('p_surname');
            $table->date('birthDate');
            $table->integer('age');
            $table->text('town');
            $table->text('country');
            $table->text('organizator')->nullable();
            $table->text('teacherName')->nullable();
            $table->text('teacherSurname')->nullable();
            $table->integer('teacherPhoneNumber')->nullable();
            $table->timestamps();
        });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::dropIfExists('tournament_participants');
}
}
