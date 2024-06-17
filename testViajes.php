<?php

include_once 'Empresa.php';
include_once 'Persona.php';
include_once 'Pasajero.php';
include_once 'Responsable.php';
include_once 'Viaje.php';

/**-------------FUNCIONES-------------**/

// creo un obj Viaje
$objViaje = new Viaje();
//Creo un obj Empresa
$objEmpresa = new Empresa();


    echo "**********************\nBienvenido al sistema\n**********************\n";
    echo "Elija una opcion\n";
    echo "1. Cargar una Empresa\n2. Cargar un Viaje\n3. Listar Empresas\n4. Listar Viajes\n5. Salir\n";
    $opcion = trim(fgets(STDIN));

    


    while ($opcion != 3) {
        switch ($opcion) {
            case 1:
                echo "***************\nCargar una Empresa\n***************\n";

                //Cargo los datos
                echo "Ingrese el nombre de la empresa\n";
                $nombre = trim(fgets(STDIN));
                echo "Ingrese la direccion de la empresa\n";
                $direccion = trim(fgets(STDIN));

                //public function cargar($idemp, $nom, $dir)
                 $objEmpresa->cargar(
                    count($objEmpresa->listar()),
                    $nombre,
                    $direccion
                );

                $respuesta = $objEmpresa->insertar();
                // Inserto el OBj Empresa en la base de datos
                if ($respuesta == true) {
                    echo "\nOP INSERCION;  La Empresa fue ingresada en la BD";
                    $colEmpresa = $objEmpresa->listar();
                    foreach ($colEmpresa as $empresa) {
                        echo $empresa;
                        echo '-------------------------------------------------------';
                    }
                } else {
                    echo $objEmpresa->getmensajeoperacion();
                }

                break;
            case 2:
                echo "***************\nCargar un Viaje\n***************\n";
                

                //Cargo los datos del viaje
                echo "Ingrese el destino del viaje\n";
                $destino = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros en el viaje\n";
                $cantidad = trim(fgets(STDIN));
                echo "Ingrese el ID de la Empresa encargada\n";
                $idEmpresa = trim(fgets(STDIN));
                echo "Ingrese el numero del Responsable\n";
                $numResponsable = trim(fgets(STDIN));
                echo "Ingrese el valor del pasaje\n";
                $valor = trim(fgets(STDIN));

                //cargar($idv, $dest, $cantmax, $idemp, $numemp, $importe)
                $objViaje->cargar(
                    count($objViaje->listar()),
                    $destino,
                    $cantidad,
                    $idEmpresa,
                    $numResponsable,
                    $valor
                );
                break;
            case 3:
                echo "***************\nListar Empresas\n***************\n";
                //Busco todas las empresas en la BD
                $coleccion = $objEmpresa->listar();
                foreach ($coleccion as $obj) {
                    echo $obj;
                    echo '-------------------------------------------------------';
                }

                break;
            case 4:
                echo "***************\nListar Viajes\n***************\n";
                //Busco todos los viajes almacenadas en la BD
                $coleccion = $objViaje->listar();
                foreach ($coleccion as $obj) {
                    echo $obj;
                    echo '-------------------------------------------------------';
                }

                break;
            default:
                echo "La opcion elegida no se encuentra disponible\n";
                break;
        }

        echo "Elija una opcion\n";
        echo "1. Cargar una Empresa\n2. Cargar un Viaje\n3. Listar Empresas\n4. Listar Viajes\n5. Salir\n";
        $opcion = trim(fgets(STDIN));
        echo "*****************************************************\n";
    }

    echo "Adios\n";


function verificarPasajero($objViaje, $numDoc)
{
}

/**
 * Devuelve un valor dependiendo si hay espacio disponible en un viaje en especifico
 * @param OBJ $objViaje
 * @param OBJ $objPasajero
 * @return BOOLEAN
 */
function hayPasajesDisponible($objViaje, $objPasajero)
{
    $valor = false;
    $consulta = 'idViaje = ' . $objViaje->getIdviaje();
    $pasajerosEnViaje = $objPasajero->listar('idviaje = ');
    //Si la cantidad de pasajeros es menor, al menos hay un lugar disponible, devuelve true
    if (count($pasajerosEnViaje) < $objViaje->getVcantmaxpasajeros()) {
        $valor = true;
    }
    return $valor;
}

function venderPasaje($objViaje, $objPasajero)
{
    if (hayPasajesDisponible($objViaje, $objPasajero)) {
        //Instrucciones para insertar un pasajero

        $respuesta = $objPasajero->insertar();
        // Inserto el OBj Pasajero en la base de datos
        if ($respuesta == true) {
            echo "\nOP INSERCION;  La Persona fue ingresada en la BD";
            $colPersonas = $objPasajero->listar();
            foreach ($colPersonas as $pasajero) {
                echo $$pasajero;
                echo '-------------------------------------------------------';
            }
        } else {
            echo $obj_Persona->getmensajeoperacion();
        }
    }
}

function agregarPasajero()
{
}

function modificarViaje()
{
}

?>
