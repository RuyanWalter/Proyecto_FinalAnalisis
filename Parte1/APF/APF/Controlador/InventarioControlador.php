<?php
// Controlador/InventarioControlador.php
require_once __DIR__ . '/../Modelo/InventarioMateriaPrima.php';
require_once __DIR__ . '/../Configuracion/Database.php';

class InventarioControlador {
    private $inventario;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->inventario = new InventarioMateriaPrima($db);
    }

    // Método para mostrar el inventario completo con ingreso, egreso y saldo
    public function mostrarInventarioCompleto() {
        $inventario = $this->inventario->obtenerInventarioCompleto();
        require __DIR__ . '/../Vista/inventarioMateriaPrima.php';  // Cargar la vista para mostrar el inventario
    }
}

?>
