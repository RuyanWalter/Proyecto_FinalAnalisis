<?php
//Modelo/Usuario.php
require_once 'configuracion/Database.php';

class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los usuarios (empleados) para los formularios
    public static function obtenerUsuarios() {
        $db = Database::getConnection();
        $query = "SELECT * FROM Usuarios";  // Ajusta el nombre de la tabla según tu base de datos
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
