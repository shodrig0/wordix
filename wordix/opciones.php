<?php

include_once("wordix.php");

/* Opcion 1 */

function imprimirMenu()
{
    $seleccionarOpcion = "\n1) Jugar al Wordix con una palabra elegida:\n2) Jugar al wordix con una palabra aleatoria:\n3) Mostrar una partida:\n4) Mostrar la primer partida ganadora:\n5) Mostrar Estadísticas Jugador:\n6) Mostrar listado de partidas ordenadas por jugador y por palabra:\n7) Agregar una palabra de 5 letras a Wordix:\n8) Salir\n";

    return $seleccionarOpcion;
}
