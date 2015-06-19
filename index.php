<?php

function __autoload($nombre_clase) {
    include $nombre_clase . '.class.php';
}

/**
 * Plantilla para incluir poblacion inicial
 */
$inicial = array(
    new Carro(explode(",", "v1,c0,s7,m-4,m-2,s124,t0,m2,c2,m3,s128,m-2,t0,m-2,t0,t0,v4,s65,m-2,c5,c4,v7,s26,c5,t0,t0,c1,t0,c3,c2,c3,t0,c3,c1,c0,s13,m4,t0,v7,c5,c1,c1,t0,m0,c5,v0,m-2,c5,v1,t0,t0,c4,s146,c3,m3,m-2,c2,m-1,c1,c4,m1,s77,v1,m-1,t0,s145,s144,m4,c0,c0,v10,s4,t0,v7")),
    new Carro(explode(",", "v1,c0,s7,m-4,m-2,s124,t0,m2,c2,m3,s128,m-2,t0,t0,v2,t0,v4,t0,s65,m-2,c5,c4,m0,v7,s26,c5,t0,t0,c1,t0,c3,c2,c3,t0,c3,c1,c0,s13,m4,t0,v7,m-2,c5,c1,c1,t0,m0,c5,s47,v0,m-2,m2,v1,t0,t0,c4,s146,c3,s16,m-2,c2,m-1,m2,c1,v3,c4,m1")),
    new Carro(explode(",", "v1,c0,s7,m-4,m-2,s124,t0,m2,c2,m3,s128,m-2,v7,t0,t0,s37,c3,t0,v7,s112,v3,t0,c0,c4,m3,m2,t0,s144,m4,v7,s74,c2,c5,c4,t0,c4,t0,c1,c4,c4,m0,c5,v0,s86,c5,v1,t0,c4,s146,c3,t0,m-2,c2,m-1,c4,m1,c3,v1,m-1,t0,s145,v1,c0,c0,t0,m-4,c1,s73,c1,c5,s42,s117,c2,s98,c5")),
    new Carro(explode(",", "v1,c0,s7,m-4,m-2,s124,t0,v5,m3,s128,m-2,t0,m-2,t0,t0,v4,m-2,c5,c4,v7,s26,c5,t0,c1,t0,c3,c2,c3,t0,c3,s143,c0,s13,m4,t0,c5,c1,c1,t0,m0,c5,v0,t0,v1,t0,t0,c4,s146,c3,m3,m-2,c2,c1,c4,m1,s77,v1,t0,s145,t0,v7,s48,v7,c3,v5,t0,t0,s113,s65,m0")),
    new Carro(explode(",", "v1,c0,v0,m-4,m-4,s124,t0,m2,c2,m3,s128,m-2,t0,m-2,t0,t0,v4,s65,m-2,c5,c4,v7,s26,c5,t0,t0,c1,t0,c3,c2,c3,t0,t0,c0,m4,t0,v7,c5,c1,c1,m-1,t0,s105,t0,v1,c4,c3,m2,m-2,s70,m3,v4,t0,c4,m-1,c2,m-2,t0,v7,t0,v7,c3,m3,s6,s63,m3,v4,s3,c0,v7,m3,v0")),
    new Carro(explode(",", "v1,c0,m-4,t0,s124,m4,m2,m3,s128,c2,t0,m-2,t0,v4,s65,t0,s26,t0,v7,m-1,v3,t0,t0,c4,m3,v1,t0,s144,c2,c5,c4,t0,c4,s146,t0,c4,m1,s77,m2,m2,t0,s105,t0,m2,v1,c4,t0,t0,c4,m-1,c3,m3,m-2,c2,m-1,c4,m1,s77,v1,m-1,t0,s145,s144,m4,c0,c0,v10,s4,t0,v7,m-2,t0,t0,v8,s60,m4")),
    new Carro(explode(",", "c1,c0,s7,m-4,m-2,s124,t0,c1,m3,s128,v7,t0,v1,t0,c3,v7,t0,c4,v7,s112,m2,t0,c0,v2,c4,m3,m-1,t0,s144,m4,v7,s68,c5,c4,t0,c4,s146,c3,c4,c4,m1,s77,m2,m-1,t0,s144,s105,t0,m2,v1,c4,c3,m-4,t0,m-2,v4,t0,s141,c4,m-1,m-2,s128,t0,v7,s48,v7,c3,t0,s39,v7,v2,m1,s23,c1,v0")),
    new Carro(explode(",", "v1,s7,m-4,m-2,t0,c3,t0,t0,t0,s65,s69,v7,t0,t0,s37,c3,v7,t0,c4,m3,m2,t0,s144,m4,v7,s74,c2,c5,c4,t0,c4,t0,c1,c4,c4,m0,c5,v0,s86,c5,v1,v9,c4,s146,c3,t0,m-2,c2,m-1,c4,m-2,c2,m-1,c1,c4,m1,s77,v1,m-1,t0,m-3,s144,c0,v10,s4,t0,v7,v3,t0,t0,m4,m1,m4,m1,c5,t0,t0,t0")),
    new Carro(explode(",", "s127,s7,v6,m-2,c3,s140,t0,s65,t0,v8,v7,s9,t0,s112,v3,t0,c5,t0,s48,v0,c2,c1,c3,c1,c0,m4,t0,m4,s20,m4,t0,m3,t0,c5,c1,m0,c5,s47,v0,m2,v1,t0,v8,c4,s146,c3,s16,c2,m-1,v3,c3,m2,m-2,t0,m-1,v4,t0,s141,c4,m-1,c2,m-2,s128,t0,v7,s48,v7,t0,c3,v10,t0,c3,s96,s149,v10,t0")),
    new Carro(explode(",", "v1,s7,m-4,m-2,t0,c3,t0,t0,t0,s65,s69,c4,c3,t0,t0,s37,c3,t0,v0,v7,s112,v3,t0,c0,v2,c4,m3,v1,t0,s144,m4,m3,c2,c5,m-2,t0,c4,c3,c4,v3,v5,s77,m2,m-1,t0,s144,s105,t0,m2,v1,c4,c3,m2,m-2,t0,m3,v4,t0,s141,c4,m-1,v5,c0,t0,t0,t0,v7,t0,s47,c2,v10,v5,t0,s3,s37,s115"))
);

$tableros = array(1.8, 2, 13, 21);
//
//for ($ntableros = 0; $ntableros < 25; $ntableros++) {
//    $tableros[] = array(1.8,  rand(1, 25),rand(1, 25),rand(1, 25));
//}

$motor = new AgEngine(10, 15, 200, 1, 10, 3, null, array($tableros), false, 22);

//$motor = new AgEngine(10, 15, 150, 25, 25, 3);

$motor->generarPoblacionInicial();
$motor->probarPoblacion();

$mostrarCada = 10;
$generacion = $motor->getGeneracionInicial();

if ($generacion == 0) {
    echo "Generacion Inicial: " . $generacion . "\n";
    $motor->mostrarPoblacion($generacion, true);
}

//$numeroGeneraciones = 500;
//for ($index = 0; $index < $numeroGeneraciones; $index++) {
do {
    $motor->seleccionarPadres();
    $motor->iniciarGeneracion();
    $motor->preservarElite();
    $motor->producirHijos();
    $motor->mutar();
    $motor->reducir();
    $motor->probarPoblacion();
    if ($generacion % $mostrarCada == 0) {
        echo "Generacion: " . $generacion . "\n";
        $motor->mostrarPoblacion($generacion, true);
    }
    $generacion++;
} while (1);
?>
