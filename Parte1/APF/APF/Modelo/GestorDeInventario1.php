<?php
//Modelo/GestorDeInventario1.php
class GestorDeInventario1 {
    private static $instancia = null;
    private $conn;

    // Constructor privado para evitar la creación de múltiples instancias
    private function __construct($db) {
        $this->conn = $db;
    }

    // Método para obtener la única instancia de la clase
    public static function obtenerInstancia($db) {
        if (self::$instancia === null) {
            self::$instancia = new GestorDeInventario1($db);
        }
        return self::$instancia;
    }

    // Obtener la conexión a la base de datos
    public function getConnection() {
        return $this->conn;
    }

    // Método para agregar materia prima al inventario
    public function agregarMateriaPrima($codigo, $cantidad) {
        $sql = "UPDATE IngresoMateriaPrima 
                SET cantidad_comprada = cantidad_comprada + :cantidad 
                WHERE codigo_materia_prima = :codigo";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cantidad' => $cantidad, ':codigo' => $codigo]);
    }

    // Método para retirar materia prima del inventario
    public function retirarMateriaPrima($codigo, $cantidad) {
        $sql = "UPDATE IngresoMateriaPrima 
                SET cantidad_comprada = cantidad_comprada - :cantidad 
                WHERE codigo_materia_prima = :codigo AND cantidad_comprada >= :cantidad";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cantidad' => $cantidad, ':codigo' => $codigo]);
    }

    // Método para consultar el inventario de una materia prima
    public function consultarInventario($codigo) {
        $sql = "SELECT cantidad_comprada 
                FROM IngresoMateriaPrima 
                WHERE codigo_materia_prima = :codigo";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
