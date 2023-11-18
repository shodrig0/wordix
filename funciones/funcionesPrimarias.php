<?php

include_once("wordix.php");
include_once("programaVillablancaAlmeiraGarcia.php");

/* Acá van a ir las funciones primarias 
Acá van a ir las funciones primarias
CREO QUE SON LAS NECESARIAS QUE FALTAN: 
- calcularPuntos();
- cargarPartidasPrecargadas();
- jugarPalabraRandom();
- buscarPartidaPrecargada();
- primeraPartidaGanada();
- jugadorEstadisticas();
- comparacionDeValores();
- partidasOrdenadasLista();
- ordenAlfabeticoPorJugador() y otra ordenAlfabeticoPorPalabra()???;
- AGREGAR MÁS SEGÚN LAS NECESIDADES
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

    //$palabraSeleccionada = $coleccionPalabras[$numeroElegido - 1];

    $partida = jugarWordix($coleccionPalabras[$numeroElegido - 1], strtolower($nombreJugador));

    return $partida;
}

/* Ahora mismo el juego me retorna una primera letra elegida luego de repetir el bucle, pero no toma el resto de letras.
*/

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
