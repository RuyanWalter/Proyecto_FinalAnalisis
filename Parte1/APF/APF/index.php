<?php
// Variables de controlador y acción
$controlador = isset($_GET['controlador']) ? filter_var($_GET['controlador'], FILTER_SANITIZE_SPECIAL_CHARS) : 'MateriaPrima';
$accion = isset($_GET['accion']) ? filter_var($_GET['accion'], FILTER_SANITIZE_SPECIAL_CHARS) : 'listar';

// Si la acción es controlarInventario, cargar el controlador de Inventario
if ($accion == 'controlarInventario') {
    $controlador = 'Inventario';
    $accion = 'mostrarInventarioCompleto';
}

// Si la acción es 'ordenesCompra', cargar el controlador de OrdenesCompra
if ($accion == 'ordenesCompra') {
    $controlador = 'OrdenesCompra';  // Cambiado a 'OrdenesCompra' para coincidir con el archivo del controlador
    $accion = 'listarOrdenes';  // Cambiar la acción a 'listarOrdenes' para mostrar las órdenes
}

// Verificar si la acción es buscar y procesar los filtros de búsqueda
if ($accion == 'buscar') {
    $codigo = isset($_GET['codigo']) ? filter_var($_GET['codigo'], FILTER_SANITIZE_SPECIAL_CHARS) : '';
    $fecha = isset($_GET['fecha']) ? filter_var($_GET['fecha'], FILTER_SANITIZE_SPECIAL_CHARS) : '';
}

// Ubicar el archivo del controlador correspondiente
$controladorArchivo = "Controlador/{$controlador}Controlador.php";
if (file_exists($controladorArchivo)) {
    require_once $controladorArchivo;

    $nombreControlador = "{$controlador}Controlador";

    if (class_exists($nombreControlador)) {
        $controlador = new $nombreControlador();

        // Verificar si el método o acción existe en el controlador
        if (method_exists($controlador, $accion)) {
            $controlador->$accion();
        } else {
            echo "Error: La acción '{$accion}' no existe.";
        }
    } else {
        echo "Error: El controlador '{$nombreControlador}' no existe.";
    }
} else {
    echo "Error: El archivo del controlador '{$controladorArchivo}' no se encuentra.";
}
?>
