<?php
require_once '../config/database.php'; // Asegúrate de que la conexión a la base de datos esté configurada

class Empleados {
    public static function obtenerEmpleados() {
        $conn = Database::getConnection();
        $stmt = $conn->query("SELECT * FROM Empleados"); // Asegúrate de que esta tabla existe
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
