<?php

/** Estructura de datos.
 *  Necesaria para los datos precargados.
 */


/** 
 * FUNCIÓN NÚMERO 1
 */

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "BOTAS", "REINA", "TIGRE", "TRONO", "DAMAS"
    ];

    return ($coleccionPalabras);
}


/*
FUNCIÓN NUMERO 2 
*/
/**
 * @param array $coleccionPartidasPrecargadas
 * @param array $cargarPartidasPrecargadas
 * @return int
 */
function cargarPartidas()
{
    $coleccionPartidasPrecargadas[0] = ["palabraWordix" => "QUESO", "jugador" => "majo", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidasPrecargadas[1] = ["palabraWordix" => "TRONO", "jugador" => "shodrig0", "intentos" => 3, "puntaje" => 15];
    $coleccionPartidasPrecargadas[2] = ["palabraWordix" => "BOTAS", "jugador" => "il3l", "intentos" => 4, "puntaje" => 13];
    $coleccionPartidasPrecargadas[3] = ["palabraWordix" => "NAVES", "jugador" => "facuu", "intentos" => 6, "puntaje" => 12];
    $coleccionPartidasPrecargadas[4] = ["palabraWordix" => "HUEVO", "jugador" => "majo", "intentos" => 5, "puntaje" => 9];
    $coleccionPartidasPrecargadas[5] = ["palabraWordix" => "VERDE", "jugador" => "p40oo", "intentos" => 5, "puntaje" => 12];
    $coleccionPartidasPrecargadas[6] = ["palabraWordix" => "YUYOS", "jugador" => "shodrig0", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidasPrecargadas[7] = ["palabraWordix" => "REINA", "jugador" => "albap", "intentos" => 1, "puntaje" => 15];
    $coleccionPartidasPrecargadas[8] = ["palabraWordix" => "YUYOS", "jugador" => "clauu", "intentos" => 1, "puntaje" => 17];
    $coleccionPartidasPrecargadas[9] = ["palabraWordix" => "MUJER", "jugador" => "il3l", "intentos" => 5, "puntaje" => 11];
    $coleccionPartidasPrecargadas[10] = ["palabraWordix" => "TIGRE", "jugador" => "facuu", "intentos" => 2, "puntaje" => 15];
    $coleccionPartidasPrecargadas[11] = ["palabraWordix" => "DAMAS", "jugador" => "p40oo", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidasPrecargadas[12] = ["palabraWordix" => "PIANO", "jugador" => "albap", "intentos" => 5, "puntaje" => 11];
    $coleccionPartidasPrecargadas[13] = ["palabraWordix" => "REINA", "jugador" => "clauu", "intentos" => 2, "puntaje" => 14];
    $coleccionPartidasPrecargadas[14] = ["palabraWordix" => "PISOS", "jugador" => "il3l", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidasPrecargadas[15] = ["palabraWordix" => "REINA", "jugador" => "facuu", "intentos" => 2, "puntaje" => 14];
    $coleccionPartidasPrecargadas[16] = ["palabraWordix" => "TINTO", "jugador" => "ian", "intentos" => 0, "puntaje" => 0];

    return $coleccionPartidasPrecargadas;
}
