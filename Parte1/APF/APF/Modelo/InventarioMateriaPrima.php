<?php
// Modelo/InventarioMateriaPrima.php
class InventarioMateriaPrima {
    private $conn;
    private $table_name_ingreso = "IngresoMateriaPrima";
    private $table_name_egreso = "EgresoMateriaPrima";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para obtener los datos de inventario con ingresos y egresos
    public function obtenerInventarioCompleto() {
        $query = "
            SELECT 
                im.codigo_materia_prima,
                im.nombre_materia_prima,
                im.unidad_medida,
                SUM(im.cantidad_comprada) AS total_ingreso,  -- Suma de todos los ingresos de materia prima
                IFNULL(SUM(em.cantidad_egresada), 0) AS total_egreso,  -- Suma de los egresos de materia prima, si existen
                (SUM(im.cantidad_comprada) - IFNULL(SUM(em.cantidad_egresada), 0)) AS saldo_actual  -- Cálculo del saldo actual
            FROM 
                " . $this->table_name_ingreso . " im
            LEFT JOIN 
                " . $this->table_name_egreso . " em
            ON 
                im.id_ingreso = em.id_ingreso
            GROUP BY 
                im.codigo_materia_prima, im.nombre_materia_prima, im.unidad_medida";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
