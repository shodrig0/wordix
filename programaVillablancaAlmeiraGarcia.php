<?php
include_once("wordix.php");
include_once("datosPrecargados.php");
include_once("./menu/opciones.php");
include_once("./funciones/funcionesPrimarias.php");
// MODULARIZAR MENU


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "BOTAS", "REINA", "TIGRE", "TRONO", "DAMAS"
    ];

    return ($coleccionPalabras);
}

/* ****COMPLETAR***** */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);

$coleccionPalabrasPrecargadas = cargarColeccionPalabras();
$coleccionPartidasJugadas = cargarPartidasPrecargadas();
$palabrasUtilizadas = []; //para hacer un count con foreach y asignale indice

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
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;

            //...
    }
} while ($opcion != 8);
