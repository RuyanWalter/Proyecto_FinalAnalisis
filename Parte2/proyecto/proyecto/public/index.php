<?php
// Enrutamiento básico
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {
    case '/produccion/planificar':
        require_once '../controllers/ProduccionController.php';
        $controller = new ProduccionController();
        $controller->planificar();
        break;

    case '/produccion/asignar_tarea':
        require_once '../controllers/ProduccionController.php';
        $controller = new ProduccionController();
        $controller->asignarTarea();
        break;

    case '/produccion/generar_informe':
        require_once '../controllers/ProduccionController.php';
        $controller = new ProduccionController();
        $controller->generarInforme();
        break;

    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;

    // Rutas para tareas
    case '/tarea/asignar':
        require_once '../controllers/TareaController.php';
        $controller = new TareaController();
        $controller->asignar();
        break;

    case '/tarea/eliminar':
        require_once '../controllers/TareaController.php';
        $controller = new TareaController();
        $controller->eliminar();
        break;

    case '/tarea/completar':
        require_once '../controllers/TareaController.php';
        $controller = new TareaController();
        $controller->completar();
        break;

    
      // Nueva ruta para informe detallado
    case '/produccion/informe_detallado':
        require_once '../controllers/ProduccionController.php';
        $controller = new ProduccionController();
        $controller->generarInformeDetallado();
        break;

        // Ruta para cambiar el estado de la producción
    case '/produccion/cambiar_estado':
        require_once '../controllers/ProduccionController.php';
        $controller = new ProduccionController();
        $controller->cambiarEstado();
        break;

    case '/produccion/cambiar_estado':
        require_once '../controllers/ProduccionController.php';
        $controller = new ProduccionController();
        $controller->cambiarEstado();
        break;


    


}

?>

