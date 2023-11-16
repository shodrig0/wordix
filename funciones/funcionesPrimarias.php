<?php

include_once("wordix.php");
include_once("programaVillablancaAlmeiraGarcia.php");

/* Acá van a ir las funciones primarias
*/

function juegoPalabraElegida($coleccionPalabras, $numeroDePalabra)
{
    echo "Hola hola!! Ingresa tu nombre: ";
    $nombreJugador = trim(fgets(STDIN));

    do {
        echo "Ahora elige un número: ";
        $numeroElegido = trim(fgets(STDIN));
        $cantPalabrasUtilizadas = count($numeroDePalabra);
        $palabraDisponible = false;

        for ($i = 0; $i < $cantPalabrasUtilizadas; $i++) {
            if ($numeroElegido == $numeroDePalabra[$i]) {
                $palabraDisponible = true;
            }
        }
        if ($palabraDisponible) {
            echo "Ups, ese número ya lo utilizaste! Intenta con otro.\n";
        }
    } while ($palabraDisponible);

    $palabraSeleccionada = $coleccionPalabras[$numeroElegido - 1];

    $partida = jugarWordix($palabraSeleccionada, strtolower($nombreJugador));

    return $partida;
}

/* Ahora mismo el juego me retorna una primera letra elegida luego de repetir el bucle, pero no toma el resto de letras.
*/