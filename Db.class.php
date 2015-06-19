<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Db
 *
 * @author cirsisjab
 */
class Db {

    private $username = "root";
    private $password = "admin";
    private $hostname = "localhost";
    private $dbname = "aggametest";
    private $dbhandle;

    public function grabarRegistro($registro) {
        error_reporting(E_ALL);

        $db = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

        if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        $sql = "INSERT INTO  poblacion (
            id ,
            individuo ,
            generacion_id ,
            nombre ,
            desempeno ,
            ninstrucciones ,
            adn,
            fechahora
            )
            VALUES (NULL ,  '" . $registro['individuo'] . "',  '" . $registro['generacion_id'] . "',  '" . $registro['nombre'] . "',  '" . $registro['desempeño'] . "',  '" . $registro['ninstrucciones'] . "',  '" . $registro['adn'] . "',now())";

        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        }
    }

    public function grabarGeneracion($registro) {
        error_reporting(E_ALL);

        $db = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

        if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        $sql = "INSERT INTO  generacion (
            id ,
            ejecucion_id,
            numero,
            fechahora
            )
            VALUES (NULL ," . $registro['ejecucion'] . " , " . $registro['numero'] . ",now())";

        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        }
        return $db->insert_id;
    }

    public function grabarEjecucion($registro) {
        error_reporting(E_ALL);

        $db = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

        if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        $sql = "INSERT INTO  `ejecucion` (
            `id` ,
            `nombre` ,
            `tpoblacion` ,
            `tadnminimo` ,
            `tadnmaximo` ,
            `npruebas` ,
            `pmutacion` ,
            `telite` ,
            `fechahora`
            )
            VALUES (
            NULL ,  '" . $registro['nombre'] . "',  '" . $registro['tpoblacion'] . "',  '" . $registro['tadnminimo'] . "',  '" . $registro['tadnmaximo'] .
                "',  '" . $registro['npruebas'] . "',  '" . $registro['pmutacion'] . "',  '" . $registro['telite'] . "',  now()
            )";


        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        }
        return $db->insert_id;
    }

    public function obtenerEjecucion($ejecucionId) {
        error_reporting(E_ALL);

        $db = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

        if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        $sql = "SELECT * FROM ejecucion WHERE id = " . $ejecucionId;


        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        }

        $row = $result->fetch_assoc();
        return $row;
    }

    public function grabarPruebas($ejecucion_id, $tableros) {
        error_reporting(E_ALL);

        $db = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

        if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        foreach ($tableros as $tablero) {
            $sql = "INSERT INTO  `prueba` (
            `id` ,
            `ejecucion_id` ,
            `parametros`
            )
            VALUES (
            NULL ,  " . $ejecucion_id . ",  '" . implode(",", $tablero) . "')";


            if (!$result = $db->query($sql)) {
                die('There was an error running the query [' . $db->error . ']');
            }
        }
    }

    public function obtenerPruebas($ejecucionId) {
        error_reporting(E_ALL);

        $db = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

        if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

        $sql = "SELECT * FROM prueba WHERE ejecucion_id = " . $ejecucionId;


        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        }

        $resultados = array();
        while ($row = $result->fetch_assoc()) {
            $resultados[] = explode(",", $row['parametros']);
        }
        return $resultados;
    }

}
