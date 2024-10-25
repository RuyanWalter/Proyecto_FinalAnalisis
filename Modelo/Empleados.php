<?php
//Modelo/Empleados.php
require_once 'configuracion/Database.php'; 

class Empleados {
    public static function obtenerEmpleados() {
        $conn = Database::getConnection();
        $stmt = $conn->query("SELECT * FROM Empleados"); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
