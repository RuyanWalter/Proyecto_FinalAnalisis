<?php
//Modelo/GestorDeInventario.php
require_once 'configuracion/Database.php';

class GestorDeInventario {
    private static $instance;
    private $inventario;

    private function __construct() {
        $this->inventario = [];
        $this->cargarInventario();
    }

    public static function obtenerInstancia() {
        if (!isset(self::$instance)) {
            self::$instance = new GestorDeInventario();
        }
        return self::$instance;
    }

    private function cargarInventario() {
        $conn = Database::getConnection();
        $stmt = $conn->query("SELECT * FROM InventarioMateriaPrima");
        $this->inventario = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarInventario($idMateriaPrima, $cantidad) {
        $conn = Database::getConnection();
        $sql = "UPDATE InventarioMateriaPrima SET stock_actual = :cantidad WHERE id_materia_prima = :id_materia_prima";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':cantidad' => $cantidad,
            ':id_materia_prima' => $idMateriaPrima
        ]);
    }

    public function obtenerInventario() {
        return $this->inventario;
    }
}
?>
