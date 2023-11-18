<?php

include_once("wordix.php");
include_once("programaVillablancaAlmeiraGarcia.php");
include_once("datosPrecargados.php");

/* Acá van a ir las funciones primarias 
CREO QUE SON LAS NECESARIAS QUE FALTAN: 
- calcularPuntos();
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
 * FUNCIÓN 10
 * @param VACIO
 * @return STRING $nombreJugador
 */

function nombreDelJugador()
{
    echo "Hola hola!! Ingresa tu nombre: ";
    echo "El nombre debe comenzar con una letra ^_^";
    do {
        $nombreJugador = trim(fgets(STDIN));

        $primeraLetraNombre = $nombreJugador[0]; // Recorro el string empezando desde 0 (primer caracter) para validar que no sea un número el primer caracter del nombre.

        if (!ctype_alpha($primeraLetraNombre)) { // Función utilizada de wordix.php para verificar que sólo sean letras.
            echo "Hmmm, algo está mal. Recuerda que el nombre debe comenzar con una letra! \(￣︶￣*\)): ";
        }
    } while (!ctype_alpha($primeraLetraNombre));

    $nombreJugador = strtolower($nombreJugador); // Función reutilizada que convierte un string en minusculas. Dada en el ejemplo de jugar wordix en el prog ppal.
    return $nombreJugador;
}

// OPCIÓN 1 MENÚ

function juegoPalabraElegida($coleccionPalabras, $coleccionPartidasPrecargadas, $nombreJugador)
{
    $palabraDisponible = false;
    $cantPalabrasUtilizadas = count($coleccionPalabras);
    echo "Ahora elige un número de 1 hasta $cantPalabrasUtilizadas: ";
    do {
        $numeroElegido = solicitarNumeroEntre(1, $cantPalabrasUtilizadas);
        $indice = $numeroElegido - 1;
        $palabraAJugar = $coleccionPalabras[$indice];
        // FALTA VERIFICAR QUE NO JUEGUE SIEMPRE LA MISMA PALABRA
    } while ($palabraDisponible);

    //$palabraSeleccionada = $coleccionPalabras[$numeroElegido - 1];

    $partida = jugarWordix($coleccionPalabras[$numeroElegido - 1], strtolower($nombreJugador));

    return $partida;
}

/* Ahora mismo el juego me retorna una primera letra elegida luego de repetir el bucle, pero no toma el resto de letras.
*/
