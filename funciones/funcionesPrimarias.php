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

/**
 * Función que solicita el nombre del jugador. FUNCIÓN NECESARIA PARA CARGAR DATOS.
 */

function nombreDelJugador()
{
    echo "Hola hola!! Ingresa tu nombre: ";
    echo "Tu nombre debe comenzar con una letra ^_^";
    do {
        $nombreJugador = trim(fgets(STDIN));

        $primeraLetraNombre = $nombreJugador[0]; // Recorro el string empezando desde 0 (primer caracter) para validar que no sea un número el primer caracter del nombre.

        if (!ctype_alpha($primeraLetraNombre)) { //función utilizada de wordix.php para verificar que sólo sean letras.
            echo "Hmmm, algo está mal. Recuerda que tu nombre debe comenzar con una letra! \(￣︶￣*\)): ";
        }
    } while (!ctype_alpha($primeraLetraNombre));

    $nombreJugador = strtolower($nombreJugador); // función reutilizada, dada en el ejemplo de jugar wordix en el prog ppal.
    return $nombreJugador;
}

/* function juegoPalabraElegida($coleccionPalabras, $numeroDePalabra)
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
*/

/* Ahora mismo el juego me retorna una primera letra elegida luego de repetir el bucle, pero no toma el resto de letras.
*/
