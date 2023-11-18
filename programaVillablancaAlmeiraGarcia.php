<?php
include_once("wordix.php");
include_once("datosPrecargados.php");
include_once("./menu/opciones.php");
include_once("./funciones/funcionesPrimarias.php");
// MODULARIZAR MENU


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:

$coleccionPalabrasPrecargadas = cargarColeccionPalabras();
$coleccionPartidasJugadas = cargarPartidasPrecargadas();

//Proceso:

do {
    echo imprimirMenu();
    echo "Ingrese una opción: ";
    $opcion = trim(fgets(STDIN));
    $juegoPartida = false;
    if ($opcion >= 1 || $opcion <= 8) {
        $juegoPartida = true; // si es una de esas opciones, el juego inicia.
    }
    switch ($opcion) {
        case 1:
            $partida = juegoPalabraElegida($coleccionPalabrasPrecargadas, $palabrasUtilizadas);
            $coleccionPalabrasPrecargadas = $partida;
            $coleccionPalabrasPrecargadas = $partida["palabraWordix"];
            $palabrasUtilizadas[] = $palabrasUtilizadas;

            break;
        case 2:
            $nro = random_int(0, count($coleccionPalabrasPrecargadas));
            $indice = $coleccionPalabrasPrecargadas[$nro];
            $partidaActual = jugarWordix($indice, $nombreUsuario);
            break;
        case 3:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;

            //...
    }
} while ($opcion != 8);
