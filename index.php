<?php

function __autoload($nombre_clase) {
    include $nombre_clase . '.class.php';
}

$instrucciones = array(
    0 => "v1",
    1 => "c5",
    2 => "s4",
    3 => "t0",
    4 => "m1",
    5 => "c5",
    6 => "s8",
    7 => "t0",
    8 => "m1",
    9 => "c5",
    10 => "s12",
    11 => "t0",
    12 => "m-1"
);

$inicial = array(
    new Carro(explode(",", "v7,v1,m1,c4,s101,t0,c5,t0,c4,c3,m-4,c5,v1,s57,t0,v2,m-2,t0,c1,v10,v9,c4,t0,s124,v1,m2,c3,v0,s124,v6,v1,m2,c3,c1,m1,s93,m-1,s95,t0,s84,m0,s22,s69,c0,m-3,m-4,s129,v3,t0,m0,s146,c0,c0,c4,c1,t0,m-3,c4,s10,v10,c0,t0,s77,s7,m2,s120,v0,t0,c4,c5,t0,m-2,v9,v5,m0,c1,v8,t0,c5,c1,t0,v6,v9,v2,c5,v8,c0,s141,m1,c5,s95,m-1,m2,c2,s37,m-2,t0,c0,t0,c0,t0,m-1,c3,t0,c4,s115,c3,m3,m-4,t0,s89,c5,c4,v3,v10,v0,m3,s69,c1,v4,t0,t0,t0,c4,t0,v1,m1,t0,v6,t0,v2,v2,c0,v5,v2,t0,c4,c1,t0,m-1,t0,c3,v2,s26,t0,v9,v0,c5,s35,t0,s47,v5,c5,t0,t0,m-2,t0,c4,c3,v5,v8,t0,t0,t0,c4,t0,m-1,v7,t0,c1,m-1,t0,m4,v9,c1,s12,m0,m-2,v4,c2,m0,s91,v10,v6,s66,c5,s97,v10,m-4,m0,c3,s110,m-4,c3,c0,s74,v4,c0,c2,s61,s146,t0,v5,v8,t0,c3,c4,m2,c1,c4,m2,m-1,c2,s38,m-2,m1,c2,s101,t0,t0,m-3,t0,s7,m1,s149,t0,c4,v4,m-4,c3,s115,t0,c0,s82,c5,c2,m-2,s1,c0,t0,s75,s5,v2")),
    new Carro(explode(",", "c1,v2,m-3,s20,m1,t0,c5,v5,t0,m-3,s37,t0,v2,m4,m-1,c4,m1,t0,s76,c3,t0,m2,m-3,s97,v9,m-4,c4,c3,s100,c1,c1,s131,s43,s43,m2,t0,v2,c4,t0,s43,m-4,t0,c1,s143,v0,c5,t0,s144,s114,t0,c1,s86,m-1,v9,c5,c0,v10,c0,v0,t0,c5,v4,c3,s45,c2,s68,t0,s51,s41,s101,s120,t0,m2,s141,s78,v1,c5,v1,t0,m1,m2,t0,c3,s125,c0,s88,v0,v5,m-1,c5,c1,c3,c3,c5,s117,m-3,m-3,t0,m1,m-1,m-3,t0,c3,c1,s92,v8,m1,m1,s99,t0,t0,m3,m-2,v3,t0,m2,s147,c5")),
    new Carro(explode(",", "m2,s117,m-2,v2,c2,t0,t0,c1,m-1,m-4,c3,t0,v1,s89,c1,v2,m4,c4,v7,s68,s2,c3,m-2,t0,m-4,s66,t0,c3,s64,c4,c0,t0,c1,c5,m2,s45,c1,m-3,t0,m-1,t0,s102,t0,s147,t0,v6,s131,c1,m-1,m3,t0,v6,t0,t0,t0,t0,s119,s56,m1,t0,c1,s144,v6,c3,v7,c2,c5,v8,t0,t0,m2,v2,m3,s95,s130,t0,m0,m0,m-2,t0,m0,s121,m1,s63,c0,m-3,s53,c4,t0,t0,c0,v9,s39,m-1,s76,c2,c4,s37,s59,s31,t0,t0,c3,v6,m1,c0,c1,t0,c4,s94,t0,v10,v1,s89,t0,s9,t0,v2,c2,c0,m4,t0,t0,t0,v3,v1,v2,t0,s89")),
    new Carro(explode(",", "v1,m1,c4,s101,t0,c5,t0,c4,c5,v8,s57,c1,s70,v9,c4,t0,t0,s124,s105,m2,m-1,c3,c1,c4,t0,s84,s69,m-3,m-4,v0,t0,m0,v4,c4,m-3,v4,v5,t0,s7,m-4,c1,m-4,c5,m-2,t0,v5,m0,s98,v8,s123,m3,v6,v9,v2,c1,s58,s26,c5,m0,s47,v5,c5,t0,t0,v1,s67,t0,c4,m-1,v6,v2,c0,s23,m2,v5,t0,t0,s82,t0,c3,s128,s91,v4,c5,m-4,m4,s110,v8,s74,c0,m-1,v3,v5,v8,c3,c5,m1,c2,t0,s8,s149,m-1,s37,s118,t0,c2,c2,s17,s85,v9,c2,t0,c0,s79,v10,c1,t0,m-3,t0,s142,s144,m-3,s150,c2,t0,s4,v9,v9,t0,s57,v2,s144,m3,s40,s142,c0,s86,m-3,t0,c2,m-3,v5,v10,c1,m3,t0,c5,v3,c4,s60,m-2,v8,v0,t0,s4,m1,t0,s20,m1,s32,t0,v9,v7,m-1,v6,v8,t0,t0,s102,c2,t0,s135,s150,c1,s13,m0,v0,c2,t0,s134,s24,m-4,m3,m2,m-4,v5,c4,t0,s133,c1,m-3,c3,m-4,s25,c1,v3,t0,c1,m2,m4,v10,c3,c2,s62,m-4,m3,s83,m2,m-2,m-4,v5,c4,m4,s133,t0,t0,c1,m-3,c3,v3,s49,c3,c1,s43,t0,c1,m2,m4,v10,c3,c2,s62,v10,c4,c5,t0,t0,t0,v1,v7,m3,s53,c2,s87,m-2,t0,c0,s117,s122,v10,c5,t0,s30,v4,t0,c0,s104,c0,c4,v5,s30,t0,t0,c5,c1,v10,v6,t0,c4,m1,s53,s55")),
    new Carro(explode(",", "v7,v1,m1,c4,s101,t0,c5,t0,c4,c3,m-4,c5,v1,s57,t0,v2,v9,v10,m-2,c1,t0,c1,v10,v9,v2,c4,t0,v0,s124,v6,v1,m2,c3,c1,m1,s93,m-1,s95,t0,s84,m0,s22,s69,c0,m-3,m-4,s129,v3,t0,m0,s146,c0,c0,c4,c1,t0,m-3,c4,s10,v10,c0,t0,s77,s7,m2,s120,v0,t0,c4,c5,t0,m-2,v9,v5,m0,c1,v8,t0,c5,c1,t0,v6,v9,v2,c5,v8,c0,s141,m1,c5,s95,m-1,m2,c2,s37,m-2,t0,c0,t0,c0,t0,m-1,c3,t0,c4,s115,c3,m-1,m4,c4,t0,s150,c2,v6,s10,v0,m3,m-4,t0,s89,c5,c4,v3,s48,v10,v0,m3,v3,c1,v4,t0,t0,s31,m2,s93,v4,c0,m4,m0,m-1,c4,t0,v1,m1,t0,v6,c1,m2,v2,c3,c0,v5,v2,t0,v5,c4,s149,s30,c3,t0,s54,t0,v8,t0,t0,s33,v10,c0,v0,m4,v5,t0,m3,v0,v7,m-2,c5,s108,c2,s44,m4,s57,v10,m-4,s137,c5,m0,s14,m-3,s26,t0,s5,c4,t0,v0,s150,v2,t0,t0,m-4,c3,m-2,s67,m-2,m1,c5,v10,t0,t0,t0,s143,s116,c0,t0,m-4,s85,t0,s1,c1"))
);

$numeroJuegos = 100;
$nivel = 0;

//$motor = new AgEngine(10, 15, 150, 50, 25, 3, array(new Carro($instrucciones)));
$motor = new AgEngine(10, 15, 150, 25, 15, 3, $inicial);

$motor->generarPoblacionInicial();
$motor->probarPoblacion();
$numeroGeneraciones = 500;
$mostrarCada = 10;
$index = 0;
//for ($index = 0; $index < $numeroGeneraciones; $index++) {
do {
    $motor->seleccionarPadres();
    $motor->iniciarGeneracion();
    $motor->preservarElite();
    $motor->producirHijos();
    $motor->mutar();
    $motor->reducir();
    $motor->probarPoblacion();
    if ($index % $mostrarCada == 0) {
        echo "Generacion: " . $index . "\n";
        $motor->mostrarPoblacion($index, true);
    }
    $index++;
} while (1);

//for ($index = 0; $index < $numeroJuegos; $index++) {
//    $juego = new Juego(new Carro($instrucciones));
//    $nivel += $juego->jugar();
//}
//echo $numeroJuegos." juegos terminados, obstaculos evitados en promedio: " . $nivel / $numeroJuegos . "\n";
?>