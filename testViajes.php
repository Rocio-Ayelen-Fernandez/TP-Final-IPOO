<?php

include_once 'Empresa.php';
include_once 'Persona.php';
include_once 'Pasajero.php';
include_once 'Responsable.php';
include_once 'Viaje.php';



// creo un obj Viaje
$objViaje = new Viaje();
//Creo un obj Empresa
$objEmpresa = new Empresa();

//VARIABLES
$arregloDatos = [];
$colViaje =[];


    echo "**********************\nBienvenido al sistema\n**********************\n";
    
    /**
     * Cargar Empresa
     * Cargar Viaje
     * Cargar Pasajero
     * Cargar Responsable
     * 
     * 
     * Listar Empresas
     * Listar Viaje
     * Listar Pasajero
     * Listar Responsable
     * 
     * --------Modificar--------
     * Verificar si hay Empresa -> Modificar Empresa
     * Verificar si hay Viaje -> Modificar Viaje
     * Verificar si hay Pasajero -> Modificar Pasajero
     * Verificar si hay Responsable -> Modificar Responsable
     */

     //Agregar empresa
     echo "***************\nCargar una Empresa\n***************\n";
     //Cargo los datos
     echo "Ingrese el nombre de la empresa\n";
     $nombre = trim(fgets(STDIN));
     echo "Ingrese la direccion de la empresa\n";
     $direccion = trim(fgets(STDIN));
     
     //cargar($idemp, $nom, $dir, $colViajes){
     
      $objEmpresa->cargar(
         count($objEmpresa->listar()),
         $nombre,
         $direccion, 
         []
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
     


    echo "Elija una opcion\n";
    echo "1. Cargar datos\n 2. Listar Datos\n3. Modificar Datos\n4. Salir\n";
    $opcion = trim(fgets(STDIN));
    while ($opcion !=4){
        switch ($opcion) {
            case 1:
                echo "--------------CARGAR DATOS--------------\n";
                echo "Elija una opcion\n";
                echo "1. Cargar Empresa\n2. Cargar Viaje\n3. Cargar Pasajero\n4. Cargar Responsable\n5. Salir";
                $opcionCargar= trim(fgets(STDIN));

                while($opcionCargar != 5){
                    switch($opcionCargar){
                        case 1:
                            
                            echo "***************\nCargar una Empresa\n***************\n";
                            //Cargo los datos
                            echo "Ingrese el nombre de la empresa\n";
                            $nombre = trim(fgets(STDIN));
                            echo "Ingrese la direccion de la empresa\n";
                            $direccion = trim(fgets(STDIN));
                            
                            //cargar($idemp, $nom, $dir, $colViajes){
                            
                             $objEmpresa->cargar(
                                count($objEmpresa->listar()),
                                $nombre,
                                $direccion, 
                                $coleccionViajes
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

                            $respuesta = $objViaje->insertar();
                            // Inserto el OBj Empresa en la base de datos
                            if ($respuesta == true) {
                                echo "\nOP INSERCION;  La Empresa fue ingresada en la BD";
                                $colViaje = $objViaje->listar();
                                foreach ($colViaje as $viaje) {
                                    echo $viaje;
                                    echo '-------------------------------------------------------';
                                }
                            } else {
                                echo $objViaje->getmensajeoperacion();
                            }

                            break;
                        case 3:
                            if(count($colViaje)>0 && count($colEmpresa)>0){
                                echo "***************\nCargar un Pasajero\n***************\n";
                                echo "Ingrese un número de documento: \n";
                                $arregloDatos["nrodoc"] = trim(fgets(STDIN));
    
                                echo "Ingrese un nombre: \n";
                                $arregloDatos["nomb"] = trim(fgets(STDIN));
                                
                                echo "Ingrese un apellido: \n";
                                $arregloDatos["ape"] = trim(fgets(STDIN));
                                
                                echo "Ingrese un teléfono: \n";
                                $arregloDatos["tel"]  = trim(fgets(STDIN));
                                
                                echo "Ingrese el ID del viaje: \n";

                                //Busca viaje por id
                                $coleccion = $colEmpresa->getColViaje();


                                if(false){

                                }
                                

                            }else{
                                echo "No hay viajes disponibles\n";
                            }
                            
                            


                            break;
                        case 4:
                            echo "***************\nCargar un responsable\n***************\n";

                            /**parent::cargar($nrodoc, $nomb, $ape, $tel);
                            *nroDocumento -> ['nrodoc']);
                            *nombre -> ['nomb']);
                            *apellido['ape']);
                            *telefono -> ['tel']); 
                            *numeroEmpleado -> ['numEmpleado']);
                            *numero Licencia['numLicencia']); */
                            
                            //Cargo los datos
                            
                            echo "Ingrese un número de documento: \n";
                            $arregloDatos["nrodoc"] = trim(fgets(STDIN));

                            echo "Ingrese un nombre: \n";
                            $arregloDatos["nomb"] = trim(fgets(STDIN));
                            
                            echo "Ingrese un apellido: \n";
                            $arregloDatos["ape"] = trim(fgets(STDIN));
                            
                            echo "Ingrese un teléfono: \n";
                            $arregloDatos["tel"]  = trim(fgets(STDIN));
                            
                            echo "Ingrese un número de empleado: \n";
                            $arregloDatos["numEmpleado"] = trim(fgets(STDIN));

                            echo "Ingrese un número de licencia: \n";
                            $arregloDatos["numLicencia"] = trim(fgets(STDIN));


                            //cargar($idemp, $nom, $dir, $colViajes){
                            
                             $objResponsable->cargar(
                                $arregloDatos
                            );
                        
                            $respuesta = $objResponsable->insertar();
                            // Inserto el OBj Responsable en la base de datos
                            if ($respuesta == true) {
                                echo "\nOP INSERCION;  El Responsable fue ingresado en la BD";
                                $colResponsable = $objResponsable->listar();
                                foreach ($colResponsable as $responsable) {
                                    echo $responsable;
                                    echo '-------------------------------------------------------';
                                }

                                //QUITAR LISTAR LUEGO
                            } else {
                                echo $objResponsable->getmensajeoperacion();
                            }
                            break;
                           
                        case 5:
                            echo "Menu anterior\n";
                            break;
                        default:
                            echo "La opcion no se encuentra disponible\n";
                            break;
                    }
                }
                break;
            case 2:
                echo "--------------LISTAR DATOS--------------\n";
                echo "Elija una opcion\n";
                echo "1. Listar Empresa\n2. Listar Viaje\n3. Listar Pasajero\n4. Listar Responsable\n5. Salir";
                $opcionListar= trim(fgets(STDIN));
                break;

                

            case 3:
                echo "--------------MODIFICAR DATOS--------------\n";
                echo "Elija una opcion\n";
                echo "1. Modificar Empresa\n2. Modificar Viaje\n3. Modificar Pasajero\n4. Modificar Responsable\n5. Salir";
                $opcionModificar= trim(fgets(STDIN));
                break;
            case 4:
                echo "Adios";
                break;
            default:
                echo "La opcion no se encuentra disponible\n";
                break;
        }
    }
/*
    echo "1. Cargar una Empresa\n2. Cargar un Viaje\n3. Listar Empresas\n4. Listar Viajes\n5. Salir\n";
    $opcion = trim(fgets(STDIN));

    while ($opcion != 5) {
        switch ($opcion) {
            case 1:
                

                

                break;
            case 2:
                echo "***************\nCargar un Viaje\n***************\n";
                

                
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
*/
/**-------------FUNCIONES-------------**/

// function verificarPasajero($objViaje, $numDoc)
// {
// }

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


?>
