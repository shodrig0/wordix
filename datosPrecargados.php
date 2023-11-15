<?php

/** Estructura de datos.
 *  Necesaria para los datos precargados.
 */

/**
 *  SISTEMA DE PUNTUACIÓN:
 *  POR INTENTOS:
 *  Si el jugador adivina al 1er intento obtendrá 6 puntos;
 *  en el 2do intento, 5;
 *  en el 3er intento, 4; 
 *  en el 4to, obtendrá 3; 
 *  en el 5to intento, 2;
 *  en el 6to, sólo un punto;
 *  Si no adivina dentro de los 6 intentos, obtendrá 0.
 *  POR LETRAS:
 *  Cada vocal vale: 1
 *  Cada consonante, hasta la M (inclusive) vale: 2
 *  Desde la N en adelante, cada consonante vale: 3
 *  RESULTADO FINAL: 
 *  La suma de cada letra, debe sumarse a los puntos obtenidos del intento en el que adivinó el jugador.
 */

function cargarPartidasPrecargadas()
{
    $coleccionPartidasPrecargadas[0] = ["palabraWordix" => "QUESO", "jugador" => "majo", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidasPrecargadas[1] = ["palabraWordix" => "TRONO", "jugador" => "shodrig0", "intentos" => 3, "puntaje" => 15];
    $coleccionPartidasPrecargadas[2] = ["palabraWordix" => "BOTAS", "jugador" => "il3l", "intentos" => 4, "puntaje" => 13];
    $coleccionPartidasPrecargadas[3] = ["palabraWordix" => "NAVES", "jugador" => "facuu", "intentos" => 6, "puntaje" => 12];
    $coleccionPartidasPrecargadas[4] = ["palabraWordix" => "HUEVO", "jugador" => "majo", "intentos" => 5, "puntaje" => 9];
    $coleccionPartidasPrecargadas[5] = ["palabraWordix" => "VERDE", "jugador" => "P40oo", "intentos" => 5, "puntaje" => 12];
    $coleccionPartidasPrecargadas[6] = ["palabraWordix" => "YUYOS", "jugador" => "shodrig0", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidasPrecargadas[7] = ["palabraWordix" => "REINA", "jugador" => "albap", "intentos" => 3, "puntaje" => 13];
    $coleccionPartidasPrecargadas[8] = ["palabraWordix" => "YUYOS", "jugador" => "clauu", "intentos" => 1, "puntaje" => 17];
    $coleccionPartidasPrecargadas[9] = ["palabraWordix" => "MUJER", "jugador" => "il3l", "intentos" => 5, "puntaje" => 11];
    $coleccionPartidasPrecargadas[10] = ["palabraWordix" => "TIGRE", "jugador" => "facuu", "intentos" => 2, "puntaje" => 15];
    $coleccionPartidasPrecargadas[11] = ["palabraWordix" => "DAMAS", "jugador" => "P40oo", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidasPrecargadas[12] = ["palabraWordix" => "PIANO", "jugador" => "albap", "intentos" => 5, "puntaje" => 11];
    $coleccionPartidasPrecargadas[13] = ["palabraWordix" => "REINA", "jugador" => "clauu", "intentos" => 2, "puntaje" => 14];
    $coleccionPartidasPrecargadas[14] = ["palabraWordix" => "PISOS", "jugador" => "il3l", "intentos" => 0, "puntaje" => 0];

    return $coleccionPartidasPrecargadas;
}

$jugadorDatosPrecargados[] = [
    "jugador" => "",
    "partidas" => 0,
    "puntaje" => 0,
    "victorias" => 0,
    "intento1" => 0,
    "intento2" => 0,
    "intento3" => 0,
    "intento4" => 0,
    "intento5" => 0,
    "intento6" => 0
];
