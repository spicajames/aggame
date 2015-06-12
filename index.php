<?php

function __autoload($nombre_clase) {
    include $nombre_clase . '.class.php';
}

/**
 * Plantilla para incluir poblacion inicial
 */
$inicial = array(
    new Carro(explode(",", "v1,c0,s7,s32,m-3,m-4,t0,m2,c2,m3,s43,m-2,t0,v7,t0,t0,s130,v4,t0,v10,m0,m2,s114,s4,c5,t0,t0,v4,s139,s67,s106,c1,c3,v9,v3,s78,m-1,v1,s62,s111,m-1,t0,s94,c2,c5,t0,v1,s87,t0,m-4,m-1,m-3,c4,v7,m2,c2,t0,v1,c5,v8,m2,c0,s141,s131,v0,c5,v1,m1,c4,m3,s24,s71,m1,m-4,m0,m0,m-1,m1,m1,v10,c1,t0,c4,c0,c0,t0,v3,s85,m-1,m3,t0,t0,v9,s1,v8,v3,c1,s71,v8,m3,v2,s43,v10,t0,c3,s27,s16,t0,s97,m1,v3,v1,t0,c0,t0,c1,m-1,c2,t0,v3,v2,s127,s103,m1,t0,t0,c2,c2,v1,t0,v5,s88,t0,v6,v7,s123,s44,m-2,t0,s58,m0,m0,s46,c0,s145,t0")),
    new Carro(explode(",", "v1,c0,s7,c0,m-3,m-4,t0,m2,c2,m3,s43,m-2,v7,t0,t0,s130,v4,t0,v10,m0,m2,s114,c5,t0,s139,s67,s106,c1,m-3,m1,s78,m-1,v1,s111,m-1,t0,c2,t0,v1,v0,t0,c2,m-3,v6,t0,c2,t0,v1,c5,v8,v8,c0,s141,s131,c5,v1,m1,c4,m3,s24,s71,m1,m-4,s150,m0,m-1,m1,m1,v10,c1,m-3,c4,t0,c0,v3,s85,m1,t0,t0,v9,s106,v8,v3,c1,s71,v8,s148,v2,s43,v10,t0,c3,s27,t0,v5,m1,v1,t0,s91,c0,c1,m-1,c2,t0,v3,v2,s127,m1,s18,t0,s4,c2,v1,t0,t0,v6,v7,s123,s44,m-2,t0,s58,m0,m0,s2,c0,s145,t0,m0,v4,t0,s40,c4,c5,c1,t0,m2,t0,v2,m-1,v0,m4,c3,s74,t0,v3,m-3")),
    new Carro(explode(",", "m0,t0,s43,s79,s121,v10,s114,s139,s106,m2,v1,c4,s67,m-2,m-1,v9,m2,t0,m0,s74,t0,t0,t0,s149,c5,s114,v10,s131,m-3,m-3,c1,t0,v6,t0,c5,t0,c2,s99,v9,c1,m0,s34,c5,s51,c2,c4,m-2,t0,v9,c1,c5,s51,s57,c4,m-2,v0,t0,m-1,t0,s96,m-1,c0,v0,t0,c5,v1,m2,t0,t0,s56,v10,s77,m3,t0,t0,t0,c3,t0,s10,c0,s65,s148,s78,v3,m0,m-4,c1,v3,t0,c0,s42,c2,c0,c0,c0,s94,m2,s56,v1,t0,m4,c4,c5,v3,c3,t0,v9,v2,m-1,c5,m1,v2,s125,m0,m-3,c3,v10,v9,m2,s96,s37,m-3,s93,m-4,m-3,v2,c2,v4,v10,s97,t0,v6,s36,v10,m4")),
    new Carro(explode(",", "m0,s43,t0,s121,t0,m0,t0,t0,s47,t0,v1,t0,s67,m-2,t0,m-1,t0,s30,c3,s64,v9,s91,c1,t0,v7,t0,v3,t0,m-4,t0,m0,s149,m-3,c0,m-1,s114,v10,s131,s103,c1,t0,v8,t0,m0,s22,v4,c3,t0,c2,c1,m-2,v6,t0,v9,s34,v2,s51,v1,c2,v0,t0,m-1,v0,s96,s85,c0,v0,c5,v1,m2,m1,t0,m2,v10,s77,t0,t0,m-3,v3,m2,v7,t0,c0,c5,s96,s148,s78,t0,s143,m0,t0,t0,c5,s34,t0,v10,s78,m0,v5,s150,m-3,s91,v8,v10,t0,v7,t0,m-4,s42,v8,m3,s89,t0,c4,v3,s11,t0,c3,c4,t0,m-1,v3,t0,t0,m1,s30,v9,s71,m3,v1,v9,v6")),
    new Carro(explode(",", "t0,c0,c3,t0,s43,c5,c3,v10,s93,v8,c3,c3,s18,s70,m1,t0,c5,t0,v10,t0,m-1,t0,t0,t0,t0,v6,c2,t0,s128,m-3,v4,t0,t0,v3,v7,t0,c0,v8,m-1,s141,c0,v8,m1,c1,s71,m1,m-4,s150,m0,m-1,m1,m1,v10,v5,t0,c4,t0,m2,t0,s53,v8,c1,t0,s71,s148,v2,v0,c3,m2,v5,t0,m3,c0,v2,c0,m1,t0,s4,c2,v1,t0,s90,t0,s123,s44,m-2,m3,m-1,t0,c1,m-3,m0,c3,c5,v10,s57,m1,t0,v10,t0,m3,v1,m2,c0,c5,t0,t0,t0,m2,v2,s110,s1,v10,s94,m1,s22,m3,t0,v8,s17,t0,c3,s3,v10,c4,m-2,t0,m0,c1,v10,c2,c0,s35,v4,t0,c0,t0,m0,v4,s42,m2")),
    new Carro(explode(",", "c0,s7,m-4,t0,m2,c2,s43,m-2,s66,t0,t0,t0,v4,t0,s27,m3,s114,c2,s67,s106,c1,m1,s78,v2,v1,s111,m-1,t0,c5,v1,v0,t0,c2,s103,v6,c4,c2,t0,v1,v8,m-1,s141,c5,v4,m1,t0,s24,s71,t0,s150,m0,v6,s132,v10,c1,t0,c4,m4,c1,t0,m1,s106,v8,t0,s71,s148,v2,v1,c4,c3,s27,t0,c2,s147,v2,c0,s18,t0,s4,c2,v1,t0,s90,s123,m-2,v9,m-1,t0,v5,c1,c3,v9,s149,c5,v10,m1,t0,v4,m3,v1,t0,c5,v0,t0,t0,t0,m2,s110,s1,v10,s94,t0,s115,m3,s1,s49,c4,v6,c0,m0,s60,s126,m-4,c1,c0,s65,s27,t0,c2,m-4,c2,c0,v5,c3,v10")),
    new Carro(explode(",", "s43,t0,s121,t0,v10,m0,m-3,s139,s106,v3,t0,v4,c1,m-2,c3,t0,v2,s150,v9,s91,c1,t0,v2,v4,v3,t0,m-4,t0,m0,s149,m-3,c0,s127,c1,v10,s131,s103,m-3,c1,v1,v8,m0,t0,v4,c3,c2,t0,c1,m-2,v6,t0,t0,c5,s51,s57,c4,m-2,v0,t0,m-1,t0,s96,m-1,c0,v0,t0,m-2,v1,m2,t0,t0,t0,s77,m3,t0,t0,m-3,v3,m2,t0,s10,c0,s65,s96,s78,t0,v3,m0,m0,t0,c0,c2,t0,c0,c0,c0,s94,m2,s56,v1,m4,c4,s115,c5,c3,c3,m1,v9,c5,m0,c5,m1,s49,t0,m2,v3,s125,m0,m-3,s137,s91,v1,m-2,t0,s80,v1,v6,c1,m-4,v10,v4,c5,m-3,v5,m-2,c4,t0,v8,s120")),
    new Carro(explode(",", "c0,m-4,t0,m2,c2,m-2,s66,t0,t0,v4,t0,v10,m0,m3,s114,m-2,s106,m1,t0,s150,v1,s106,m-1,v10,v1,s124,c2,m-3,c5,c4,c2,t0,v1,v8,m-1,s141,c5,s93,m1,c4,s24,s71,m1,m-4,s150,m0,c1,m1,m1,s10,c1,t0,m-2,t0,m2,c1,t0,t0,s106,v3,s131,s71,s148,v2,v0,c3,s27,v5,m3,c0,c2,s147,v2,c0,m1,s18,t0,s4,c2,v1,t0,s90,c4,t0,s100,s44,m-2,m3,v9,c2,v5,c1,c3,m0,c3,c5,v10,m1,t0,v10,t0,m3,m2,t0,t0,c5,t0,t0,t0,m2,m2,s1,v10,s94,t0,s115,m3,t0,c0,s10,m-3,c2,c1,t0,v9,c5,v9,c1,v9,v10,c3,s65,t0,c5,m0,t0,c4,c5,t0,t0,c2,c4,c3,v4,s14,s29")),
    new Carro(explode(",", "c0,s7,c2,m-4,s18,m2,c2,s43,m-2,t0,t0,t0,v4,t0,v10,v4,c5,c5,c2,v5,v10,c0,t0,c1,t0,t0,v9,t0,t0,c2,t0,v3,m-3,v4,c4,t0,v3,t0,s54,c0,m4,s23,c4,m1,t0,m-1,t0,m3,m4,m-3,t0,c4,m-2,c2,t0,t0,c2,m-1,s96,m-1,c0,s116,t0,c5,t0,c2,m2,v2,t0,s56,t0,v10,s96,v2,t0,v10,m-3,v3,m-4,c4,t0,c0,v7,t0,v5,t0,v3,m0,t0,s12,t0,t0,t0,t0,t0,t0,s76,m3,c4,t0,v8,m-1,m-1,v4,v3,c1,v0,m-3,m1,t0,t0,c4,m-1,t0,v1,v2,v9,t0,s45,c3,c0,m1,v4,c0,c5,v9,t0,v5,v5,c4,v8")),
    new Carro(explode(",", "v1,c0,s148,s32,s24,c4,m2,c2,s43,c1,t0,v7,t0,s130,m1,v10,m0,t0,c5,t0,v4,c3,m-3,s106,c3,v3,m-1,v1,s62,s111,m3,s52,s94,c2,t0,c1,t0,m1,m-1,m-3,v7,m2,s85,s30,s89,m1,m1,s141,s131,v0,c5,c4,s27,t0,t0,v1,c1,s106,v8,m4,c1,m-4,s148,s43,v10,t0,c3,s27,t0,m1,v1,t0,s91,c0,s140,c1,t0,v3,v2,s35,m1,s18,t0,c2,v1,v6,v7,s123,m-2,t0,s58,m0,m0,m-4,c0,s145,m0,v4,t0,s40,s25,v0,c3,s74,t0,v3,s90,m-1,c3,c3,t0,t0,v7,s97,t0,m1,s124,t0,v1,v6,m-3,m-2,v1,v2,v1,s121,c5,s7,c2,c4,c1,s99,m2,c1,v3,v1,v7,c0,s44,v8,c5,c5,t0,t0"))
);
$motor = new AgEngine(10, 15, 150, 25, 25, 3, $inicial);

//$motor = new AgEngine(10, 15, 150, 25, 25, 3);

$motor->generarPoblacionInicial();
$motor->probarPoblacion();

$mostrarCada = 10;
$index = 50650;

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
    if ($index % $mostrarCada == 0) {
        echo "Generacion: " . $index . "\n";
        $motor->mostrarPoblacion($index, true);
    }
    $index++;
} while (1);
?>
