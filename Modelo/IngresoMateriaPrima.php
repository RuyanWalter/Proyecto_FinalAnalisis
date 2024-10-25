<?php
//Modelo/IngresoMateriaPrima.php
require_once 'configuracion/Database.php';

class IngresoMateriaPrima {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las materias primas disponibles
    public static function obtenerMateriasPrimas() {
        $db = Database::getConnection();
        $query = "SELECT * FROM ingresomateriaprima";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Restar la cantidad usada de cantidad_comprada
    public static function restarCantidadComprada($codigoMateriaPrima, $cantidadUsada) {
        $db = Database::getConnection();
        $query = "UPDATE ingresomateriaprima SET cantidad_comprada = cantidad_comprada - :cantidad_usada
                  WHERE codigo_materia_prima = :codigo_materia_prima AND cantidad_comprada >= :cantidad_usada";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':cantidad_usada' => $cantidadUsada,
            ':codigo_materia_prima' => $codigoMateriaPrima
        ]);

        if ($stmt->rowCount() == 0) {
            throw new Exception("No hay suficiente cantidad de materia prima disponible.");
        }
    }
}
?>


