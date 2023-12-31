<?php

include_once("wordix.php");
include_once("programaVillablancaAlmeiraGarcia.php");
include_once("datosPrecargados.php");


/**
 * Función que solicita el nombre del jugador. FUNCIÓN NECESARIA PARA CARGAR DATOS. 
 * FUNCIÓN 10
 * @return string
 */

function nombreDelJugador()
{
//string $nombreJugador, $primeraLetraNombre
    echo "Veo que has decidido jugar! Entonces ingresa tu nombre: " . "\n";
    echo "El nombre debe comenzar con una letra ^_^" . "\n";
    $nombreJugador = "";
    $primeraLetraNombre = "";
    do {
        $nombreJugador = trim(fgets(STDIN));

        $primeraLetraNombre = $nombreJugador[0]; // Recorro el string empezando desde 0 (primer caracter) para validar que no sea un número el primer caracter del nombre.

        if (!ctype_alpha($primeraLetraNombre)) { // Función utilizada de wordix.php para verificar que sólo sean letras.
            echo "Hmmm, algo está mal. Recuerda que el nombre debe comenzar con una letra! \(￣︶￣*\)):\n";
        }
    } while (!ctype_alpha($primeraLetraNombre));

    $nombreJugador = strtolower($nombreJugador); // Función reutilizada que convierte un string en minusculas. Dada en el ejemplo de jugar wordix en el prog ppal.
    return $nombreJugador;
}

/**
 * Funcion para ingresar el nombre del case 4
 * @return string
 */
function nombreRegistrado()
{
    echo "Quieres saber sobre un jugador? Ingresa su nombre:\n";
    $nombreJugador = trim(fgets(STDIN));
    $nombreJugador = strtolower($nombreJugador); // Función reutilizada que convierte un string en minusculas. Dada en el ejemplo de jugar wordix en el prog ppal.
    return $nombreJugador;
}

/**
 * Función que agrega una palabra a la colección palabras para jugar
 * @param string $palabraNueva
 * @param array $coleccionPalabrasP
 * @return array 
 */

function agregarPalabra($palabraNueva, $coleccionPalabrasP)
{
//boolean $palabraExistente
//int $iConteo, $cantPalabrasExistentes
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
        echo "Listo! Tu palabra fue agregada a la colección :)";
    } else {
        echo "La palabra ya se encuentra en la colección :(\nIntenta con otra!\n";
    }

    return $coleccionPalabrasP;
}

/**
 * Funcion para verificar si una palabra ya fue utilizada para jugar
 * @param array $coleccionPalabras, $coleccionPartidasPrecargadas
 * @param string $nombreJugador
 * @return boolean
 */

function juegoPalabraElegida($coleccionPalabras, $coleccionPartidasPrecargadas, $nombreJugador)
{
//boolean $palabraDisponible
//array $palabraAJugar, $palabraDisponible, $partida
//int $indice, $numeroElegido, $cantPalabrasUtilizadas
    $palabraDisponible = false; // nombre dudoso pero sería determinar que la palabra está válida para jugar
    $cantPalabrasUtilizadas = count($coleccionPalabras);
    echo "Ahora elige un número de 1 hasta $cantPalabrasUtilizadas:\n";
    do {
        $numeroElegido = solicitarNumeroEntre(1, $cantPalabrasUtilizadas); //función reutilizada de wordix.php
        $indice = $numeroElegido - 1;
        $palabraAJugar = $coleccionPalabras[$indice];

        $palabraDisponible = verificarPalabra($nombreJugador, $coleccionPartidasPrecargadas, $coleccionPalabras, $indice);
        echo $palabraDisponible;
        if ($palabraDisponible) {
            echo "\nUps, esa palabra ya fue utilizada!:\n";
        }
    } while ($palabraDisponible);

    $partida = jugarWordix($palabraAJugar, $nombreJugador); //función de wordix reutilizada

    return $partida;
}

