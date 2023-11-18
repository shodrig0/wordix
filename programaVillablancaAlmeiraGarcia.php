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
$coleccionPartidasJugadas = cargarPartidas();
$juegoPartida = false;

//Proceso:

do {
    echo imprimirMenu();
    echo "Ingrese una opción: ";
    $opcion = solicitarNumeroEntre(1, 8);

    switch ($opcion) {

        case 1:
            /*$partida = juegoPalabraElegida($coleccionPalabrasPrecargadas, $palabrasUtilizadas);
            $coleccionPalabrasPrecargadas = $partida;
            $coleccionPalabrasPrecargadas = $partida["palabraWordix"];
            $palabrasUtilizadas[] = $palabrasUtilizadas;
            */
            break;

        case 2:
            $nro = random_int(0, count($coleccionPalabrasPrecargadas));
            $indice = $coleccionPalabrasPrecargadas[$nro];
            $partidaActual = jugarWordix($indice, $nombreJugador);
            break;
        case 3:
            /* Menu punto 3 */
            $coleccionPartidasPrecargadas = [];
            echo "nro: \n";
            $nroIngresado = trim(fgets(STDIN));

            while ($nroIngresado > 15) {
                echo "Ese numero no existe, ingrese de nuevo", "\n", "nro://";
                $nroIngresado = trim(fgets(STDIN));
            }

            $partidas = cargarPartidas();
            echo "************************************************", "\n";
            echo "Partida WORDIX ", $nroIngresado, ": palabra ", $partidas[$nroIngresado]["palabraWordix"], "\n";
            echo "Jugador: ", $partidas[$nroIngresado]["jugador"], "\n";
            echo "Puntaje: ", $partidas[$nroIngresado]["puntaje"], " puntos", "\n";

            if ($partidas[$nroIngresado]["puntaje"] > 0) {
                echo "Intento: Adivino la palabra en ", $partidas[$nroIngresado]["intentos"], " ", "intentos", "\n";
            } elseif ($partidas[$nroIngresado]["puntaje"] <= 0) {
                echo "Intento: No adivino la palabra", "\n", "************************************************", "\n";
            }

            break;

            //...
    }
} while (!$juegoPartida);
