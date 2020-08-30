<?php

namespace App\Repositories;

use App\Models\RegistroTrabalhoCard;

class RegistroTrabalhoCardRepository extends AbstractRepository
{
    public function __construct(RegistroTrabalhoCard $registroTrabalhoCard)
    {
        parent::__construct($registroTrabalhoCard);
    }

    public function buscarHorasRegistradasPorCard($cards)
    {
        parent::setCampos([
            'card_id',
            'data_inicio',
            'data_fim',
        ]);

        parent::getModel()->whereIn('card_id', $cards);

        return parent::getModel()->get();
    }
}