/**
 * Funcion para verificar si la palabra fue utilizada
 * @param string $nombreJugador
 * @param array $coleccionPartidasPrecargadas, $coleccionPalabras
 * @return boolean
 */
function verificarPalabra($nombreJugador, $coleccionPartidasPrecargadas, $coleccionPalabras, $indicePalabra)
{
//boolean $palabraAJugar
//int $iConteo, $cantidadPartidas
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
 * Funcion para verificar el nombre del jugador 
 * @param string $nombreJugador
 * @param array $coleccionPartidasPrecargadas
 * @return string
 */
function verificarNombreDelJugador($nombreJugador, $coleccionPartidasPrecargadas)
{
    $jugadorBuscado = false;
    $resultadoBusqueda = ""; //Dependiendo la condición al final del bucle se asignará al nombre jugador
    $iConteo = 0;
    $cantPartidas = count($coleccionPartidasPrecargadas);

    while ($iConteo < $cantPartidas && !$jugadorBuscado) {
        if ($nombreJugador == $coleccionPartidasPrecargadas[$iConteo]["jugador"]) {
            $jugadorBuscado = true;
        }
        $iConteo++; // incremeta su valor mediante el bucle
    }

    if ($jugadorBuscado) {
        $resultadoBusqueda = $nombreJugador;
    }

    return $resultadoBusqueda;
}

/**
 * Función necesaria para el menú 4.
 * Funcion que muestra la primer partida ganada
 * @param string $nombreJugador
 * @param array $coleccionPartidasP
 * @return int
 */
function primeraPartidaGanada($nombreJugador, $coleccionPartidasP) //cambiar despues nombre segundo param
{
//boolean $victoria
//int $contPrimeraPartidaGanada, $cantPartidas
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
 * Funcion para obtener la informacion de una partida
 * @param array $coleccionPartidasPrecargadas
 * @return array 
 * 
 */
function listaIndicePartida($coleccionPartidasPrecargadas)
{
//int $limiteDeListado, $indicePartidaSolicitada
    $limiteDelListado = count($coleccionPartidasPrecargadas);
    echo "\nIngrese un número, entre 1 y " . $limiteDelListado . ", para conocer la información sobre esa partida: " . "\n";
    $indicePartidaSolicitada = solicitarNumeroEntre(1, $limiteDelListado); //función de wordix.php reutilizada
    $indicePartidaSolicitada -= 1; // el array siempre comienza desde 0, por lo que a la variable hay que restarle 1 para que coincida
    return $indicePartidaSolicitada;
}

/**
 * Funcion para indicar cuando un jugador no gano ninguna partida
 * @param array $coleccionPartidasPrecargadas
 * @param string $nombreJugador
 * @return string
 */
function partidaNoGanada($coleccionPartidasPrecargadas, $nombreJugador)
{
    $jugadorRegistrado = verificarNombreDelJugador($nombreJugador, $coleccionPartidasPrecargadas);
    if ($jugadorRegistrado) {
        $mensaje = "El jugador $jugadorRegistrado no ganó ninguna partida! :(\n";
    } else {
        $mensaje = "\nHmmm, parece que este jugador no tiene registros! :/\n";
    }
    return $mensaje;
}

/**
 * busqueda y presentacion de informacion sobre una partida
 * @param array $coleccionPartidasPrecargadas
 * @param int $valorIndicePartida
 * @return string 
 * 
 */

function imprimirPartida($coleccionPartidasPrecargadas, $valorIndicePartida, $nombreJugador)
{
//string $mensaje, $aviso
//int $valorRealIndice
//arrayb $palabraWordix, $jugadorRegistrado, $puntaje, $intentos
    $mensaje = "";

    if ($valorIndicePartida == -1) {
        $mensaje = partidaNoGanada($coleccionPartidasPrecargadas, $nombreJugador);
    } else {
        $valorRealIndice = $valorIndicePartida + 1;
        $palabraWordix = $coleccionPartidasPrecargadas[$valorIndicePartida]["palabraWordix"];
        $jugadorRegistrado = $coleccionPartidasPrecargadas[$valorIndicePartida]["jugador"];
        $puntaje = $coleccionPartidasPrecargadas[$valorIndicePartida]["puntaje"];
        $intentos = $coleccionPartidasPrecargadas[$valorIndicePartida]["intentos"];

        $aviso = "";

        if ($puntaje > 0) {
            $aviso = "Adivinó la palabra en " . $intentos . " intento/s";
        } else {
            $aviso = "No adivinó la palabra";
        }

        $mensaje =         "**************************************************************\n   
         Partida WORDIX $valorRealIndice: palabra $palabraWordix \n          
         Jugador: $jugadorRegistrado \n
         Puntaje: $puntaje \n
         Intentos: $aviso \n
         \n**************************************************************";
    }

    return $mensaje;
}

/**
 * Función para obtener las estadísticas del jugador
 * @param array $coleccionPartidas
 * @param string $jugador
 * @return string
 */
function estadisticasJugador($coleccionPartidas, $jugador)
{
    $mensaje = "";
    $jugadorEnColeccion = false;
    $partidasJugadas = 0;
    $victorias = 0;
    $puntajeTotal = 0;
    $intentosAdivinados = [ //array vacío de intentos
        "intento1" => 0,
        "intento2" => 0,
        "intento3" => 0,
        "intento4" => 0,
        "intento5" => 0,
        "intento6" => 0
    ];

    for ($i = 0; $i < count($coleccionPartidas); $i++) {
        $partida = $coleccionPartidas[$i];

        if ($partida["jugador"] == $jugador) {
            $jugadorEnColeccion = true;
            $partidasJugadas++;

            if ($partida["puntaje"] > 0) {
                $victorias++;
            }

            $puntajeTotal += $partida["puntaje"];

            $intentos = $partida["intentos"];
            if ($intentos >= 1) {
                $intentosAdivinados["intento" . $intentos]++; //concatenamos la clave "intento" con la posición en la que se encuentra en el recorrido.
            }
        }
    }

    if ($jugadorEnColeccion) {
        $mensaje .= "\nEstadísticas del jugador:\n";
        $mensaje .= "Nombre Jugador: $jugador\n";
        $mensaje .= "Partidas jugadas: $partidasJugadas\n";
        $mensaje .= "Victorias: $victorias\n";
        $mensaje .= "Porcentaje: ";
        if ($partidasJugadas > 0) {
            $porcentaje = ($victorias / $partidasJugadas) * 100;
            $mensaje .= "$porcentaje %\n";
        } else {
            $mensaje .= "0%\n";
        }

        $mensaje .= "Puntaje total: $puntajeTotal\n";
        $mensaje .= "Intentos adivinados:\n";

        foreach ($intentosAdivinados as $intentos => $cantidad) {
            $mensaje .= "$intentos: $cantidad\n";
        }
    } else {
        $mensaje .= "\nEse jugador no existe!\n";
    }

    return $mensaje;
}

/**
 * Funcion para ordenar las palabras
 * @param array $patidaUno, $partidaDos
 * @return int
 */
function ordenLista($partidaUno, $partidaDos)
{
//array $compPalabra
    //strcmp() sirve para comparar cadena de caracteres
    $compPalabra = strcmp($partidaUno["jugador"], $partidaDos["jugador"]);
    if ($compPalabra == 0) {
        $compPalabra = strcmp($partidaUno["palabraWordix"], $partidaDos["palabraWordix"]);
    }
    return $compPalabra;
}

/**
 * Funcion para mostrar las partidas en orden alfabetico
 * @param array $coleccionPartidasP
 * @return array
 */
function ordenPartida($coleccionPartidasP)
{
    uasort($coleccionPartidasP, "ordenLista");

    $coleccionPartidasP = array_values($coleccionPartidasP);

    return $coleccionPartidasP;
}
