<?php
// Modelo/InventarioMateriaPrima1.php
class InventarioMateriaPrima {
    private $conn;
    private $table_name = "inventariomateriaprima";  // Actualización para usar la tabla correcta

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para obtener los datos del inventario
    public function obtenerInventarioCompleto() {
        $query = "
            SELECT 
                codigo_materia_prima,
                nombre_materia_prima,
                unidad_medida,
                total_ingreso,
                total_egreso,
                saldo_actual
            FROM 
                " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
