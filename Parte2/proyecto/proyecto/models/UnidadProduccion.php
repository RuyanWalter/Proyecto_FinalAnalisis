<?php
require_once '../config/database.php';

class UnidadProduccion {
    // Método para obtener todas las unidades de producción disponibles
    public static function obtenerUnidades() {
        $conn = Database::getConnection();
        $stmt = $conn->query("SELECT * FROM UnidadesProduccion");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
