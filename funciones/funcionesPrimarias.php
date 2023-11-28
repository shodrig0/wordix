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
 * Funcion verifica si el nombre ya esta registrado
 * @return string
 */
function nombreRegistrado()
{
    echo "Quieres saber sobre un jugador? Ingresa su nombre:\n";
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
 * Función que agrega una palabra a la colección palabras para jugar
 * @param string $palabraNueva
 * @param array $coleccionPalabrasP
 * @return array 
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

/**
 * Funcion para verificar si una palabra ya fue utilizada para jugar
 * @param array $coleccionPalabras, $coleccionPartidasPrecargadas
 * @param string $nombreJugador
 * @return boolean
 */

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

/**
 * Funcion para verificar si la palabra fue utilizada
 * @param string $nombreJugador
 * @param array $coleccionPartidasPrecargadas, $coleccionPalabras
 * @return boolean
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
 * Funcion para verificar el nombre del jugador 
 * @param string $nombreJugador
 * @param array $coleccionPartidasPrecargadas
 * @return string
 */
function verificarNombreDelJugador($nombreJugador, $coleccionPartidasPrecargadas)
{
    $jugadorBuscado = false;
    $iConteo = 0;
    $cantPartidas = count($coleccionPartidasPrecargadas);

    while ($iConteo < $cantPartidas && !$jugadorBuscado) {
        if ($nombreJugador == $coleccionPartidasPrecargadas[$iConteo]["jugador"]) {
            $jugadorBuscado = true;
        }
        $iConteo++; // incremeta su valor mediante el bucle
    }

    return $nombreJugador;
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
    $mensaje = "El jugador $jugadorRegistrado no ganó ninguna partida! :(";
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
 * Funcion para contar la cantidad de partidas realizadas de un jugador
 * @param string $jugador
 * @param array $partJugada
 * @return int
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
 * @param string $jugador
 * @param array $partJugada
 * @return int
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
 * @param string $jugador
 * @param array $partJugada
 * @return int
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
 * Funcion para calcular el porcentaje de victorias de un jugador
 * @param int $victorias
 * @param array $partJugada
 * @return int
 */
function porcentajeJugador($victorias, $coleccionPartidasP)
{
    $resultado = 0;

    if ($coleccionPartidasP > 0) {
        $resultado = ($victorias / $coleccionPartidasP) * 100;
    }

    return $resultado;
}

/**
 * Funcion para guardar los datos de en que intento gano
 * @param string $jugador
 * @param array $partJugada
 * @return array
 */
function adivinadas($jugador, $partJugada)
{
    $cantIntentos = [
        "intento1" => 0,
        "intento2" => 0,
        "intento3" => 0,
        "intento4" => 0,
        "intento5" => 0,
        "intento6" => 0
    ];

    for ($i = 0; $i < count($partJugada); $i++) {
        if ($jugador == $partJugada[$i]["jugador"]) {
            $intentos = $partJugada[$i]["intentos"];

            if ($intentos >= 1 && $intentos <= 6) {
                $cantIntentos["intento" . $intentos]++;
            }
        }
    }

    return $cantIntentos;
}

/**
 * Funcion para mostrar las estadisticas del jugador
 * @param array $coleccionPartidas
 * @param string $jugador
 * @return string
 */
function estadisticasJugador($coleccionPartidas, $jugador)
{
    $partidasJugadas = cantidadDePartidas($jugador, $coleccionPartidas);
    $victorias = victorias($jugador, $coleccionPartidas);
    $porcentaje = porcentajeJugador($victorias, $partidasJugadas);
    $puntajeTotal = puntajeTotal($jugador, $coleccionPartidas);
    $intentosAdivinados = adivinadas($jugador, $coleccionPartidas);

    $mensaje = "Estadísticas del jugador:\n";
    $mensaje .= "Partidas jugadas: $partidasJugadas\n";
    $mensaje .= "Victorias: $victorias\n";
    $mensaje .= "Porcentaje: $porcentaje%\n";
    $mensaje .= "Puntaje total: $puntajeTotal\n";
    $mensaje .= "Intentos adivinados:\n";

    foreach ($intentosAdivinados as $intentos => $cantidad) {
        $mensaje .= "$intentos: $cantidad\n";
    }

    return $mensaje;
}

/**
 * Funcion para ordenar las palabras 
 * @param array $partidaUno, $partidaDos
 * @return 
 */

function ordenarPalabras($partidaUno, $partidaDos)
{
    if ($partidaUno["jugador"] < $partidaDos["jugador"]) {
        $orden = -1;
    } elseif ($partidaUno["jugador"] > $partidaDos["jugador"]) {
        $orden = 1;
    } else {
        if ($partidaUno["palabraWordix"] < $partidaDos["palabraWordix"]) {
            $orden = -1;
        } else {
            $orden = 1;
        }
    }
    return $orden;
}

/**
 * Ordena de forma alfabetica los jugadores y las palabras que jugaron
 * Su retorno es directo desde el print, que se invoca en el prog. pincipal
 */

function alfabeticOrden()
{
    // string retorno $orden, invocacion array $cantDeJugadores
    $partidasOrd[] = cargarPartidas();
    uasort($partidasOrd, 'ordenarPalabras');
    print_r($partidasOrd);
}
