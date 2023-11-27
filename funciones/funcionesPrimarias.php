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
    echo "Veo que has decidido jugar! Entonces ingresa tu nombre: " . "\n";
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

/**
 * FUNCIÓN 4 O 7 YA NO SÉ ME PERDÍ
 * Cambio de lógica
 */

function agregarPalabra($palabraNueva, $coleccionPalabrasP)
{
    $palabraExistente = false; //cambio de true a false
    $iConteo = 0;
    $cantPalabrasExistentes = count($coleccionPalabrasP);

    while ($cantPalabrasExistentes > $iConteo && !$palabraExistente) {

        if ($coleccionPalabrasP[$iConteo] == $palabraNueva) { // NO ES CON EL COUNT DEL ARRAY 
            $palabraExistente = true;
        }
        $iConteo++;
    }

    if (!$palabraExistente) {
        $coleccionPalabrasP[] = $palabraNueva;
    } else {
        echo "La palabra ya se encuentra en la colección :(\nIntenta con otra!\n";
    }

    return $coleccionPalabrasP;
}

// OPCIÓN 1 MENÚ

function juegoPalabraElegida($coleccionPalabras, $coleccionPartidasPrecargadas, $nombreJugador)
{
    $palabraDisponible = false; // nombre dudoso pero sería determinar que la palabra está válida para jugar
    $cantPalabrasUtilizadas = count($coleccionPalabras);
    echo "Ahora elige un número de 1 hasta $cantPalabrasUtilizadas: ";
    do {
        $numeroElegido = solicitarNumeroEntre(1, $cantPalabrasUtilizadas); //función reutilizada de wordix.php
        $indice = $numeroElegido - 1;
        $palabraAJugar = $coleccionPalabras[$indice];

        $palabraDisponible = verificarPalabra($nombreJugador, $coleccionPartidasPrecargadas, $coleccionPalabras, $indice);
        echo $palabraDisponible;
        if ($palabraDisponible) {
            echo "Ups, esa palabra ya fue utilizada!: ";
        }
    } while ($palabraDisponible);

    $partida = jugarWordix($palabraAJugar, $nombreJugador); //función de wordix reutilizada

    return $partida;
}


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

    do {
        $cantPartidas = count($coleccionPartidasPrecargadas); //VARIABLE USADA PARA WHILE DE SER POSIBLE

        for ($i = 0; $i < $cantPartidas && !$jugadorBuscado; $i++) {

            if ($nombreJugador == $coleccionPartidasPrecargadas[$i]["jugador"]) {
                $jugadorBuscado = true;
            }
        }

        if (!$jugadorBuscado) {
            echo "El nombre ingresaste no está registrado! Prueba escribiéndolo otra vez :) \n";
            $nombreJugador = trim(fgets(STDIN));
        }
    } while (!$jugadorBuscado);

    return $nombreJugador;

    //$iConteo = 0; VARIABLE USADA PARA WHILE

    /**while ($iConteo < $cantPartidas && !$jugadorBuscado) {
         if ($nombreJugador == $coleccionPartidasPrecargadas[$iConteo]["jugador"]) {
             $jugadorBuscado = true;
         } else {
             echo "El nombre que ingresaste no está registrado! Prueba escribiéndolo otra vez\n";
             $nombreJugador = nombreDelJugador();
         }
         $iConteo++; // incremeta su valor mediante el bucle
     }
 
     return $nombreJugador;
     */
    // SEGUIR PROBANDO CON WHILE, TAL VEZ SEA MEJOR QUE RECORRER TODO EL ARRAY. SIN FIXEAR
}

/**
 * Función necesaria para el menú 4.
 */
function primeraPartidaGanada($nombreJugador, $coleccionPartidasP) //cambiar despues nombre segundo param
{
    $victoria = false;
    $contPrimeraPartidaGanada = 0;
    $cantPartidas = count($coleccionPartidasP);

    while ($contPrimeraPartidaGanada < $cantPartidas && !$victoria) { // bucle para ingresar al array y hacer recorrido parcial hasta que coincidan las condiciones
        if ($nombreJugador == $coleccionPartidasP[$contPrimeraPartidaGanada]["jugador"] && $coleccionPartidasP[$contPrimeraPartidaGanada]["puntaje"] > 0) {
            $victoria = true; // si el nombre del jugador existe, verificado con la función verificarNombreDelJugador, al momento de que la variable $victoria pase a true, sale del bucle.
        } else {
            $contPrimeraPartidaGanada++; // se incrementa en cada bucle. SINO ARROJA CUALQUIER RESULTADO. PROBAR
        }
    }

    if (!$victoria) {
        $contPrimeraPartidaGanada = -1;
    }

    return $contPrimeraPartidaGanada; // retorna el indice del array, utilizado para después mostrarlo en pantalla con la otra función
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

/**
 * @param array $coleccionPartidasPrecargadas
 * @return 
 * 
 */

function listaIndicePartida($coleccionPartidasPrecargadas)
{
    $limiteDelListado = count($coleccionPartidasPrecargadas);
    echo "\nIngrese un numero, entre 0 y ", $limiteDelListado, ", para conocer la informacion sobre esa partida: ", "\n";
    $indicePartidaSolicitada = solicitarNumeroEntre(1, $limiteDelListado); //función de wordix.php reutilizada
    $indicePartidaSolicitada -= 1; // el array siempre comienza desde 0, por lo que a la variable hay que restarle 1 para que coincida
    return $indicePartidaSolicitada;
}

/**
 * busqueda y presentacion de inforacion sobre una partida
 * @param array $coleccionPartidasPrecargadas
 * @param int $valorIndicePartida
 * @param return 
 * 
 */

function imprimirPartida($coleccionPartidasPrecargadas, $valorIndicePartida)
{
    //if numero == UN ALGO que retorne el modulo 4
    //strig $jugador, $palabra, $puntaje, $intentos, $aviso, $valorRealIndice
    $valorRealIndice = $valorIndicePartida + 1; //El array cuenta desde 0, por ende hay que sumarle un 1 para que coincida el indice real, con el indice a mostrar.
    $palabraWordix = $coleccionPartidasPrecargadas[$valorIndicePartida]["palabraWordix"];
    $jugadorRegistrado = $coleccionPartidasPrecargadas[$valorIndicePartida]["jugador"];
    $puntaje = $coleccionPartidasPrecargadas[$valorIndicePartida]["puntaje"];
    $intentos = $coleccionPartidasPrecargadas[$valorIndicePartida]["intentos"];

    if ($puntaje > 0) {
        $aviso = "Adivinó la palabra en " . $intentos . " intento/s";
    } else {
        $aviso = "No adivinó la palabra";
    }

    $partidaMostrada =
        "\n****************************************************
    Partida WORDIX $valorRealIndice: palabra $palabraWordix
    Jugador: $jugadorRegistrado
    Puntaje: $puntaje 
    Intentos: $aviso 
****************************************************\n";

    return $partidaMostrada;
}