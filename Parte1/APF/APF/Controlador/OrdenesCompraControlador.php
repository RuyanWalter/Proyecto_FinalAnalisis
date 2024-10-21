<?php
//Controlador/OrdenesCompraControlador.php
require_once __DIR__ . '/../Modelo/OrdenCompra.php';
require_once __DIR__ . '/../Modelo/GestorDeInventario1.php';
require_once __DIR__ . '/../Configuracion/Database.php';

class OrdenesCompraControlador {
    private $ordenCompra;
    private $gestorInventario;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->ordenCompra = new OrdenCompra($db);
        $this->gestorInventario = GestorDeInventario1::obtenerInstancia($db);
    }

    public function generarOrdenesAutomaticas() {
        // Consultar el inventario y verificar si los niveles están bajos
        $materiasPrimas = $this->gestorInventario->obtenerMateriasPrimasConBajoInventario();

        if (!empty($materiasPrimas)) {
            foreach ($materiasPrimas as $materiaPrima) {
                // Generar una orden de compra
                $this->ordenCompra->crearOrdenCompra($materiaPrima['codigo_materia_prima'], $materiaPrima['cantidad_requerida']);
            }
        }
    }

    public function listarOrdenes() {
        $ordenes = $this->ordenCompra->obtenerOrdenesCompra();
        // Cambia el nombre del archivo requerido aquí
        require __DIR__ . '/../Vista/ordenCompraVista.php';  // Corregido para coincidir con el nombre del archivo real
    }

    public function confirmarOrden($id_orden) {
        $this->ordenCompra->confirmarOrdenCompra($id_orden);
        header('Location: index.php?accion=verOrdenes');
    }
}
?>
