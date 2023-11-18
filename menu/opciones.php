<?php

include_once("wordix.php");

// ACÁ SOLO SIRVE PARA IMPRIMIR EL MENÚ, PARA NO MOSTRAR DICHA FUNCIÓN EN EL PROGRAMA PRINCIPAL. LAS FUNCIONES QUE SE CREEN DEBEN HACERSE EN EL ARCHIVO DE funcionesPrimarias.php

/* Opcion 1 */

function imprimirMenu()
{
    $seleccionarOpcion = "\n1) Jugar al Wordix con una palabra elegida:\n2) Jugar al wordix con una palabra aleatoria:\n3) Mostrar una partida:\n4) Mostrar la primer partida ganadora:\n5) Mostrar Estadísticas Jugador:\n6) Mostrar listado de partidas ordenadas por jugador y por palabra:\n7) Agregar una palabra de 5 letras a Wordix:\n8) Salir\n";

    return $seleccionarOpcion;
}

/* Menu punto 3 */
$coleccionPartidasPrecargadas = [];
echo "nro: \n";
$nroIngresado = trim(fgets(STDIN));

while ($nroIngresado > 15) {
    echo "Ese numero no existe, ingrese de nuevo", "\n", "nro://";
    $nroIngresado = trim(fgets(STDIN));
}

$partidas = cargarPartidasPrecargadas();
echo "************************************************", "\n";
echo "Partida WORDIX ", $nroIngresado, ": palabra ", $partidas[$nroIngresado]["palabraWordix"], "\n";
echo "Jugador: ", $partidas[$nroIngresado]["jugador"], "\n";
echo "Puntaje: ", $partidas[$nroIngresado]["puntaje"], " puntos", "\n";

if ($partidas[$nroIngresado]["puntaje"] > 0) {
    echo "Intento: Adivino la palabra en ", $partidas[$nroIngresado]["intentos"], " ", "intentos", "\n";
} elseif ($partidas[$nroIngresado]["puntaje"] <= 0) {
    echo "Intento: No adivino la palabra", "\n", "************************************************", "\n";
}
