<?php
require_once 'BaseDatos.php'; 

// se Crear una instancia de la clase BaseDatos
$baseDatos = new BaseDatos();

// Intentar iniciar la conexión
if ($baseDatos->Iniciar()) {
    echo "Conexión exitosa a la base de datos.\n";

    //consulta de prueba
    $consulta = "SELECT * FROM persona"; //
    if ($baseDatos->Ejecutar($consulta)) {
        echo "Consulta ejecutada exitosamente.\n";
        // Obtener y mostrar los resultados de la consulta
        while ($registro = $baseDatos->Registro()) {
            print_r($registro);
        }
    } else {
        echo "Error al ejecutar la consulta: " . $baseDatos->getError() . "\n";
    }
} else {
    echo "Error al conectar a la base de datos: " . $baseDatos->getError() . "\n";
}
?>
