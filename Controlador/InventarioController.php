<?php
// Controlador/InventarioControlador1.php
require_once __DIR__ . '/../Modelo/InventarioMateriaPrima.php';
require_once __DIR__ . '/../Configuracion/Database.php';

class InventarioController {  // Cambiado el nombre de la clase a InventarioControlador1
    private $inventario;

    public function __construct() {
        // Llamada correcta al método estático
        $db = Database::getConnection();
        $this->inventario = new InventarioMateriaPrima($db);
    }

    // Método para mostrar el inventario completo
    public function mostrarInventarioCompleto() {
        $inventario = $this->inventario->obtenerInventarioCompleto();
        require_once 'Vista/inventarioMateriaPrima.php';
    }
}

?>
