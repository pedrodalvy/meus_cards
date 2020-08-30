<?php

namespace App\Observers;

use App\Models\Diaria;

class DiariaObserver
{
    public function creating(Diaria $model) {
        $model->user_id = auth()->user()->id;
    }
}
