<?php

/**
 * Description of Juego
 *
 * @author cirsisjab
 */
class Juego2 {

    private $tablero;
    private $carro;
    private $p_obstaculos = 8;
    private $nivelActual = 0;
    private $velocidad;
    private $parametrosTablero;
    private $ptableroactual = 0;
    private $instruccionesUsadas = array();

    public function __construct($carro, $p_obstaculos = 8, $parametrosTablero = null) {
        $this->p_obstaculos = $p_obstaculos;
        $this->parametrosTablero = $parametrosTablero;
        $this->setCarro($carro);
        $this->tablero = new Tablero($this->getCarro());
    }

    public function jugar($velocidad = 0, $ver = false) {
        $this->velocidad = $velocidad;
        if ($ver) {
            $this->verEstado();
        }
        $adn = $this->getCarro()->getAdn();
        $sadn = sizeof($adn);
        do {
            $colision = $this->avanzar();
            if ($colision) {
                break;
            }
            $detectarCicloInfinito = 0;
            for ($index = 0; $index < count($adn); $index++) {
                $detectarCicloInfinito++;
//                $this->replaceOut("------------->" . $detectarCicloInfinito . "");
                if ($index == 0) {
                    $colisionInminente = $this->colisionInminente();
                    if ($colisionInminente)
                        $this->nivelActual++;
                }

                $instruccion = $adn[$index];
                $this->instruccionesUsadas[] = $index;
                $this->instruccionesUsadas = array_unique($this->instruccionesUsadas);
//                var_dump($this->instruccionesUsadas);
//                exit();


                $partes = array(substr($instruccion, 0, 1), intval(substr($instruccion, 1, strlen($instruccion) - 1)));
                if ($velocidad > 0)
                    usleep($velocidad);
                switch ($partes[0]) {
                    case "v": $this->ver($partes[1]);
                        break;
                    case "c": $this->verificarColision($partes[1]);
                        break;
                    case "s": $index = $this->verificarSalto($index, $partes[1]);
                        break;
                    case "t": $index = $this->terminar(count($adn));
                        break;
                    case "m": $colision = $this->moverse($partes[1]);
                        break;
                    default:
                        break;
                }

                if ($ver) {
                    $this->verEstado($index);
                }
                if ($detectarCicloInfinito > $sadn) {
                    $colision = true;
                    $this->nivelActual = 0;
                    $index = count($adn);
                    break;
                }
                if ($colision) {
                    break;
                }
            }
            if ($ver) {
                $this->verEstado($index);
            }
            if ($velocidad > 0)
                usleep($velocidad);
        } while (!$colision);
        return $this->nivelActual;
    }

    public function terminar($fin) {
        return $fin;
    }

    public function verificarColision($columna) {
        if (sizeof($this->carro->memoriaVisual) > 0) {
            if ($columna == 5) {
                $columna = $this->carro->getPosicionActual();
            }
            if ($this->carro->memoriaVisual[$columna] === 0) {
                array_push($this->carro->memoria, 1);
                return true;
            }
        }
        return false;
    }

    public function colisionInminente() {
        if ($this->tablero->carretera[1][$this->carro->getPosicionActual()] !== " ") {
            return true;
        }
        return false;
    }

    public function verificarSalto($index, $linea) {
        $memoriaActual = array_pop($this->carro->memoria);
        if ($memoriaActual == 1) {
            return $linea - 1;
        }
        return $index;
    }

    public function ver($linea) {
        $memoria = $this->getTablero()->verLinea($linea);
        $this->getCarro()->setMemoriaVisual($memoria);
    }

    public function moverse($posicionRelativa) {
        $movimientos = abs($posicionRelativa);
        $direccion = 1;
        if ($posicionRelativa < 0) {
            $direccion = -1;
        }

        if ($movimientos > 1) {
            for ($paso = 0; $paso < $movimientos; $paso++) {
                $colision = $this->darPaso($direccion);

                if ($colision)
                    return true;
            }
            return false;
        } else {
            return $this->darPaso($posicionRelativa);
        }
    }

    private function darPaso($posicionRelativa) {
        if ($this->velocidad > 0)
            usleep($this->velocidad);
        $posicionAnterior = $this->getCarro()->getPosicionActual();
        $columna = $posicionAnterior + $posicionRelativa;
        if ($columna < 0)
            $columna = 0;
        if ($columna >= 5)
            $columna = 4;
        $colision = $this->getTablero()->setCarro($posicionAnterior, $columna);
//        var_dump($colision);
        if (!$colision) {
            $this->getCarro()->setPosicionActual($columna);
        }
        return $colision;
    }

