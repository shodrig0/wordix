<?php

include_once("wordix.php");
include_once("programaVillablancaAlmeiraGarcia.php");
include_once("datosPrecargados.php");

/* Acá van a ir las funciones primarias 
CREO QUE SON LAS NECESARIAS QUE FALTAN: 
- calcularPuntos();
- jugarPalabraRandom(); (Lugar donde guardar las palabras random elegidas y palabras prohibidas a usar)
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
    $nombreJugador = "";
    $primeraLetraNombre = "";
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

        echo "hola";
        $palabraDisponible = verificarPalabra($nombreJugador, $coleccionPartidasPrecargadas, $coleccionPalabras, $indice);
        echo $palabraDisponible;
        if ($palabraDisponible) {
            echo "Ups, esa palabra ya fue utilizada!: ";
        }
    } while ($palabraDisponible);

    $partida = jugarWordix($palabraAJugar, $nombreJugador);

    return $partida;
}

/* Ahora mismo el juego me retorna una primera letra elegida luego de repetir el bucle, pero no toma el resto de letras.
*/

function verificarPalabra($nombreJugador, $coleccionPartidasPrecargadas, $coleccionPalabras, $indicePalabra)
{
    $palabraAJugar = false; // Palabra utilizada? No, pues false, indicando que está disponible.
    $iConteo = 0; //Variable iteradora, necesaria para el conteo en el bucle while. Inicializada en 0 para que coincida con el índice del array.
    $cantidadPartidas = count($coleccionPartidasPrecargadas);

    while ($iConteo < $cantidadPartidas && !$palabraAJugar) { //si el numero que coincide en la variable iteradora es igual indice del registro de partidas jugadas, y cumple con la condición de que la palabra no haya sido utilizada, ingresa al bucle.
        if ($nombreJugador == $coleccionPartidasPrecargadas[$iConteo]["jugador"]) {
            if ($coleccionPalabras[$indicePalabra] == $coleccionPartidasPrecargadas[$iConteo]["palabraWordix"]) {
                $palabraAJugar = true;
            }
        }
        $iConteo++; // conteo que se incrementa en cada bucle
    }

    return $palabraAJugar;
}

/**
 * Función necesaria para el menú, opción 4. Validar si el usuario existe.
 */

function verificarNombreDelJugador($nombreJugador, $coleccionPartidasPrecargadas)
{
    $jugadorBuscado = false;
    $iConteo = 0;
    $cantPartidas = count($coleccionPartidasPrecargadas);

    while ($iConteo < $cantPartidas && !$jugadorBuscado) {
        if ($nombreJugador == $coleccionPartidasPrecargadas[$iConteo]["jugador"]) {
            $jugadorBuscado = true;
        } else {
            echo "El nombre que ingresaste no está registrado! Prueba escribiéndolo otra vez\n";
            $nombreJugador = nombreDelJugador();
            $iConteo = 0; // volvemos a inicializar en 0 para que se reinicie el bucle.
        }

        if ($iConteo < $cantPartidas - 1) {
            $iConteo++;
        } else {
            $iConteo = 0; //volvemos a inicializar en 0 en caso de no encontrar el nombre del jugador.
        }
    }

    return $nombreJugador;
}

/**
 * Funcion para contar la cantidad de partidas realizadas de un jugador
 */
function cantidadDePartidas($jugador, $partJugada)
{
    $cantPartidas = 0;
    for ($i = 0; $i < count($partJugada); $i++) {
        $nombreUsuario = $partJugada[$i]["jugador"];
        if ($jugador == $nombreUsuario) {
            $cantPartidas++;
        }
    }
    return $cantPartidas;
}

/**
 * Funcion para contar la cantidad de victorias de un jugador
 */
function victorias($jugador, $partJugada)
{
    $victorias = 0;
    for ($i = 0; $i < count($partJugada); $i++) {
        if ($jugador == $partJugada[$i]["jugador"] && $partJugada[$i]["puntaje"] > 0) {
            $victorias++;
        }
    }
    return $victorias;
}

/**
 * Funcion para calcular el puntaje total de un jugador
 */
function puntajeTotal($jugador, $partJugada)
{
    $puntaje = 0;
    for ($i = 0; $i < count($partJugada); $i++) {
        if ($jugador == $partJugada[$i]["jugador"]) {
            $puntaje = $puntaje + $partJugada[$i]["puntaje"];
        }
    }
    return $puntaje;
}
