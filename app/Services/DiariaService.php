<?php

namespace App\Services;

use App\Repositories\CardRepository;
use App\Repositories\DiariaRepository;

class DiariaService
{
    private $diariaRepository;
    private $cardRepository;

    public function __construct(DiariaRepository $diariaRepository, CardRepository $cardRepository)
    {
        $this->diariaRepository = $diariaRepository;
        $this->cardRepository   = $cardRepository;
    }

    public function mostrarRegistrosDoDia($diaria)
    {
        $diaria = $this->diariaRepository->find($diaria)->toArray();
        $cards = $this->cardRepository->buscarCardsTrabalhadosNoDia($diaria['data_diaria']);
        $diaria['cards'] = $cards->toArray();

        return $diaria;
    }
}