    public function getTablero() {
        return $this->tablero;
    }

    public function getCarro() {
        return $this->carro;
    }

    public function setTablero($tablero) {
        $this->tablero = $tablero;
    }

    public function setCarro($carro) {
        $this->carro = $carro;
    }

    public function replaceOut($str) {
        $numNewLines = substr_count($str, "\n");
        echo chr(27) . "[0G"; // Set cursor to first column
        echo $str;
        echo chr(27) . "[" . $numNewLines . "A"; // Set cursor up x lines
    }

    private function colorearUsadas($adn) {
        if (sizeof($this->instruccionesUsadas) > 0) {
            $nuevoAdn = array();
            for ($index = 0; $index < count($adn); $index++) {
                if (in_array($index, $this->instruccionesUsadas)) {
                    $colors = new Colors();
                    $instruccion = $colors->getColoredString($adn[$index], "black", "light_gray");
//                    echo "entre"; echo $instruccion; exit();
                    $nuevoAdn[] = $instruccion;
                } else {
                    $nuevoAdn[] = $adn[$index];
                }
            }
            return $nuevoAdn;
        }
        return $adn;
    }

    public function verEstado($index = -1) {
//        system("clear");        
//        echo $this->getTablero();
//        echo $this->getCarro();
        $cadena = "";
        $cadena .= $this->getTablero();
        $cadena .= $this->getCarro();
        $cadena .="Tablero: " . implode("-", $this->parametrosTablero) . "\n";
        $cadena .="Obstaculos evitados: " . $this->nivelActual . "\n";

        if ($index >= 0) {
            $adn = $this->getCarro()->getAdn();
            if ($index < sizeof($adn)) {
                $instruccion = $adn[$index];
                $adn = $this->colorearUsadas($adn);

                $parte1 = array_slice($adn, 0, $index);
                $parte2 = array_slice($adn, $index + 1, sizeof($adn));

                $colors = new Colors();
                $instruccion = $colors->getColoredString($instruccion, "white", "red");
                $ninstrucciones = array_merge($parte1, array($instruccion), $parte2);
                for ($index = 0; $index < count($ninstrucciones); $index = $index + 40) {
                    $cadena .= implode(",", array_slice($ninstrucciones, $index, 40)) . "\n";
                }
            }
        }
        $this->replaceOut($cadena);
    }

    public function avanzar() {
        $carretera = $this->getTablero()->getCarretera();
        if ($carretera[1][$this->getCarro()->getPosicionActual()] === $this->getTablero()->getC_obstaculo()) {
            return true;
        }

        /**
         * Mover las filas existentes
         */
        for ($fila = 0; $fila < 10; $fila++) {
            if ($fila == 0) {
                /**
                 * Mover la primera fila si repintar el carro si no es necesario
                 */
                for ($columna = 0; $columna < 5; $columna++) {
                    if ($columna != $this->getCarro()->getPosicionActual()) {
                        $carretera[$fila][$columna] = $carretera[$fila + 1][$columna];
                    }
                }
            } else {
                $carretera[$fila] = $carretera[$fila + 1];
            }
        }
        /**
         * Crear la nueva fila que apenas se hace visible
         */
        if (is_null($this->parametrosTablero)) {
            echo "queeeeeee!";
            exit();
//        for ($columna = 0; $columna < 5; $columna++) {
//            $aleatorio = " ";
//            if (mt_rand(1, 100) < $this->p_obstaculos) {
//                $aleatorio = $this->getTablero()->getC_obstaculo();
//            }
//            $carretera[10][$columna] = $aleatorio;
//        }
        } else {
            $carretera[10] = $this->calcularSiguienteLinea();
        }
        $this->getTablero()->setCarretera($carretera);
        return false;
    }

    private function calcularSiguienteLinea() {
        $i = $this->parametrosTablero[0];
        $a = $this->parametrosTablero[1];
        $b = $this->parametrosTablero[2];
        $c = $this->parametrosTablero[3];

        $fila = array();
        for ($columna = 0; $columna < 5; $columna++) {
            $t = $this->ptableroactual;
            $x = $i * cos($a * $t) - cos($b * $t) * sin($c * $t);
            $this->ptableroactual++;
            if (round($x) == 0) {
                $fila[] = $this->tablero->getC_obstaculo();
            } else {
                $fila[] = " ";
            }
        }
        $this->ptableroactual = $t;


//                        var_dump($fila);
//                exit();

        return $fila;
    }

}
