<?php

class AgEngine {

    private $tamañoPoblacion;
    private $tamañoADNMaximo;
    private $tamañoADNMinimo;
    private $tamañoElite;
    private $mutacion;
    private $numeroPruebas;
    private $instrucciones;
    private $poblacion;
    private $poblacionElite;
    private $desempeñoTotal;
    private $padres;
    private $hijos;
    private $fecha;

    public function __construct($tamañoPoblacion = 30, $tamañoADNMinimo = 15, $tamañoADNMaximo = 100, $numeroPruebas = 100, $mutacion = 25, $tamañoElite = 3, $poblacionElite = null) {
        $this->instrucciones = array(
            0 => array("v", 0, 10),
            1 => array("c", 0, 5),
            2 => array("s", 0, $tamañoADNMaximo),
            3 => array("t", 0, 0),
            4 => array("m", -4, +4)
        );

        $this->numeroPruebas = $numeroPruebas;
        $this->tamañoADNMaximo = $tamañoADNMaximo;
        $this->tamañoADNMinimo = $tamañoADNMinimo;
        $this->tamañoPoblacion = $tamañoPoblacion;
        $this->mutacion = $mutacion;
        $this->poblacionElite = $poblacionElite;
        $this->tamañoElite = $tamañoElite;

        date_default_timezone_set('Etc/GMT+5');
        $this->fecha = date("Ymd-His");

        $resultado = "";
        $resultado .= " Po: " . $this->tamañoPoblacion;
        $resultado .= " Ami: " . $this->tamañoADNMinimo;
        $resultado .= " Amx: " . $this->tamañoADNMaximo;
        $resultado .= " Pr: " . $this->numeroPruebas . " ";
        $resultado .= " M: " . $this->mutacion;
        $resultado .= " Te: " . $this->tamañoElite;
        if (sizeof($this->poblacionElite) > 0) {
            $resultado .= " Elite: \n";
            foreach ($this->poblacionElite as $value) {
                $resultado.= implode(",",$value->getAdn())."\n";
            }
        }
        file_put_contents("aglog-" . $this->fecha . ".txt", $resultado, FILE_APPEND);
    }

    public function generarPoblacionInicial() {
        $this->poblacion = array();
        for ($index = 0; $index < $this->tamañoPoblacion; $index++) {
            if (isset($this->poblacionElite[$index])) {
                $this->poblacion[] = $this->poblacionElite[$index];
            } else {
                $this->poblacion[] = new Carro($this->generarADN());
            }
        }
        return $this->poblacion;
    }

    private function generarADN() {
        $tamañoInstrucciones = mt_rand($this->tamañoADNMinimo, $this->tamañoADNMaximo);
        $instrucciones = array();
        for ($index1 = 0; $index1 < $tamañoInstrucciones; $index1++) {
            $instrucciones[] = $this->generarInstruccion();
        }
        return $instrucciones;
    }

    private function generarInstruccion() {
        $instruccionBase = mt_rand(0, 4);
        $instruccionNumero = mt_rand($this->instrucciones[$instruccionBase][1], $this->instrucciones[$instruccionBase][2]);
        return "" . $this->instrucciones[$instruccionBase][0] . $instruccionNumero;
    }

    public function probarPoblacion() {
        $this->desempeñoTotal = 0;
        for ($ipoblacion = 0; $ipoblacion < count($this->poblacion); $ipoblacion++) {
            $nivel = 0;
            for ($ipruebas = 0; $ipruebas < $this->numeroPruebas; $ipruebas++) {
                $juego = new Juego($this->poblacion[$ipoblacion]);
                $nivel += $juego->jugar();
            }
            $nivelFinal = round($nivel / $this->numeroPruebas);
            $this->poblacion[$ipoblacion]->setDesempeño($nivelFinal);
            $this->desempeñoTotal += $nivelFinal;
        }

        //Ordenar la poblacion deacuerdo al desempeño
        usort($this->poblacion, array("Carro", "comparar"));
    }

