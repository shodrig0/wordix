<?php

include_once("wordix.php");
include_once("index.php");

/* Acá van a ir las funciones primarias
*/

function juegoPalabraElegida($coleccionPalabras, $numeroDePalabra)
{
    echo "(*＾-＾*)\n";
    echo "Hola hola!! Ingresa tu nombre: ";
    $nombreJugador = trim(fgets(STDIN));

    do {
        echo "Ahora elige un número: ";
        $numeroElegido = trim(fgets(STDIN));
        $cantPalabrasUtilizadas = count($numeroDePalabra);
        $palabraDisponible = false;

        for ($i = 0; $i < $cantPalabrasUtilizadas; $i++) {
            if ($numeroElegido != $numeroDePalabra[$i]) {
                $palabraDisponible = true;
            }
        }

        if (!$palabraDisponible) { //convierto el true a false al negarlo
            echo "(* ￣︿￣)\n";
            echo "Ups, ese número ya lo utilizaste! Intenta con otro.\n";
        }
    } while ($palabraDisponible);

    $palabraSeleccionada = $coleccionPalabras[$numeroElegido];

    $partida = jugarWordix($palabraSeleccionada, strtolower("$nombreJugador"));

    return $partida;
}
