<?php

/**
 * Description of Tablero
 *
 * @author cirsisjab
 */
class Tablero {

    public $carretera;
    private $c_obstaculo = 0;

    public function __construct(Carro $carro) {
        for ($fila = 0; $fila <= 10; $fila++) {
            for ($columna = 0; $columna <= 4; $columna++) {
                $aleatorio = " ";
//                if (mt_rand(1, 100) > 80)
//                    $aleatorio = 1;
                $this->carretera[$fila][$columna] = $aleatorio;
                if ($fila == 0) {
                    $this->carretera[$fila][$columna] = " ";
                    if ($columna == $carro->getPosicionActual()) {
                        $this->carretera[$fila][$columna] = "A";
                    }
                }
            }
        }
    }

    public function verLinea($linea) {
        return $this->getCarretera()[$linea];
    }

    public function setObstaculo($fila, $columna) {
        $this->carretera[$fila][$columna] = $c_obstaculo;
    }

    public function removeObstaculo($fila, $columna) {
        $this->carretera[$fila][$columna] = " ";
    }

    public function __toString() {
        $resultado = "";
        for ($fila = 10; $fila >= 0; $fila--) {
            for ($columna = 0; $columna <= 4; $columna++) {
                $resultado .= $this->carretera[$fila][$columna];
            }
            $resultado .= "\n";
        }
        return $resultado;
    }

    public function getCarretera() {
        return $this->carretera;
    }

    public function setCarretera($carretera) {
        $this->carretera = $carretera;
    }

    public function setCarro($anterior, $nueva) {
        if ($this->carretera[0][$nueva] === $this->c_obstaculo) {
            return true;
        }
        if ($anterior != $nueva) {
            $this->carretera[0][$anterior] = " ";
            $this->carretera[0][$nueva] = "A";
        }
        return false;
    }

    public function getC_obstaculo() {
        return $this->c_obstaculo;
    }

    public function setC_obstaculo($c_obstaculo) {
        $this->c_obstaculo = $c_obstaculo;
    }

}
