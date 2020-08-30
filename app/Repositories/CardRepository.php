<?php

namespace App\Repositories;

use App\Models\Card;

class CardRepository extends AbstractRepository
{
    public function __construct(Card $card)
    {
        parent::__construct($card);

        if ($usuario = auth()->user()) {
            parent::setUsuarioLogado('user_id', $usuario->id);
        }
    }

    public function listarCards()
    {
        parent::setCampos([
            'id',
            'card',
            'titulo',
            'status',
            'data_inicio',
            'data_fim',
        ]);

        return parent::paginate();
    }

    public function buscarCardsTrabalhadosNoDia($data)
    {
        parent::setCampos([
            'id',
            'card',
            'titulo',
            'status',
            'data_inicio',
            'data_fim',
        ]);

        return parent::getModel()
            ->where('data_inicio', '<', $data)
            ->where(function ($query) use ($data) {
                $query->whereNull('data_fim')->orWhere('data_fim', '>', $data);
            })->get();
    }
}