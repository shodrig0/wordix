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
            $nombreUsuario = nombreDelJugador();

            $partida = juegoPalabraElegida($coleccionPalabrasPrecargadas, $coleccionPartidasJugadas, $nombreUsuario);

            $coleccionPartidasJugadas[] = $partida;

            print_r($coleccionPartidasJugadas);

            break;

        case 2:
            $nro = random_int(0, count($coleccionPalabrasPrecargadas));
            $indice = $coleccionPalabrasPrecargadas[$nro];
            $partidaActual = jugarWordix($indice, $nombreUsuario);
            break;
        case 3:
            /* Menu punto 3 */
            
            echo "Ingrese un numero, del cero en adelante, para ver la informacion sobre esa partida: \n";
            $nroIngresado = trim(fgets(STDIN));
            $limiteDelListado=count($partidas);
            $partidas = cargarPartidas();

                // FALTA AGREGAR QUE PASA SI INGRESAN UN NUMERO NEGATIVO 
            while ($nroIngresado > $limiteDelListado) {
                echo "Ese numero de partida no existe, ingrese un numero nuevamente:", "\n";
                $nroIngresado = trim(fgets(STDIN));
            }
            echo "************************************************", "\n";
            echo "Partida WORDIX ", $nroIngresado, ": palabra ", $partidas[$nroIngresado]["palabraWordix"], "\n";
            echo "Jugador: ", $partidas[$nroIngresado]["jugador"], "\n";
            echo "Puntaje: ", $partidas[$nroIngresado]["puntaje"], " puntos", "\n";

            if ($partidas[$nroIngresado]["puntaje"] > 0 && $partidas[$nroIngresado]["intentos"]!==1) {
                echo "Intento: Adivino la palabra en ", $partidas[$nroIngresado]["intentos"], " ", "intentos", "\n";
                echo "************************************************","\n";
            } elseif ($partidas[$nroIngresado]["puntaje"] <= 0) {
                echo "Intento: No adivino la palabra", "\n";
                echo "************************************************","\n";
           // } elseif($partidas[$nroIngresado]["intentos"] === 1) {
           //     echo "Intento: Adivino la palabra en ", $partidas[$nroIngresado]["intentos"], " ", "intento", "\n";
           //     echo "************************************************","\n"; 
                        //INTENTANDO QUE SI EL INTENTO DE ADIVINAR FUE UNO DIGA INTENTO Y NO INTENTOS.. 
            }
            break;

        case 8:

            $juegoPartida = true;
    }
} while (!$juegoPartida);

echo "fin juego, nos vemos pronto!";
