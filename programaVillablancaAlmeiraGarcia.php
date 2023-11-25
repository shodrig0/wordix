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
            //print_r($coleccionPartidasJugadas);
            break;

        case 2:
            $nro = random_int(0, count($coleccionPalabrasPrecargadas));
            $indice = $coleccionPalabrasPrecargadas[$nro];
            $partidaActual = jugarWordix($indice, $nombreUsuario);
            break;

        case 3:
            /* Menu punto 3 */
            
            //invocacion de funciones
            $partidasDeWordix = cargarPartidas();
            $conteoDeListado = count($partidasDeWordix);
            //comienzo del menu 3 
            echo "Ingrese un numero, del 0 al ", $conteoDeListado, ", para ver la informacion sobre esa partida: \n";
            $nroIngListado = trim(fgets(STDIN));
            $retornoLista = mostrarPartida($nroIngListado, $conteoDeListado, $partidasDeWordix);

            break;

        case 4:
            $nombreUsuario = nombreDelJugador();
            $nombreUsuario = verificarNombreDelJugador($nombreUsuario, $coleccionPartidasJugadas);


        case 5:
            echo "Ingrese el nombre de un jugador", "\n";
            $jugador = trim(fgets(STDIN));
            $partidasJugadas = cantidadDePartidas($jugador, $coleccionPartidasJugadas);
            $partGanadas = victorias($jugador, $coleccionPartidasJugadas);
            $porcentaje = ($partGanadas / $partidasJugadas) * 100;
            $puntajeFinal = puntajeTotal($jugador, $coleccionPartidasJugadas);

            break;

            echo $partidasJugadas;

        case 6:

            // orden alfabetico de las palabras de la coleccion que se encuentra en datosPrecargados.php
            $ordenAlfabeticoDePalabras = cargarColeccionPalabras();
            uasort($var, 'strnatcmp');
            print_r($var);
            // orden alfabetico por jugador, usando el lista de datosPrecargados.php
            $ordenPorJugador = cargarPartidas();
            for ($indice = 0; $indice < count($var); $indice++) {
                $nombre = ($var[$indice]["jugador"]) . "\n";
                //uasort($var,"strcasecm");//me falta la organizacion alfabetica
                print_r($nombre);
            }

            break;
        case 7:
            // PUNTO 7 DEL MENU 

            $invocaPalabra = leerPalabra5Letras();
            echo $invocaPalabra;

            break;


        case 8:

            $juegoPartida = true;
    }
} while (!$juegoPartida);

echo "fin juego, nos vemos pronto!";
