<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroTrabalhoCard extends Model
{
    protected $table = 'registro_trabalho_cards';

    protected $fillable = [
        'card_id',
        'data_inicio',
        'data_fim',
        'descricao',
    ];

    protected $dates = [
        'data_inicio',
        'data_fim',
        'created_at',
        'updated_at',
    ];
}
