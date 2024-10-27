<?php

// Inicializar variables para evitar el warning
$controlador = null;
$accion = null;

// Obtener la URL solicitada
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Eliminar "index.php" de la ruta si está presente
$request = str_replace('/index.php', '', $request);

// Si la URL contiene parámetros `controlador` y `accion`, procesarlos
if (isset($_GET['controlador']) || isset($_GET['accion'])) {
    $controlador = isset($_GET['controlador']) ? filter_var($_GET['controlador'], FILTER_SANITIZE_SPECIAL_CHARS) : 'MateriaPrima';
    $accion = isset($_GET['accion']) ? filter_var($_GET['accion'], FILTER_SANITIZE_SPECIAL_CHARS) : 'listar';

    // Si la acción es controlarInventario, cargar el controlador de Inventario
    if ($accion == 'controlarInventario') {
        $controlador = 'Inventario';
        $accion = 'mostrarInventarioCompleto';
    }

    // Si la acción es 'ordenesCompra', cargar el controlador de OrdenesCompra
    if ($accion == 'ordenesCompra') {
        $controlador = 'OrdenesCompra';
        $accion = 'listarOrdenes';
    }

    // Verificar si la acción es buscar y procesar los filtros de búsqueda
    if ($accion == 'buscar') {
        $codigo = isset($_GET['codigo']) ? filter_var($_GET['codigo'], FILTER_SANITIZE_SPECIAL_CHARS) : '';
        $fecha = isset($_GET['fecha']) ? filter_var($_GET['fecha'], FILTER_SANITIZE_SPECIAL_CHARS) : '';
    }
} else {
    // Si no hay parámetros en la URL, procesar las rutas específicas
    switch ($request) {
        // Rutas de producción
        case '/produccion/planificar':
            $controlador = 'Produccion';
            $accion = 'planificar';
            break;
        case '/produccion/asignar_tarea':
            $controlador = 'Produccion';
            $accion = 'asignarTarea';
            break;
        case '/produccion/generar_informe':
            $controlador = 'Produccion';
            $accion = 'generarInforme';
            break;
        case '/produccion/informe_detallado':
            $controlador = 'Produccion';
            $accion = 'generarInformeDetallado';
            break;
        case '/produccion/cambiar_estado':
            $controlador = 'Produccion';
            $accion = 'cambiarEstado';
            break;

        // Rutas de Tarea
        case '/tarea/asignar':
            $controlador = 'Tarea';
            $accion = 'asignar';
            break;
        case '/tarea/eliminar':
            $controlador = 'Tarea';
            $accion = 'eliminar';
            break;
        case '/tarea/completar':
            $controlador = 'Tarea';
            $accion = 'completar';
            break;
        case '/tarea/mostrar':
            $controlador = 'Tarea';
            $accion = 'mostrarTareas';
            break;

        // Rutas de Materia Prima (nuevas)
        case '/materiaprima/crear':
            $controlador = 'MateriaPrima';
            $accion = 'crear';
            break;
        case '/materiaprima/guardar':
            $controlador = 'MateriaPrima';
            $accion = 'guardar';
            break;
        case '/materiaprima/buscar':
            $controlador = 'MateriaPrima';
            $accion = 'buscar';
            break;
        case '/materiaprima/editar':
            $controlador = 'MateriaPrima';
            $accion = 'editar';
            break;
        case '/materiaprima/actualizar':
            $controlador = 'MateriaPrima';
            $accion = 'actualizar';
            break;
        case '/materiaprima/borrar':
            $controlador = 'MateriaPrima';
            $accion = 'borrar';
            break;

        default:
            break;  // Si no coincide con ninguna ruta específica, sigue con el procesamiento normal
    }
}

// Si no hay controlador o acción definidos, mostrar la vista "Seleccionar Módulo"
if (!$controlador || !$accion) {
    require_once 'Vista/seleccionarModulo.php';
    exit();
}

// Verificar si el controlador y la acción existen
$controladorArchivo = "Controlador/{$controlador}Controller.php";
$nombreControlador = "{$controlador}Controller";

// Verificar si el archivo del controlador existe
if (!file_exists($controladorArchivo)) {
    echo "Error: El archivo del controlador '{$controladorArchivo}' no se encuentra.";
    exit();
}

require_once $controladorArchivo;

// Verificar si la clase del controlador existe
if (!class_exists($nombreControlador)) {
    echo "Error: El controlador '{$nombreControlador}' no existe.";
    exit();
}

$controladorObj = new $nombreControlador();

// Verificar si la acción del controlador existe
if (!method_exists($controladorObj, $accion)) {
    echo "Error: La acción '{$accion}' no existe en el controlador '{$nombreControlador}'.";
    exit();
}

// Ejecutar la acción
$controladorObj->$accion();
