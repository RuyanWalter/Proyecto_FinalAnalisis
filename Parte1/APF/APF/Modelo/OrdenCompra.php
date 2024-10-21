<?php
class OrdenCompra {
    private $conn;
    private $table_name = "OrdenesCompra";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearOrdenCompra($codigo_materia_prima, $cantidad_pedida) {
        $query = "INSERT INTO " . $this->table_name . " (codigo_materia_prima, cantidad_pedida, fecha_orden, estado) 
                  VALUES (:codigo, :cantidad, NOW(), 'Pendiente')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo_materia_prima);
        $stmt->bindParam(':cantidad', $cantidad_pedida);
        $stmt->execute();
    }

    public function obtenerOrdenesCompra() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_orden DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function confirmarOrdenCompra($id_orden) {
        $query = "UPDATE " . $this->table_name . " SET estado = 'Confirmada' WHERE id_orden_compra = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id_orden);
        $stmt->execute();
    }
}
?>
