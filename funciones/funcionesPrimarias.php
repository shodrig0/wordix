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
    echo "Hola hola!! Ingresa tu nombre: " . "\n";
    echo "El nombre debe comenzar con una letra ^_^" . "\n";
    do {
        $nombreUsuario = trim(fgets(STDIN));

        $primeraLetraNombre = $nombreUsuario[0]; // Recorro el string empezando desde 0 (primer caracter) para validar que no sea un número el primer caracter del nombre.

        if (!ctype_alpha($primeraLetraNombre)) { // Función utilizada de wordix.php para verificar que sólo sean letras.
            echo "Hmmm, algo está mal. Recuerda que el nombre debe comenzar con una letra! \(￣︶￣*\)): ";
        }
    } while (!ctype_alpha($primeraLetraNombre));

    $nombreUsuario = strtolower($nombreUsuario); // Función reutilizada que convierte un string en minusculas. Dada en el ejemplo de jugar wordix en el prog ppal.
    return $nombreUsuario;
}

// OPCIÓN 1 MENÚ

function juegoPalabraElegida($coleccionPalabras, $coleccionPartidasPrecargadas, $nombreUsuario)
{
    $palabraDisponible = false;
    $cantPalabrasUtilizadas = count($coleccionPalabras);
    echo "Ahora elige un número de 1 hasta $cantPalabrasUtilizadas: ";
    do {
        $numeroElegido = solicitarNumeroEntre(1, $cantPalabrasUtilizadas);
        $indice = $numeroElegido - 1;
        $palabraAJugar = $coleccionPalabras[$indice];

        $palabraDisponible = verificarPalabra($nombreUsuario, $coleccionPartidasPrecargadas, $coleccionPalabras, $indice);
        if ($palabraDisponible) {
            echo "Ups, esa palabra ya fue utilizada!";
        }
    } while ($palabraDisponible);

    //$palabraSeleccionada = $coleccionPalabras[$numeroElegido - 1];

    //$partida = jugarWordix($palabraSeleccionada, strtolower($nombreJugador));

    return $palabraAJugar;
}

/* Ahora mismo el juego me retorna una primera letra elegida luego de repetir el bucle, pero no toma el resto de letras.
*/

function verificarPalabra($nombreJugador, $coleccionPartidasPrecargadas, $coleccionPalabras, $indicePalabra)
{
    $palabraAJugar = false;
    $conteo = 0;
    $cantidadPartidas = count($coleccionPartidasPrecargadas);
    while ($conteo < $cantidadPartidas && !$palabraAJugar) {
        if ($nombreJugador == $coleccionPartidasPrecargadas[$conteo]["jugador"]) {
            if ($coleccionPalabras[$indicePalabra] == $coleccionPartidasPrecargadas[$conteo]["palabraWordix"]) {
                $palabraAJugar = true;
            }
        }
        $conteo += 1;
    }
    return $palabraAJugar;
}
