<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    protected $fillable = [
        'user_id',
        'card',
        'titulo',
        'status',
        'data_inicio',
        'data_fim',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registroTrabalho()
    {
        return $this->hasMany(RegistroTrabalhoCard::class);
    }
}
