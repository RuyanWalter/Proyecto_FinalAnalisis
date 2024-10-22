<?php
require_once '../config/database.php';

class MateriaPrima {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las materias primas para los formularios
    public static function obtenerMateriasPrimas() {
        $db = Database::getConnection();
        $query = "SELECT * FROM MateriaPrima";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
