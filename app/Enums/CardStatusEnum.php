<?php

namespace App\Enums;

use ReflectionClass;

class CardStatusEnum
{
    const INICIADO = 1;
    const PAUSADO = 2;
    const FINALIZADO = 3;
    const DESATRIBUIDO = 4;

    static function getConstants() {
        $constantes = new ReflectionClass(__CLASS__);
        return array_values($constantes->getConstants());
    }
}