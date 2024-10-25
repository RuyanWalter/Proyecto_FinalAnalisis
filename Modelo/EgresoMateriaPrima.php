<?php
// Modelo/EgresoMateriaPrima.php
require_once 'configuracion/Database.php';

class EgresoMateriaPrima {
    public static function registrarEgreso($codigoMateriaPrima, $cantidadEgresada, $idProduccion) {
        $db = Database::getConnection();
        $query = "INSERT INTO egresomateriaprima (codigo_materia_prima, cantidad_egresada, fecha_egreso, id_produccion) 
                  VALUES (:codigo_materia_prima, :cantidad_egresada, :fecha_egreso, :id_produccion)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':codigo_materia_prima' => $codigoMateriaPrima,
            ':cantidad_egresada' => $cantidadEgresada,
            ':fecha_egreso' => date('Y-m-d'),
            ':id_produccion' => $idProduccion
        ]);
    }
}
?>
