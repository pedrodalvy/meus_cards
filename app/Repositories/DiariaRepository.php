<?php

namespace App\Repositories;

use App\Models\Diaria;

class DiariaRepository extends AbstractRepository
{
    public function __construct(Diaria $diaria)
    {
        parent::__construct($diaria);
        parent::setUsuarioLogado('user_id', auth()->user()->id);
    }

    public function listarDiarias($mes, $ano)
    {
        parent::setCampos([
            'id',
            'data_diaria',
            'inicio_jornada',
            'fim_jornada',
            'inicio_almoco',
            'fim_almoco',
            'observacoes',
        ]);

        parent::getModel()->whereMonth('data_diaria', $mes);
        parent::getModel()->whereYear('data_diaria', $ano);

        parent::setOrdem([
            'data_diaria' => 'DESC',
            'id'          => 'DESC',
        ]);

        return parent::paginate();
    }
}