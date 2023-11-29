<?php
include_once("wordix.php");
include_once("datosPrecargados.php");
include_once("./menu/opciones.php");
include_once("./funciones/funcionesPrimarias.php");

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/
/**
 *   Villablanca Rodrigo / Legajo FAI-5097 / email: rodrialvillablanca@gmail.com / Github: shodrig0
 *   Garcia Romero Paola Fernanda / Legajo FAI-4387 / email: paolagarcianqn@gmail.com / Github: PaoGarciaRF
 *   Almeira Ilel Luciana / Legajo FAI4914 / email: ilelalmeira@gmail.com / Github: ilelalmeira
 */
//Declaración de variables:


//Inicialización de variables:

$coleccionPalabrasPrecargadas = cargarColeccionPalabras();
$coleccionPartidasJugadas = cargarPartidas();
$juegoPartida = false;

//Proceso:

do {
    echo imprimirMenu();
    echo "\nIngrese una opción: ";
    $opcion = solicitarNumeroEntre(1, 8);

    switch ($opcion) {

        case 1:
            $nombreUsuario = nombreDelJugador();
            $partida = juegoPalabraElegida($coleccionPalabrasPrecargadas, $coleccionPartidasJugadas, $nombreUsuario);
            $coleccionPartidasJugadas[] = $partida;

            break;

        case 2:
            $nombreUsuario = nombreDelJugador();
            $nro = random_int(0, count($coleccionPalabrasPrecargadas));
            $indice = $coleccionPalabrasPrecargadas[$nro];
            $partidaActual = jugarWordix($indice, $nombreUsuario);
            break;

        case 3:
            $nroIndicePartida = listaIndicePartida($coleccionPartidasJugadas);
            $imprimirPartida = imprimirPartida($coleccionPartidasJugadas, $nroIndicePartida, $nombreUsuario);
            echo $imprimirPartida;
            break;

        case 4:
            $nombreUsuario = nombreRegistrado();
            $nombreUsuario = verificarNombreDelJugador($nombreUsuario, $coleccionPartidasJugadas);
            $partidaGanada = primeraPartidaGanada($nombreUsuario, $coleccionPartidasJugadas); //si hay error, cambiar posicion
            $imprimirPartida = imprimirPartida($coleccionPartidasJugadas, $partidaGanada, $nombreUsuario);
            echo $imprimirPartida;

            break;

        case 5:
            echo "Ingrese el nombre de un jugador", "\n";
            $jugador = trim(fgets(STDIN));
            $mensajeEstadisticas = estadisticasJugador($coleccionPartidasJugadas, $jugador);
            echo $mensajeEstadisticas;
            break;

        case 6:
            $ordenP = ordenPartida($coleccionPartidasJugadas);
            print_r($ordenP);
            break;

        case 7:
            $palabraNueva = leerPalabra5Letras();
            $coleccionPalabrasPrecargadas = agregarPalabra($palabraNueva, $coleccionPalabrasPrecargadas);
            break;

        case 8:
            $juegoPartida = true;
    }
} while (!$juegoPartida);

echo "fin juego, nos vemos pronto!";
