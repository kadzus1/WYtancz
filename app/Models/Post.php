<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Atrybuty, które można przypisać masowo.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id', 'image'
    ];

    /**
     * Atrybuty, które powinny być rzutowane na typy danych.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Zwraca użytkownika, który utworzył ten post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
