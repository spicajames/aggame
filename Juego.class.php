<?php

/**
 * Description of Juego
 *
 * @author cirsisjab
 */
class Juego {

    private $tablero;
    private $carro;
    private $p_obstaculos = 8;
    private $nivelActual = 0;

    public function __construct($carro, $p_obstaculos = 8) {
        $this->p_obstaculos = $p_obstaculos;
        $this->setCarro($carro);
        $this->tablero = new Tablero($this->getCarro());
//        $this->ver(0);
//        $this->moverse(4);
//        $this->ver(0);
//        $this->verEstado();
    }

    public function jugar($velocidad = 0, $ver = false) {
//        $nivel = 0;
        if ($ver) {
            $this->verEstado();
        }
        do {
            $colision = $this->avanzar();
            $adn = $this->getCarro()->getAdn();
            $detectarCicloInfinito = 0;
            for ($index = 0; $index < count($adn); $index++) {
                $detectarCicloInfinito++;
                if ($index == 0) {
                    $colisionInminente = $this->colisionInminente();
                    if ($colisionInminente)
                        $this->nivelActual++;
                }

                $instruccion = $adn[$index];

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
                    case "m": $this->moverse($partes[1]);
                        break;
                    default:
                        break;
                }

                if ($ver) {
                    $this->verEstado($index);
                }
                if ($detectarCicloInfinito > 10) {

                    $colision = true;
                    $this->nivelActual = 0;
                    $index = count($adn);
                }
            }

//            $nuevaPosicion = $this->carro->moverse();
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
        $posicionAnterior = $this->getCarro()->getPosicionActual();
        $columna = $posicionAnterior + $posicionRelativa;
        if ($columna < 0)
            $columna = 0;
        if ($columna >= 5)
            $columna = 4;
        $this->getTablero()->setCarro($columna);
        $this->getCarro()->setPosicionActual($columna);
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

    public function verEstado($index = -1) {
//        system("clear");        
//        echo $this->getTablero();
//        echo $this->getCarro();
        $cadena = "";
        $cadena .= $this->getTablero();
        $cadena .= $this->getCarro();
        $cadena .="Obstaculos evitados: " . $this->nivelActual . "\n";

        if ($index >= 0) {
            $adn = $this->getCarro()->getAdn();
            if ($index < sizeof($adn)) {
                $instruccion = $adn[$index];
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
        for ($fila = 1; $fila < 10; $fila++) {
            $carretera[$fila] = $carretera[$fila + 1];
        }
        for ($columna = 0; $columna < 5; $columna++) {
            $aleatorio = " ";
            if (mt_rand(1, 100) < $this->p_obstaculos) {
                $aleatorio = $this->getTablero()->getC_obstaculo();
            }
            $carretera[10][$columna] = $aleatorio;
        }
        $this->getTablero()->setCarretera($carretera);
        return false;
    }

}