    public function seleccionarPadres() {
        $this->padres = array();
//        $padre = new Carro();
        $numeroPadres = 0;
        foreach ($this->poblacion as $key => $padre) {
            $numeroApariciones = round($padre->getDesempeño() * $this->tamañoPoblacion / $this->desempeñoTotal);
            for ($iapariciones = 0; $iapariciones < $numeroApariciones; $iapariciones++) {
                if ($numeroPadres >= $this->tamañoPoblacion) {
                    break 2;
                }
                $this->padres[] = $padre;
                $numeroPadres++;
            }
        }
    }

    public function iniciarGeneracion() {
        $this->hijos = array();
    }

    public function preservarElite() {
        for ($ielite = 0; $ielite < $this->tamañoElite; $ielite++) {
            $this->hijos[] = $this->poblacion[$ielite];
        }
    }

    public function producirHijos() {
        for ($ihijos = 0; $ihijos < $this->tamañoPoblacion; $ihijos++) {
            //escoger padre
            $ipadreA = mt_rand(0, $this->tamañoPoblacion - 1);
            $ipadreB = mt_rand(0, $this->tamañoPoblacion - 1);
            $hijo = $this->combinar($this->poblacion[$ipadreA], $this->poblacion[$ipadreB]);
            $this->hijos[] = $hijo;
            $hijo2 = $this->combinar($this->poblacion[$ipadreB], $this->poblacion[$ipadreA]);
            $this->hijos[] = $hijo2;
        }
    }

    private function combinar(Carro $padreA, Carro $padreB) {
        $puntoMaximoCorteA = sizeof($padreA->getAdn());
        $puntoMaximoCorteB = sizeof($padreB->getAdn());
        $puntoMaximoCorte = $puntoMaximoCorteA;
        if ($puntoMaximoCorteA > $puntoMaximoCorteB) {
            $puntoMaximoCorte = $puntoMaximoCorteB;
        }

        $puntoCombinacion = mt_rand(1, $puntoMaximoCorte - 1);
        $adnA = $padreA->getAdn();
        $adnB = $padreB->getAdn();

        $parteA = array_slice($adnA, 0, $puntoCombinacion);
        $parteB = array_slice($adnB, $puntoCombinacion, sizeof($adnB));

        $final = array_merge($parteA, $parteB);

        return(new Carro($final));
    }

    public function mutar() {
        foreach ($this->hijos as $key => $hijo) {
            if ($key > $this->tamañoElite) {
                $adn = $hijo->getAdn();
                for ($iadn = 0; $iadn < count($adn); $iadn++) {
                    if (mt_rand(0, 100) <= $this->mutacion) {
                        $eleccion = mt_rand(0, 2);
                        switch ($eleccion) {
                            case 0: $adn[$iadn] = $this->generarInstruccion();
                                break;
                            case 1:
                                if (sizeof($adn) < $this->tamañoADNMaximo) {
                                    $adn[] = $this->generarInstruccion();
                                }
                                break;
                            case 2:
                                if (sizeof($adn) > $this->tamañoADNMinimo) {
                                    array_splice($adn, mt_rand(0, sizeof($adn)), 1);
                                }
                                break;
                        }
                    }
                }
                $hijo->setAdn($adn);
            }
        }
    }

    public function reducir() {
        $this->poblacion = array();
        $this->poblacion = array_slice($this->hijos, 0, $this->tamañoPoblacion);
    }

    public function mostrarPoblacion($generacion = 0, $guardarEnDisco = false) {
        date_default_timezone_set('Etc/GMT+5');
        $resultado = "".date("Ymd-His");
        $resultado .= " Generacion: " . $generacion . " Poblacion: " . sizeof($this->poblacion) . "\n";
        echo "Poblacion (" . sizeof($this->poblacion) . "):\n";
        foreach ($this->poblacion as $key => $value) {
            echo $value;
            if ($guardarEnDisco) {
                $resultado .= $value->log();
            }
        }
        file_put_contents("aglog-" . $this->fecha . ".txt", $resultado, FILE_APPEND);

//        echo "Padres (" . sizeof($this->padres) . "):\n";
//        foreach ($this->padres as $key => $value) {
//            echo $value;
//        }
    }

}
