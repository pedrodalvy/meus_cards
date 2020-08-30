<?php

namespace App\Services;

use App\Repositories\RegistroTrabalhoCardRepository;
use App\Repositories\CardRepository;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Arr;

class CardService
{
    private $cardRepository;
    private $registroTrabalhoCard;

    public function __construct(CardRepository $cardRepository, RegistroTrabalhoCardRepository $registroTrabalhoCard)
    {
        $this->cardRepository       = $cardRepository;
        $this->registroTrabalhoCard = $registroTrabalhoCard;
    }

    public function listarCards()
    {
        $cards   = $this->cardRepository->listarCards();
        $idCards = $cards->pluck('id')->all();

        $registros = $this->registroTrabalhoCard->buscarHorasRegistradasPorCard($idCards)->toArray();

        foreach ($cards as $card) {
            $tempoRegistrado = $this->somarMinutosRegistrados($registros, $card->id);

            $card->tempo_registrado    = $this->formatarTempoRegistrado($tempoRegistrado);
            $card->minutos_registrados = $tempoRegistrado;
        }

        return $cards;
    }

    protected function somarMinutosRegistrados($registros, $card)
    {
        $registrosDoCard = Arr::where($registros, function ($value) use ($card) {
            return $value['card_id'] == $card;
        });

        $tempoRegistrado = 0;
        $horaAtual = Carbon::now(env('TIME_ZONE'))->format('Y-m-d H:i:s');

        foreach ($registrosDoCard as $registro) {
            $horaInicial = Carbon::parse('2020-08-30T15:28:00');
            $horaFinal   = Carbon::parse($registro['data_fim'] ?? $horaAtual);

            $tempoRegistrado += $horaFinal->diffInMinutes($horaInicial);
        }

        return $tempoRegistrado;
    }

    protected function formatarTempoRegistrado($minutos)
    {
        $horas = floor($minutos / 60);

        if ($horas == 1) {
            $minutos = floor($minutos % 60);
        } elseif ($horas > 1) {
            $minutos = floor($minutos % $horas);
        }

        $horas   = $horas > 9 ? $horas : "0" . $horas;
        $minutos = $minutos > 9 ? $minutos : "0" . $minutos;

        return "{$horas}h {$minutos}m";
    }
}