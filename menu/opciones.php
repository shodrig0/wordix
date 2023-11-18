<?php

include_once("wordix.php");

/* Opcion 1 */

function imprimirMenu()
{
    $seleccionarOpcion = "\n1) Jugar al Wordix con una palabra elegida:\n2) Jugar al wordix con una palabra aleatoria:\n3) Mostrar una partida:\n4) Mostrar la primer partida ganadora:\n5) Mostrar Estadísticas Jugador:\n6) Mostrar listado de partidas ordenadas por jugador y por palabra:\n7) Agregar una palabra de 5 letras a Wordix:\n8) Salir\n";

    return $seleccionarOpcion;
}

// PUNTO 3 DEL MENU - Se puede mover si es necesario a otro php o carpeta // 

 /**
 * @param array $coleccionPartidasPrecargadas
 * @param array $cargarPartidasPrecargadas
 * @return int
 */

 function cargarPartidasPrecargadas()
 {
     $coleccionPartidasPrecargadas[0] = ["palabraWordix" => "QUESO", "jugador" => "majo", "intentos" => 0, "puntaje" => 0];
     $coleccionPartidasPrecargadas[1] = ["palabraWordix" => "TRONO", "jugador" => "shodrig0", "intentos" => 3, "puntaje" => 15];
     $coleccionPartidasPrecargadas[2] = ["palabraWordix" => "BOTAS", "jugador" => "il3l", "intentos" => 4, "puntaje" => 13];
     $coleccionPartidasPrecargadas[3] = ["palabraWordix" => "NAVES", "jugador" => "facuu", "intentos" => 6, "puntaje" => 12];
     $coleccionPartidasPrecargadas[4] = ["palabraWordix" => "HUEVO", "jugador" => "majo", "intentos" => 5, "puntaje" => 9];
     $coleccionPartidasPrecargadas[5] = ["palabraWordix" => "VERDE", "jugador" => "P40oo", "intentos" => 5, "puntaje" => 12];
     $coleccionPartidasPrecargadas[6] = ["palabraWordix" => "YUYOS", "jugador" => "shodrig0", "intentos" => 0, "puntaje" => 0];
     $coleccionPartidasPrecargadas[7] = ["palabraWordix" => "REINA", "jugador" => "albap", "intentos" => 3, "puntaje" => 13];
     $coleccionPartidasPrecargadas[8] = ["palabraWordix" => "YUYOS", "jugador" => "clauu", "intentos" => 1, "puntaje" => 17];
     $coleccionPartidasPrecargadas[9] = ["palabraWordix" => "MUJER", "jugador" => "il3l", "intentos" => 5, "puntaje" => 11];
     $coleccionPartidasPrecargadas[10] = ["palabraWordix" => "TIGRE", "jugador" => "facuu", "intentos" => 2, "puntaje" => 15];
     $coleccionPartidasPrecargadas[11] = ["palabraWordix" => "DAMAS", "jugador" => "P40oo", "intentos" => 0, "puntaje" => 0];
     $coleccionPartidasPrecargadas[12] = ["palabraWordix" => "PIANO", "jugador" => "albap", "intentos" => 5, "puntaje" => 11];
     $coleccionPartidasPrecargadas[13] = ["palabraWordix" => "REINA", "jugador" => "clauu", "intentos" => 2, "puntaje" => 14];
     $coleccionPartidasPrecargadas[14] = ["palabraWordix" => "PISOS", "jugador" => "il3l", "intentos" => 0, "puntaje" => 0];
     
     return $coleccionPartidasPrecargadas;
 }
 
 /* Menu punto 3 */
 $coleccionPartidasPrecargadas = [ ];
 echo "nro: \n";
 $nroIngresado = trim(fgets(STDIN));
 
 while ($nroIngresado>15){
     echo "Ese numero no existe, ingrese de nuevo","\n","nro://";
     $nroIngresado = trim(fgets(STDIN)); 
 }
 
     $partidas=cargarPartidasPrecargadas(); 
     echo "************************************************","\n";
     echo "Partida WORDIX ",$nroIngresado,": palabra ", $partidas[$nroIngresado]["palabraWordix"],"\n";
     echo "Jugador: ",$partidas[$nroIngresado]["jugador"],"\n";
     echo "Puntaje: ",$partidas[$nroIngresado]["puntaje"]," puntos","\n";
 
     if($partidas[$nroIngresado]["puntaje"]>0){
         echo "Intento: Adivino la palabra en ", $partidas[$nroIngresado]["intentos"]," ","intentos","\n";
     }elseif($partidas[$nroIngresado]["puntaje"]<=0){
         echo "Intento: No adivino la palabra","\n","************************************************","\n";
      } 