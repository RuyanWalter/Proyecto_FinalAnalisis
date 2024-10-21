<?php
require_once __DIR__ . '/Configuracion/Database.php';

// Intentar realizar la conexión a la base de datos
$db = (new Database())->getConnection();

// Verificar si la conexión fue exitosa
if ($db) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error en la conexión a la base de datos.";
}
?>
