<?php

/**
 * Description of Carro
 *
 * @author cirsisjab
 */
class Carro {

    private $adn;
    private $nombre;
    private $posicionActual;
    public $memoria = array();
    public $memoriaVisual = array();
    private $desempeño;

    public function getNombre() {
        return $this->nombre;
    }

    public function getDesempeño() {
        return $this->desempeño;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDesempeño($desempeño) {
        $this->desempeño = $desempeño;
    }

    public function __construct($adn) {
        $this->setPosicionActual(2);
        $this->setAdn($adn);
        $this->nombre = $this->generarNombre();
    }

    private function generarNombre() {
        return md5(implode("", $this->getAdn()));
    }

    public function colision($columna) {
        if ($this->memoriaVisual[$columna] !== " ") {
            array_push($this->memoria, array($columna, 0));
            return true;
        }
        return false;
    }

    public function moverse() {
        $actual = array_pop($this->memoria);
//        print_r($actual);
        if ($actual[1] !== " " && $actual[0] == $this->posicionActual) {
            $aleatorio = mt_rand(1, 0);
            if ($aleatorio == 1) {
                $npos = $this->posicionActual - 1;
                if ($npos == -1)
                    return($this->posicionActual + 1);
                return $npos;
            }
            else {
                $npos = $this->posicionActual + 1;
                if ($npos == 5)
                    return($this->posicionActual - 1);
                return $npos;
            }
        }
        return -1;
    }

    public function getPosicionActual() {
        return $this->posicionActual;
    }

    public function getAdn() {
        return $this->adn;
    }

    public function getMemoria() {
        return $this->memoria;
    }

    public function setPosicionActual($posicionActual) {
        $this->posicionActual = $posicionActual;
    }

    public function setAdn($adn) {
        $this->adn = $adn;
    }

    public function setMemoria($memoria) {
        $this->memoria = $memoria;
    }

    public function getMemoriaVisual() {
        return $this->memoriaVisual;
    }

    public function setMemoriaVisual($memoriaVisual) {
        $this->memoriaVisual = $memoriaVisual;
    }

    public static function comparar(Carro $a, Carro $b) {
        if ($a->getDesempeño() == $b->getDesempeño()) {
            return 0;
        }
        return ($a->getDesempeño() > $b->getDesempeño()) ? -1 : 1;
    }

    public function __toString() {
        $cadena = "";
        $cadena .= "Nombre: " . $this->nombre . " ";
        $cadena .= "(" . str_pad($this->getDesempeño(), 3, " ", STR_PAD_LEFT) . ") ";

        $maxAdnSize = 80;

        $trailing = "";
        if (strlen(implode(",", $this->getAdn())) > $maxAdnSize)
            $trailing = "...";
        $cadena .= "Adn: (" . sizeof($this->getAdn()) . ") " . substr(implode(",", $this->getAdn()), 0, $maxAdnSize) . $trailing . "\n";

        return $cadena;
    }

    public function log() {
        $cadena = "";
        $cadena .= "Nombre: " . $this->nombre . " ";
        $cadena .= "(" . str_pad($this->getDesempeño(), 3, " ", STR_PAD_LEFT) . ") ";
        $cadena .= "Adn: (" . sizeof($this->getAdn()) . ") " . implode(",", $this->getAdn()) . "\n";
        return $cadena;
    }

    public function dbLog($base) {
        $registro['nombre'] = $this->nombre;
        $registro['desempeño'] = $this->getDesempeño();
        $registro['ninstrucciones'] = sizeof($this->getAdn());
        $registro['adn'] = implode(",", $this->getAdn());
        return(array_merge($base, $registro));
    }

//    public function __toString() {
//        $cadena = "Posicion Actual: " . $this->getPosicionActual() . " \n";
//        $cadena .= "Memoria Visual: " . "\n";
//        for ($index = 0; $index < count($this->getMemoriaVisual()); $index++) {
//            $cadena .= $this->getMemoriaVisual()[$index] . "";
//        }
//        $cadena .= "\nMemoria: \n";
//        for ($index = 0; $index < count($this->memoria); $index++) {
//            $cadena .= $this->memoria[$index] . " ";            
//        }
//        $cadena .= "\n";
////        var_dump($this->memoria);
//
//        return $cadena;
//    }
}
