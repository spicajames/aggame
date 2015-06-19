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
    private $poblacionInicial;
    private $desempeñoTotal;
    private $padres;
    private $hijos;
    private $fecha;
    private $idEjecucion;
    private $nombre;
    private $tableros;
    private $verEstado;
    private $generacionInicial = 0;

    public function getGeneracionInicial() {
        return $this->generacionInicial;
    }

    public static function continuar($ejecucionId) {
        $db = new Db();

        $this->idEjecucion = $ejecucionId;
        $rejecucion = $db->obtenerEjecucion($ejecucionId);

        $this->generacionInicial = $rejecucion['generacionActual'];

        $tableros = $db->obtenerPruebas($ejecucionId);

        $instance = new self(
                $rejecucion['tpoblacion'], $rejecucion['tadnminimo'], $rejecucion['tadnmaximo'],
                $rejecucion['npruebas'], $rejecucion['pmutacion'], $rejecucion['telite'], 
                $rejecucion['poblacionInicial'], $tableros, false
        );
        return $instance;
    }

    public function __construct($tamañoPoblacion = 30, $tamañoADNMinimo = 15, $tamañoADNMaximo = 100,
            $numeroPruebas = 100, $mutacion = 25, $tamañoElite = 3, $poblacionInicial = null, 
            $tableros = null, $verEstado = false) {
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
        $this->poblacionInicial = $poblacionInicial;
        $this->tamañoElite = $tamañoElite;
        $this->tableros = $tableros;
        $this->verEstado = $verEstado;

        date_default_timezone_set('Etc/GMT+5');
        $this->fecha = date("Ymd-His");

        $rejecucion['tpoblacion'] = $this->tamañoPoblacion;
        $rejecucion['tadnminimo'] = $this->tamañoADNMinimo;
        $rejecucion['tadnmaximo'] = $this->tamañoADNMaximo;
        $rejecucion['npruebas'] = $this->numeroPruebas;
        $rejecucion['pmutacion'] = $this->mutacion;
        $rejecucion['telite'] = $this->tamañoElite;

        $cadenaParametros = implode("-", $rejecucion);

        $this->nombre = md5($cadenaParametros);
        $rejecucion['nombre'] = $this->nombre;

        if (!isset($this->idEjecucion)) {
            $db = new Db();
            $this->idEjecucion = $db->grabarEjecucion($rejecucion);
            $db->grabarPruebas($this->idEjecucion, $this->tableros);
        }
        $this->mostrarInicializacion();
    }

    private function mostrarInicializacion() {
        $resultado = "";
        $resultado .= " Po: " . $this->tamañoPoblacion;
        $resultado .= " Ami: " . $this->tamañoADNMinimo;
        $resultado .= " Amx: " . $this->tamañoADNMaximo;
        $resultado .= " Pr: " . $this->numeroPruebas . " ";
        $resultado .= " M: " . $this->mutacion;
        $resultado .= " Te: " . $this->tamañoElite;
        if (sizeof($this->poblacionInicial) > 0) {
            $resultado .= " Elite: \n";
            foreach ($this->poblacionInicial as $value) {
                $resultado.= implode(",", $value->getAdn()) . "\n";
            }
        }

        if (!is_null($this->tableros)) {
            $resultado .= "\nTableros:\n";
            foreach ($this->tableros as $tablero) {
                $resultado .= implode("-", $tablero) . "\n";
            }
        }

        file_put_contents("aglog-" . $this->fecha . ".txt", $resultado, FILE_APPEND);
    }

    public function generarPoblacionInicial() {
        $this->poblacion = array();
        for ($index = 0; $index < $this->tamañoPoblacion; $index++) {
            if (isset($this->poblacionInicial[$index])) {
                $this->poblacion[] = $this->poblacionInicial[$index];
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
                $juego = new Juego2($this->poblacion[$ipoblacion], null, $this->tableros[$ipruebas]);
                $velo = 0;
                if ($this->verEstado) {
                    $velo = 10000;
                }
                $nivel += $juego->jugar($velo, $this->verEstado);
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

    public function mostrarPoblacion($generacion = 0, $guardar = false) {
        $resultadodb = array();
        date_default_timezone_set('Etc/GMT+5');
        $resultado = "" . date("Ymd-His");
        $resultado .= " Generacion: " . $generacion . " Poblacion: " . sizeof($this->poblacion) . "\n";

        $rgeneracion['numero'] = $generacion;
        $rgeneracion['ejecucion'] = $this->idEjecucion;
        $db = new Db();
        $generacionId = $db->grabarGeneracion($rgeneracion);

//        $resultadodb["generacion"] = $generacion;
        $resultadodb["generacion_id"] = $generacionId;

        echo "Poblacion (" . sizeof($this->poblacion) . "):\n";
        $individuo = 0;
        foreach ($this->poblacion as $key => $value) {
            echo $value;
            $resultadodb["individuo"] = $individuo;
            $individuo++;
            if ($guardar) {
                $resultado .= $value->log();
                $resultadodb = $value->dbLog($resultadodb);
                $db = new Db();
                $db->grabarRegistro($resultadodb);
            }
        }
        file_put_contents("aglog-" . $this->fecha . ".txt", $resultado, FILE_APPEND);




//        echo "Padres (" . sizeof($this->padres) . "):\n";
//        foreach ($this->padres as $key => $value) {
//            echo $value;
//        }
    }

}
