<?php

namespace App\Models;

use App\Observers\DiariaObserver;
use Illuminate\Database\Eloquent\Model;

class Diaria extends Model
{
    protected $table = 'diarias';

    protected $fillable = [
        'user_id',
        'data_diaria',
        'inicio_jornada',
        'inicio_almoco',
        'fim_almoco',
        'fim_jornada',
        'observacoes',
    ];

    protected $dates = [
        'created_at',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();
        parent::observe(new DiariaObserver());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
