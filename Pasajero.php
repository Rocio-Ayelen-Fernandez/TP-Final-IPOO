<?php
include_once "BaseDatos.php";

class Pasajero extends Persona {
    private $objViaje;
    
    
 

    public function __construct(){
        parent::__construct(); // Llama al constructor de la clase padre (Persona)
        $this->objViaje = "";
    }

    public function setObjViaje($objViaje){
        $this->objViaje = $objViaje;
        
    }
    public function getObjViaje(){
        return $this->objViaje;
        
    }

    public function cargar($param){
        parent::cargar($param);
        $this->setObjViaje($param['objViaje']);
    }

    public function buscar($nrodoc){
        
        $base = new BaseDatos();
        $consultaResponsable = "SELECT * FROM pasajero WHERE numdocPasajero = " . $nrodoc;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaResponsable)) {
                if ($row = $base->Registro()) {
                    $this->setNrodoc($row['numdocPasajero']);
                   
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

    public function listar($condicion = ""){
        $arregloPasajero = null;
        $base = new BaseDatos();
        $consultaPasajero = "SELECT * FROM pasajero ";
        if ($condicion != "") {
            $consultaPasajero = $consultaPasajero . ' WHERE ' . $condicion;
        }
        $consultaPasajero .= " ORDER BY apellido ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPasajero)) {
                $arregloPasajero = array();
                while ($row2 = $base->Registro()) {
                    $NroDoc = $row2['nrodoc'];
                    $idViaje = $row2['idViaje'];
                    $pasajero = new Pasajero();

                    $persona = parent::listar("nrodoc = ".$NroDoc);
                    $pasajero->cargar(['nomb'=> $persona["nomb"], 'nrodoc' => $NroDoc, 'ape'=> $persona["ape"], 'tel' => $persona["tel"], "objViaje"=>$idViaje]);
                    
                    array_push($arregloPasajero, $pasajero);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloPasajero;
    }



    public function insertar(){
        //Inserta los datos a la tabla persona
        parent::insertar();

        $base = new BaseDatos();
        $resp = false;
        // Se insertan los datos del pasajero en la tabla pasajero
        $consultaInsertar = "INSERT INTO pasajero (numdocPasajero, idviaje) VALUES ('" . parent::getNrodoc() ."','" .$this->getObjViaje()->getIdviaje().")";
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
        parent::modificar();
        $resp = false;
        $base = new BaseDatos();
        // Se actualizan los datos del pasajero en la tabla pasajero
        $consultaModifica = "UPDATE pasajero SET numdocPasajero= ". $this->getNrodoc() . ", idviaje= ".$this->getObjViaje()->getIdviaje(). " WHERE numdocPasajero=" . $this->getNrodoc() . " ";
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
        parent::eliminar();//preguntar si es necesario
        $base = new BaseDatos();
        $resp = false;
        // Se elimina el pasajero de la tabla pasajero
        $consultaEliminar = "DELETE FROM pasajero WHERE numdocPasajero='" . $this->getNrodoc() . "'";
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
        $resultado = parent::__toString(); // Obtener la representación de la clase padre (Persona)
        $resultado.= "Viaje: \n".$this->getObjViaje();
     
        return $resultado;
    }
    
}