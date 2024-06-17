<?php
include_once "BaseDatos.php";

class Responsable extends Persona {
    private $numeroEmpleado;
    private $numeroLicencia;

    public function __construct(){
        parent::__construct(); // Llama al constructor de la clase padre (Persona)
        $this->numeroEmpleado = "";
        $this->numeroLicencia = "";
    }

    public function cargar($param){
    //  parent::cargar($nrodoc, $nomb, $ape, $tel);
        parent::cargar($param);
        $this->setNumeroEmpleado($param['numEmpleado']);
        $this->setNumeroLicencia($param['numLicencia']);
    }

    public function setNumeroEmpleado($rnumemp){
        $this->numeroEmpleado = $rnumemp;
    }

    public function setNumeroLicencia($rnumlic){
        $this->numeroLicencia = $rnumlic;
    }

    public function getNumeroEmpleado(){
        return $this->numeroEmpleado;
    }

    public function getNumeroLicencia(){
        return $this->numeroLicencia;
    }

    public function buscar($nrodoc){
        $base = new BaseDatos();
        $consultaResponsable = "SELECT * FROM responsable WHERE numeroDocumentoRes = " . parent::getNrodoc();
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaResponsable)) {
                if ($row = $base->Registro()) {
                    $this->setNrodoc($row['numeroDocumentoRes']);
                    $this->setNumeroEmpleado($row['numeroEmpleado']);
                    $this->setNumeroLicencia($row['numeroLicencia']);
                    $resp = true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function insertar(){
        parent::insertar(); // Asegura que la inserción en Persona se realice primero
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO responsable (numeroDocumentoRes, numeroEmpleado, numeroLicencia) VALUES ('" . $this->getNrodoc() . "','" . $this->getNumeroEmpleado() . "','" . $this->getNumeroLicencia() . "')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaInsertar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function modificar(){
        parent::modificar(); // Asegura que la modificación en Persona se realice primero
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE responsable SET numeroEmpleado='" . $this->getNumeroEmpleado() . "', numeroLicencia='" . $this->getNumeroLicencia() . "' WHERE numeroDocumentoRes=" . $this->getNrodoc();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $base = new BaseDatos();
        $resp = false;
        $consultaEliminar = "DELETE FROM responsable WHERE numeroDocumentoRes=" . $this->getNrodoc();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaEliminar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function __toString(){
        return "Número de Documento: " . $this->getNrodoc() . "\n" .
               "Número de Empleado: " . $this->getNumeroEmpleado() . "\n" .
               "Número de Licencia: " . $this->getNumeroLicencia() . "\n";
    }
}
?>
